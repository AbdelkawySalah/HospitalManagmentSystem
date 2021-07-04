<?php
namespace App\Repository\insurances;
use App\Interfaces\insurances\insuranceRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

use App\Models\Insurance;
use Illuminate\Support\Facades\DB;

class insuranceRepository implements insuranceRepositoryInterface
{
   public function index(){
      $insurances=Insurance::all();
      return view('Dashboard.insurance.index',compact('insurances'));

   }

   public function create(){
      return view('Dashboard.insurance.create');
 
    }
   public function store($request){
      DB::beginTransaction();
      try {
         $insurances = new Insurance();
         $insurances->insurance_code = $request->insurance_code;
         $insurances->discount_percentage = $request->discount_percentage;
         $insurances->Company_rate = $request->Company_rate;
         $insurances->status = 1;
         $insurances->save();

         // insert trans
         $insurances->name = $request->name;
         $insurances->notes = $request->notes;
         $insurances->save();

         DB::commit();
         session()->flash('add');
         return redirect()->route('Insurance.create');
     }
     catch (\Exception $e) {
         DB::rollback();
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
   }

   public function edit($id){

      $insurances = Insurance::findorfail($id);
      // return $insurances;
      return view('Dashboard.insurance.edit', compact('insurances'));
    
   }

   public function update($request){
      // بقوله هنا لو مضغطش علي التشك بوكس هضيف ليه قيمه 0 ولما ضغط هضيف ليه قيمة واحد
      if (!$request->has('status'))
            $request->request->add(['status' => 0]);
        else
            $request->request->add(['status' => 1]);

      // return $request;
        $insurances = Insurance::findOrFail($request->insuranceid);

        $insurances->update($request->all());

        // insert trans
        $insurances->name = $request->name;
        $insurances->notes = $request->notes;
        $insurances->save();

        session()->flash('Update');
        return redirect('Insurance');
    
    }
   public function destroy($request)
   {
   //   return $request;
      Insurance::destroy($request->id);
      session()->flash('Delete');
      return redirect('Insurance');
   }

  


}