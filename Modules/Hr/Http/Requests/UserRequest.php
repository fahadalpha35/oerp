<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'EMP_ID' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|confirmed',
            'joining_date' => 'required',
            'salary' => 'required|numeric',
            'job_type' => 'required|in:0,1,2',
            'designation_id' => 'required|exists:designations,id',
            'annual_leave' => 'nullable|numeric',
            'sick_leave' => 'nullable|numeric',
            'casual_leave' => 'nullable|numeric',
            'date_of_birth' => 'required',
            'phone_number' => 'required|string|max:15',
            'personal_email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'account_number' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'IBAN' => 'required|string|max:255',
            'shift_start_timing' => 'required',
            'shift_end_timing' => 'required|after:shift_start_timing',
            'profile_image' => 'nullable|image|file',
            'documents.*' => 'nullable|file',
        ];
    }
}
