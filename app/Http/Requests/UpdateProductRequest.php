<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'matiere_id'  => ['required', 'exists:matieres,id'],

            'reference' => [
                'required', 'string',
                Rule::unique(Product::class)->ignore($this->route('product')->id),
            ],
            'designation' => ['required', 'string'],
            'buy_price'   => ['required', 'integer', 'min:1'],
            'sell_price'  => ['required', 'integer', 'min:1'],
            'weight'      => ['required', 'integer', 'min:1'],
            'discount'    => ['sometimes', 'decimal', 'min:0'],
            'quantity'    => ['required', 'integer'],
        ];
    }
}
