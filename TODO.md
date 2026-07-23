# Task: Fix Chatbot & Admin Panel Visibility

## Steps:
- [x] Understand requirements
- [x] Read relevant files
- [x] Create plan and get approval
- [x] Edit `resources/views/layouts/app.blade.php` - Fix chatbot condition:
  - Changed from complex `@if(!Auth::check() || (Auth::check() && !Auth::user()->isAdmin()))`
  - To split `@guest`/`@else`/`@if(!Auth::user()->isAdmin())` pattern
  - Ensures chatbot appears for guests AND regular users
  - Ensures chatbot is hidden for admin users
- [x] Verify `resources/views/components/navbar.blade.php` - "Panel Admin" link already hidden for non-admin users


