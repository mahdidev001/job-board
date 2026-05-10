# UI Components Visual Reference

## Quick Navigation

- [Buttons](#buttons)
- [Forms](#forms)
- [Cards](#cards)
- [Navigation](#navigation)
- [Alerts](#alerts)
- [Badges](#badges)
- [Modals](#modals)
- [Tables](#tables)
- [Typography](#typography)

---

## BUTTONS

### Primary Button

```blade
<button class="btn btn-primary">
  Click Me
</button>
```

**Appearance**: Blue gradient background, white text, shadow, hover effect

### Secondary Button

```blade
<button class="btn btn-secondary">
  Cancel
</button>
```

**Appearance**: Gray background, dark text, subtle shadow

### Outline Button

```blade
<button class="btn btn-outline">
  Learn More
</button>
```

**Appearance**: Blue border, transparent background, blue text

### Danger Button

```blade
<button class="btn btn-danger">
  Delete
</button>
```

**Appearance**: Red/Pink gradient, white text, destructive action

### Small Button

```blade
<button class="btn btn-primary btn-small">
  Apply
</button>
```

**Appearance**: Smaller padding, compact size

### Button States

```blade
<!-- Disabled -->
<button class="btn btn-primary" disabled>
  Processing...
</button>

<!-- Loading -->
<button class="btn btn-primary">
  <svg class="loading-spinner mr-2"></svg>
  Saving...
</button>
```

---

## FORMS

### Input Group

```blade
<div class="form-group">
  <label class="form-label">Email Address</label>
  <input type="email" class="form-input"
         placeholder="you@example.com">
</div>
```

**Features**: Label, input field, placeholder, focus state

### Input with Error

```blade
<div class="form-group">
  <label class="form-label">Password</label>
  <input type="password" class="form-input form-input-error">
  <p class="form-error">Password is required</p>
</div>
```

**Features**: Red border, error message display

### Select Input

```blade
<div class="form-group">
  <label class="form-label">Category</label>
  <select class="form-input">
    <option>Option 1</option>
    <option>Option 2</option>
  </select>
</div>
```

### Textarea

```blade
<div class="form-group">
  <label class="form-label">Message</label>
  <textarea rows="6" class="form-input"
            placeholder="Enter your message..."></textarea>
</div>
```

### Checkbox

```blade
<div class="form-group">
  <label class="flex items-center gap-2">
    <input type="checkbox" class="w-4 h-4">
    <span>I agree to terms</span>
  </label>
</div>
```

### Radio Buttons

```blade
<div class="form-group">
  <label class="flex items-center gap-2">
    <input type="radio" name="role" value="user">
    <span>Job Seeker</span>
  </label>
  <label class="flex items-center gap-2">
    <input type="radio" name="role" value="employer">
    <span>Employer</span>
  </label>
</div>
```

---

## CARDS

### Basic Card

```blade
<div class="card">
  <h3 class="card-title">Card Title</h3>
  <p>Card content goes here...</p>
</div>
```

**Features**: White background, rounded corners, shadow, hover effect

### Card with Header

```blade
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Section Title</h3>
  </div>
  <p>Card content with border header...</p>
</div>
```

### Card with Image

```blade
<div class="card overflow-hidden">
  <img src="image.jpg" alt="Card image" class="w-full h-48 object-cover">
  <div class="p-6">
    <h3 class="card-title">Card Title</h3>
    <p>Description...</p>
  </div>
</div>
```

---

## NAVIGATION

### Navbar

```blade
<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-brand">JobHub</div>
    <ul class="navbar-menu">
      <li><a class="navbar-link" href="/">Home</a></li>
      <li><a class="navbar-link" href="/jobs">Jobs</a></li>
      <li><a class="navbar-link" href="/contact">Contact</a></li>
    </ul>
  </div>
</nav>
```

### Active Link

```blade
<a class="navbar-link text-blue-600 dark:text-blue-400" href="/jobs">
  Jobs
</a>
```

---

## ALERTS

### Info Alert

```blade
<div class="alert alert-info">
  <svg class="w-5 h-5"><!-- icon --></svg>
  <span>This is an informational message</span>
</div>
```

### Success Alert

```blade
<div class="alert alert-success">
  <svg class="w-5 h-5"><!-- check icon --></svg>
  <span>Operation completed successfully!</span>
</div>
```

### Error Alert

```blade
<div class="alert alert-error">
  <svg class="w-5 h-5"><!-- error icon --></svg>
  <span>An error occurred. Please try again.</span>
</div>
```

### Warning Alert

```blade
<div class="alert alert-warning">
  <svg class="w-5 h-5"><!-- warning icon --></svg>
  <span>Please review this information</span>
</div>
```

---

## BADGES

### Primary Badge

```blade
<span class="badge badge-primary">Featured</span>
```

### Secondary Badge

```blade
<span class="badge badge-secondary">2 weeks ago</span>
```

### Success Badge

```blade
<span class="badge badge-success">Available</span>
```

### Warning Badge

```blade
<span class="badge badge-warning">Highlighted</span>
```

### Danger Badge

```blade
<span class="badge badge-danger">Urgent</span>
```

### Badge Groups

```blade
<div class="flex gap-2">
  <span class="badge badge-primary">PHP</span>
  <span class="badge badge-primary">Laravel</span>
  <span class="badge badge-primary">MySQL</span>
</div>
```

---

## MODALS

### Modal Dialog

```blade
<dialog id="myModal" class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg mb-4">Dialog Title</h3>

    <p>Modal content goes here...</p>

    <div class="modal-action">
      <button onclick="myModal.close()" class="btn btn-secondary">
        Close
      </button>
      <button class="btn btn-primary">
        Confirm
      </button>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<!-- Trigger -->
<button onclick="document.getElementById('myModal').showModal()"
        class="btn btn-primary">
  Open Modal
</button>
```

---

## TABLES

### Basic Table

```blade
<table class="table w-full">
  <thead class="table-header">
    <tr>
      <th class="table-cell">Column 1</th>
      <th class="table-cell">Column 2</th>
      <th class="table-cell">Column 3</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-row">
      <td class="table-cell">Data 1</td>
      <td class="table-cell">Data 2</td>
      <td class="table-cell">Data 3</td>
    </tr>
  </tbody>
</table>
```

---

## TYPOGRAPHY

### Headings

```blade
<h1>This is H1 - Main Heading</h1>
<h2>This is H2 - Page Title</h2>
<h3>This is H3 - Section Title</h3>
<h4>This is H4 - Subsection</h4>
<h5>This is H5 - Minor Heading</h5>
<h6>This is H6 - Smallest Heading</h6>
```

### Paragraph

```blade
<p>This is regular paragraph text with normal font weight and line height.</p>
<p class="text-gray-500">This is secondary text with gray color.</p>
<p class="text-sm">Small text for details and helpers.</p>
<p class="text-xs">Extra small text for captions.</p>
```

### Text Styles

```blade
<strong>Bold text</strong>
<em>Italic text</em>
<u>Underlined text</u>
<code>Code snippet</code>
<del>Deleted text</del>
```

### Text Colors

```blade
<p class="text-gray-900">Dark text</p>
<p class="text-gray-700">Normal text</p>
<p class="text-gray-500">Secondary text</p>
<p class="text-blue-600">Primary color</p>
<p class="text-green-600">Success color</p>
<p class="text-red-600">Error color</p>
```

### Text Alignment

```blade
<p class="text-left">Left aligned</p>
<p class="text-center">Center aligned</p>
<p class="text-right">Right aligned</p>
</code>
```

---

## LAYOUT COMPONENTS

### Hero Section

```blade
<section class="bg-gradient-to-r from-blue-600 to-indigo-600
                dark:from-gray-800 dark:to-gray-900 text-white py-12">
  <div class="max-w-7xl mx-auto px-4">
    <h1 class="text-4xl font-bold mb-2">Hero Title</h1>
    <p class="text-blue-100 dark:text-gray-300">Hero subtitle</p>
  </div>
</section>
```

### Container

```blade
<div class="max-w-7xl mx-auto px-4">
  <!-- Content -->
</div>
```

### Grid Layout (3 columns)

```blade
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  <div>Column 1</div>
  <div>Column 2</div>
  <div>Column 3</div>
</div>
```

### Flex Layout

```blade
<div class="flex items-center justify-between gap-4">
  <div>Left side</div>
  <div>Right side</div>
</div>
```

### Spacing Utilities

```blade
<!-- Margin -->
<div class="mb-6">With margin bottom</div>

<!-- Padding -->
<div class="p-6">With padding</div>

<!-- Gap -->
<div class="flex gap-4">
  <div>Item 1</div>
  <div>Item 2</div>
</div>
```

---

## RESPONSIVE PATTERNS

### Mobile-First

```blade
<!-- Mobile (default) -->
<div class="flex flex-col">
  <!-- Mobile layout -->
</div>

<!-- Tablet and up -->
<div class="flex flex-col md:flex-row">
  <!-- Tablet+ shows side by side -->
</div>
```

### Responsive Visibility

```blade
<!-- Hidden on mobile, visible on md+ -->
<div class="hidden md:block">Desktop only</div>

<!-- Visible on mobile, hidden on md+ -->
<div class="block md:hidden">Mobile only</div>
```

### Responsive Text

```blade
<!-- Text size changes -->
<h1 class="text-2xl md:text-3xl lg:text-4xl">
  Responsive heading
</h1>
```

### Responsive Padding

```blade
<!-- Padding changes -->
<div class="px-4 md:px-6 lg:px-8">
  Responsive padding
</div>
```

---

## DARK MODE EXAMPLES

### Conditional Colors

```blade
<!-- Light: white, Dark: gray-800 -->
<div class="bg-white dark:bg-gray-800">
  <!-- Light: gray-900, Dark: white -->
  <p class="text-gray-900 dark:text-white">
    Text that adapts to dark mode
  </p>
</div>
```

### Dark Mode Forms

```blade
<input type="text" class="form-input">
<!-- Light: white bg with gray border
     Dark: gray-700 bg with gray-600 border -->
```

### Dark Mode Cards

```blade
<div class="card">
  <!-- Light: white bg, shadow-md
       Dark: gray-800 bg, darker shadow -->
</div>
```

---

## INTERACTIVE COMPONENTS

### Dropdown Menu (HTML + CSS ready)

```blade
<div class="relative">
  <button class="btn btn-secondary">Menu</button>
  <div class="absolute hidden">
    <a href="#" class="block px-4 py-2">Option 1</a>
    <a href="#" class="block px-4 py-2">Option 2</a>
  </div>
</div>
```

### Tabs (JavaScript ready)

```blade
<div class="flex border-b">
  <button class="px-4 py-2 border-b-2 border-blue-600">Tab 1</button>
  <button class="px-4 py-2 border-b-2 border-transparent">Tab 2</button>
</div>
<div>Tab 1 content</div>
```

### Accordion (JavaScript ready)

```blade
<details class="border rounded-lg p-4 mb-2">
  <summary class="font-bold cursor-pointer">Section 1</summary>
  <p class="mt-4">Content for section 1...</p>
</details>
```

---

## EMPTY STATES

### No Data Found

```blade
<div class="empty-state">
  <svg class="empty-state-icon"><!-- icon --></svg>
  <h3 class="empty-state-title">No results found</h3>
  <p class="empty-state-text">Try adjusting your search filters</p>
  <button class="btn btn-primary">Clear filters</button>
</div>
```

---

## LOADING STATES

### Spinner

```blade
<svg class="loading-spinner"><!-- spinner --></svg>
```

### Loading Button

```blade
<button class="btn btn-primary" disabled>
  <svg class="loading-spinner inline mr-2"></svg>
  Loading...
</button>
```

### Pulse Animation

```blade
<div class="loading-pulse">
  <div class="h-12 bg-gray-200 rounded"></div>
</div>
```

---

## ANIMATIONS

### Fade In

```css
@apply animate-fade-in;
```

### Slide In

```css
@apply animate-slide-in;
```

### Bounce

```css
@apply animate-bounce-sm;
```

---

## SPACING GUIDE

### Common Spacings

```
xs:  4px
sm:  8px
md:  12px
lg:  16px
xl:  24px
2xl: 32px
3xl: 48px
4xl: 64px
```

### Usage Examples

```blade
<div class="mb-6">Margin bottom 24px</div>
<div class="p-6">Padding 24px all sides</div>
<div class="px-4 py-6">Padding X 16px, Y 24px</div>
<div class="gap-4">Gap 16px between items</div>
```

---

## BREAKPOINTS GUIDE

```
Default:    Mobile (< 640px)
sm:         Small devices (≥ 640px)
md:         Medium devices (≥ 768px) ← Tablets
lg:         Large devices (≥ 1024px) ← Desktops
xl:         Extra large (≥ 1280px)
2xl:        Huge screens (≥ 1536px)
```

### Responsive Examples

```blade
<!-- One column mobile, two on tablet, three on desktop -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
  <div>Item 1</div>
  <div>Item 2</div>
  <div>Item 3</div>
</div>

<!-- Hidden on mobile, shown on tablet+ -->
<div class="hidden md:block">
  Desktop navigation
</div>

<!-- Different text sizes -->
<h1 class="text-xl md:text-2xl lg:text-4xl">
  Responsive heading
</h1>
```

---

## Common Patterns

### Card Grid

```blade
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  @foreach($items as $item)
    <div class="card">
      <!-- Card content -->
    </div>
  @endforeach
</div>
```

### Form with Buttons

```blade
<form action="#" class="space-y-6">
  <div class="form-group">
    <label class="form-label">Name</label>
    <input type="text" class="form-input">
  </div>

  <div class="flex gap-3">
    <button type="submit" class="btn btn-primary flex-1">Save</button>
    <button type="reset" class="btn btn-secondary flex-1">Cancel</button>
  </div>
</form>
```

### List with Actions

```blade
<div class="space-y-4">
  @foreach($items as $item)
    <div class="card flex items-center justify-between">
      <div>{{ $item->name }}</div>
      <div class="flex gap-2">
        <button class="btn btn-small btn-secondary">Edit</button>
        <button class="btn btn-small btn-danger">Delete</button>
      </div>
    </div>
  @endforeach
</div>
```

---

## Tips & Tricks

1. **Always use `space-y-` for vertical spacing in lists**

    ```blade
    <div class="space-y-4">
      <div>Item 1</div>
      <div>Item 2</div>
    </div>
    ```

2. **Use `flex` with `justify-between` for left-right alignment**

    ```blade
    <div class="flex justify-between items-center">
      <span>Left</span>
      <span>Right</span>
    </div>
    ```

3. **Use `grid` for complex layouts**

    ```blade
    <div class="grid grid-cols-3 gap-4">
      <!-- 3 equal columns -->
    </div>
    ```

4. **Always include `dark:` variants for dark mode**

    ```blade
    <div class="bg-white dark:bg-gray-800">
      <!-- Light and dark backgrounds -->
    </div>
    ```

5. **Use `md:` for tablet breakpoint**
    ```blade
    <div class="grid grid-cols-1 md:grid-cols-2">
      <!-- 1 col mobile, 2 cols tablet+ -->
    </div>
    ```

---

**Last Updated**: 2024
**Version**: 1.0
