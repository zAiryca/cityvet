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
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'regex:/^09\d{9}$/', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,admin'],
            'terms' => ['required', 'accepted'],
            'privacy' => ['nullable', 'accepted'],
        ];
    }

    /**
     * Configure the validator instance for custom checks (like duplicate names).
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            // Get form inputs and convert to lowercase for comparison
            $firstLower = Str::lower($this->input('first_name'));
            $middleLower = $this->input('middle_name')
                ? Str::lower($this->input('middle_name'))
                : null;
            $lastLower = Str::lower($this->input('last_name'));

            // Check if a user with this name combination already exists
            $query = User::whereRaw('LOWER(first_name) = ?', [$firstLower])
                         ->whereRaw('LOWER(last_name) = ?', [$lastLower]);

            // Handle middle name: match null or exact value
            if ($middleLower === null) {
                $query->whereNull('middle_name');
            } else {
                $query->whereRaw('LOWER(middle_name) = ?', [$middleLower]);
            }

            // Add validation error if duplicate name exists
            if ($query->exists()) {
                $validator->errors()->add(
                    'first_name',
                    'A user with this name combination already exists. Please use a different name or add a middle name to differentiate.'
                );
            }
        });
    }
}
