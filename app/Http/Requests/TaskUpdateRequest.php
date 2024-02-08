<?php
declare(strict_types=1);
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
    {
        return [
            'name' => 'required|string|max:20',
            'priority' => 'required|numeric',
            'id' => 'required|numeric',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required' => 'Task name is required.',
            'name.string' => 'The task name must be a string.',
            'name.max' => 'The task name may not be greater than 255 characters.',
            'priority.required' => 'Priority is required.',
            'priority.numeric' => 'The priority must be a number.',
        ];
    }
}
