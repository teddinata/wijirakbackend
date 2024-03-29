<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'categories_id' => 'required|integer|exists:categories,id',
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'tags' => 'required|max:255',
            'weight' => 'required|integer',
            'sku' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'slug' => [ 'required', 'alpha_dash',
                        'unique:products']
        ];
    }
}
