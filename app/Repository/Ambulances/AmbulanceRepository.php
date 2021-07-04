<?php
namespace App\Repository\Ambulances;
use  App\Interfaces\Ambulances\AmbulanceRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

use App\Models\Ambulance;
use Illuminate\Support\Facades\DB;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
   public function index(){
    $ambulances=Ambulance::all();
      return view('Dashboard.Ambulance.index',compact('ambulances'));
     
   }

   public function create(){
    return view('Dashboard.Ambulance.create');
    }
   public function store($request){
    DB::beginTransaction();
      try {
       $ambulances = new Ambulance();
       $ambulances->car_number = $request->car_number;
       $ambulances->car_model = $request->car_model;
       $ambulances->car_year_made = $request->car_year_made;
       $ambulances->driver_license_number = $request->driver_license_number;
       $ambulances->driver_phone = $request->driver_phone;
       $ambulances->is_available = 1;
       $ambulances->car_type = $request->car_type;
       $ambulances->save();

       //insert trans
       $ambulances->driver_name = $request->driver_name;
       $ambulances->notes = $request->notes;
       $ambulances->save();

         DB::commit();
         session()->flash('add');
         return redirect()->route('Ambulance.create');
     }
     catch (\Exception $e) {
         DB::rollback();
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
   
   }

   public function edit($id){

      $ambulances =Ambulance::findorfail($id);
      return view('Dashboard.Ambulance.Edit',compact('ambulances'));

   }

   public function update($request){
      if (!$request->has('is_available'))
      $request->request->add(['is_available' => 2]);
  else
      $request->request->add(['is_available' => 1]);

      //  return $request;
      $ambulance = Ambulance::findOrFail($request->Ambulanceid);
      $ambulance->update($request->all());

      // insert trans
      $ambulance->driver_name = $request->driver_name;
      $ambulance->notes = $request->notes;
      $ambulance->save();

      session()->flash('Update');
      return redirect('Ambulance');
    }
   public function destroy($request)
   {
//    //   return $request;
     Ambulance::destroy($request->id);
      session()->flash('Delete');
      return redirect('Ambulance');
   }

  


}