<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    public function index()
    {
        $user = User::find(Auth()->user()->id);
        $user_country = [];
        foreach ($user->country as $aux) {
            $user_country = $aux;
        }

        $role = $this->getRoleUserLogguedIn();

        return view('home')
                ->with('role', $role)
                ->with('user', $user)
                ->with('user_country', $user_country);
    }

    private function getRoleUserLogguedIn(){
        $dato = User::find(Auth()->user()->id);

        foreach ($dato->getRoleNames() as $aux) {
            $role = $aux;
        }

        return $role;
    }
}
