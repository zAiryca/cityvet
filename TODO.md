# Pet Management System Updates - 3-Day Holding Period & Adoptable Enhancements

## Overview

-   Change holding period from 7 days to 3 days for impounded and adoptable pets
-   Automatic status changes: Impounded (3 days) → Adoptable (3 days) → Unclaimed/Unadopted
-   Add reason dropdown and notes field for adoptable pets
-   Update UI to show "unclaimed/unadopted" instead of separate statuses
-   Add instructional notes for users on impounded vs adoptable processes

## Tasks

### 1. Update Pet Model (remaining_days calculation)

-   [x] Change `remaining_days` attribute calculation from 7 to 3 days
-   [x] Update `shouldBeArchived()` method logic
-   [x] Update `archiveIfExpired()` method to handle impounded→adoptable→unclaimed/unadopted flow

### 2. Update Archive Command

-   [x] Modify `ArchiveExpiredPets` command to implement new flow
-   [x] Ensure impounded pets move to adoptable after 3 days
-   [x] Ensure adoptable pets move to unclaimed/unadopted after another 3 days

### 3. Update Admin Pet Creation Form

-   [x] Add conditional reason dropdown for adoptable pets with 10 options:
    -   [x] Owner Relocation/Moving
    -   [x] Owner Illness/Death
    -   [x] Financial Hardship
    -   [x] Landlord/Housing Restriction
    -   [x] Lifestyle/Schedule Change
    -   [x] Incompatibility with Existing Pets
    -   [x] Incompatibility with Children
    -   [x] Household Allergies
    -   [x] Needs More Space/Exercise
    -   [x] Behavioral Issues (Requires Detail in Notes)
-   [x] Add optional notes field for adoptable pets
-   [x] Update form validation and storage logic

### 4. Update Pet Show Views

-   [x] Add instructional notes for impounded pets: "If unclaimed after 3 days, pet will be moved to adoptable section"
-   [x] Add instructional notes for adoptable pets: "Must submit adoption form through system. Direct pickup not available."
-   [x] Update user-facing views to show appropriate instructions

### 5. Update Admin Interface

-   [x] Change "unclaimed, unadopted" to "unclaimed/unadopted" in admin views
-   [x] Update status filters and displays
-   [x] Ensure proper status handling in admin pet management

### 6. Update Request Process

-   [x] Ensure adoptable pets require form submission (no direct pickup)
-   [x] Update request flow to enforce system usage for adoptable pets
-   [x] Add process notes: Form → Approval → FTF Screening → Fee Settlement → Pickup → Mark Adopted

## Database Changes Needed

-   [ ] Add `adoption_reason` column to pets table (if not exists)
-   [ ] Add `adoption_notes` column to pets table (if not exists)

## Testing

-   [ ] Test 3-day holding period calculation
-   [ ] Test automatic status changes
-   [ ] Test admin direct adoptable pet creation with new fields
-   [ ] Test user instructions display
-   [ ] Test request process for adoptable pets
