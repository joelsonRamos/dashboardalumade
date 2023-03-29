<?php

namespace App\Http\Controllers\Painel\Usuarios;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class UsuariosController extends Controller
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
        $permicao = DB::table('permissions')
        ->select('permissions.id','permissions.name')
        ->get();
        // dd($permicao);
        $users = DB::table('users')
        ->join('model_has_permissions', 'model_has_permissions.model_id', '=', 'users.id' )
        ->join('permissions', 'permissions.id', '=', 'model_has_permissions.permission_id')
        ->select('users.id','users.name as name_user', 'permissions.id as permissions_id', 'permissions.name')
        ->get();
        $uri = $this->request->route()->uri();
        $exploder = explode('/',$uri);
        $urlAtual = $exploder[1];

        return view('Painel.Usuarios.index', compact('user','urlAtual','users','permicao'));
        
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $name_permission = $request->name;
        $name_user = $request->nome;
        $id = $request->id;
        $permicao = DB::table('permissions')
        ->where('permissions.name','=', $name_permission)
        ->get();

        DB::table('users')
        ->where('id', '=', $id)
        ->update(
            ['name' => $name_user]
        );

        DB::table('model_has_permissions')
        ->where('model_has_permissions.model_id','=', $id)
        ->update(
            ['permission_id' => $permicao[0]->id]
        );
        return back();
    }
    
}
