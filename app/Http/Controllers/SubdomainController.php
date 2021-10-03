<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    public function index($subdomain) {
        return view('subdomain.home', compact('subdomain'));
    }
}
