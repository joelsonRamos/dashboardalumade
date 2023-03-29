<?php

namespace App\Http\Controllers\Painel\Campos;

use App\Http\Controllers\Controller;
use App\Models\produto;
use App\Models\etapa;
use App\Models\campo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CamposController extends Controller
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
        $campoEtapa =[];
        $user = Auth()->User();
        $userId = $user['id'];
        $uri = $this->request->route()->uri();
        $exploder = explode('/', $uri);
        $urlAtual = $exploder[1];
        
        // $idEtapa = campo::all('id_etapas', 'deletado')->where('deletado', '=', 0);
        
        // foreach($idEtapa as $item){
        //     $campoEtapa[] = $item->id_etapas;
        // }

        $etapa = DB::table('produtos')
        ->join('etapas','produtos.id' , '=', 'etapas.id_produto')
        ->get();

        $campo = DB::table('etapas')
        ->join('produtos', 'etapas.id_produto', '=', 'produtos.id')
        ->join('campos', 'etapas.id', '=', 'campos.id_etapas')
        ->get();
        // dd($campo );
        return view('Painel.Campo.index', compact('user','urlAtual','etapa','campo','userId'));
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
        $data = $request->all();
        // dd($data);
        campo::create($data);
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

        $campo = campo::findOrFail($request->id_campo);
        
        $data = $request->all();
        // dd($data);
        if(!$request->get('status')){ $data['status'] = 0; }
        
        $campo->update($data);
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
        // dd($data);
        $etapa = campo::findOrFail($request->campo_id);
     
        $etapa->update($data);

        return back();
    }
}
