<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


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
            $data['location'] = $location;
            var_dump($data);
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
            $data['location'] = $location;
            $data['days'] = $days;
            var_dump($data);
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
            $data['location'] = $location;
            $data['days'] = $days;
            $data['groupsize'] = $groupsize;
            var_dump($data);
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
            $data['location'] = $location;
            $data['days'] = $days;
            $data['groupsize'] = $groupsize;
            $data['accommodations'] = $accommodations;
            var_dump($data);
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
            $data['location'] = $location;
            $data['days'] = $days;
            $data['groupsize'] = $groupsize;
            $data['accommodations'] = $accommodations;
            $data['transportation'] = $transportation;
            var_dump($data);
            return view('food', $data); 
        } else {
            $request->session()->put('food', $request['food']);
            $food = session()->get('food');
            return redirect()->action('PageController@entertainment');
        }
    }
    public function entertainment(Request $request)
    {
        if($request['entertainment'] === null) {
            $location = session()->get('location');
            $days = session()->get('days');
            $groupsize = session()->get('groupsize');
            $accommodations = session()->get('accommodations');
            $transportation = session()->get('transportation');
            $food = session()->get('food');
            $data['location'] = $location;
            $data['days'] = $days;
            $data['groupsize'] = $groupsize;
            $data['accommodations'] = $accommodations;
            $data['transportation'] = $transportation;
            $data['food'] = $food;
            var_dump($data);
            return view('entertainment', $data); 
        } else {
            $request->session()->put('entertainment', $request['entertainment']);
            $entertainment = session()->get('entertainment');
            dd($entertainment);
            return redirect()->action('PageController@overview');
        }
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
