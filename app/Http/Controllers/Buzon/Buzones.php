<?php

namespace cactu\Http\Controllers\Buzon;

use Illuminate\Http\Request;
use cactu\Http\Controllers\Controller;
use cactu\Models\Ninio;
use cactu\Models\Buzon\BuzonCarta;
use cactu\Models\Buzon\Buzon;
use cactu\Models\Buzon\MensajeNinio;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
class Buzones extends Controller
{
    public function index($token)
    {
        $ninio=Ninio::where('token',$token)->first();
        if($ninio){
            $buzones=$ninio->buzones()->where('estado','!=','Respondida')->where('estado','Enviada')->get();
            $data = array('ninio' =>$ninio,'buzones'=>$buzones);
            return view('buzon.index',$data);
        }else{
            return abort(404);
        }
    }
    public function buzon($token){
        $ninio=Ninio::where('token',$token)->first();
        if($ninio){
            $buzones=$ninio->buzones()->where('estado','!=','Respondida')->where('estado','Enviada')->get();
            
            $data = array('ninio' =>$ninio,'buzones'=>$buzones);
            return view('buzon.buzon',$data);
        }else{
            return abort(404);
        }
    }
    public function respuestaCarta($idCarta,$token)
    {
        try {
            $idCartade=Crypt::decryptString($idCarta);
            $idniniode=Crypt::decryptString($token);
            $ninio=Ninio::where('token',$idniniode)->first();
            $buzonCarta=BuzonCarta::where('id',$idCartade)->with('buzon')->with('tipoCarta')->first();
            $buzon=Buzon::where('ninio_id',$ninio->id)->where('id',$buzonCarta->buzon->id)->first();         
                if($ninio && $buzonCarta && $buzon){
                    if($buzonCarta->buzon->estado=='Respondida' || $buzonCarta->estado=='Respondida'){
                        session()->flash('info','Recuerde esta carta ya fue respondida  '. $buzonCarta->tipoCarta->nombres);
                        return redirect()->route('misCartasBuzon',$ninio->token);
                    }else{

                        $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$idCartade)->get();                        
                        $data = array('ninio' =>$ninio,'buzones'=>$buzones,'buzonCarta'=> $buzonCarta);
                        return view('buzon.respuesta.main',$data);
                    }                  
                }else{
                    return abort(404);
            }
        } catch (DecryptException $e) {
            return abort(404);
        }
    
    }
    public function guardarImagenUno(Request $request)
    {
        $buzonCarta=BuzonCarta::findOrFail($request->getIp);
        if($request->numero==1){
        
              if ($request->hasFile('foto')) {
                if ($request->file('foto')->isValid()) {
                    $extension = $request->foto->extension();
                   $imageName = $buzonCarta->id.'.'.$extension;  
                    $path = Storage::putFileAs(
                        'public/imagenNinio',$request->file('foto'),$buzonCarta->id.'.'.$extension
                    );
                    $url = Storage::url("public/imagenNinio/".$imageName);
                      $buzonCarta->imagen=$url;
                     $buzonCarta->save();
                    $data_res = array('success' =>"Foto registrada exitosamente");
                }                  
            }else{
                $data_res = array('error' =>'No se puede registrar la imágen');
            }              
        
            return response()->json($data_res);
        }else{
            
            if ($request->hasFile('foto')) {
                if ($request->file('foto')->isValid()) {
                    $extension = $request->foto->extension();
                   $imageName =$buzonCarta->id.'2'.'.'.$extension;  
                   $path = Storage::putFileAs(
                        'public/imagenNinio',$request->file('foto'),$buzonCarta->id.'2'.'.'.$extension
                    );
                    $url = Storage::url("public/imagenNinio/".$imageName);
                      $buzonCarta->imagen2=$url;
                     $buzonCarta->save();
                    $data_res = array('success' =>"Foto registrada exitosamente");
                }                  
            }else{
                $data_res = array('error' =>'No se puede registrar la imágen');
            }      
        
            return response()->json($data_res);
        }
    }
    public function responderPreMayores(Request $request)
    {
        try {
            $idCartade=Crypt::decryptString($request->getIp);
            $idniniode=Crypt::decryptString($request->token);
            $op=Crypt::decryptString($request->op);
            $ninio=Ninio::where('token',$idniniode)->first();
            $buzonCarta=BuzonCarta::where('id',$idCartade)->with('buzon')->with('tipoCarta')->first();
            $buzon=Buzon::where('ninio_id',$ninio->id)->where('id',$buzonCarta->buzon->id)->first();  
            $diaHoy=Carbon::now();
            if($ninio && $buzonCarta && $buzon){
                if($this->buscarImagnes($buzonCarta->id)==true){
                    $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$idCartade)->get(); 
                        if($op=="mayor"){
                            
                            $respuesta=$op.'\-'.$diaHoy.'\-'.$request->hola.'\-'.$request->soy.'\-'.$request->meDicen.'\-'.$request->edad.'\-'.$request->miMejorAmigo.'\-'.$request->esMejorAmigo.'\-'.$request->loquehago.'\-'.$request->miSueno.'\-'.$request->dondeAprendo.'\-'.$request->gustaAprendes.'\-'.$request->mePaso.'\-'.$request->meGustaria.'\-'.$request->miFamilia.'\-'.$request->nuestraPro.'\-'.$request->idioma.'\-'.$request->lugarFavorito.'\-'.$request->comidaTipica.'\-'.$request->comer.'\-'.$request->masMeGusta.'\-'.$request->pregunta.'\-'.$request->despedida;
                        }else{
                            $respuesta=$op.'\-'.$diaHoy.'\-'.$request->hola.'\-'.
                                    $request->escribo.'\-'.
                                    $request->mi.'\-'.
                                    $request->queel.'\-'.
                                    $request->cumple.'\-'.
                                    $request->noSabe.'\-'.
                                    $request->ademas.'\-'.
                                    $request->leGusta.'\-'.
                                    $request->dondeAprendo.'\-'.
                                    $request->gustaAprendes.'\-'.
                                    $request->mePaso.'\-'.
                                    $request->meGustaria.'\-'.
                                    $request->miNombre.'\-'.
                                    $request->ysoy.'\-'.
                                    $request->de.'\-'.
                                    $request->mifamila.'\-'.
                                    $request->nuestraPro.'\-'.
                                    $request->idioma.'\-'.
                                    $request->lugarFavorito.'\-'.
                                    $request->comidaTipica.'\-'.
                                    $request->ya.'\-'.
                                    $request->comer.'\-'.
                                    $request->masMeGusta.'\-'.
                                    $request->pregunta.'\-'.
                                    $request->despedida;
                        }     
                        $buzonCarta->respuesta=$respuesta;
                        $buzonCarta->estado="Respondida";
                        $buzonCarta->save();
                        if($buzones->count()>0){
                            
                            session()->flash('success','Carta respondida exitosamente! Tienes mas carta para responder');
                            return response()->json(['enn'=>route('misCartasRespuestas',[Crypt::encryptString($this->primeraPosiscion($buzones)),Crypt::encryptString($ninio->token)])]);
                            
                        }else{
                            $buzon->estado="Respondida";
                           $buzon->save(); 
                            session()->flash('success','Carta respondida exitosamente ');
                            
                            return response()->json(['inicio'=>route('misCartasBuzon',$ninio->token)]);

                        }

                    }else{
                        return response()->json('sinImagenes'); 
                    }             
                }else{
                    return response()->json('false');
            }
        } catch (DecryptException $e) {
            return response()->json('false');
        }
       
    }
    public function responderOtrasCartas(Request $request)
    {
        try {
            $idCartade=Crypt::decryptString($request->getIp);
            $idniniode=Crypt::decryptString($request->token);         
            $ninio=Ninio::where('token',$idniniode)->first();
            $buzonCarta=BuzonCarta::where('id',$idCartade)->with('buzon')->with('tipoCarta')->first();
            $buzon=Buzon::where('ninio_id',$ninio->id)->where('id',$buzonCarta->buzon->id)->first();  
            $diaHoy=Carbon::now();
            if($ninio && $buzonCarta && $buzon){
                if($buzonCarta->imagen){
                    $buzones=$buzon->buzonCartasNinio()->where('estado','!=','Respondida')->wherePivot('id','!=',$idCartade)->get(); 
                        $buzonCarta->respuesta=$request->respuesta;
                        $buzonCarta->estado="Respondida";
                        $buzonCarta->save();
                        if($buzones->count()>0){
                            session()->flash('success','Carta respondida exitosamente! Tienes mas carta para responder');
                            
                            return response()->json(['enn'=>route('misCartasRespuestas',[Crypt::encryptString($this->primeraPosiscion($buzones)),Crypt::encryptString($ninio->token)])]);
                        }else{
                           $buzon->estado="Respondida";
                           $buzon->save(); 
                           session()->flash('success','Carta respondida exitosamente ');
                            
                            return response()->json(['inicio'=>route('misCartasBuzon',$ninio->token)]);

                        }

                    }else{
                        return response()->json('sinImagenes'); 
                    }             
                }else{
                    return response()->json('false');
            }
        } catch (DecryptException $e) {
            return response()->json('false');
        }
       
    }

    public function buscarImagnes($idCartade)
    {      
        $buzonCarta=BuzonCarta::where('id',$idCartade)->with('buzon')->with('tipoCarta')->first();
            if($buzonCarta->imagen && $buzonCarta->imagen2){
                return true;
            }else{
                return false;
            }
    
    }
    function primeraPosiscion($buzones){
        $count=0;
        $id;
        foreach($buzones as $bu){
            if($count==0){
                $id=$bu->cartasBuzon->id;
            }
        }
        return $id;
    }
    public function guardarMesaje(Request $request)
    {
        if ($request->ajax()) {
            $diaHoy=Carbon::now();
                  
            $ninio=Ninio::where('token',$request->getIp)->first();
            if($ninio){
            $mesajefecha=MensajeNinio::where('ninio_id',$ninio->id)->whereDate('fecha',$diaHoy->toDateString());
            if( $mesajefecha->count()<2){
            $mesajeNinio=new MensajeNinio();
            $mesajeNinio->ninio_id=$ninio->id;
            $mesajeNinio->mensaje=$request->mensaje;
            $mesajeNinio->fecha=$diaHoy;
            $mesajeNinio->save();
            return response()->json(['success'=>'Tu mensaje fue enviado a nombre de: '.$ninio->nombres.$diaHoy]);

           
            }else{
                return response()->json(['yaexiste'=>'Por hoy ya no puedes enviar mensajes']); 
            }
            }else{
                return response()->json('false'); 
            }

        } else{
            return response()->json('false');
        }
    }
}
