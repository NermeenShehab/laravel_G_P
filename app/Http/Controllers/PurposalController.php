<?php

namespace App\Http\Controllers;
use App\Models\Purposal;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class PurposalController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function index()
    {
        return purposal::all();
    }*/

    public function index()
    {
        $purposals = Purposal::join('projects', 'purposals.project_id', '=', 'projects.id')
            ->join('users', 'users.id', '=', 'purposals.developer_id')
            ->select('users.fname', 'users.lname', 'users.image' ,'projects.name as project_name', 'purposals.*')
            ->get();

        return ($purposals);
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        return Purposal::create($request->all());
    }

 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function show($id)
    {
        return project::find($id);
    }*/

    public function getPurposal($id)
    {
        $purposal = Purposal::join('projects', 'purposals.project_id', '=', 'projects.id')
            ->join('users', 'users.id', '=', 'purposals.developer_id')
            ->where('purposals.id', $id)
            ->select('users.fname', 'users.lname', 'users.image' ,'projects.name as project_name', 'purposals.*')
            ->first();
        return $purposal;
    }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $purposal = Purposal::find($id);
        return $purposal->update($request->all());
    }


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Purposal::destroy($id);
    }
}
