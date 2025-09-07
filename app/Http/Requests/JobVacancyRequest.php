<?php

namespace App\Http\Requests;

use App\Models\JobVacancy;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobVacancyRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric|min:1000|max:1000000',
            'location' => 'required|string',
            'level' => [
                'required',
                Rule::in(JobVacancy::$levels),
            ],
            'category' => [
                'required',
                Rule::in(JobVacancy::$categories),
            ],
        ];
    }
}
