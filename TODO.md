# TODO: Replace "Events" with "Announcements" in Views

## Completed Tasks
- [x] resources/views/pages/about.blade.php: Change "events" to "announcements"
- [x] resources/views/pages/donate.blade.php: Change "adoption events" to "adoption workshops"
- [x] resources/views/auth/register.blade.php: Remove "join events"
- [x] resources/views/layouts/admin.blade.php: Change "Events" to "Announcements" in nav link, update route to admin.announcements.index
- [x] resources/views/admin/dashboard.blade.php: Change "Event Management" to "Announcement Management", update routes to admin.announcements.*, change "Upcoming Events" to "Upcoming Announcements"
- [x] resources/views/admin/reports/generate.blade.php: Change "Total Events" to "Total Announcements", "Events Held" to "Announcements Held"
- [x] resources/views/admin/announcements/edit.blade.php: Change "Update Event" to "Update Announcement"

## Notes
- Admin events views (create.blade.php, edit.blade.php, registrations.blade.php, all-registrations.blade.php) do not exist, likely already renamed or removed.
- User registration for events removed as per user feedback.
- Announcements are not for user registration, only for admin management.
