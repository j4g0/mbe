<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Counseling;
use App\Http\Resources\Counseling as CounselingResource;

class CounselingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /* $counselings = Counseling::orderBy('date', 'desc')->paginate(20); */
      $counselings = Counseling::orderBy('date', 'desc')->get();
      return CounselingResource::collection($counselings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $counseling = new Counseling;
      $counseling->client_id = $request->client_id;
      $counseling->description = $request->description;
      $counseling->date = $request->date;

      if($counseling->save()){
        return new CounselingResource($counseling);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $counseling = Counseling::find($id);
      return new CounselingResource($counseling);
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
      $counseling = Counseling::find($id);
      $counseling->client_id = $request->client_id;
      $counseling->description = $request->description;
      $counseling->date = $request->date;

      if($counseling->save()){
        return new CounselingResource($counseling);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $counseling = Counseling::find($id);
      if($counseling->delete()){
        return new CounselingResource($counseling);
      }
    }
}
