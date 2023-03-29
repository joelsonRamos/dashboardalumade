<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $request;
    public function __construct(Request $request)
    {
       $this->middleware('auth');
       $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth()->User();
        $uri = $this->request->route()->uri();
        $exploder = explode('/',$uri);
        $urlAtual = $exploder[0];
        //  dd($urlAtual);

        return view('Painel.index', compact('user', 'urlAtual'));
        // return 'OLaaaaa';
    }

}
