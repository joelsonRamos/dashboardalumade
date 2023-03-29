<?php

namespace App\Http\Controllers\Painel\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\produto;
use App\Models\etapa;
use App\Models\campo;
use App\Models\Item;
use App\Models\pedido;
use App\Models\setting_pedido;
use App\Models\lista;
use App\Models\relacionamento;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $request;
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }
    public function index()
    {
        // dd('teste');
        $user = Auth()->User();
        $uri = $this->request->route()->uri();
        $exploder = explode('/',$uri);
        $urlAtual = $exploder[1];
        $produto = produto::all();
        $produto = $produto->where('status', '=', 1);
        // dd($produto);
        

        return view('Painel.Pedido.index', compact('user','urlAtual', 'produto'));
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
        
        $dados = $request->all();
        $items = $dados['values'];
        $pedido = $dados['id_produto'];
        $id_produto = $dados['id_produto']['id_produto'];

        pedido::create($pedido);
        $id_pedido = pedido::latest('id')->first();

        foreach($items as $indice=>$obj){
            list($id_etapa, $id_campo, $id_item) = Str::of($indice)->explode('-');
            if($obj != NULL){
                setting_pedido::create([
                    'id_pedido'  => $id_pedido->id,
                    'id_produto' => $id_produto,
                    'id_etapa'   => $id_etapa,
                    'id_campo'   => $id_campo,
                    'id_item'   => $id_item,
                    'item'       => $obj,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth()->User();
        $id_produto = $id;
        $uri = $this->request->route()->uri();
        $exploder = explode('/',$uri);
        $urlAtual = $exploder[1].' / '.$exploder[2];

        //Produto
        $produto = produto::all('id','name','price','status')->where('id', '=', $id_produto);
        $produto = $produto->where('status', '=', 1);

        //Etapa
        $etapa = etapa::all('id','nome_etapa','id_produto', 'status')->where('status', '=', 1);
        $etapaProduto = etapa::all('id','id_produto');

        //Campo
        $campo = campo::all('id','name_campo','id_etapas','status')->where('status', '=', 1);
        $campoEtapa = campo::all('id','id_etapas');

        //Item
        $items = Item::all('id','name_item','placeholder', 'id_campo','tipo_item','limite_max', 'limite_min', 'visivel_em','status')->where('status', '=', 1);
        $item_campo = Item::all('id','id_campo');

        //Sub-Itens
        $subitens = lista::all();
        $listaEtapa = [];
        $lista_id = [];

        foreach ($etapaProduto as $indice=> $valor){
            $listaProduto[] = explode(',',$valor->id_produto);
        }
       

        foreach ($campoEtapa as $indice=> $valor){
            $listaEtapa[] = explode(',',$valor->id_etapas);
        }
        foreach($item_campo as $indice=>$itens){
            $lista_id[] = explode(',', $itens->id_campo);
        }
        //  dd($campo['items']);
     

        return view('Painel.Pedido.New.index', 
        compact(
        'user',
        'urlAtual', 
        'produto', 
        'etapa', 
        'etapaProduto',
        'id_produto',
        'listaProduto',
        'campo', 
        'listaEtapa',
        'items',
        'subitens',
        'lista_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function relacionar(Request $request)
    {   
        
        $data = $request->all();
        $id_produto = $data['id_produto'];
        $itens = $data['variavelAtual'];
        
        $relacao  = relacionamento::all('id_do_produto', 'id_associacao', 'formula_associacao')
        ->where( 'id_do_produto', '=', $id_produto)
        ->where('id_associacao', '=', $itens);

        return compact('relacao');

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
        $pedido = pedido::findOrFail($request->pedido_id);
        $data = $request->all();
     
        $pedido->update($data);
        return back();
        
        // dd($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function exibe()
    {
        $user = Auth()->User();
        
        $uri = $this->request->route()->uri();
        $exploder = explode('/',$uri);
        $urlAtual = $exploder[1].' / '.$exploder[2];

        $pedido = DB::table('produtos')
        ->join('pedidos','produtos.id', '=', 'pedidos.id_produto')
        ->select('pedidos.id','pedidos.status', 'produtos.name')->get();
        // dd($pedido);


        return view('Painel.Pedido.Realizados.index', compact('user','urlAtual', 'pedido'));
    }
    public function visualizar($id){
        $user = Auth()->User();
        
        $uri = $this->request->route()->uri();
        $exploder = explode('/',$uri);
        $urlAtual = $exploder[1].' / '.$exploder[2];

        //setting_pedidos
        //$visializar = setting_pedido::all('id','id_pedido','id_produto','id_etapa','id_campo','id_item','item')->where('id_pedido', '=', $id);

        
        $visualizar = DB::table('setting_pedidos')
        ->leftJoin('produtos', 'setting_pedidos.id_produto', '=','produtos.id')
        ->leftJoin('etapas','setting_pedidos.id_etapa', '=','etapas.id' )
        ->leftJoin('campos','setting_pedidos.id_etapa', '=','campos.id' )
        ->leftJoin('items','setting_pedidos.id_item', '=','items.id' )
        ->select('setting_pedidos.id', 'produtos.name', 'etapas.nome_etapa', 'campos.name_campo', 'items.name_item','setting_pedidos.item' )
        ->where('setting_pedidos.id_pedido', '=', $id)
        ->get();

        // $produto = produto::all('id','name')->where('id', '=',$visializar->id_produto);
        // dd($visualizar);
        return view('Painel.Pedido.Visualizar.index', compact('user','urlAtual','visualizar'));

    }
}
