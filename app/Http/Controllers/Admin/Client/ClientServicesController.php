<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientServicesController extends Controller
{
    public function index()
    {
        return view("pages.admin.clientServices.booking.index");
    }
}
