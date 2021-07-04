<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\single_invoice;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\FundAccount;
use App\Models\PatientAccount;
use Illuminate\Support\Facades\DB;

class SingleInvoices extends Component
{
    public $InvoiceUpdated,$InvoiceSaved=false;
    public $show_table=true;
    public $patient_id,$doctor_id,$section_id,$type,$Service_id,$price;
    public $discount_value=0,$tax_rate=0;
    public $updateMode=false;
    public $single_invoices_id;

    public function render()
    {
        return view('livewire.single-invoices.single-invoices',[
                  'single_invoices'=>single_invoice::all(),
                  'Patients'=>Patient::all(),
                  'Doctors'=>Doctor::all(),
                  'Services'=>Service::all(),
                  'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
                  'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
       ]
    );
    }

    public function show_form_add(){
        $this->show_table=false;
        $this->InvoiceSaved=false;


    }

    public function get_section(){
        $doctor_id = Doctor::where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
    }

    public function get_price()
    {
        $this->price = Service::where('id', $this->Service_id)->first()->price;
    }

    public function store(){

//في حالة الفاتورة نقدي
//begin if     
 if($this->type==1)
 {
    DB::beginTransaction();
    try {
        //1- الفاتورة نقدي وهتعدل يبقي هتعدل بجدول الفواتير وكذلك بحساب الصندوق
        if($this->updateMode){
          $single_invoices =single_invoice::findorFail($this->single_invoices_id);
          $single_invoices->invoice_date = date('Y-m-d');
          $single_invoices->patient_id = $this->patient_id;
          $single_invoices->doctor_id = $this->doctor_id;
          $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
          $single_invoices->Service_id = $this->Service_id;
          $single_invoices->price = $this->price;
          $single_invoices->discount_value = $this->discount_value;
          $single_invoices->tax_rate = $this->tax_rate;
          // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
          $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
          // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
          $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
          $single_invoices->type = $this->type;
          $single_invoices->save();

         //تعديل بحساب الصندوق
          $Fund_Account=FundAccount::where('single_invoice_id',$this->single_invoices_id)->first();
          $Fund_Account->date=date('Y-m-d');
          $Fund_Account->single_invoice_id=$single_invoices->id;
          $Fund_Account->Debit=$single_invoices->total_with_tax;
          $Fund_Account->credit=0.00;
          $Fund_Account->save();

      
        }


        //2-الفاتورة نقدي وهنحفظ فاتورة جديدة وهنضف ف صندوق مبلغ جديد
        else{
          
          //حفظ في جدول الفواتير
          $single_invoices = new single_invoice();
          $single_invoices->invoice_date = date('Y-m-d');
          $single_invoices->patient_id = $this->patient_id;
          $single_invoices->doctor_id = $this->doctor_id;
          $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
          $single_invoices->Service_id = $this->Service_id;
          $single_invoices->price = $this->price;
          $single_invoices->discount_value = $this->discount_value;
          $single_invoices->tax_rate = $this->tax_rate;
          // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
          $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
          // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
          $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
          $single_invoices->type = $this->type;
          $single_invoices->save();
 
          //حفظ مبلغ جديد بجدول الصندوق fund account
          $Fund_Account=new FundAccount();
          $Fund_Account->date=date('Y-m-d');
          $Fund_Account->single_invoice_id=$single_invoices->id;
          $Fund_Account->Debit=$single_invoices->total_with_tax;
          $Fund_Account->credit=0.00;
          $Fund_Account->save();

          //نهايه كود الحفظ 
        }
        //end of else
        
        DB::commit();
    }
    //end try
    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
//end if 
//في حالة الفاتورة اجل
 elseif($this->type==2)
{
  DB::beginTransaction();
  try {   
  //1- الفاتورة اجل وهتعدل يبقي هتعدل بجدول الفواتير وكذلك بحساب المريض
        if($this->updateMode)
        {
                $single_invoices = single_invoice::findorFail($this->single_invoices_id);
                $single_invoices->invoice_date = date('Y-m-d');
                $single_invoices->patient_id = $this->patient_id;
                $single_invoices->doctor_id = $this->doctor_id;
                $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                $single_invoices->Service_id = $this->Service_id;
                $single_invoices->price = $this->price;
                $single_invoices->discount_value = $this->discount_value;
                $single_invoices->tax_rate = $this->tax_rate;
                // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                // $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
        
                // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                $single_invoices->type = $this->type;
                $single_invoices->save();

              //وهيحفظ في  جدول حسابات المريض
              $Patient_Account=PatientAccount::where('single_invoice_id',$this->single_invoices_id)->first();
              $Patient_Account->date=date('Y-m-d');
              $Patient_Account->single_invoice_id=$single_invoices->id;
              $Patient_Account->patient_id=$single_invoices->patient_id;
              $Patient_Account->Debit=$single_invoices->total_with_tax;
              $Patient_Account->credit=0.00;
              $Patient_Account->save();

        }

        //2-الفاتورة اجل وهنحفظ فاتورة جديدة وهنضف ف حساب المريض مبلغ جديد
        else
        {
            //هيحفظ في جدول الفواتير
          //حفظ في جدول الفواتير
          $single_invoices = new single_invoice();
          $single_invoices->invoice_date = date('Y-m-d');
          $single_invoices->patient_id = $this->patient_id;
          $single_invoices->doctor_id = $this->doctor_id;
          $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
          $single_invoices->Service_id = $this->Service_id;
          $single_invoices->price = $this->price;
          $single_invoices->discount_value = $this->discount_value;
          $single_invoices->tax_rate = $this->tax_rate;
          // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
          $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
          // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
          $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
          $single_invoices->type = $this->type;
          $single_invoices->save();

        //وهيحفظ في  جدول حسابات المريض
         $Patient_Account=new PatientAccount();
         $Patient_Account->date=date('Y-m-d');
         $Patient_Account->single_invoice_id=$single_invoices->id;
         $Patient_Account->patient_id=$single_invoices->patient_id;
         $Patient_Account->Debit=$single_invoices->total_with_tax;
         $Patient_Account->credit=0.00;
         $Patient_Account->save();


        }
        //end else
        DB::commit();
      }
      //end try
      catch (\Exception $e) {
          DB::rollback();
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
        
}
//End of else الخاص لو كانت الفاتورة لاجل  
        
    //  clear after save
        $this->InvoiceSaved =true;
        $this->show_table =true;
        $this->patient_id="";
        $this->section_id="";
        $this->type="";
        $this->doctor_id="";
        $this->Service_id="";
        $this->price=0;
        $this->discount_value=0;
        $this->tax_rate=0;


    }

    public function edit($id){
      $this->show_table=false;
      $this->updateMode=true;
      $single_invoices =single_invoice::findorFail($id);
      $this->single_invoices_id=$single_invoices->id;
      $this->patient_id=$single_invoices->patient_id;
      $this->doctor_id=$single_invoices->doctor_id;
      $this->section_id=DB::table('section_translations')->where('section_id', $single_invoices->section_id)->first()->name;
      $this->type=$single_invoices->type;
      $this->Service_id=$single_invoices->Service_id;
      $this->price=$single_invoices->price;
      $this->discount_value=$single_invoices->discount_value;
      $this->tax_rate=$single_invoices->tax_rate;


    }

    public function delete($id){
    
      $this->single_invoices_id = $id;
     }
 
     public function destroy(){
         single_invoice::destroy($this->single_invoices_id);
          return redirect()->to('/Single-Invoices');
     }
}
