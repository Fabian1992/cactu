<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;
use cactu\Models\Ninio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        return view('home');
    }


    /*A:Deivid
    D:Cosultar datos de ninio*/
    public function datoNinio(Request $request)
    {
        $ninio=Ninio::findOrFail($request->ninio);
        return response()->json($ninio);
    }


    public function miPerfil()
    {
        $user=Auth::user();
        return view('auth.miPerfil',['usuario'=>$user]);
    }

    public function miPerfilActualizar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'password' => 'nullable|string|min:8|confirmed',
            'foto'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user=Auth::user();
        $user->name=$request->name;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->actualizadoPor=Auth::user()->id;
        $user->save();

        if ($request->hasFile('foto')) {
            if ($request->file('foto')->isValid()) {
                Storage::delete($user->foto);
                $extension = $request->foto->extension();
                $path = Storage::putFileAs(
                    'public/usuarios', $request->file('foto'), $user->id.'.'.$extension
                );
                $user->foto=$path;
                $user->save();
            }
        }

        $request->session()->flash('success','Perfil actualizado exitosamente');

        return redirect()->route('miPerfil');
    }


    // A:Deivid Criollo
    // soporte
    public function soporte()
    {
        return view('sistema.soporte');
    }

}
