# Design System Guide

## 🎨 Color Palette

### Primary Colors

```
Blue-600:     #2563EB  (Primary Action)
Indigo-600:   #4F46E5  (Secondary Action)
Gradient:     Blue → Indigo
```

### Neutral Colors

```
White:        #FFFFFF  (Backgrounds)
Gray-50:      #F9FAFB  (Light backgrounds)
Gray-100:     #F3F4F6  (Light borders)
Gray-200:     #E5E7EB  (Borders)
Gray-700:     #374151  (Body text)
Gray-900:     #111827  (Headings)
Black:        #000000  (Dark elements)
```

### Status Colors

```
Green-600:    #16A34A  (Success)
Red-600:      #DC2626  (Error/Danger)
Yellow-600:   #CA8A04  (Warning)
Blue-600:     #2563EB  (Info)
```

### Dark Mode

```
Gray-800:     #1F2937  (Card backgrounds)
Gray-900:     #111827  (Page backgrounds)
Gray-950:     #030712  (Darkest)
```

---

## 📐 Typography

### Font Family

**Primary Font**: Inter

- Clean, modern
- Excellent readability
- Professional appearance
- Available from Google Fonts

### Font Sizes

```
h1:   2.25rem (36px)  - Section titles, heroes
h2:   1.875rem (30px) - Page titles
h3:   1.5rem (24px)   - Card titles
h4:   1.25rem (20px)  - Subsection titles
h5:   1.125rem (18px) - Labels
h6:   1rem (16px)     - Body text
sm:   0.875rem (14px) - Small text
xs:   0.75rem (12px)  - Tiny text
```

### Font Weights

```
400 (Normal):      Body text
500 (Medium):      Labels, badges
600 (Semibold):    Important text, badges, labels
700 (Bold):        Headings, strong emphasis
```

### Line Heights

```
Tight:    1.25 (Headings)
Snug:     1.375
Normal:   1.5 (Body text)
Relaxed:  1.625
Loose:    2
```

---

## 🎯 Spacing System

### 4px Grid System

```
1 unit   = 4px
2 units  = 8px
3 units  = 12px
4 units  = 16px (base)
6 units  = 24px
8 units  = 32px
12 units = 48px
16 units = 64px
```

### Common Spacings

```
xs: 4px
sm: 8px
md: 12px
lg: 16px
xl: 24px
2xl: 32px
3xl: 48px
4xl: 64px
```

---

## 🔲 Sizing

### Button Sizes

```
Small:       px-4 py-2
Regular:     px-6 py-3 (default)
Large:       px-8 py-4
Full:        w-full
```

### Card Dimensions

```
Small card:  400px max-width
Medium card: 600px max-width
Large card:  800px max-width
Full:        100% max-width
```

### Container Widths

```
sm: 640px
md: 768px
lg: 1024px
xl: 1280px
2xl: 1536px
7xl: 1280px (max-w-7xl)
```

---

## ✨ Border & Radius

### Border Widths

```
1px: Standard borders
2px: Input focus
4px: Focus rings
```

### Border Radius

```
sm: 0.25rem (2px)   - Subtle rounding
md: 0.5rem (4px)
lg: 0.75rem (6px)
xl: 1rem (8px)
2xl: 1.5rem (12px)  - Cards, large elements
3xl: 2rem (16px)
full: 9999px        - Badges, avatars
```

---

## 🎬 Shadows

### Shadow Levels

```
sm: 0 1px 3px rgba(0,0,0,0.1)
md: 0 4px 6px rgba(0,0,0,0.1)
lg: 0 10px 15px rgba(0,0,0,0.1)
xl: 0 20px 25px rgba(0,0,0,0.1)
2xl: 0 25px 50px rgba(0,0,0,0.25)
```

### Usage

```
Cards:        md shadow, lg on hover
Buttons:      lg shadow, xl on hover
Modals:       2xl shadow
Dropdowns:    md shadow
```

---

## 🎨 Component Styles

### Buttons

#### Primary Button

```css
Background:   Gradient (Blue → Indigo)
Text:         White
Padding:      px-6 py-3
Border:       None
Radius:       0.75rem
Shadow:       lg shadow, xl on hover
Transition:   All 200ms
State:
  - Hover: Darker gradient + shadow xl + lift
  - Focus: Ring-2 ring-blue-500
  - Disabled: Opacity 50%
```

#### Secondary Button

