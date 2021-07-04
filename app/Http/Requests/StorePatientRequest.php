<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => 'required',
            "email" => 'required|email|unique:patients,email,'.$this->patientid,
            "password" => 'required|sometimes',
            "Phone" => 'required|numeric|unique:patients,Phone,'.$this->patientid,
            'Date_Birth' => 'required|date|date_format:Y-m-d',
            "Gender" => 'required|integer|in:1,2',
            "Blood_Group" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('Dashboard\validation.required'),
            'email.unique' => trans('Dashboard\validation.unique'),
            'password.required' => trans('Dashboard\validation.required'),
            'password.sometimes' => trans('Dashboard\vDashboard\alidation.sometimes'),
            'Phone.required' => trans('Dashboard\validation.required'),
            'Phone.unique' => trans('Dashboard\validation.unique'),
            'Phone.numeric' => trans('Dashboard\validation.numeric'),
            'Date_Birth.required' => trans('Dashboard\validation.required'),
            'Date_Birth.date' => trans('Dashboard\validation.date'),
            'Gender.required' => trans('Dashboard\validation.required'),
            'Gender.integer' => trans('Dashboard\validation.integer'),
            'Blood_Group.required' => trans('Dashboard\validation.required'),
        ];
    }

}
