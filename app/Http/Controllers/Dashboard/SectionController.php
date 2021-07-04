<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\Sections\SectionRepositoryInterface;
class SectionController extends Controller
{
    
    private $Sections;
    public function __construct(SectionRepositoryInterface $Sections)
    {
       //Sections1 اصبح فيها كل اللي في ريبروستري 
        $this->Sections1=$Sections;
    }
    public function index()
    {
     
        return $this->Sections1->index();
    }

    public function store(Request $request)
    {
        //
        return $this->Sections1->store($request);
    }

    public function update(Request $request)
    {
        return $this->Sections1->update($request);
    }

    public function destroy(Request $request)
    {
        //
        return $this->Sections1->destroy($request);

    }

    public function show($id){
        return $this->Sections1->show($id);
    }
}
