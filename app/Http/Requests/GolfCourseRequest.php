<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class GolfCourseRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'locale' => ['required', 'string', 'size:2', 'in:ja,en'],
            'country_code' => ['required', 'string', 'size:2'],
            'state_prefecture' => ['nullable', 'string', 'max:255'],
            'course_name' => ['required', 'string', 'max:255'],
            'kinds' => ['nullable', 'integer'],
            'web' => ['nullable', 'url', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'indoor' => ['boolean'],
            'outdoor' => ['boolean'],
            'short_course' => ['boolean'],
            'long_course' => ['boolean'],
            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lng' => ['nullable', 'numeric', 'between:-180,180'],
            'form_email' => ['nullable', 'email', 'max:255'],
            'reservation' => ['nullable', 'string', 'max:255'],
            'reservation_method' => ['nullable', 'string', 'max:255'],
            'remarks' => ['nullable', 'string', 'max:5000'],
            'image1' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image3' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $lat = $this->input('lat');
                $lng = $this->input('lng');

                if (($lat === null || $lat === '') !== ($lng === null || $lng === '')) {
                    $validator->errors()->add(
                        'lat',
                        'Please enter both latitude and longitude, or leave both empty.'
                    );
                }
            }
        ];
    }
}
