<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Yajra\DataTables\Facades\DataTables;

class ApiCovidController extends Controller
{
    public function positif()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.kawalcorona.com/positif');
        return $response->getBody();
        
    }

    public function recovered()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.kawalcorona.com/sembuh');
        return $response->getBody();
        
    }

    public function death()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.kawalcorona.com/meninggal');
        return $response->getBody();
        
    }

    public function world()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.kawalcorona.com');
        $array = json_decode($response->getBody());
        return DataTables::of($array)
        ->addIndexcolumn()->make(true);
        
        
    }

    public function indonesiaCase()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.kawalcorona.com/indonesia/');
        return $response->getBody();
        
    }


    public function indonesia()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.kawalcorona.com/indonesia/provinsi/');
        $array = json_decode($response->getBody());
        return DataTables::of($array)
        ->addIndexcolumn()->make(true);
        
        
    }
}
