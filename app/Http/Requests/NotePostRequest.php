<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NotePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'note' => 'required|unique:notes|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'note.required' => 'A title is required',
            'note.unique' => 'A title is must be unique',
            "note.min" => "The note has to have at least :min characters.",
            "note.max" => "The note has to have no more than :max characters.",
        ];
    }
    protected function failedValidation(Validator $validator) {
        $response = [
            'status' => false,
            'message' => $validator->errors()->first(),
            'data' => $validator->errors()
        ];
        throw new HttpResponseException(response()->error('Error occurred',$response));
    }
}
