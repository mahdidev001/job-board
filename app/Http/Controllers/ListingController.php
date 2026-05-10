<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

\Stripe\Stripe::setApiKey(config('services.stripe.secret'));



class ListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::where('is_active', true)->with('tags')->latest();

        if ($request->has('tag')) {
            $tag = $request->get('tag');
            $query->whereHas('tags', function (Builder $builder) use ($tag) {
                $builder->where('slug', $tag);
            });
        }

        $listings = $query->get();

        if ($request->has('s')) {
            $search = strtolower($request->get('s'));
            $listings = $listings->filter(function ($listing) use ($search) {
                return Str::contains(strtolower($listing->title), $search) ||
                       Str::contains(strtolower($listing->company), $search) ||
                       Str::contains(strtolower($listing->location), $search);
            });
        }

        $tags = Tag::orderBy('name')->get();

        return view('listings.index', compact('listings', 'tags'));
    }

    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    public function apply(Listing $listing, Request $request)
    {
        $listing->clicks()->create([
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip()
        ]);

        return redirect()->to($listing->apply_link);
    }

    public function create()
    {
        // Only employers can create listings
        if (auth()->user()->role !== 'employer') {
            return redirect()->route('listings.index')
                ->with('error', 'Only employers can post jobs. Please upgrade your account to employer to post jobs.');
        }
        return view('listings.create');
    }

  


    public function store(Request $request)
    {
        // Only employers can store listings
        if (Auth::check() && Auth::user()->role !== 'employer') {
            return redirect()->route('listings.index')
                ->with('error', 'Only employers can post jobs. Please upgrade your account to employer to post jobs.');
        }

    // Validation
    $validationArray = [
        'title' => 'required',
        'company' => 'required',
        'logo' => 'nullable|file|max:2048',
        'location' => 'required',
        'url' => 'required|url',
        'description' => 'required',
        'payment_method_id' => 'nullable'
    ];

    if (!Auth::check()) {
        $validationArray = array_merge($validationArray, [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'name' => 'required'
        ]);
    }

    $request->validate($validationArray);

    // Check if user is signed in, otherwise create
    $user = Auth::user();

    if (!$user) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employer'
        ]);

        $user->createAsStripeCustomer();
        Auth::login($user);
    }

    try {
        $amount = 10000; // 10,000 DA in cents
        if ($request->filled('is_highlighted')) {
            $amount += 5000;
        }

        // Stripe PaymentIntent
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
            'customer' => $user->stripe_id,
            'payment_method' => $request->payment_method_id,
            'payment_method_types' => ['card'], // force cards only
            'confirm' => true, // immediate confirmation
        ]);

        // Process listing creation
        $md = new \ParsedownExtra();

        $listing = $user->listings()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . rand(1111, 9999),
            'company' => $request->company,
            'logo' => $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : null,
            'location' => $request->location,
            'apply_link' => $request->url,
            'content' => $md->text($request->input('description')),
            'salary_min' => $request->filled('salary_min') ? intval($request->salary_min) : null,
            'salary_max' => $request->filled('salary_max') ? intval($request->salary_max) : null,
            'is_highlighted' => $request->filled('is_highlighted'),
            'is_active' => true
        ]);

        // Attach tags
        foreach (explode(',', $request->tags) as $requestTag) {
            $tag = Tag::firstOrCreate(
                ['slug' => Str::slug(trim($requestTag))],
                ['name' => ucwords(trim($requestTag))]
            );
            $tag->listings()->attach($listing->id);
        }

        return redirect()->route('dashboard');

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

    public function destroy(Listing $listing)
    {
        // Check if user is authorized to delete
        if (Auth::user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized');
        }

        // Delete the listing
        $listing->delete();

        return redirect()->route('dashboard')->with('success', 'Listing deleted successfully');
    }

    public function edit(Listing $listing)
    {
        // Check if user is authorized to edit
        if (Auth::user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized');
        }

        return view('listings.edit', compact('listing'));
    }

    public function update(Listing $listing, Request $request)
    {
        // Check if user is authorized to update
        if (Auth::user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized');
        }

        // Validation
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'logo' => 'nullable|file|max:2048',
            'location' => 'required',
            'url' => 'required|url',
            'description' => 'required',
            'tags' => 'nullable|string'
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('logos', $filename, 'public');
            $listing->logo = 'logos/' . $filename;
        }

        // Update listing
        $md = new \ParsedownExtra();

        $listing->update([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'apply_link' => $request->url,
            'content' => $md->text($request->input('description')),
            'salary_min' => $request->filled('salary_min') ? intval($request->salary_min) : null,
            'salary_max' => $request->filled('salary_max') ? intval($request->salary_max) : null,
        ]);

        // Update tags
        if ($request->tags) {
            $tagNames = array_filter(array_map('trim', explode(',', $request->tags)));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tag = \App\Models\Tag::firstOrCreate(
                    ['slug' => \Illuminate\Support\Str::slug($tagName)],
                    ['name' => $tagName]
                );
                $tagIds[] = $tag->id;
            }
            $listing->tags()->sync($tagIds);
        }

        if ($request->has('logo')) {
            $listing->save();
        }

        return redirect()->route('dashboard')->with('success', 'Listing updated successfully');
    }

    public function applications(Listing $listing)
    {
        // Check if user is authorized to view
        if (Auth::user()->id !== $listing->user_id) {
            abort(403, 'Unauthorized');
        }

        $clicks = $listing->clicks()->latest()->get();

        return view('listings.applications', compact('listing', 'clicks'));
    }

    public function rate(Listing $listing, Request $request)
    {
        // Only regular users (not employers) can rate
        if (auth()->user()->role === 'employer') {
            return redirect()->back()->with('error', 'Only job seekers can rate listings.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500'
        ]);

        // Check if user already rated this listing
        $existingRating = \App\Models\Rating::where('user_id', auth()->id())
            ->where('listing_id', $listing->id)
            ->first();

        if ($existingRating) {
            $existingRating->update([
                'rating' => $request->rating,
                'review' => $request->review
            ]);
            return redirect()->back()->with('success', 'Your rating has been updated!');
        }

        \App\Models\Rating::create([
            'user_id' => auth()->id(),
            'listing_id' => $listing->id,
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return redirect()->back()->with('success', 'Thank you for rating this job listing!');
    }
}
