

<div class="container1">
    <br>
    <br>
    @php
    $date = (\Carbon\Carbon::now());
    @endphp

<div class="card p-3">
  
    <p>Fecha {{ \Carbon\Carbon::parse($date)->format('d/M/Y')}}</p>
    
        <div class="golden-forms">
            <form action="{{route('registroPerMayosUno')}}" method="POST" id="formPresentacionMayo">
            
                @csrf
       
                    <input type="hidden" required name="getIp"  id="getIp" value="{{ Crypt::encryptString($buzonCarta->id) }}"  class="form-control " placeholder="Ingresa el nombre a quién escribes">
                    <input type="hidden" required name="token" id="token" value="{{ Crypt::encryptString($buzonCarta->buzon->ninio->token) }}" class="form-control " placeholder="Ingresa el nombre a quién escribes">
                    <input type="hidden" required name="op" id="op" value="{{ Crypt::encryptString('mayor') }}" class="form-control " placeholder="Ingresa el nombre a quién escribes">
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Hola</span> 
                        </div>   
                        <input type="text" required name="hola" id="hola" class="form-control input " placeholder="Ingresa el nombre de tu patrocinador">
                        
                    </div>
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Soy</span> 
                        </div>   
                        <input type="text" required name="soy" id="soy" class="form-control input " placeholder="Ingresa tu nombre">
                        
                    </div>
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">y mis amigos me dicen</span> 
                        </div>   
                        <input type="text" required name="meDicen" id="meDicen" class="form-control input " placeholder="Como te dicen">
                        
                    </div>      
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Tengo</span> 
                        </div>   
                        <input type="text" required name="edad" id="edad" class="form-control input " placeholder="Ingresa tu edad Ejm: 11 años">
                        
                    </div> 
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Mi mejor amigo se llama</span> 
                        </div>   
                        <input type="text" required name="miMejorAmigo" id="miMejorAmigo" class="form-control input " placeholder="Como se llama tu mejor amigo ">
                        
                    </div> 
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">es mi mejor <br> amigo porque</span> 
                        </div>   
                        <textarea required name="esMejorAmigo" id="esMejorAmigo" rows="3" class="form-control textarea no-resize" ></textarea>
                        
                    </div>
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Lo que maś me <br>   gusta hacer es </span> 
                        </div>   
                        <textarea required name="loquehago" id="loquehago" rows="3" class="form-control textarea no-resize" ></textarea>
                    
                    </div>

                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Cuando sea grande <br> mi sueño es</span> 
                        </div>   
                        <textarea type="text" required name="miSueno" id="miSueno" class="form-control textarea no-resize" rows="3"></textarea>

                    
                    </div> 
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">El lugar <br> donde aprendo es </span> 
                        </div>   
                        <textarea type="text" required name="dondeAprendo" id="dondeAprendo" class="form-control textarea no-resize" rows="3"></textarea>

                    </div> 
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">lo que me gusta <br> aprender es </span> 
                        </div>   
                        <textarea type="text" required name="gustaAprendes" id="gustaAprendes" class="form-control textarea no-resize " rows="3"></textarea>

                    </div> 
                        <span class="text-danger">Recuerda que debe ser una foto solo de ti presiona el icono <i class="icon-video-camera2  " ></i> para encender tu cámara</span>
                        <div class="display-cover dosdu" style="background-image: url('/buzon/img/avatarCamara.jpg');">
                            <video class="video1" autoplay></video>
                            <canvas  class="canvas1 d-none"></canvas>
                        
                            <div class="video-options">
                                <select name="" id="" class="custom-select">
                                    <option value="">Select camera</option>
                                </select>
                            </div>                
                            
                            <img class="screenshot-image image1 d-none" alt="">
                        
                            <div class="controls">
                                <a class="btn btn-danger bg-danger play" title="Encender"><i class="icon-video-camera2  text-white" ></i></a>
                                <a class="btn btn-info bg-info pause d-none" title="Pausar"><i class="icon-video-camera-slash text-white"></i></a>
                                <a class="btn btn-outline-success bg-success screenshot d-none" title="Capturar"><i class="icon-shutter text-white"></i></a>
                            </div>
                        </div>
                        <div id="imagen1">
                            @if ($buzonCarta->imagen!="")
                            <div class="card-img-actions text-center">
                                <img id="imagenfoto" class="img-thumbnail" src="{{ $buzonCarta->imagen }}" >
                            </div>
                            @else
                            <div class="card-img-actions text-center">
                                <img id="imagenfoto" class="img-thumbnail" src="" >
                            </div>
                            @endif

                        </div>
                    

                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Lo más importante que me pasó últimamente es</label>
                            <div class="col-lg-10">
                                <textarea type="text" required name="mePaso" id="mePaso" class="form-control textarea no-resize" rows="3"></textarea>


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Lo que me gustaría aprender en el programa de ChildFund es</label>
                            <div class="col-lg-10">
                                <textarea type="text" required name="meGustaria" id="meGustaria" class="form-control textarea no-resize" rows="3"></textarea>


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Esta es mi famila</label>
                            <div class="col-lg-10">
                                <textarea type="text" required name="miFamilia" id="miFamilia" class="form-control textarea no-resize" rows="3"></textarea>


                            </div>
                        </div>     
                        <span class="text-danger">Recuerda que debes ser una foto con tu famila presiona el icono <i class="icon-video-camera2  " ></i> para encender tu cámara</span>
                        <div class="display-cover1 dosdu">
                            <video class="video2" autoplay></video>
                            <canvas class="canvas2 d-none"></canvas>
                        
                            <div class="video-options1">
                                <select name="" id="" class="custom-select">
                                    <option value="">Select camera</option>
                                </select>
                            </div>                
                            
                            <img class="screenshot-image1 imagen2 d-none" alt="">
                        
                            <div class="controls1">
                                <a class="btn btn-danger bg-danger play1" title="Encender"><i class="icon-video-camera2  text-white" ></i></a>
                                <a class="btn btn-info bg-info pause1 d-none" title="Pausar"><i class="icon-video-camera-slash text-white"></i></a>
                                <a class="btn btn-outline-success bg-success screenshot1 d-none" title="Capturar"><i class="icon-shutter text-white"></i></a>
                            </div>
                        </div>
                        <div id="imagen2">
                            @if ($buzonCarta->imagen2!="")
                            <div class="card-img-actions text-center">
                                <img id="imagenfoto2" class="img-thumbnail" src="{{ $buzonCarta->imagen2 }}" >
                            </div>
                            @else
                                <div class="card-img-actions text-center">
                                    <img id="imagenfoto2" class="img-thumbnail" src="" >
                                </div>

                            @endif

                        </div>
                        <p>También quiero contarte del lugar donde vivo</p>
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">Nuestra provincia se llama</span> 
                            </div>   
                            <input type="text" required name="nuestraPro" id="nuestraPro" class="form-control input " >
                            
                        </div> 
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">y el idioma que hablamos es</span> 
                            </div>   
                            <input type="text" required name="idioma" id="idioma" class="form-control input " >
                            
                        </div>
                        <p>Donde nosotros vivimos hay sitios muy hermosos,</p>
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">mi lugar favorito es</span> 
                            </div>   
                            <input type="text" required name="lugarFavorito" id="lugarFavorito" class="form-control input " >
                            
                        </div>
                        <p>También tenemos comida típica, por ejemplo</p>
                        <div class="form-group row">                
                            <div class="col-lg-12">
                                <textarea type="text" required name="comidaTipica" id="comidaTipica" class="form-control textarea no-resize" rows="3"></textarea>


                            </div>
                        </div>
                        <div class="input-group input-group-sm mb-3 mt-2 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">y a mi me gusta comer</span> 
                            </div>   
                            <input type="text" required name="comer" id="comer" class="form-control input " >
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">De nuestras tradiciones, <br> lo que más me gusta es</label>
                            <div class="col-lg-10">
                                <textarea type="text" required name="masMeGusta" id="masMeGusta" class="form-control textarea no-resize" rows="3"></textarea>


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Me gustaría hacerte <br> una pregunta</label>
                            <div class="col-lg-10">
                                <textarea type="text" required name="pregunta" id="pregunta" class="form-control textarea no-resize" rows="3"></textarea>


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Cuéntale por qué quisieras que te conteste tu patrocinador, envíale un mensaje de despedida</label>
                            <div class="col-lg-10">
                                <textarea type="text" required name="despedida" id="despedida" class="form-control textarea no-resize" rows="3"></textarea>


                            </div>
                        </div>
                    
                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-primary list-icons-item timeline-content btn-ladda btn-ladda-progress ladda-button">Responder <i class="icon-paperplane ml-2"></i></button>
                            <div class="ladda-progress" style="width: 140px;"></div>
                        </div>
                
            </form> 
        </div>
    </div> 
