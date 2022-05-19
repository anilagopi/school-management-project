<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Construct for controller
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Loads Home Index Page
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('home');
    }
}
