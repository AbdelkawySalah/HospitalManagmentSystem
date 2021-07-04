<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Http\Requests\StoreSingleServiceRequest;
class SingleServiceController extends Controller
{
    private $SingleService;
    public function __construct(SingleServiceRepositoryInterface $SingleService)
    {
       //Sections1 اصبح فيها كل اللي في ريبروستري 
        $this->SingleService=$SingleService;
    }
    public function index()
    {
        return  $this->SingleService->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSingleServiceRequest $request)
    {
        
        return  $this->SingleService->store($request);

    }

  
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(StoreSingleServiceRequest $request)
    {

    //   return $request;
        return  $this->SingleService->update($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return  $this->SingleService->destroy($request);

    }
}
