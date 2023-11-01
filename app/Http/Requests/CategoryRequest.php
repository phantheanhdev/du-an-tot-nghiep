<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {  $rules = [];

        // Lấy phương thức đang hoạt động
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'create':
                        $rules = [
                            'category_name' => 'required|unique:categories|max:255',
                            'note'=> 'nullable',
                            'image' => ['nullable', 'image'],
                            'status' => 'required|in:active,inactive',
                        ];
                        break;
                        case 'edit':
                            $id = $this->route('id');
                            $rules = [
                                'category_name' => [
                                    'required',
                                    Rule::unique('categories')->ignore($id),
                                    'max:255',
                                ],
                                'note' => 'nullable',
                                'image' => ['nullable', 'image'],
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
