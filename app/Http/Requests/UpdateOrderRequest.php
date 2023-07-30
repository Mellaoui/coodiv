<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Order;

class UpdateOrderRequest extends FormRequest
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
            // 'product_id' => ['required', 'exists:products,id'],
            // 'user_id' => ['required', 'exists:users,id'],

            'tracking_number' => [
                'required', 'string',
                Rule::unique(Order::class)->ignore($this->route('order')->id)
            ],
            'quantity' => ['required', 'integer'],
            'status' => [
                'required', 'string',
                Rule::in(['pending', 'shipped', 'delivered', 'returned'])
            ],
        ];
    }
}
