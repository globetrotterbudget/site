<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function location(Request $request)
    {
        if($request['location'] === null) {
            return view('layouts.location');
        } else {
            $request->session()->put('location', $request['location']);
            return redirect()->action('PageController@days');
        }
    }
    public function days(Request $request)
    {
        if($request['days'] === null) {

            $location = session()->get('location');
            $data['array'] = ['location' => $location];

            return view('days', $data);

        } else {

            $request->session()->put('days', $request['days']);
            return redirect()->action('PageController@groupsize');
        }
    }
    public function groupsize(Request $request)
    {
        if($request['groupsize'] === null) {

            $location = session()->get('location');
            $days = session()->get('days');
            $data['array'] = ['location' => $location, 'days' => $days];

            return view('groupsize', $data);

        } else {

            $request->session()->put('groupsize', $request['groupsize']);
            return redirect()->action('PageController@accommodations');
        }
    }
    public function accommodations(Request $request)
    {
        if($request['accommodations'] === null) {

            $location = session()->get('location');
            $days = session()->get('days');
            $groupsize = session()->get('groupsize');

            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize];
            
            return view('accommodations', $data);

        } else {

            $request->session()->put('accommodations', $request['accommodations']);
            return redirect()->action('PageController@transportation');
        }
    }
    public function transportation(Request $request)
    {
        if($request['transportation'] === null) {
            $location = session()->get('location');
            $days = session()->get('days');
            $groupsize = session()->get('groupsize');
            $accommodations = session()->get('accommodations');

            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, '    accommodations' => $accommodations];

            return view('transportation', $data);
        } else {
            $request->session()->put('transportation', $request['transportation']);
            return redirect()->action('PageController@food');
        }
    }
    public function food(Request $request)
    {
       if($request['food'] === null) {
            $location = session()->get('location');
            $days = session()->get('days');
            $groupsize = session()->get('groupsize');
            $accommodations = session()->get('accommodations');
            $transportation = session()->get('transportation');

            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, '    accommodations' => $accommodations, 'transportation'=> $transportation];

            return view('food', $data);
        } else {
            $request->session()->put('food', $request['food']);
            return redirect()->action('PageController@entertainment');
        } 
    }
    public function entertainment(Request $request)
    {

        if($request['entertainment'] === null) {
            $transportation = session()->get('transportation');
            $location = session()->get('location');
            $days = session()->get('days');
            $groupsize = session()->get('groupsize');
            $accommodations = session()->get('accommodations');
            $transportation = session()->get('transportation');
            $food = session()->get('food');

            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, '    accommodations' => $accommodations, 'transportation' => $transportation, 'food'=>$food];
            return view('entertainment', $data);

        } else {
            $request->session()->put('entertainment', $request['entertainment']);
            return redirect()->action('PageController@summary');
        }

    }

    public function summary(Request $request) {

        $entertainment = session()->get('entertainment');
        $transportation = session()->get('transportation');
        $location = session()->get('location');
        $days = session()->get('days');
        $groupsize = session()->get('groupsize');
        $accommodations = session()->get('accommodations');

        $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, '    accommodations' => $accommodations, 'transportation' => $transportation, 'entertainment' => $entertainment];

        return view('summary', $data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
