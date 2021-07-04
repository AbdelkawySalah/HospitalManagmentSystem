<?php
namespace App\Repository\Finance;
use App\Interfaces\Finance\ReceiptRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

 use App\Models\ReceiptAccount;
 use App\Models\FundAccount;
 use App\Models\PatientAccount;

 use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface
{
   public function index(){
    //  $Debit=PatientAccount::where('patient_id',1)->sum('Debit');
    //  $Credit=PatientAccount::where('patient_id',1)->sum('credit');
    // $total=$Debit - $Credit;
    // return $total;
     $receipts=ReceiptAccount::all();
     return view('Dashboard.Receipts.index',compact('receipts'));
   }

   public function create(){
    $Patients=Patient::all();
    return view('Dashboard.Receipts.create',compact('Patients'));
    }
   public function store($request){
    DB::beginTransaction();

    try{
      //هيحفظ في ثلاث جدول
        // store receipt_accounts في جدول السندات
        $receipt_accounts = new ReceiptAccount();
        $receipt_accounts->date =date('y-m-d');
        $receipt_accounts->patient_id = $request->patient_id;
        $receipt_accounts->Debit = $request->Debit;
        $receipt_accounts->description = $request->description;
        $receipt_accounts->save();
        // store fund_accountsفي صندوق
        $fund_accounts = new FundAccount();
        $fund_accounts->date =date('y-m-d');
        $fund_accounts->receipt_id = $receipt_accounts->id;
        $fund_accounts->Debit = $request->Debit;
        $fund_accounts->credit = 0.00;
        $fund_accounts->save();
        // store patient_accounts جدول حساب المريض
        $patient_accounts = new PatientAccount();
        $patient_accounts->date =date('y-m-d');
        $patient_accounts->patient_id = $request->patient_id;
        $patient_accounts->receipt_id = $receipt_accounts->id;
        $patient_accounts->Debit = 0.00;
        $patient_accounts->credit =$request->Debit;
        $patient_accounts->save();

        DB::commit();
        session()->flash('add');
        return redirect()->route('Receipt.create');
    }

    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }

    public function edit($id){
      $receipt_accounts = ReceiptAccount::findorfail($id);
      $Patients = Patient::all();
      return view('Dashboard.Receipts.edit',compact('Patients','receipt_accounts'));

    }

    public function update($request){
      // return $request;
      DB::beginTransaction();

      try{
        //هيحفظ في ثلاث جدول
          // store receipt_accounts في جدول السندات
          $receipt_accounts =ReceiptAccount::findOrfail($request->id);
          $receipt_accounts->date =date('y-m-d');
          $receipt_accounts->patient_id = $request->patient_id;
          $receipt_accounts->Debit = $request->Debit;
          $receipt_accounts->description = $request->description;
          $receipt_accounts->save();
          // store fund_accountsفي صندوق
          $fund_accounts =FundAccount::where('receipt_id',$request->id)->first();
          $fund_accounts->date =date('y-m-d');
          $fund_accounts->receipt_id = $receipt_accounts->id;
          $fund_accounts->Debit = $request->Debit;
          $fund_accounts->credit = 0.00;
          $fund_accounts->save();
          // store patient_accounts جدول حساب المريض
          $patient_accounts =PatientAccount::where('receipt_id',$request->id)->first();
          $patient_accounts->date =date('y-m-d');
          $patient_accounts->patient_id = $request->patient_id;
          $patient_accounts->receipt_id = $receipt_accounts->id;
          $patient_accounts->Debit = 0.00;
          $patient_accounts->credit =$request->Debit;
          $patient_accounts->save();
  
          DB::commit();
          session()->flash('Update');
          return redirect()->route('Receipt.index');
      }
  
      catch (\Exception $e) {
          DB::rollback();
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  
    }

   public function destroy($request)
   {
    
    try {
      ReceiptAccount::destroy($request->id);
      session()->flash('Delete');
      return redirect()->back();
      // return redirect()->route('Receipt.index');
       }
    catch (\Exception $e) 
    {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

   }

  


}