<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiValidateOrganisationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:organisations,name',
            ],
            'owner_user_id' => [
                'required',
                'numeric',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Organisation name is required.',
            'name.unique' => 'Organisation name should be unique.',
            'owner_user_id.required' => 'Owner is required.',
            'owner_user_id.numeric' => 'Owner must be a numeric value.',
        ];
    }
}
