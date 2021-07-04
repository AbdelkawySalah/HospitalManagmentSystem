<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSingleServiceRequest extends FormRequest
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

        //    select from service_translations where name = namr input and idinput = Service_id

        //valdtion اول حاجة بتطبق
            //\بقوله هنا انه هيطبق valdation on name field is 'required|unique:service_translations' <<in this is tablr
            //الجزئية تانيه دي,name,'.$this->IdServiceHideen.',Service_id' عشان تعديل
            //بقوله فيها انك هتعدل في حقل نيم لما يكون IdServiceHideen
            //معني كلام انت رايح تعدل هيروح عي فلديشين ويقولك انت عاوز تعدل في الاسم اه طب معاك سيرفيس اي دي ايون خلاص عدل 
            //هيطبق عليه فلديشين هل هوه فيه قيمه اه يبقي عدي من ركويرد هل هوه يونيك لو قاله لا يبقي بيعدل
            //طب في حالة دي عشان يعرف انه علي نفس الصف علي رقم الخدمه نفس اللي جيلي اه
            'name' => 'required|unique:service_translations,name,'.$this->IdServiceHideen.',Service_id',
             'price' => 'numeric|required',

             // 'name' => 'required|unique:service_translations',


            // هنا بقوله ادخل جدول الترجمة معاك اسم الخدمة ورقم الخدمة هو كدة يبدا يفهم

            // كان الاول يدخخل الجدول معة اسم الخدمة ورقم الخدمة

            // بس كان بيشيك برقم id الجدول الاساسي انا قولت له شيك برقم الخدمة واسم الخدمة وصلت 
            // هوه بس مش فاهم معني سطر ده

// $this->id.',Service_id',

       

//            // 'status' => 'required|in:0,1',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => trans('Dashboard\validation.required'),
            'name.unique' => trans('Dashboard\validation.unique'),
            'price.required' => trans('Dashboard\validation.required'),
            'price.numeric' => trans('Dashboard\validation.numeric'),
        ];
    }
}
