<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
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
            'gender' => ['required', 'in:male,female,other'],
            'birthday' => ['required', 'date', 'before:today'],
                // Expect Philippine mobile numbers: 11 digits starting with 09 (e.g. 09123025471)
                'contact_number' => ['required', 'regex:/^09\\d{9}$/'],
                'emergency_contact' => ['required', 'regex:/^09\\d{9}$/'],
            'street' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'city_municipality' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:10'],
          'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
            'id_photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,pdf,doc,docx', 'max:5120'],
        ];
    }

}
