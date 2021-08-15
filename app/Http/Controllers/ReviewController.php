<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Review::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return (Review::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reviews = Review::Join('users' , 'users.id' , '=' , 'reviews.rater_id')
        ->join('projects' , 'projects.id' , '=' , 'reviews.project_id')
        ->select('reviews.*' , 'projects.name' , 'users.fname' , 'users.lname' , 'users.image')
        ->where('reviews.ratee_id' , $id)
        ->get();
        return $reviews;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function HomeReviews(){
        $reviews = Review::join('users' , 'users.id' , '=' , 'reviews.rater_id')
        ->distinct('reviews.*' , 'users.fname' , 'users.lname' , 'users.image')
        ->where('reviews.rate' , '>=' , '3')
        ->get()
        ->random(3);

        return $reviews;
    }
}
