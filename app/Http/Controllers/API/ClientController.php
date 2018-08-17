<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Http\Resources\Client as ClientResource;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $clients = Client::get()->sortByDesc('id');
      return ClientResource::collection($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $client = new Client;
      $client->first_name = $request->input('first_name');
      $client->last_name = $request->input('last_name');

      if($client->save()){
        return new ClientResource($client);
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
      $client = Client::findOrFail($id);
      /* $client = Client::with('counselings')->find($id); */
      return new ClientResource($client);
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
      $client = Client::findOrFail($id);
      $client->first_name = $request->input('first_name');
      $client->last_name = $request->input('last_name');

      if($client->save()){
        return new ClientResource($client);
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
      $client = Client::find($id);
      if($client->delete()){
        return new ClientResource($client);
      }
    }
}
