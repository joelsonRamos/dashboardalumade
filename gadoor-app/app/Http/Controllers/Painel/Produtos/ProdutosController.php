<?php

namespace App\Http\Controllers\Painel\Produtos;

use App\Http\Controllers\Controller;
use App\Models\produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProdutosController extends Controller
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
        // dd('teste');
        $user = Auth()->User();
        $userId = $user['id'];
        $uri = $this->request->route()->uri();
        $exploder = explode('/',$uri);
        $urlAtual = $exploder[1];

        $produto = produto::all();
        return view('Painel.Produto.index', compact('user','urlAtual', 'produto','userId' ));
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
        // return $request->all();
        $data = $request->all();
        $data['status'] = 1;
        // dd($data);
        produto::create($data);
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
        
        $produto = produto::findOrFail($request->produto_id);
        $data = $request->all();
        if(!$request->get('status')){ $data['status'] = 0; }
        $produto->update($data);
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
        $produto = produto::findOrFail($request->produto_id);
        $produto->update($data);

        DB::table('etapas')
        ->where('id_produto', '=', $produto['id'])
        ->update([
            'deletado' => 1,
            'user'=>$produto['user']
        ]);
        DB::table('campos')
        ->where('id_produtos', '=', $produto['id'])
        ->update([
            'deletado' => 1,
            'user'=>$produto['user']
        ]);
        

        return back();
    }
}
