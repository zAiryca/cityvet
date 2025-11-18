# Pet Deadline System Implementation

## Tasks

-   [x] Create migration to add 'unclaimed' and 'unadopted' to status enum
-   [x] Remove decision_date and urgent_deadline columns if present
-   [x] Update Pet model remaining_days logic and add scopes
-   [x] Update Admin PetController to include new status filters
-   [x] Update admin pets index view to add Unclaimed/Unadopted tabs
-   [x] Update user pet views to hide unclaimed/unadopted and show deadlines
-   [x] Create artisan command for automatic status updates
-   [x] Test the implementation

## Status

Completed - Migration run, command tested (no expired pets found as expected)
