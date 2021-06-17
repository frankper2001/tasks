<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //cambio provisional LAR17 ->70
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['title' => 'required|max:255',
            'description' => 'required|max:255',
            'category' => 'required|max:255',
            'matricula' => "required|nullable|
                            regex:/^\d{4}[B-Z]{3}$/i|
                            unique:tasks,matricula,$task->id|
                            confirmed",
            'color' => 'nullable|regex:/^#[\dA-F]{6}$/i',
            'importance' => 'required|max:15',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'];
    }
}
