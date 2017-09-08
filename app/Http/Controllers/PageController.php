<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\budgetyourtrip_api\Accomodation;
use App\budgetyourtrip_api\Categories;
use App\budgetyourtrip_api\Costs;
use App\budgetyourtrip_api\Countries;
use App\budgetyourtrip_api\Currencies;
use App\budgetyourtrip_api\Locations;
use App\Trip;
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

        if(session()->has('itinerary')) {
            session()->forget('itinerary');
            return redirect()->action('PageController@save');
        }
        if($request['location'] === null) {

            $location = session()->get('location');
            $data['array'] = ['location' => $location];

            return view('location', $data);
        } else {
<<<<<<< HEAD
            
            $request->session()->put('location', $request['location']);
=======
            $location = 2988507;
            $request->session()->put('location', $location); 
>>>>>>> 8eab1113fcbfd1995e712cdd54e93a0ef3fb5d38
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
            $costs = new Costs(env('API_KEY'));
            $cost_data = $costs->getLocation($location);
            $cost_per_day = $cost_data[count($cost_data) - 1];
            $average_cost_per_day = $cost_per_day->value_midrange;
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_cost_per_day_summary = $currencies->convert('EURO', 'USD', $average_cost_per_day);
            $USD_average_cost_per_day = round($USD_average_cost_per_day_summary->newAmount, 2);
            $average_trip_cost = round(($days * $USD_average_cost_per_day_summary->newAmount), 2);
            // $category_ids = [];
            // foreach($cost_data as $categories){
            //     array_push($category_ids, $categories->category_id);
            // }
            // $categories = new Categories(env('API_KEY'));
            // $categories_description = [];
            // foreach($category_ids as $id){
            //     array_push($categories_description, $categories->getCategories($id));
            // }
            // var_dump($category_ids);
            // var_dump($categories_description);
            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'Average Cost per Person' => number_format((float)$average_trip_cost, 2, '.', ''), 'Average Cost per Person per Day' => number_format((float)$USD_average_cost_per_day, 2, '.', '')];
            
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

            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations];

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

            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations, 'transportation'=> $transportation];

            return view('food', $data);
        } else {
            $request->session()->put('food', $request['food']);
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

            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations, 'transportation' => $transportation, 'food'=>$food];
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
<<<<<<< HEAD
        $food = session()->get('food');

        $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations, 'transportation' => $transportation, 'food'=>$food, 'entertainment' => $entertainment];
=======
        $transportation = session()->get('transportation');
        $food = session()->get('food');
        $entertainment = session()->get('entertainment');
        $food = session()->get('food');

        $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations, 'transportation' => $transportation, 'food'=>$food, 'entertainment' => $entertainment];

>>>>>>> 8eab1113fcbfd1995e712cdd54e93a0ef3fb5d38
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
    public function save(Request $request)
    {
        $entertainment = session()->get('entertainment');
        $transportation = session()->get('transportation');
        $location = session()->get('location');
        $days = session()->get('days');
        $groupsize = session()->get('groupsize');
        $accommodations = session()->get('accommodations');
        $food = session()->get('food');

        $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations, 'transportation' => $transportation, 'food'=>$food, 'entertainment' => $entertainment];

        return view('/save', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trip = new trip();
        $trip->user_id = Auth::id();
        $trip->trip_name = $request->trip_name;
        $trip->location = session()->get('location');
        $trip->groupsize = session()->get('groupsize');
        $trip->days = session()->get('days');
        $trip->accommodations = session()->get('accommodations');
        $trip->transportation = session()->get('transportation');
        $trip->food = session()->get('food');
        $trip->save();

        session()->flush();

        $request->session()->flash("successMessage", "Your post was saved successfully");


        // var_dump($request);

        return view('layouts.location');






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

