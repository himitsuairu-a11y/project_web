<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAdoptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'cat_id' => ['required', 'exists:cats,id'],
            'applicant_name' => ['required', 'string', 'max:255'],
            'applicant_address' => ['required', 'string', 'max:500'],
            'salary_slip' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'identity_card' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'reason' => ['required', 'string', 'min:10'],
        ];
    }
}
