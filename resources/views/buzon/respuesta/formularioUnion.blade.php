
@section('title', 'Page Title')
<br>
<br>
  @php
    $date = (\Carbon\Carbon::now());
  @endphp
  <div class="card p-3 mt-2 dosdr">    
    <div class="header-elements-inline">
      <h3 class="no-browser-support">Lo sentimos, su navegador no admite la API de Web Speech. Intenta  en Google Chrome.
      </h3> 
      <h5 id="recording-instructions">Presione el botón  <strong>Iniciar reconocimiento</strong> y permita el acceso.
      </h5>
      
      <div class="header-elements">
        <button id="start-record-btn" class="micro dosdu"><i class="fas fa-microphone "></i></button>
      </div>

  </div>
   
    <p>Ecuador {{ \Carbon\Carbon::parse($date)->format('d/M/Y')}} </p>    
    @if ($buzonCarta->buzon->ninio->fechaNacimiento)            
        @php
            $edad=\Carbon\Carbon::parse($ninio->fechaNacimiento)->age
        @endphp
    {{-- 6244 --}}
        @if ($edad<=5)            
        <h6 class="font-weight-semibold mt-1 text-pink-600"><i class="icon-notification2"></i> La edad del Niñ@ es menor a 6 años <span class="ml-1"> deben ayudarle a responde en tercera persona</span></h6>
      
        @endif    
  
    @endif
    <h4 class="text-right text-danger">Máximo 680 caracteres <span class="char-count"> 0</span>/680, Mínimo <span>400</span> </h4>   
   
    
    <form action="{{route('registroDeotrasCartas')}}" method="POST" id="formularioContestacion" >
      @csrf
      <input type="hidden" required name="getIp"  id="getIp" value="{{ Crypt::encryptString($buzonCarta->id) }}"  class="form-control " placeholder="Ingresa el nombre a quién escribes">
      <input type="hidden" required name="token" id="token" value="{{ Crypt::encryptString($buzonCarta->buzon->ninio->token) }}" class="form-control " placeholder="Ingresa el nombre a quién escribes">
      <div class="paper dosdu">
        <div class="paper-content ">
          <textarea name="respuesta" data-length=680 class="respuesta" id="respuesta" required autofocus></textarea>
        </div>
      </div>
      <br>
      <span class="text-danger mt-4">Recuerda que debe ser una foto de un dibujo tuyo  <i class="icon-video-camera2  " ></i> para encender tu cámara</span>
  
      <div class="display-cover dosdr " style="background-image: url('/buzon/img/arbol.jpg');">
        <video class="video1" autoplay></video>
        <canvas  class="canvas1 d-none"></canvas>
        
        <div class="video-options">
          <select name="" id="" class="custom-select">
            <option value="">Selecione camera</option>
          </select>
        </div>                
        
        <img class="screenshot-image image1 d-none" alt="">
        
        <div class="controls">
          <a class="btn btn-danger bg-danger dosdu  play" title="Encender"><i class="icon-video-camera2  text-white" ></i></a>
          <a class="btn btn-info bg-info pause  dosdu d-none" title="Pausar"><i class="icon-video-camera-slash text-white"></i></a>
          <a class="btn btn-outline-success dosdu bg-success screenshot d-none" title="Capturar"><i class="icon-shutter text-white"></i></a>
        </div>
      </div>
      <div id="imagen1 " class="dosdr">
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
      <div class="text-right mt-3">
        <button type="submit" class="btn btn-primary dosdu list-icons-item timeline-content btn-ladda btn-ladda-progress ladda-button">Responder <i class="icon-paperplane ml-2"></i></button>
        <div class="ladda-progress" style="width: 140px;"></div>
      </div>
    </form>       
  </div>
  <link href="{{ asset('buzon/css/camara1.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('buzon/css/form.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('buzon/css/audio.css') }}" rel="stylesheet" type="text/css">
  
 <script>
   function b64ToUint8Array(b64Image) {
        var img = atob(b64Image.split(',')[1]);
        var img_buffer = [];
        var i = 0;
        while (i < img.length) {
            img_buffer.push(img.charCodeAt(i));
            i++;
        }
        return new Uint8Array(img_buffer);
    }
  var doScreenshot = () => {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    screenshotImage.src = canvas.toDataURL('image/jpeg');
    var dataURL = canvas.toDataURL('image/jpeg');
    
    $.blockUI({message:'<h1>Guardando Imagen.!</h1>'});
      var urlFoto="{{ route('registroImagenUno') }}";
      var u8Image  = b64ToUint8Array(dataURL);

      var formData = new FormData();
      formData.append("foto", new Blob([ u8Image ], {type: "image/jpg"}));
      formData.append("getIp","{{ $buzonCarta->id }}" );
      formData.append("numero", 1);
      $.ajax({
          url: urlFoto,
          type: "POST",
          data:formData,                  
          processData: false,  // tell jQuery not to process the data
          contentType: false,   // tell jQuery not to set contentType
          success : function(data) {
        
            if(data.success){
              notificar('success',data.success);               
              screenshotImageFoto.src = canvas.toDataURL('image/jpeg');                        
            }
            if(data.error){
              notificar('info',data.info);
            } 
          },
          error : function(xhr, status) {
             notificar("error","Ocurrio un error");
          },
          complete : function(jqXHR, status) {
                $.unblockUI();
          }
      });      
    screenshotImage.classList.remove('d-none');
  };
  
  
</script>
<script src="{{ asset('buzon/js/cama1.js') }}"></script>
<script src="{{ asset('buzon/js/contestacion.js') }}"></script>

<script>
$("#formularioContestacion").submit(function(e) {
  e.preventDefault(); // avoid to execute the actual submit of the form.         
  var form = $(this);
  var url = form.attr('action');
  var continuarVali = false;
  var $valid = $("#formularioContestacion").valid();
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
       


