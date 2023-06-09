<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:companies,name,' . $this->company->id,
            'email' => 'required|email|unique:companies,email,' . $this->company->id,
            'website' => 'required|string|unique:companies,website,' . $this->company->id,
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp',
        ];
    }
}
