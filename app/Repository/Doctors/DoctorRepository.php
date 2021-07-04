<?php
namespace App\Repository\Doctors;
use App\Interfaces\Doctors\DoctorRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DoctorRepository implements DoctorRepositoryInterface
{
   use UploadTrait;
   
   public function index(){
    //    get all sections;
   // $doctors=Doctor::all();
   $doctors=Doctor::with('doctorappointments')->get();
//   return $doctors;
   return view('Dashboard.Doctors.index',compact('doctors'));
   }
   
   public function create()
   {
      $sections=\App\Models\Section::all();
      $appointments=Appointment::all();
      return view('Dashboard.Doctors.add',compact('sections','appointments'));

      // return $sections;
   }
   public function store($request){
      DB::beginTransaction();

      try {

          $doctors = new Doctor();
          $doctors->email = $request->email;
          $doctors->password = Hash::make($request->password);
          $doctors->section_id = $request->section_id;
          $doctors->phone = $request->phone;
         //  $doctors->price = $request->price;
          $doctors->status = 1;
          $doctors->save();
          // store trans
          $doctors->name = $request->name;
          $doctors->save();
       
        // insert pivot tABLE
        $doctors->doctorappointments()->attach($request->appointments);

 // update pivot tABLE
         // $doctors->doctorappointments()->sync($request->appointments);
          //Upload img
          $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\Doctor');

          DB::commit();
          session()->flash('add');
          return redirect()->route('Doctors.create');

      }
      catch (\Exception $e) {
          DB::rollback();
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

   }

   public function update($request){
      DB::beginTransaction();

      try {

         $doctors = Doctor::findorfail($request->id);
          $doctors->email = $request->email;
          $doctors->section_id = $request->section_id;
          $doctors->phone = $request->phone;
          $doctors->save();
          // doctor trans
          $doctors->name = $request->name;
          $doctors->save();

         // update pivot tABLE
         $doctors->doctorappointments()->sync($request->appointments);


        // update photo
        if ($request->has('photo')){
         // Delete old photo
         if ($doctors->image){
             $old_img = $doctors->image->filename;
             $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id);
         }
         //Upload img
         $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
     }
          DB::commit();
          session()->flash('Update');
          return redirect()->route('Doctors.index');

      }
      catch (\Exception $e) {
          DB::rollback();
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

     
   }

   public function destroy($request)
   {
         //معنها انه اختار دكتور واحد بس للحذف
      if($request->page_id==1){
      //لو هوه جاي معانا بصورة للطبيب هيروح ينفذ تريت ويحذف صورة من قاعدة بيانات وجهاز
         if($request->filename){
           $this->Delete_attachment('upload_image','doctors/'.$request->filename,$request->id,$request->filename);
         }
         //سواء في صورة او مفيش كده كده هيدخل هنا عشان يحذف من قاعدة البيانات           
         Doctor::destroy($request->id);
            session()->flash('Delete');
            return redirect()->route('Doctors.index');
        }
  
  
        //---------------------------------------------------------------
  
        else{
  
           // delete selector doctor
           $delete_select_id = explode(",", $request->delete_select_id);
         //   return $delete_select_id;
           foreach ($delete_select_id as $ids_doctors){
               $doctor = Doctor::findorfail($ids_doctors);
               if($doctor->image){
                   $this->Delete_attachment('upload_image','doctors/'.$doctor->image->filename,$ids_doctors,$doctor->image->filename);
               }
           }
 
           Doctor::destroy($delete_select_id);
           session()->flash('Delete');
           return redirect()->route('Doctors.index');
  
        }
  
  
  
      

   }

   public function edit($id)
   {
        $sections = Section::all();
        $appointments = Appointment::all();
        $doctor = Doctor::findorfail($id);
        return view('Dashboard.Doctors.Edit',compact('sections','appointments','doctor'));
   }

   public function update_password($request){

      try {
         $doctor = Doctor::findorfail($request->id);
         $doctor->update([
             'password'=>Hash::make($request->password)
            // 'password'=>$request->password

         ]);

         session()->flash('Update');
         return redirect()->back();
     }

     catch (\Exception $e) {
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }   

   }

   public function update_status($request)
   {
      try {
         $doctor = Doctor::findorfail($request->id);
         $doctor->update([
             'status'=>$request->status
         ]);

         session()->flash('Update');
         return redirect()->back();
     }

     catch (\Exception $e) {
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }   
   }

  
}