<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function index(Country $country)
    {
        return view('countries.index')->with(['questions' => $country->getByCountry()]);
    }
}
