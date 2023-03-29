<?php

namespace App\Http\Controllers\Painel\Itens;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\campo;
use App\Models\lista;
use Illuminate\Support\Facades\DB;
use App\Models\item_switch;
use App\Models\item_numero;
use Illuminate\Http\Request;

class ItensController extends Controller
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
    public function index($id)
    {
        $user = Auth()->User();
        $userId = $user['id'];
        $id_campo = $id;
        $uri = $this->request->route()->uri();
        $exploder = explode('/', $uri);
        $urlAtual = $exploder[1];
        $campo = campo::all('id','name_campo')->where('id', '=', $id_campo);
        
        $item = Item::all()->where('id_campo', '=', $id_campo );
        
        $itemid = DB::table('item_numeros')
        ->join('items','items.id', '=', 'item_numeros.id_item' )
        ->select('items.id','limite_min', 'limite_max','placeholder')
        ->get();
        
        $idswitch = DB::table('item_switches')
        ->join('items','items.id', '=', 'item_switches.id_item' )
        ->select('items.id','alternativa_um', 'alternativa_dois')
        ->get();
        
        return view('Painel.Item.index', compact('user','urlAtual','campo','item', 'id_campo','userId','itemid','idswitch' ));
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
        if($data['tipo_item'] == 'select'){
            Item::create([
                'name_item' => $data['name_item'],
                'id_campo' => $data['id_campo'],
                'tipo_item' => $data['visualizacao'],
                'visivel_em' =>$data['visivel_em'],
                'status' => 1,
                'deletado' => $data['deletado'],
                'user' => $data['user'],
            ]);
        }else{

            Item::create([
                'name_item' => $data['name_item'],
                'id_campo' => $data['id_campo'],
                'tipo_item' => $data['tipo_item'],
                'visivel_em' =>$data['visivel_em'],
                'status' => 1,
                'deletado' => $data['deletado'],
                'user' => $data['user'],
            ]);
        }

        $id_item = Item::latest('id')->first();
        // dd($data['tipo_item']);
        if($data['tipo_item'] == 'number'){
            
            item_numero:: create([
                'id_item' => $id_item->id,
                'placeholder' => $data['placeholder'],
                'limite_min' => $data['limite_min'],
                'limite_max' => $data['limite_max'],
                'deletado' => $data['deletado'],
                'user' => $data['user']

            ]);
        }
        elseif($data['tipo_item'] == 'switch'){
            
            item_switch:: create([
                'id_item' => $id_item->id,
                'alternativa_um' => $data['alternativa_um'],
                'alternativa_dois' => $data['alternativa_dois'],
                'deletado' => $data['deletado'],
                'user' => $data['user']

            ]);
        }
        
        return back();
        
    }
    
    public function storesub(Request $request)
    {
        $data = $request->all();
        $comeca ='.';
        $existe_img = (strpos($data['image'],$comeca) !== false);
        if($existe_img){
            if($request->hasFile('image') && $request->file('image')->isValid())
            {
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;
                $requestImage->move(public_path('AdminLTE/dist/img/listas'), $imageName);
                $data['image'] = $imageName;
            }
        }
        $data['status'] = 1;
        lista::create($data);
        return back();
        // dd($data);
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
        $id_item = $id;
        $uri = $this->request->route()->uri();
        $exploder = explode('/', $uri);
        $urlAtual = $exploder[1].' / '.$exploder [2];
        $subitem = lista::all()->where('id_item','=', $id_item);
        $nome_item = Item::all('id','name_item','id_campo')->where('id','=', $id_item);
        
        // dd($nome_item);
        // exit;

        return view('Painel.Item.SubItem.index', compact('user','urlAtual', 'id_item', 'subitem','nome_item', ));
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
        $item = Item::findOrFail($request->id_item);
        $data = $request->all();
        dd($data);
        if(!$request->get('status')){ $data['status'] = 0; }

        if($data['tipo_item'] == 'select'){
            $item->update([
                'name_item' => $data['name_item'],
                'id_campo' => $data['id_campo'],
                'id_item' => $data['id_item'],
                'tipo_item' => $data['visualizacaoedit'],
                'user' => $data['user']

            ]);
        }
        // $item->update($data);
        return back();
     }
     public function updatesub(Request $request, $id)
     {
         $lista = lista::findOrFail($request->id);
         $data = $request->all();
         dd($data);
         
            $comeca ='.';
            $existe_img = (strpos($data['image'],$comeca) !== false);
            dd($existe_img );
            if($existe_img){
                if($request->hasFile('image') && $request->file('image')->isValid())
                {
                    $requestImage = $request->image;
                    $extension = $requestImage->extension();
                    $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;
                    $requestImage->move(public_path('AdminLTE/dist/img/listas'), $imageName);
                    $data['image'] = $imageName;
                }
            }
         if(!$request->get('status')){ $data['status'] = 0; }
         dd($data['image']);
         $lista->update($data);
         return back();
      }
      public function updateduplica(Request $request, $id)
     {

        
        $data = $request->all();
        
        
        $itemid = $data['id_items']; // id do select 
        
        $campo = $data['id_campo']; // Array com os Ids dos checkboxes
        
        $listaItem = Item::all('id','name_item', 'placeholder','id_campo','tipo_item','limite_max','limite_min','visivel_em','status')->where('id', '=', $itemid);
        $lista = lista::all('id','id_item', 'nome_lista','image','tipo_acao','acao', 'status')->where('id_item','=',$itemid);
        $listaAll = lista::all();
        // dd($listaItem);
        

        foreach($listaItem as $item){
            foreach($campo as $valor){
                Item::create([
                    'name_item'     => $item->name_item,
                    'placeholder'   => $item->placeholder,
                    'id_campo'      => $valor,
                    'tipo_item'     => $item->tipo_item,
                    'limite_max'    => $item->limite_max,
                    'limite_min'    => $item->limite_min,
                    'visivel_em'    => $item->visivel_em,
                    'status'        => $item->status
                ]);
            }
        }

        $item_list_id = [];
        foreach($campo as $valor){
            $iditem = Item::all('id','id_campo','tipo_item')->where('tipo_item', '=', 'select');
            $iditem = $iditem->where('id_campo', '=', $valor)->max('id');
            $item_list_id[] = $iditem;
        }
        foreach($lista as $list){
            foreach($item_list_id as $list_id){
                lista::create([
                    'id_item'       => $list_id,
                    'image'         => $list->image,
                    'tipo_acao'     => $list->tipo_acao,
                    'acao'          => $list->acao,
                    'nome_lista'    => $list->nome_lista,
                    'status'        => $list->status
                ]);
            }
        }
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
