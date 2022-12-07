<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{

    private $name_min = 15;

    // protected $stopOnFirstFailure = true;
    // protected $redirect = '/home';
    // protected $redirectRoute = 'home';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        // dd($this::fullUrl());
        // dd($this::getRequestUri());
        // $this->user();
        // $this->route();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', "min:$this->name_min", 'max:50'],
            'email' => [
                'required',
                Rule::unique('employees', 'email')->ignore($this->route('id')),
                "max:100"
            ],
            'status' => ['required']
        ];
    }
    public function attributes()
    {
        return [
            'name' => "Employee name",
            'email' => "email address"
        ];
    }

    public function messages()
    {
        return [
            'name.min' => ":attribute cannot be less than $this->email_min characters",
            'email.unique' => "There's already an employee with this :attribute"
        ];
    }
}
