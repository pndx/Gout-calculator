<?php

namespace App\Http\Requests\Human;

use Illuminate\Foundation\Http\FormRequest;

class HumanStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'       => 'required|string',
            'age'        => 'required|integer',
            'address'    => 'required|string',
            'is_painful' => 'required|boolean',
            'purine'     => 'required|integer',
        ];
    }
}