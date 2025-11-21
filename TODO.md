# Registration Debugging Checklist

## 1. Check the Registration Form (register.blade.php)

-   [x] Form action: Should be `{{ route('register') }}`
-   [x] Form method: Should be `POST`
-   [x] CSRF token: Should have `@csrf`
-   [x] All required fields present: first_name, last_name, contact_number, email, password, password_confirmation, terms, role (hidden)
-   [x] Field names match validation rules

**If issues found:**

-   [ ] Add `@csrf` inside the form if missing
-   [ ] Change form action to `action="{{ route('register') }}"` if wrong

## 2. Check Routes (routes/auth.php)

-   [ ] Routes exist for both GET and POST register
-   [ ] Routes point to correct controller methods (RegisteredUserController@create and @store)
-   [ ] Routes are under 'guest' middleware

**If issues found:**

-   [ ] Add missing routes:

```php
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
```

## 3. Check Controller (RegisteredUserController.php)

-   [x] `create()` method returns the register view
-   [x] `store()` method validates with RegisterRequest
-   [x] User creation includes all required fields
-   [x] Role is set to 'user' (not admin for public registration)
-   [x] Redirects to verification notice after registration

**If issues found:**

-   [ ] Change role from 'admin' to 'user' if hardcoded wrong
-   [ ] Ensure all required User model fields are included in create()

## 4. Check Validation (RegisterRequest.php)

-   [ ] All required fields are validated
-   [ ] Contact number regex allows 11-digit numbers starting with 09
-   [ ] Email uniqueness validation
-   [ ] Password confirmation validation
-   [ ] Terms acceptance validation
-   [ ] Role validation allows 'user' and 'admin'

**If issues found:**

-   [ ] Fix contact regex to `'regex:/^09\d{9}$/'` if wrong
-   [ ] Add `'terms' => ['required', 'accepted']` if missing

## 5. Check User Model (User.php)

-   [ ] Implements MustVerifyEmail
-   [ ] Fillable includes all registration fields
-   [ ] Email attribute casts to lowercase
-   [ ] Has relationships if needed

**If issues found:**

-   [ ] Add `implements MustVerifyEmail` if missing
-   [ ] Ensure fillable array includes: 'first_name', 'middle_name', 'last_name', 'contact_number', 'email', 'password', 'role'

## 6. Check Database Migrations

-   [ ] Users table has all required columns
-   [ ] Migrations have been run
-   [ ] Column types match validation rules

**If issues found:**

-   [ ] Run `php artisan migrate:status` to check migration status
-   [ ] Run `php artisan migrate` if migrations are missing

## 7. Check Email Verification Setup

-   [ ] Email verification routes exist
-   [ ] verify-email.blade.php exists and works
-   [ ] MAIL configuration is set up
-   [ ] User model implements MustVerifyEmail

**If issues found:**

-   [ ] Check MAIL\_\* environment variables
-   [ ] Ensure routes/auth.php has verification routes

## 8. Check Application Logs

-   [ ] Laravel logs for registration errors
-   [ ] Database connection errors
-   [ ] Validation errors
-   [ ] Email sending errors

**If issues found:**

-   [ ] Check `storage/logs/laravel.log` for error messages
-   [ ] Clear caches: `php artisan config:clear`, `php artisan route:clear`, `php artisan view:clear`

## 9. Run Registration Tests

-   [ ] Tests pass or show specific failures
-   [ ] Test data matches your form requirements

**If issues found:**

-   [ ] Run `php artisan test --filter=RegistrationTest`
-   [ ] Fix any failing tests based on error messages

## 10. Check Environment Configuration

-   [ ] APP_URL is correct
-   [ ] Database connection is working
-   [ ] Mail configuration for verification emails

**If issues found:**

-   [ ] Verify .env file has correct APP_URL
-   [ ] Test database connection with `php artisan tinker` then `DB::connection()->getPdo()`

## Common Issues to Look For:

-   [ ] CSRF token mismatch - Check if @csrf is present
-   [ ] Route not found - Verify routes are loaded
-   [ ] Validation failures - Check form field names match validation rules
-   [ ] Database errors - Check migrations and fillable fields
-   [ ] Email verification issues - Check mail config and MustVerifyEmail implementation
-   [ ] Role issues - Ensure role is set to 'user' for public registration

## Next Steps:

1. Start with checking the logs first (`storage/logs/laravel.log`)
2. Then verify the form submission, routes, and controller flow
3. Work through each unchecked item systematically
4. Test registration after each fix
