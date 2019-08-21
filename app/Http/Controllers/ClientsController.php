<?php

namespace App\Http\Controllers;

use App\Client as Business;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ClientsController extends Controller
{
    /**
     * Display business details on home page
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $client = Business::first(); // Fetch the first client ID with details
        return view('clients.index')->with('client',$client);
    }

    /**
     * Display Business opening hours fetched from Google Places API
     *
     * @return \Illuminate\Http\Response
    */
    public function openingHours()
    {
        $status = "";
        $openingHours = array();
        $business = Business::first();
        $googleAPIKey = env('GOOGLE_API_KEY');
        $businessName = $business->name;

        //create new instance of Client class
        $client = new Client();
 
        //Request Google Places Search API to find place_id
        $url = 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input='.urlencode($businessName).'&inputtype=textquery&fields=place_id,opening_hours&key='.$googleAPIKey;

        //send get request to fetch data
        $response = $client->request('GET', $url,['decode_content' => false]);
        //check response status ex: 200 is 'OK'
        if ($response->getStatusCode() == 200 && (string)$response->getBody()) { 
 
            //get body content
            $body = (string)$response->getBody();
            $data = json_decode($body);
            $status = ($data->candidates[0]->opening_hours->open_now)?'<p><b>Open</b></p>':'<p style="color:red"><b>Closed</b></p>';
          
                    // Call Places Details API to find opening hours detailed information
                    $url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid='.$data->candidates[0]->place_id.'&fields=name,opening_hours&key='.$googleAPIKey;
                   
                    $placeDetail = $client->request('GET', $url);
                    if ($placeDetail->getStatusCode() == 200){
                        //get body content
                        $body = (string)$placeDetail->getBody();
                        $data = json_decode($body);
                        $openingHours = $data->result->opening_hours->weekday_text;
                    }
    }else{
        $status = "<p style='color:red'>There is some problem in API returing the data.</p>";
    }
    $viewData = array('businessName'=>$businessName, 'status'=>$status, 'openingHours'=>$openingHours);
    return view('clients.openingHours')->with('data',$viewData);
}
}