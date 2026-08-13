---
name: Academic Core
colors:
  surface: '#f7f9fb'
  surface-dim: '#d8dadc'
  surface-bright: '#f7f9fb'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f4f6'
  surface-container: '#eceef0'
  surface-container-high: '#e6e8ea'
  surface-container-highest: '#e0e3e5'
  on-surface: '#191c1e'
  on-surface-variant: '#3d4a42'
  inverse-surface: '#2d3133'
  inverse-on-surface: '#eff1f3'
  outline: '#6d7a72'
  outline-variant: '#bccac0'
  surface-tint: '#006c4a'
  primary: '#006948'
  on-primary: '#ffffff'
  primary-container: '#00855d'
  on-primary-container: '#f5fff7'
  inverse-primary: '#68dba9'
  secondary: '#515f74'
  on-secondary: '#ffffff'
  secondary-container: '#d5e3fc'
  on-secondary-container: '#57657a'
  tertiary: '#006947'
  on-tertiary: '#ffffff'
  tertiary-container: '#00855b'
  on-tertiary-container: '#f5fff6'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#85f8c4'
  primary-fixed-dim: '#68dba9'
  on-primary-fixed: '#002114'
  on-primary-fixed-variant: '#005137'
  secondary-fixed: '#d5e3fc'
  secondary-fixed-dim: '#b9c7df'
  on-secondary-fixed: '#0d1c2e'
  on-secondary-fixed-variant: '#3a485b'
  tertiary-fixed: '#6ffbbe'
  tertiary-fixed-dim: '#4edea3'
  on-tertiary-fixed: '#002113'
  on-tertiary-fixed-variant: '#005236'
  background: '#f7f9fb'
  on-background: '#191c1e'
  surface-variant: '#e0e3e5'
  status-hadir: '#22c55e'
  status-izin: '#f59e0b'
  status-sakit: '#0ea5e9'
  status-alfa: '#f43f5e'
  border-default: '#e2e8f0'
  text-main: '#0f172a'
typography:
  headline-lg:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  headline-md:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-default:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
  input-text:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  touch-target: 44px
  container-padding-mobile: 1rem
  list-gap: 0.5rem
  section-margin: 1.5rem
  grid-gutter: 1rem
---

## Brand & Style
The design system is centered on **high-performance academic operations**. It prioritizes utility, speed, and reliability over decorative elements. The target audience includes busy educators and administrators who require a tool that functions flawlessly in high-pressure classroom environments.

The chosen style is **Modern Corporate**, leaning heavily into functional minimalism. 
- **Efficiency First:** The UI is designed to minimize cognitive load, allowing teachers to complete attendance in under 60 seconds.
- **Mobile-First Utility:** Every interaction is optimized for one-handed thumb use on mobile devices while expanding into a high-density data dashboard for desktop administrators.
- **Professional Neutrality:** It avoids "educational" cliches or heavy institutional ornamentation, presenting instead as a clean, sophisticated work tool that commands professional respect.

## Colors
The palette is anchored by **Emerald 600**, chosen for its professional and calming associations rather than religious connotations. 

- **Primary (Emerald):** Used for primary actions, branding, and active navigation states.
- **Status Colors:** These are the most critical semantic tokens. They use high-chroma variants (Green, Amber, Sky, Rose) to ensure instant scannability during the attendance process.
- **Neutral:** A range of slates is used to create hierarchy without introducing color fatigue. The background is a crisp `slate-50` to maintain a clean, airy feel.
- **Accessibility:** All color combinations must meet WCAG AA standards. Status indicators must never rely on color alone; they must always be accompanied by text labels or distinct iconography.

## Typography
**Inter** is the exclusive typeface for this design system, chosen for its exceptional legibility on small screens and its neutral, systematic character.

- **Mobile Optimization:** The `input-text` level is strictly set to **16px** to prevent browsers (especially iOS Safari) from auto-zooming when a user taps into an input field.
- **Hierarchy:** Use `font-medium` (500) for UI labels and student names to differentiate them from purely informational body text. `font-semibold` (600) is reserved for page titles and primary CTA buttons.
- **Data Density:** On desktop, use the `body-default` (14px) size for table data to maximize the amount of information visible at once.

## Layout & Spacing
The layout uses a **Fluid Grid** for mobile and a **12-column Fixed Grid** (max-width: 1280px) for desktop administration views.

- **The 44px Rule:** Every interactive element (attendance buttons, checkboxes, navigation links) must have a minimum hit area of 44x44px. This is non-negotiable for the "Teacher-in-Class" persona.
- **Attendance Flow:** List items in the attendance module should use a `0.5rem` gap to ensure vertical separation while maintaining high density.
- **Responsive Behavior:** 
    - **Mobile (<640px):** Single column, sticky bottom actions for forms.
    - **Tablet (640px - 1024px):** Cards may move to 2-column layouts; sidebars remain hidden behind a hamburger menu.
    - **Desktop (>1024px):** Permanent sidebar, multi-column dashboard widgets, and dense data tables.

## Elevation & Depth
This design system uses **Tonal Layers** and **Subtle Shadows** to communicate hierarchy.

- **Surfaces:** The page background is `slate-50`. All primary content is housed in white cards (`#FFFFFF`).
- **Shadows:** Use a single, soft shadow style for cards: `0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)`. This provides depth without making the UI feel "heavy."
- **Borders:** Use `slate-200` for low-contrast outlines on input fields and card containers.
- **Interactive State:** Buttons should lift slightly on hover (on desktop) or show a dimmed overlay on tap (on mobile). Use a `2px` emerald ring for focus states to ensure keyboard accessibility.

## Shapes
The shape language is **Rounded**, utilizing a **0.5rem (8px)** base radius. This strikes a balance between the friendliness required for a school environment and the precision required for a professional tool.

- **Standard Elements:** Cards, buttons, and input fields use the base `rounded (0.5rem)`.
- **Status Badges:** Use `rounded-full` (pill shape) to distinguish them clearly from interactive buttons.
- **Small Elements:** Checkboxes use a smaller `0.25rem` radius to maintain a crisp, sharp look at small scales.

## Components

### Attendance Checklist
This is the core component. It consists of a vertical list of student cards.
- **Layout:** Student name on the left; a horizontal row of four buttons (Hadir, Izin, Sakit, Alfa) on the right.
- **State:** Buttons are outlined/grey in their "unselected" state. When tapped, they transition to their solid semantic color.
- **Feedback:** A small "Syncing..." indicator or checkmark appears momentarily near the student name using Livewire's `wire:loading` to confirm the data is saved.

### Status Badges
- **Style:** Small, pill-shaped tags with `text-xs` bold uppercase text.
- **Usage:** Used in "History" views or "Waka Kurikulum" reports to provide an instant heat map of class health.

### Numeric Inputs (Formatif)
- **Constraint:** Must trigger the numeric keypad on mobile.
- **Visuals:** Inline validation styling—border turns green if valid (0-100), red if invalid.

### Primary Buttons
- **Style:** Solid Emerald 600 background, white text, 44px height.
- **Shadow:** Small shadow to indicate clickability.

### Data Tables (Admin)
- **Style:** Borderless rows with `slate-100` zebra striping. 
- **Density:** Reduced vertical padding on desktop to show 15-20 records per screen without scrolling.