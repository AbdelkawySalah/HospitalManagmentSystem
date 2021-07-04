<?php
namespace App\Repository\Sections;
use App\Interfaces\Sections\SectionRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{
   public function index(){
    //    get all sections;
    $sections=Section::all();
    return view('Dashboard.Sections.index',compact('sections'));
   }

   public function store($request){

      Section::create([
         'name'=>$request->section_name
      ]);
      session()->flash('add');
      return redirect()->route('Sections.index');
   }

   public function update($request){
      $section=Section::findOrFail($request->sectionid);
      $section->update([
       //   'name'=>$request->input(sectionname),
          $section->name=$request->sectionname,
          $section->description=$request->description,
      ]);
      session()->flash('Update');
      return redirect('/Sections');
   }

   public function destroy($request)
   {
      $section=Section::findOrFail($request->sectionid)->delete();
      session()->flash('Delete');
      return redirect('/Sections');

   }

   public function show($id){
      // return $id;
      // $doctors =Doctor::where('section_id',$id)->get();
      $doctors =Section::findOrFail($id)->doctors;
      // return $doctors;
      $section = Section::findOrFail($id);
      return view('Dashboard.Sections.show_doctors',compact('doctors','section'));
  }


}