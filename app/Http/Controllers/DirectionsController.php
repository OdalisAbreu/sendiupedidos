<?php

namespace App\Http\Controllers;

use App\Directions;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;

class DirectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Directions  $directions
     * @return \Illuminate\Http\Response
     */
    public function show(Directions $directions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Directions  $directions
     * @return \Illuminate\Http\Response
     */
    public function edit(Directions $directions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Directions  $directions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Directions $directions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Directions  $directions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Directions $directions)
    {
        //
    }

    public function map(){
       
        $gmap = new GMaps();

       // $config['center'] = '{ lat: -34.397, lng: 120.644 }';
       $config['center'] = '18.445480, -69.950365';
        $config['zoom'] = '14';
        $config['map_height'] = '600px'; 
        //$config['map_width'] = '500px';
       // $config['scrollwheel'] = false;
        
        $gmap->initialize($config);

        //Añadir marca
        $marker['position'] = '18.445480, -69.950365';
        //$marker['location'] = '18.463142, -69.941539';
        // $marker['infowindow_content'] = '18.463142, -69.941539';
        //$marker['icon'] = 'URL';
        $gmap->add_marker($marker);


        $map = $gmap->create_map();



        return view('admin.orders.map')->with('map', $map);
    }
}
