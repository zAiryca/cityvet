# TODO: Implement Automatic Denial Reasons

## Completed Tasks

-   [x] Add 'denial_reason' to PetRequest model's $fillable array
-   [x] Update markAsAdopted method to set denial_reason: 'Pet was adopted by another applicant'
-   [x] Update markAsClaimed method to set denial_reason: 'Pet was claimed by the owner'

## Notes

-   The finalize() method in PetRequestController already sets denial_reason for competing requests
-   User request show view already displays denial_reason when present
-   Manual admin denials (via deny() method) still don't set denial_reason - this could be enhanced later if needed

## Testing

-   Need to test that when admin marks a pet as adopted/claimed, other pending requests get denied with appropriate reasons
-   Verify that denied requests show the denial_reason to users