```css
Background:   Gray-200 (light) / Gray-700 (dark)
Text:         Gray-900 (light) / White (dark)
Padding:      px-6 py-3
Border:       None
Radius:       0.75rem
Shadow:       md shadow, lg on hover
State:
  - Hover: Darker gray
  - Focus: Ring-2 ring-gray-500
```

#### Outline Button

```css
Background:   Transparent
Border:       2px solid Blue-600
Text:         Blue-600
Padding:      px-6 py-3
Radius:       0.75rem
State:
  - Hover: Light blue background
  - Focus: Ring-2 ring-blue-500
```

### Forms

#### Input Fields

```css
Background:   White (light) / Gray-700 (dark)
Border:       2px solid Gray-300
Text:         Gray-900
Padding:      px-4 py-3
Radius:       0.75rem
Transition:   All 200ms

State:
  - Hover: Gray-400 border
  - Focus: Blue-500 ring + border transparent
  - Error: Red-500 border + ring
  - Disabled: Opacity 50%
```

#### Labels

```css
Font Size:    0.875rem
Font Weight:  600
Color:        Gray-700 (light) / Gray-300 (dark)
Margin:       0 0 8px 0
```

#### Error Message

```css
Font Size:    0.875rem
Color:        Red-600 (light) / Red-400 (dark)
Margin:       8px 0 0 0
Font Weight:  500
```

### Cards

#### Card Container

```css
Background:   White (light) / Gray-800 (dark)
Border:       1px solid Gray-100 (light) / Gray-700 (dark)
Padding:      24px (1.5rem)
Radius:       0.75rem
Shadow:       md shadow
Transition:   All 300ms

State:
  - Hover: lg shadow + transform translate-y -1px
```

#### Card Header

```css
Padding:      0 0 16px 0
Border:       1px solid Gray-200 (light) / Gray-700 (dark)
Margin:       0 0 16px 0
```

#### Card Title

```css
Font Size:    1.25rem
Font Weight:  700
Color:        Gray-900 (light) / White (dark)
```

### Navigation

#### Navbar

```css
Background:   White (light) / Gray-800 (dark)
Height:       64px
Padding:      16px horizontal
Position:     Sticky top-0
Z-Index:      50
Shadow:       lg shadow
Border:       1px bottom Gray-200 (light) / Gray-700 (dark)
```

#### Logo

```css
Font Size:    1.5rem
Font Weight:  700
Color:        Gradient (Blue → Indigo)
```

### Alerts

#### Alert Container

```css
Padding:      16px
Radius:       0.5rem
Border:       4px left solid [color]
Margin:       0 0 16px 0

Variants:
  Info:     bg-blue-50 text-blue-800 border-blue-500
  Success:  bg-green-50 text-green-800 border-green-500
  Error:    bg-red-50 text-red-800 border-red-500
  Warning:  bg-yellow-50 text-yellow-800 border-yellow-500
```

### Badges

#### Badge

```css
Padding:      px-3 py-1
Radius:       9999px (full)
Font Size:    0.875rem
Font Weight:  600
Inline-flex:  items-center center

Variants:
  Primary:    bg-blue-100 text-blue-800
  Secondary:  bg-gray-100 text-gray-800
  Success:    bg-green-100 text-green-800
  Warning:    bg-yellow-100 text-yellow-800
  Danger:     bg-red-100 text-red-800
```

---

## 🎬 Animations

### Timing

```
Fast:     150ms
Normal:   200ms
Slow:     300ms
```

### Easing Functions

```
ease-out: cubic-bezier(0, 0, 0.2, 1)     - Deceleration
ease-in-out: cubic-bezier(0.4, 0, 0.2, 1) - Smooth
```

### Animation Types

#### Fade In

```css
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
duration: 300ms;
```

#### Slide In

```css
@keyframes slideIn {
    from {
        transform: translateY(-10px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
duration: 300ms;
```

#### Bounce (small)

```css
@keyframes bounceSm {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-4px);
    }
}
duration: 1s infinite;
```

---

## 📱 Responsive Breakpoints

### Tailwind Breakpoints

```
sm: 640px  - Small phones
md: 768px  - Tablets
lg: 1024px - Desktops
xl: 1280px - Large screens
2xl: 1536px - Extra large screens
```

### Mobile-First Approach

```
- Start with mobile styles
- Add md: for tablets
- Add lg: for desktops
- Add xl: for large screens
```

### Layout Patterns

```
Mobile:
  - Full width, 1 column
  - Vertical stacking
  - Touch-friendly sizes (44px min)

Tablet:
  - 2-3 columns
  - Optimized spacing

Desktop:
  - 3-4 columns
  - Sidebar layouts
  - Grid layouts
```

