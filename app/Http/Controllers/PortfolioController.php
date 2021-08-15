<?php

namespace App\Http\Controllers;

use App\Models\portfolio;
use App\Models\PortfolioSkill;
use App\Models\PortfolioImage ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return portfolio::all();
    }
    // 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id )
    {
        $image = $request->file('image');
        if($request->hasFile('image')){
            $imgName=rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/storage/images/portfolios'),$imgName);

            $portfolio = new Portfolio() ;
            $portfolio->images = $imgName ;
            $portfolio->name = $request->name;
            $portfolio->description = $request->description;
            $portfolio->link = $request->link;
            $portfolio->skills = explode(",", $request->skills);
            $portfolio->user_id = $id ;
            $portfolio->save();
            return response()->json("done .. thx");
        }else{
            return response()->json('image null');
        }
                // $input = $request->only('name', 'description','link','user_id','skills');
        //     return portfolio::create($input);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return portfolio::find($id);
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
        $portfolio = portfolio::find($id);
        return $portfolio->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return portfolio::destroy($id);
    }

    //get count of portfolio
    public function count($user_id)
    {
        $count=portfolio::where('user_id',$user_id)->count();
        return $count;
    }




}


