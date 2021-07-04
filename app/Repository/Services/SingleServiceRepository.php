<?php
namespace App\Repository\Services;
use App\Interfaces\Services\SingleServiceRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   
use App\Models\Service;

class SingleServiceRepository implements SingleServiceRepositoryInterface
{
   public function index(){
    //    echo 'dddd';
   //   print_r('ddcffffd');
      $services=Service::all();
      // return $services;
      return view('Dashboard.Services.Single Service.index',compact('services'));
   }

   public function store($request){

      try {
         $SingleService = new Service();
         $SingleService->price = $request->price;
         $SingleService->description = $request->description;
         $SingleService->status = 1;
         $SingleService->save();

         // store trans
         $SingleService->name = $request->name;
         $SingleService->save();

         session()->flash('add');
         return redirect()->route('Service.index');

     }
     catch (\Exception $e) {
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
   }

   public function update($request)
   {
    //   سبني افكر فيها لان فيها فكره كدة هدور عليها فاضي ندور
    //معاك طبعا اتفضل يبشمهندس 
    //انا بقالي ايام بدور علي الحل مش عارف والله
    try {


        $SingleService = Service::findOrFail($request->IdServiceHideen);
        // return  $SingleService;

        $SingleService->price = $request->price;
        $SingleService->description = $request->description;
        $SingleService->status = $request->status;
        $SingleService->save();

        // store trans
        $SingleService->name = $request->name;
        $SingleService->save();

        session()->flash('Update');
        return redirect()->route('Service.index');

    }
    catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


   }
       

    

     public function destroy($request){
         // return $request;
         Service::destroy($request->id);
         session()->flash('Delete');
         return redirect()->route('Service.index');
    }

}