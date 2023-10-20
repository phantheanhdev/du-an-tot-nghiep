<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class   ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    { $rules = [];

        // Lấy phương thức đang hoạt động
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'create':
                        $rules = [
                            'name' => 'required|unique:products|max:255',
                            'price' => 'required|numeric',
                            'item' => 'nullable|string',
                            'image' => ['nullable', 'image'],
                            'description' => 'required|string',
                            'category_id' => 'required|integer',
                            'status' => 'required|in:active,inactive',
                        ];
                        break;
                        case 'edit':
                            $id = $this->route('id');
                            $rules = [
                                'name' => [
                                    'required',
                                    Rule::unique('products')->ignore($id),
                                    'max:255',
                                ],
                                'price' => 'required|numeric',
                                'item' => 'nullable|string',
                                'image' => ['nullable', 'image'],
                                'description' => 'required|string',
                                'category_id' => 'required|integer',
                                'status' => 'required|in:active,inactive',
                            ];
                            break;
                    default:
                        break;
                }
                break;
        }

        return $rules;
    }
}
