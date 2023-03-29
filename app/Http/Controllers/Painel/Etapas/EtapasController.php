<?php

namespace App\Http\Controllers\Painel\Etapas;

use App\Http\Controllers\Controller;
use App\Models\etapa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtapasController extends Controller
{
    public $request;
    public function __construct(Request $request)
    {
       $this->middleware('auth');
       $this->request = $request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etapaProduto =[];
        $user = Auth()->User();
        $userId = $user['id'];
        $uri = $this->request->route()->uri();
        $exploder = explode('/', $uri);
        $urlAtual = $exploder[1];

        $produto = DB::table('produtos')->get();

        $etapa = DB::table('produtos')
        ->join('etapas', 'produtos.id', '=',  'etapas.id_produto')
        ->get();


        return view('Painel.Etapa.index', compact('user','urlAtual', 'produto','etapa','userId'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $converte = '';
        $data = $request->all();
        // dd($data);
        etapa::create($data);
        return back();

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $etapa = etapa::findOrFail($request->etapa_id);
        $data = $request->all();
        // dd($data);
        if(!$request->get('status')){ $data['status'] = 0; }
        $etapa->update($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        if(!$request->get('deletado')){ $data['deletado'] = 1; }
        $etapa = etapa::findOrFail($request->etapa_id);
        
        $etapa->update($data);
        DB::table('campos')
        ->where('id_etapas', '=', $etapa['id'])
        ->update([
            'deletado' => 1,
            'user'=>$etapa['user']
        ]);

        return back();
    }
}