</div>

    <link href="{{ asset('buzon/css/camara1.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('buzon/css/form.css') }}" rel="stylesheet" type="text/css">
    
    <script>

        var doScreenshot = () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            screenshotImage.src = canvas.toDataURL('image/jpeg');  
            var dataURL = canvas.toDataURL('image/jpeg');  
            
            $.blockUI({message:'<h1>Guardando Imagen.!</h1>'});
            $.post("{{ route('registroImagenUno') }}", { getIp:"{{ $buzonCarta->id }}",foto:dataURL,numero:1 })
            .done(function( data ) {
                console.log(data)
                if(data.success){
               
                    notificar('success',data.success);               
                    screenshotImageFoto.src = canvas.toDataURL('image/jpeg');                          
                }
                if(data.error){
                    notificar('info',data.info);
                }        
                
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                 notificar("error","Ocurrio un error");
            });        
            screenshotImage.classList.remove('d-none');
        };

     
    </script>
    <script>
  

        var doScreenshot1 = () => {
   
            canvas1.width = video1.videoWidth;
            canvas1.height = video1.videoHeight;
            canvas1.getContext('2d').drawImage(video1, 0, 0);
            screenshotImage1.src = canvas1.toDataURL('image/jpeg');
            var dataURL=canvas1.toDataURL('image/jpeg');
            $.blockUI({message:'<h1>Guardando Imagen.!</h1>'});
            $.post("{{ route('registroImagenUno') }}", { getIp:"{{ $buzonCarta->id }}",foto:dataURL,numero:2 })
            .done(function( data ) {
                if(data.success){                                      
                                             
                    notificar('success',data.success);
                    screenshotImageFoto1.src = canvas1.toDataURL('image/jpeg');                 
                }
                if(data.error){
                    notificar('info',data.info);
                }        
                
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                 notificar("error","Ocurrio un error");
            });        
            screenshotImage1.classList.remove('d-none');
        };
        
    </script>
        <script src="{{ asset('buzon/js/cama1.js') }}"></script>
        <script src="{{ asset('buzon/js/cama2.js') }}"></script>
<script>
    $("#formPresentacionMayo").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.         
        var form = $(this);
        var url = form.attr('action');
        var continuarVali = false;
        var $valid = $("#formPresentacionMayo").valid();
        if (!$valid) {
            return false;
        }
        if (continuarVali) {
            return false;
        }
        continuarVali =true;

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {             
             
                if(data.enn){

                    window.location.href=data.enn;
                }
                if(data.inicio){

                    window.location.href=data.inicio;
                }
            
              if(data=="sinImagenes"){
                notificar("error", "Advertencia! no tiene imagenes registradas");
              }
              if(data=="false"){
                notificar("error", "Advertencia! la información ingresada no es la correcta");
              }
            }
            });


    });

   
   
</script>