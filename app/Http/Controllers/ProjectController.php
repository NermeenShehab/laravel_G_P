<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return project::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return project::create($request->all());
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
   public function gettProject($id)
    {
        $project = Project::join('categories', 'projects.category_id', '=', 'categories.id')
            ->join('users', 'users.id', '=', 'projects.developer_id')
            ->where('projects.id', $id)
            ->select('users.fname', 'users.lname', 'categories.name as cat_name', 'projects.*')
            ->first();
        return $project;
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
        $project = project::find($id);
        return $project->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return project::destroy($id);
    }

    public function getMostProjects()
    {
        $projects = Project::join('categories', 'projects.category_id', '=', 'categories.id')
            ->join('users', 'users.id', '=', 'projects.developer_id')
            ->join('reviews' , 'projects.id' , '=' , 'reviews.project_id')
            ->select('users.fname', 'users.lname', 'categories.name as cat_name', 'projects.*' , 'reviews.rate as project_rate')
            ->orderBy('reviews.rate')
            ->limit(3)
            ->get();

        return ($projects);
    }

    //get count of projects
    public function count($id, $status)
    {
        $count = project::where('developer_id', $id)->where('status', $status)->count();
        return $count;
    }

    //get active projects related with the developer
    public function active($id)
    {
        return DB::table('projects')->where('developer_id', $id)->get();
    }

    public function recent($category_id)
    {
        $projects = Project::join('users', 'projects.owner_id', '=', 'users.id')
        ->where('projects.category_id', $category_id)
        ->where('projects.status', 'pending')
        ->select('projects.id','projects.name' ,'projects.description','projects.created_at','users.image' , 'users.fname','users.lname' )
        ->limit(5)
        ->get();

        return $projects ;
    }


}
