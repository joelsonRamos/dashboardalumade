<?php

namespace App\Http\Controllers\Painel\Relacionamento;
use App\Http\Controllers\Controller;
use App\Models\produto;
use App\Models\etapa;
use App\Models\campo;
use App\Models\Item;
use App\Models\relacionamento;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;


class RelacionamentoController extends Controller
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
        $user = Auth()->User();
        $uri = $this->request->route()->uri();
        $exploder = explode('/', $uri);
        $urlAtual = $exploder[1];
        $dados =  $this->request->all();
        $produto = produto::all('id','name','status')->where('status', '==', 1);

        $relacionamento = DB::table('relacionamentos')
        ->join('produtos','relacionamentos.id_do_produto', '=', 'produtos.id')
        ->select('produtos.name',
                'relacionamentos.id',
                'relacionamentos.id_do_produto',
                'relacionamentos.nome_id_associacao',
                'relacionamentos.nome_formula_associacao')->get();

        return view('Painel.Relacionamento.index', compact('user','urlAtual', 'produto', 'relacionamento'));

    }
    public function produto(Request $request)
    {
        $dados = $request->all();
        $etapa = etapa::all('id','nome_etapa','id_produto');
        // ->where('id_produto', '=', $dados['value']);
        foreach ($etapa as $indice=> $valor){
            $listaProduto[] = explode(',',$valor->id_produto);
        }
        foreach ($etapa as $indice=> $valoretapa){
            foreach($listaProduto as $key=> $itemp){
                foreach ($listaProduto[$key] as $valor){
                    if($indice == $key){
                        if($valor == $dados['value']){
                            $etapas[] = $valoretapa;
                        }
                    }
                }
            }
        }
		 
        return  $etapas;
    }

    public function etapa(Request $request,  $id)
    {
        $dados = $request->all();
        $campo = campo::all('id','name_campo','id_etapas');
        // ->where('id_etapas', '=', $dados['value']);
        foreach ($campo as $indice=> $valor){
            $listaEtapa[] = explode(',',$valor->id_etapas);
        }
        foreach ($campo as $indice=> $valorcampo){
            foreach($listaEtapa as $key=> $itemp){
                foreach ($listaEtapa[$key] as $valor){
                    if($indice == $key){
                        if($valor == $dados['value']){
                            $campos[] = $valorcampo;
                        }
                    }
                }
            }
        }
        return  $campos;
    }

    public function campo(Request $request, $id)
    {
        $item = Item::all('id','name_item','id_campo','tipo_item', 'status')
        ->where('id_campo', '=', $id)
        ->where('status', '=', 1);
        return  $item;
    }

    public function store(Request $request)
    {
        $data = $request -> dadosRelacionamento;
        
        $relacionamento = relacionamento::all()
        ->where('id_do_produto','=', $data['id_do_produto'])
        ->where('id_associacao','=', $data['id_associacao']);

        // return $relacionamento;

        if( sizeof($relacionamento)== 0 ){
            // return 'estou aqui';

            relacionamento::create( [
                'id_do_produto'             =>$data['id_do_produto'],
                'id_associacao'             =>$data['id_associacao'],
                'nome_id_associacao'        =>$data['nome_id_associacao'],
                'formula_associacao'        =>$data['formula_associacao'],
                'nome_formula_associacao'   =>$data['nome_formula_associacao']
            ]);

            $mensage = (object)[
                'error' => 0,
                'text' => 'Salvo com sucesso!'
            ];

            return $mensage;
        }else{
            $mensage = (object)[
                'error' => 1,
                'text' => 'Já existe relacionamento para essa variavel!',
            ];

        }


        
        return $mensage;
    }

    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     // dd($data);
    //     relacionamento::create( $data);
    //     return back();
    // }
}
