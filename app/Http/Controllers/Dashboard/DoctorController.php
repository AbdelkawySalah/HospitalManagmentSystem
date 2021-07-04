<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Interfaces\Doctors\DoctorRepositoryInterface;

class DoctorController extends Controller
{
    
    private $Doctors;
    public function __construct(DoctorRepositoryInterface $Doctors)
    {
       //Sections1 اصبح فيها كل اللي في ريبروستري 
        $this->Doctors=$Doctors;
    }
    public function index()
    {
       return  $this->Doctors->index();
    }

   
    public function create()
    {
        return  $this->Doctors->create();
    }

   
    public function store(Request $request)
    {
        return  $this->Doctors->store($request);

    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        return  $this->Doctors->edit($id);
    }

    
    public function update(Request $request)
    {
        //
        return  $this->Doctors->update($request);
    }

    public function destroy(Request $request)
    {
        return  $this->Doctors->destroy($request);

    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        $val=$request->validate(
            [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ],
        );
        return  $this->Doctors->update_password($request);

    }

    public function update_status(Request $request)
    {
       //دي عشان احمي الحالة بتاعتي من الاختراق فبقوله انها تكون بين 0 و1 فقط
        $this->validate($request, [
            'status' => 'required|in:0,1',
        ]);
        return  $this->Doctors->update_status($request);

    }
}
