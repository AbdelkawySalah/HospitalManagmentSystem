<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsuranceRequest extends FormRequest
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
            //
            'insurance_code' => 'required|unique:insurances,insurance_code,'.$this->insuranceid,
            'discount_percentage' =>'required|numeric',
            'Company_rate' =>'required|numeric',
            'name' => 'required|unique:insurance_translations,name,' .$this->insuranceid.',insurance_id',
            // 'name' => 'required|unique:insurance_translations,name,'.$this->id,

           
        ];
    }

    public function messages()
    {
        return [
            'insurance_code.required' => trans('Dashboard\validation.required'),
            'insurance_code.unique' => trans('Dashboard\validation.unique'),
            'discount_percentage.required' => trans('Dashboard\validation.required'),
            'discount_percentage.numeric' => trans('Dashboard\validation.numeric'),
            'Company_rate.required' => trans('Dashboard\validation.required'),
            'Company_rate.numeric' => trans('Dashboard\validation.numeric'),
            'name.required' => trans('Dashboard\validation.required'),
            'name.unique' => trans('Dashboard\validation.unique'),
        ];
    }
}
