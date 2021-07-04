<?php
namespace App\Repository\Patients;
use App\Interfaces\Patients\PatientRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PatientRepository implements PatientRepositoryInterface
{
   public function index(){
    $patient=Patient::all();
     return view('Dashboard.Patients.index',compact('patient'));
   }

   public function create(){
    return view('Dashboard.Patients.create');
    }
   public function store($request){
    //    return $request;
      DB::beginTransaction();
      try {
        
     $patient=new Patient();
     $patient->email=$request->email;
     $patient->Password=Hash::make($request->Phone);

     $patient->Date_Birth=$request->Date_Birth;
     $patient->Phone=$request->Phone;
     $patient->Gender=$request->Gender;
     $patient->Blood_Group=$request->Blood_Group;
     $patient->save();

     //store in translation
     $patient->name=$request->name;
     $patient->Address=$request->Address;
     $patient->save();

         DB::commit();
         session()->flash('add');
        //  return redirect()->back();
         return redirect()->route('Patients.index');
     }
     catch (\Exception $e) {
         DB::rollback();
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
   }

   public function edit($id){
  $patient=Patient::findorfail($id);
  //  return $patient;
    return view('Dashboard.Patients.Edit',compact('patient'));
    
   }

   public function update($request){
    //  return $request;
     DB::beginTransaction();
     try {
       
    $patient=Patient::findorfail($request->patientid);
    $patient->email=$request->email;

    $patient->Date_Birth=$request->Date_Birth;
    $patient->Phone=$request->Phone;
    $patient->Gender=$request->Gender;
    $patient->Blood_Group=$request->Blood_Group;
    $patient->save();

    //store in translation
    $patient->name=$request->name;
    $patient->Address=$request->Address;
    $patient->save();

        DB::commit();
        session()->flash('Update');
       //  return redirect()->back();
        return redirect()->route('Patients.index');
    }
    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
   public function destroy($request)
   {
    Patient::destroy($request->id);  
    session()->flash('Delete');
    return redirect('Patients');
   }

  


}