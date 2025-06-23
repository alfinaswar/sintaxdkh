<?php

namespace App\Http\Controllers;

use App\Models\DataInventaris;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $user = User::where('KodeRS', auth()->user()->KodeRS)->count();
        $inv = DataInventaris::where('KodeRS', auth()->user()->id)->count();
        return view('home', compact('user', 'inv'));
    }
}