---

## 🌙 Dark Mode

### Theme Colors in Dark Mode

```
Background:
  Light: #F9FAFB (Gray-50)
  Dark: #030712 (Gray-950)

Card Background:
  Light: White
  Dark: #1F2937 (Gray-800)

Text:
  Light: #111827 (Gray-900)
  Dark: White

Secondary Text:
  Light: #6B7280 (Gray-500)
  Dark: #D1D5DB (Gray-300)
```

### Toggle Implementation

```html
<!-- Add dark class to html element -->
<html class="dark">
    <!-- Dark styles apply -->
</html>

<!-- In CSS use dark: prefix -->
<div class="bg-white dark:bg-gray-800">
    <!-- White in light, Gray-800 in dark -->
</div>
```

---

## ♿ Accessibility

### Focus States

```css
All interactive elements should have:
- Visible focus ring: ring-2 ring-[color]
- Keyboard navigable
- Tab order logical
```

### Color Contrast

```
Level AA (recommended):
- Text: 4.5:1
- Large text: 3:1

Level AAA:
- Text: 7:1
- Large text: 4.5:1
```

### Semantic HTML

```html
<button>
    - For actions
    <a>
        - For navigation
        <label>
            - For form inputs
            <nav>
                - For navigation sections
                <main>
                    - For main content
                    <section>
                        - For content sections
                        <article>
                            - For standalone content
                            <footer>
                                - For footer
                                <header>- For headers</header>
                            </footer>
                        </article>
                    </section>
                </main>
            </nav></label
        ></a
    >
</button>
```

---

## 🎯 Best Practices

### Do's ✅

- Use consistent spacing (4px grid)
- Maintain color hierarchy
- Provide clear focus states
- Use semantic HTML
- Test on multiple devices
- Support dark mode
- Use animations sparingly
- Ensure good contrast ratios

### Don'ts ❌

- Don't use too many colors
- Don't forget focus states
- Don't break responsive layouts
- Don't use animations for everything
- Don't forget accessibility
- Don't use unreadable fonts
- Don't ignore error states
- Don't make buttons too small

---

## 🔧 Customization Guide

### Change Primary Color

1. Find: `from-blue-600`, `to-indigo-600` in CSS
2. Replace with your colors
3. Update all `bg-blue-*` to your color

### Change Font

1. Update: `resources/css/app.css`
2. Change: `font-family: 'Inter'` to your font
3. Import font in layout

### Change Spacing

1. Edit: `tailwind.config.js`
2. Modify: `spacing` section
3. Update references in HTML

### Change Shadows

1. Edit: `resources/css/app.css`
2. Find: `box-shadow` properties
3. Update values

---

## 📋 Component Checklist

Use this checklist when creating new components:

- [ ] Proper spacing (4px grid)
- [ ] Accessible markup (semantic HTML)
- [ ] Focus states visible
- [ ] Hover states defined
- [ ] Dark mode support
- [ ] Responsive design
- [ ] Error states
- [ ] Loading states
- [ ] Empty states
- [ ] Animations smooth
- [ ] Color contrast ≥ 4.5:1
- [ ] Touch-friendly sizes (44px min)

---

## 🎨 Colors Quick Reference

### Button Colors

```
Primary:    Blue-600 (#2563EB)
Secondary:  Gray-200 (#E5E7EB)
Danger:     Red-600 (#DC2626)
Success:    Green-600 (#16A34A)
Warning:    Yellow-600 (#CA8A04)
```

### Text Colors

```
Headings:   Gray-900 (#111827)
Body:       Gray-700 (#374151)
Secondary:  Gray-500 (#6B7280)
Disabled:   Gray-400 (#9CA3AF)
```

### Background Colors

```
Light:      Gray-50 (#F9FAFB)
Default:    White (#FFFFFF)
Dark:       Gray-800 (#1F2937)
```

### Status Colors

```
Success:    Green-600 (#16A34A)
Error:      Red-600 (#DC2626)
Warning:    Yellow-600 (#CA8A04)
Info:       Blue-600 (#2563EB)
```

---

## 📚 Resources

- Tailwind CSS: https://tailwindcss.com
- Inter Font: https://fonts.google.com/specimen/Inter
- Color Palette: https://tailwindcss.com/docs/customizing-colors
- Accessibility: https://www.a11y-101.com

---

**Design System Version**: 1.0
**Last Updated**: 2024
**Status**: Production Ready ✅
