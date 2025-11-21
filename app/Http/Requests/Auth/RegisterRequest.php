<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Concerns\InteractsWithInput;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Validator;

class RegisterRequest extends FormRequest
{
    use InteractsWithInput;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            // FIXED: Changed regex from \d{10} to \d{9} to correctly validate 11-digit numbers (09 + 9 digits).
            'contact_number' => ['required', 'string', 'regex:/^09\d{9}$/', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Role is set server-side for public registrations; make it optional in the request
            'role' => ['nullable', 'in:user,admin'],
            'terms' => ['required', 'accepted'],
        ];
    }

    /**
     * Configure the validator instance for custom checks (like duplicate names).
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            // Get form inputs and convert to lowercase for comparison
            $firstLower = Str::lower($this->input('first_name'));
            $lastLower = Str::lower($this->input('last_name'));

            // Check if a user with this name combination already exists
            $query = User::whereRaw('LOWER(first_name) = ?', [$firstLower])
                         ->whereRaw('LOWER(last_name) = ?', [$lastLower]);

            // Add validation error if duplicate name exists
            if ($query->exists()) {
                $validator->errors()->add(
                    'first_name',
                    'A user with this name combination already exists. Please use a different name.'
                );
            }
        });
    }
}
