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
use App\Cost;
use App\Entertainment;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutUs(Request $request) 
    {
        return view('auth/about');
    }

    public function startover(Request $request)
    {
        
        session()->forget('location');
        session()->forget('itinerary');
        return view('layouts.location');
    }
    public function location(Request $request)
    {

        if(session()->has('itinerary')) {
            session()->forget('itinerary');
            return redirect()->action('PageController@save');
        }
        if($request['location'] === null) {
            return view('layouts.location');
        } else {
            
            $locations = new Locations(env('API_KEY'));
            $input = explode(',', $request['location']);
            $city = trim(strtolower($input[0]));

            if(strpos($city, ' ') !== false){
                $citySearchable = str_replace(' ', '-', $city);
                $possible_locations = $locations->search($citySearchable);
            } else {
                $possible_locations = $locations->search($city);            
            }
            if(count($input) === 2){
                $province = strtolower(trim($input[1]));
                
                $possible_location_names = [];
                if($possible_locations === []){
                    $request['location'] = null;
                    $request->session()->flash('no_match_error', 'There were no results for your search.');
                    return redirect()->action('PageController@location');
                }
                foreach($possible_locations as $possible_location){
                    array_push($possible_location_names, $possible_location->name);
                    if(strtolower($possible_location->name) === $city && trim(strtolower($possible_location->country_name)) === $province){
                        $location = $possible_location->name;
                        session()->put('geonameid', $possible_location->geonameid);
                        session()->put('currency_code', $possible_location->currency_code);
                    } else if(strtolower($possible_location->name) === $city && trim(strtolower(    $possible_location->statename) === $province)){
                        $location = $possible_location->name;
                        session()->put('geonameid', $possible_location->geonameid);
                        session()->put('currency_code', $possible_location->currency_code);
                    }
                }
                if(session()->has('geonameid') && session()->has('currency_code')){
                    $request->session()->put('location', $location);
                    return redirect()->action('PageController@days');
                } else {
                    $request['location'] = null;
                    $request->session()->flash('no_match_error', 'Did you mean ' . $possible_location_names[0] .'?');
                    return redirect()->action('PageController@location');
                }
            } else {
                $request['location'] = null;
                $request->session()->flash('no_match_error', 'You must enter a city and state/country.');
                return redirect()->action('PageController@location');
            }
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
            $request->session()->put('id', $request['id']);
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
            $geonameid = session()->get('geonameid');
            $currency_code = session()->get('currency_code');
            $costs = new Costs(env('API_KEY'));
            $cost_data = $costs->getLocation($geonameid);
            $cost_per_day = $cost_data[count($cost_data) - 1];
            $average_cost_per_day = $cost_per_day->value_midrange;
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_cost_per_day_summary = $currencies->convert($currency_code, 'USD', $average_cost_per_day);
            $USD_average_cost_per_day = round($USD_average_cost_per_day_summary->newAmount, 2);
            $average_trip_cost = round(($days * $USD_average_cost_per_day_summary->newAmount), 2);
            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'Average Cost per Person per Day' => number_format((float)$USD_average_cost_per_day, 2, '.', '')];
            
            //  Avg cost per person per day...
            // 'Average Cost per Person' => number_format((float)$average_trip_cost, 2, '.', '')
            
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
            $geonameid = session()->get('geonameid');
            $currency_code = session()->get('currency_code');
            $costs = new Costs(env('API_KEY'));
            $cost_data = $costs->getLocation($geonameid);
            $accommodations_per_day = $cost_data[0];
            if ($accommodations <= 2){
                $accommodations_cost_per_day = $accommodations_per_day->value_budget;
            } else if ($accommodations > 2 && $accommodations <= 4){
                $accommodations_cost_per_day = $accommodations_per_day->value_midrange;
            } else if ($accommodations > 3 && $accommodations <= 5){
                $accommodations_cost_per_day = $accommodations_per_day->value_luxury;
            }
            $currencies = new Currencies(env('API_KEY'));

            $USD_average_accommodation_per_day_summary = $currencies->convert($currency_code, 'USD', $accommodations_cost_per_day);
            $USD_average_accommodation_per_day = round($USD_average_accommodation_per_day_summary->newAmount, 2);
            $average_accommodation_cost = round(($days * $USD_average_accommodation_per_day_summary->newAmount), 2);

            if ($groupsize > 1){
                $USD_average_accommodation_per_day /= 2;
                $average_accommodation_cost /= 2;
            }
            session()->put('average_accommodation_cost', number_format((float)$average_accommodation_cost, 2, '.', ''));
            session()->put('average_accommodation_cost_per_day', number_format((float)$USD_average_accommodation_per_day, 2, '.', '') );
            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations . ' stars', 'Average Accomodation Cost per Person per Day' => number_format((float)$USD_average_accommodation_per_day, 2, '.', '')];
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
            $geonameid = session()->get('geonameid');
            $currency_code = session()->get('currency_code');
            $average_accommodation_cost = session()->get('average_accommodation_cost');
            $average_accommodation_cost_per_day = session()->get('average_accommodation_cost_per_day');
            $costs = new Costs(env('API_KEY'));
            $cost_data = $costs->getLocation($geonameid);
            $transportation_cost_per_day = $cost_data[1];
            if($transportation === strtolower('public')){
                $average_transportation_cost_per_day = $transportation_cost_per_day->value_budget;
            } else {
                $average_transportation_cost_per_day = $transportation_cost_per_day->value_luxury;
            }
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_transportation_cost_per_day_summary = $currencies->convert($currency_code, 'USD', $average_transportation_cost_per_day);
            $USD_average_transportation_cost_per_day = round($USD_average_transportation_cost_per_day_summary->newAmount, 2);
            $average_transportation_cost = round(($days * $USD_average_transportation_cost_per_day_summary->newAmount), 2);
            session()->put('average_transportation_cost', number_format((float)$average_transportation_cost, 2, '.', ''));
            session()->put('average_transportation_cost_per_day', number_format((float)$USD_average_transportation_cost_per_day, 2, '.', '') );
            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations . ' stars', 'Average Accomodation Cost per Person per Day'=>$average_accommodation_cost_per_day, 'transportation'=> $transportation, 'Transportation Cost per Person per Day'=> number_format((float)$USD_average_transportation_cost_per_day, 2, '.', ''), 'Transportation Cost per Person'=> number_format((float)$average_transportation_cost, 2, '.', ''), 'Total Trip Cost' => $average_transportation_cost + $average_accommodation_cost];

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
            $geonameid = session()->get('geonameid');
            $currency_code = session()->get('currency_code');
            $average_accommodation_cost_per_day = session()->get('average_accommodation_cost_per_day');
            $average_accommodation_cost = session()->get('average_accommodation_cost');
            $average_transportation_cost_per_day = session()->get('average_transportation_cost_per_day');
            $average_transportation_cost  = session()->get('average_transportation_cost');
            $costs = new Costs(env('API_KEY'));
            $cost_data = $costs->getLocation($geonameid);
            $food_cost_per_day = $cost_data[2];
            if($food === 'lowest'){
                $average_food_cost_per_day = $food_cost_per_day->value_budget;
            } else if($food === 'modest') {
                $average_food_cost_per_day = $food_cost_per_day->value_midrange;
            } else {
                $average_food_cost_per_day = $food_cost_per_day->value_luxury;
            }
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_food_cost_per_day_summary = $currencies->convert($currency_code, 'USD', $average_food_cost_per_day);
            $USD_average_food_cost_per_day = round($USD_average_food_cost_per_day_summary->newAmount, 2);
            $average_food_cost = round(($days * $USD_average_food_cost_per_day_summary->newAmount), 2);
            $cost_highlights = $costs->getHighlights($geonameid);
            $entertainment_options = [];
            foreach($cost_highlights as $highlight){
                if($highlight->category_id === '6'){
                    $USD_entertainment_costs = $currencies->convert($currency_code, 'USD', $highlight->cost);
                    $USD_entertainment_cost = round($USD_entertainment_costs->newAmount, 2);
                    $highlight->cost = $USD_entertainment_cost;
                    array_push($entertainment_options, $highlight);
                };
            }
 
            session()->put('average_food_cost_per_day', $USD_average_food_cost_per_day);
            session()->put('average_food_cost', $average_food_cost);
            $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations . ' stars', 'Average Accommodation Cost per Person per Day' => $average_accommodation_cost_per_day, 'transportation' => $transportation, 'Average Transportation Cost Per Person Per Day' => $average_transportation_cost_per_day, 'food'=>$food, 'Meal Cost per Day Per Person'=> number_format((float)$USD_average_food_cost_per_day, 2, '.', ''), 'Meal Cost per Person'=> number_format((float)$average_food_cost, 2, '.', ''), 'Total Trip Cost' => $average_transportation_cost + $average_accommodation_cost + $average_food_cost];
            $data['entertainmentOptions'] = $entertainment_options;

            return view('entertainment', $data);

        } else {
            
            $request->session()->put('entertainment', $request['entertainment']);
            return redirect()->action('PageController@summary');
        }

    }
    public function paris_feature() {
        session()->put('location', 'Paris');
        session()->put('geonameid', 2988507);
        session()->put('days', 7);
        session()->put('groupsize', 2);
        session()->put('accomodations', 3);
        session()->put('transportation', 'public');
        session()->put('entertainment', '');
        session()->put('food', 'modest');
        $costs = new Costs(env('API_KEY'));
            $cost_data = $costs->getLocation(2988507);
            $accommodations_per_day = $cost_data[0];
            $accommodations_cost_per_day = $accommodations_per_day->value_midrange;
            $currencies = new Currencies(env('API_KEY'));

            $USD_average_accommodation_per_day_summary = $currencies->convert('EUR', 'USD', $accommodations_cost_per_day);
            $USD_average_accommodation_per_day = round($USD_average_accommodation_per_day_summary->newAmount, 2);
            $average_accommodation_cost = round((7 * $USD_average_accommodation_per_day_summary->newAmount), 2);
            $USD_average_accommodation_per_day /= 2;
            $average_accommodation_cost /= 2;
            $transportation_cost_per_day = $cost_data[1];
            $average_transportation_cost_per_day = $transportation_cost_per_day->value_budget;
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_transportation_cost_per_day_summary = $currencies->convert('EUR', 'USD', $average_transportation_cost_per_day);
            $USD_average_transportation_cost_per_day = round($USD_average_transportation_cost_per_day_summary->newAmount, 2);
            $average_transportation_cost = round((7 * $USD_average_transportation_cost_per_day_summary->newAmount), 2);
            $food_cost_per_day = $cost_data[2];
            $average_food_cost_per_day = $food_cost_per_day->value_midrange;
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_food_cost_per_day_summary = $currencies->convert('EUR', 'USD', $average_food_cost_per_day);
            $USD_average_food_cost_per_day = round($USD_average_food_cost_per_day_summary->newAmount, 2);
            $average_food_cost = round((7 * $USD_average_food_cost_per_day_summary->newAmount), 2);
 
            session()->put('average_food_cost_per_day', $USD_average_food_cost_per_day);
            session()->put('average_food_cost', $average_food_cost);
            session()->put('average_transportation_cost', number_format((float)$average_transportation_cost, 2, '.', ''));
            session()->put('average_transportation_cost_per_day', number_format((float)$USD_average_transportation_cost_per_day, 2, '.', '') );
            session()->put('average_accommodation_cost', number_format((float)$average_accommodation_cost, 2, '.', ''));
            session()->put('average_accommodation_cost_per_day', number_format((float)$USD_average_accommodation_per_day, 2, '.', '') );
        return redirect()->action('PageController@summary');
    }
    public function tel_aviv_feature() {
        session()->put('location', 'Tel Aviv-Yasof');
        session()->put('currency_code', 'NIS');
        session()->put('days', 7);
        session()->put('groupsize', 2);
        session()->put('accomodations', 3);
        session()->put('transportation', 'public');
        session()->put('entertainment', '');
        session()->put('food', 'modest');
        $costs = new Costs(env('API_KEY'));
            $cost_data = $costs->getLocation(293394);
            $accommodations_per_day = $cost_data[0];
            $accommodations_cost_per_day = $accommodations_per_day->value_midrange;
            $currencies = new Currencies(env('API_KEY'));

            $USD_average_accommodation_per_day_summary = $currencies->convert('NIS', 'USD', $accommodations_cost_per_day);
            $USD_average_accommodation_per_day = round($USD_average_accommodation_per_day_summary->newAmount, 2);
            $average_accommodation_cost = round((7 * $USD_average_accommodation_per_day_summary->newAmount), 2);
            $USD_average_accommodation_per_day /= 2;
            $average_accommodation_cost /= 2;
            $transportation_cost_per_day = $cost_data[1];
            $average_transportation_cost_per_day = $transportation_cost_per_day->value_budget;
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_transportation_cost_per_day_summary = $currencies->convert('NIS', 'USD', $average_transportation_cost_per_day);
            $USD_average_transportation_cost_per_day = round($USD_average_transportation_cost_per_day_summary->newAmount, 2);
            $average_transportation_cost = round((7 * $USD_average_transportation_cost_per_day_summary->newAmount), 2);
            $food_cost_per_day = $cost_data[2];
            $average_food_cost_per_day = $food_cost_per_day->value_midrange;
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_food_cost_per_day_summary = $currencies->convert('NIS', 'USD', $average_food_cost_per_day);
            $USD_average_food_cost_per_day = round($USD_average_food_cost_per_day_summary->newAmount, 2);
            $average_food_cost = round((7 * $USD_average_food_cost_per_day_summary->newAmount), 2);
 
            session()->put('average_food_cost_per_day', $USD_average_food_cost_per_day);
            session()->put('average_food_cost', $average_food_cost);
            session()->put('average_transportation_cost', number_format((float)$average_transportation_cost, 2, '.', ''));
            session()->put('average_transportation_cost_per_day', number_format((float)$USD_average_transportation_cost_per_day, 2, '.', '') );
            session()->put('average_accommodation_cost', number_format((float)$average_accommodation_cost, 2, '.', ''));
            session()->put('average_accommodation_cost_per_day', number_format((float)$USD_average_accommodation_per_day, 2, '.', '') );
        return redirect()->action('PageController@summary');
    }
    public function tokyo_feature() {
        session()->put('location', 'Tokyo');
        session()->put('currency_code', 'JPY');
        session()->put('days', 7);
        session()->put('groupsize', 2);
        session()->put('accomodations', 3);
        session()->put('transportation', 'public');
        session()->put('entertainment', '');
        session()->put('food', 'modest');
        $costs = new Costs(env('API_KEY'));
            $cost_data = $costs->getLocation(1850147);
            $accommodations_per_day = $cost_data[0];
            $accommodations_cost_per_day = $accommodations_per_day->value_midrange;
            $currencies = new Currencies(env('API_KEY'));

            $USD_average_accommodation_per_day_summary = $currencies->convert('JPY', 'USD', $accommodations_cost_per_day);
            $USD_average_accommodation_per_day = round($USD_average_accommodation_per_day_summary->newAmount, 2);
            $average_accommodation_cost = round((7 * $USD_average_accommodation_per_day_summary->newAmount), 2);
            $USD_average_accommodation_per_day /= 2;
            $average_accommodation_cost /= 2;
            $transportation_cost_per_day = $cost_data[1];
            $average_transportation_cost_per_day = $transportation_cost_per_day->value_budget;
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_transportation_cost_per_day_summary = $currencies->convert('JPY', 'USD', $average_transportation_cost_per_day);
            $USD_average_transportation_cost_per_day = round($USD_average_transportation_cost_per_day_summary->newAmount, 2);
            $average_transportation_cost = round((7 * $USD_average_transportation_cost_per_day_summary->newAmount), 2);
            $food_cost_per_day = $cost_data[2];
            $average_food_cost_per_day = $food_cost_per_day->value_midrange;
            $currencies = new Currencies(env('API_KEY'));
            $USD_average_food_cost_per_day_summary = $currencies->convert('JPY', 'USD', $average_food_cost_per_day);
            $USD_average_food_cost_per_day = round($USD_average_food_cost_per_day_summary->newAmount, 2);
            $average_food_cost = round((7 * $USD_average_food_cost_per_day_summary->newAmount), 2);
 
            session()->put('average_food_cost_per_day', $USD_average_food_cost_per_day);
            session()->put('average_food_cost', $average_food_cost);
            session()->put('average_transportation_cost', number_format((float)$average_transportation_cost, 2, '.', ''));
            session()->put('average_transportation_cost_per_day', number_format((float)$USD_average_transportation_cost_per_day, 2, '.', '') );
            session()->put('average_accommodation_cost', number_format((float)$average_accommodation_cost, 2, '.', ''));
            session()->put('average_accommodation_cost_per_day', number_format((float)$USD_average_accommodation_per_day, 2, '.', '') );
        return redirect()->action('PageController@summary');
    }
    public function summary(Request $request) {
             
        $location = session()->get('location');
        $days = session()->get('days');
        $groupsize = session()->get('groupsize');
        $accommodations = session()->get('accommodations');
        $transportation = session()->get('transportation');
        $entertainment = session()->get('entertainment');
        $food = session()->get('food');
        $id = session()->get('id');

        $data['array'] = ['location' => $location, 'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations, 'transportation' => $transportation, 'food'=>$food, 'id' => $id, 'entertainment' => $entertainment];
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

        $data['tripNames'] = Trip::select('trip_name')->distinct()->get();

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
        $trip->daily = session()->get('daily');
        $trip->save();

        $cost = new cost();
        $cost->trip_id = $trip->id;
        $cost->accom_day_cost = session()->get('average_accommodation_cost_per_day');
        $cost->accom_cost = session()->get('average_accommodation_cost');
        $cost->avg_food_day_cost = session()->get('average_food_cost_per_day');
        $cost->avg_food_cost = session()->get('average_food_cost');
        $cost->avg_trans_day_cost = session()->get('average_transportation_cost_per_day');
        $cost->avg_trans_cost = session()->get('average_transportation_cost');
        $cost->save();

        $entertainment = (!empty(session()->get('entertainment'))) ? session()->get('entertainment') : [["description"=>"None available","price"=>"0"]];
        
        foreach($entertainment as $options) {

            $option = new entertainment();
            $option->trip_id = $trip->id;
            $option->description = $options['description'];
            $option->price = $options['price'];
            $option->save();

        }

       $request->session()->flash("successMessage", "Your post was saved successfully");


        // var_dump($request);

        return redirect()->action('PageController@trips');
    }
    public function trips()
    {

        $data['tripNames'] = Trip::select('trip_name')->where('user_id', Auth::id())->distinct()->get();

        $tripsArray = $data['tripNames'];

        foreach($tripsArray as $trips){

            $trip = $trips['attributes']['trip_name'];

            $result = \App\Trip::where('user_id', Auth::id())->where('trip_name', $trip)->get();
            

            // $daily = 0;
            $totaldays = 0;
            $cost = 0;
            
            foreach($result as $single)
            {

                $daily = (float)$single['daily'];
                $days = (float)$single['days'];
                $totaldays += (float)$single['days'];
                $cost += (float)($daily * $days);
                $dailyavg = (float)($cost / $totaldays);

                
            }
            $costs[] = [$cost, $dailyavg];
            



            // echo $result[0]['daily'];
        }
            
        $data['costs'] = $costs;
        return view('/trips', $data);

    }
    public function tripDetail($tripName)
    {
        
        $trips = \App\Trip::where('user_id', Auth::id())->where('trip_name', $tripName)->get();

        $data['trips'] = $trips;
        
        return view('/tripdetail', $data);

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
        $trip = \DB::table('trips')->where('id', $id)->get();


        foreach($trip as $key)
        {   

            foreach($key as $value=>$info)
            {
               $array[$value] = $info; 
               
            }
        }
        
        $array = array_splice($array,3,1);
        
        $data['array'] = $array;
        
        return view('/days', $data);

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
        
        $location = ($request->session()->get('location'));
        $days = ($request->session()->get('days'));
        $groupsize = ($request->session()->get('groupsize'));
        $accommodations = ($request->session()->get('accommodations'));
        $transportation = ($request->session()->get('transportation'));
        $food = ($request->session()->get('food'));

        \DB::table('trips')->where('id', $id)->update(['location' => $location,
            'days' => $days, 'groupsize' => $groupsize, 'accommodations' => $accommodations, 'transportation' => $transportation, 'food' => $food]);
        $name = \DB::table('trips')->select('trip_name')->where('id', $id)->get();
        $tripName = $name[0]->trip_name;
        return redirect()->action('PageController@tripDetail', $tripName);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $tripNameArr = \DB::table('trips')->select('trip_name')->where('id', $id)->get();
        $tripName = $tripNameArr[0]->trip_name;

        \DB::table('costs')->where('trip_id', $id)->delete();
        \DB::table('options')->where('trip_id', $id)->delete();
        \DB::table('trips')->where('id', $id)->delete();
        
        return redirect()->action('PageController@tripDetail', $tripName);
    }
}

