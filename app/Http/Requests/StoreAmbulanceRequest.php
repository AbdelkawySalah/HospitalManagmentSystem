<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmbulanceRequest extends FormRequest
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
            'car_number' => 'required|unique:ambulances,car_number,'.$this->Ambulanceid,
            'car_model' =>'required',
            'car_year_made' =>'required|numeric',
            'car_type' => "required|in:1,2",
            'driver_name' => 'required|unique:ambulance_translations,driver_name,'.$this->Ambulanceid.',ambulance_id',
            'driver_license_number' =>'required|numeric',
            'driver_phone' =>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'car_number.required' => trans('Dashboard\validation.required'),
            'car_number.unique' => trans('Dashboard\validation.unique'),
            'car_model.required' => trans('Dashboard\validation.required'),
            'car_year_made.required' => trans('Dashboard\validation.required'),
            'car_year_made.numeric' => trans('Dashboard\validation.numeric'),
            'car_type.required' => trans('Dashboard\validation.required'),
            'driver_name.required' => trans('Dashboard\validation.required'),
            'driver_name.unique' => trans('Dashboard\validation.unique'),
            'driver_license_number.required' => trans('Dashboard\validation.required'),
            'driver_license_number.numeric' => trans('Dashboard\validation.numeric'),
            'driver_phone.required' => trans('Dashboard\validation.required'),
            'driver_phone.numeric' => trans('Dashboard\validation.numeric'),
        ];
    }
}
