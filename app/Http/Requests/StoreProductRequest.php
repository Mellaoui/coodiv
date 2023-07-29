<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'matiere_id' => ['required', 'exists:matieres,id'],

            'reference' => ['required', 'string'],
            'designation' => ['required', 'string'],
            'buy_price' => ['required', 'integer', 'min:1'],
            'sell_price' => ['required', 'integer', 'min:1'],
            'weight' => ['required', 'integer', 'min:1'],
            'discount' => ['sometimes', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer'],
        ];
    }
}
