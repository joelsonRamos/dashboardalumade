<?php

namespace App\Http\Controllers\Painel\Setores;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\setor;
use App\Models\campo;
use App\Models\setor_campo;
use Illuminate\Http\Request;

class SetoresController extends Controller
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
        $exploder = explode('/',$uri);
        $urlAtual = $exploder[1];
        $setor = setor::all();
        $setor_campo = setor_campo::all('id','id_setor','id_campo');
        $campos = campo::all('id','name_campo');
        $campos_all = campo::all('id','name_campo');

        $operadores = DB::table('model_has_permissions')
        ->join('users', 'model_has_permissions.model_id', '=', 'users.id')
        ->select(
        'users.id',
        'users.name',
        'model_has_permissions.model_id',
        'model_has_permissions.permission_id'
        )
        ->where('model_has_permissions.permission_id', '=', 4)->get();

        $lista_id_campo = [];
        $list_campo = [];
        $ordem_id = [];
        $ReponsavelExplode = [];
        $nomesResponsavel =[];
        $nomes_final =[];
        $nomestrings= '';

        foreach($setor_campo as $indice=>$itens) {
            $lista_id_campo[] = explode(',', $itens->id_campo);
        }
        foreach($campos as $itens) {
            $list_campo[] = $itens->id;
        }

        foreach($lista_id_campo as $list_id){
            foreach($list_id as $item_list){
                $ordem_id[] = $item_list;
            }
        }

        foreach($setor as $indice=>$itens) {
            $ReponsavelExplode[$indice] = explode(',', $itens->responsaveis);   
        }

        foreach($ReponsavelExplode as $indice=>$itens) {
            $rb = DB::table('users')->select('id','name')->whereIn('id', $itens)->get();
            foreach($rb as $itens) {
                // dd($itens->name);
                // foreach($itens as $b){
                    $nomesResponsavel[$indice][] = $itens->name;
                // }
            }
                
        }

        for ($i=0; $i < count($nomesResponsavel); $i++) { 
            if(count($nomesResponsavel[$i])>1){
                for($j=0; $j < count($nomesResponsavel[$i]); $j++){
                    
                    $nomestrings.=$nomesResponsavel[$i][$j]."; ";
                    
                }
                $nomes_final[] = substr($nomestrings, 0,-2);
            }else{
                $nomes_final[] = $nomesResponsavel[$i][0];
            }

            $nomestrings ='';
        }
        

        foreach($setor as $indice=>$itens) {
            
            $itens->nome_responsaveis = $nomes_final[$indice];

        }

        $valor_diferente = array_diff($list_campo,$ordem_id);
        
        $campos= campo::all('id','name_campo')
        ->whereIn('id', $valor_diferente);
        return view('Painel.Setores.index', compact(
                    'user', 
                    'urlAtual',
                    'setor', 
                    'campos',
                    'lista_id_campo',
                    'setor_campo', 
                    'campos_all',
                    'operadores',
                ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $converte = '';
        $dados = $data['id_campo'];
        foreach($dados as  $valor)
        {
            $converte .= $valor.','; 
        }
        $data['id_campo'] = substr( $converte, 0, -1);
        // dd($data);
        setor_campo::create($data);
        return back();
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
       
        $converte = '';
        $responsaveis = $data['responsaveis'];
        foreach($responsaveis as  $valor)
        {
            $converte .= $valor.','; 
        }
        $data['responsaveis'] = substr( $converte, 0, -1);

        // dd($data);
        setor::create($data);
        return back();
    }

    public function updaterel(Request $request)
    {
        
        $setor_campo = setor_campo::findOrFail($request->id);
        $setor = setor::findOrFail($request->id_setor);

        $data = $request->all();
        // dd($data);
        $converte = '';
        $converte_reponsavel = '';
        
        $id_campo = $data['id_campo'];
        $id_responsavel = $data['responsaveis'];
        
        foreach($id_campo as  $valor)
        {
            $converte .= $valor.','; 
        }
        $data['id_campo'] = substr( $converte, 0, -1);

        foreach($id_responsavel as  $valor)
        {
            $converte_reponsavel .= $valor.','; 
        }
        $data['responsaveis'] = substr( $converte_reponsavel, 0, -1);

        // dd($data);

        $setor_campo->update($data);
        $setor->update($data);
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
    public function createRel(Request $request)
    {
        $data = $request->all();


        dd($data);
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
        $setor = setor::findOrFail($request->id);
        $data = $request->all();

        
        $setor->update($data);
        return back();
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
}
