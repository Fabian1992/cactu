@extends('layouts.app',['title'=>'Registro de asistencia a actividades'])

@section('breadcrumbs', Breadcrumbs::render('registrarAsistencia',$asis))


@section('content')


<div class="card">
    
    @can('puedoTomarAsistencia', $asis)
        <a href="{{ route('registrarAsistencia',$asis->id) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Actualizar camaras">
            Recargar cámaras
        </a>
        <div class="btn-group" role="group" aria-label="Basic example" id="selecionCamaras">    
        </div>
        <video id="camara"></video>

    @endcan


    <div id="cargaListado">

    </div>
    


</div>


@push('linksCabeza')
    {{--  camara  --}}
    <style>
        video {
            width: 20%
            height: 20%;
        }
    </style>
    <script src="{{ asset('admin/js/adapter.min.js') }}"></script>
    <script src="{{ asset('admin/js/instascan.min.js') }}"></script>

@endpush

@prepend('linksPie')

    <script>
        $('#menuRegistroAsistencia').addClass('active');

    
        //camara
        var n_camara = sessionStorage.getItem('camara');
        sessionStorage.setItem('camara', '0');
        
        let scanner = new Instascan.Scanner({ video: document.getElementById('camara'),captureImage: true, });
        scanner.addListener('scan', function (content,image) {
            procesar(content,image);
        });

        function abrirCamara(n)
        {
            $('#selecionCamaras').html('')
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[n]);
                    sessionStorage.setItem("camara", n)
                    var botones='';
                    for(var i=0;i<cameras.length;i++){
                        botones+='<button class="btn btn-dark btn-sm" onclick="abrirCamara('+i+')">Cámara <b>'+(i+1)+'</b></button>';
                    }
                $('#selecionCamaras').append(botones)
                } else {
                console.error('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
            });
        }

        abrirCamara(n_camara);



        function procesar(content,image){
            
            $.blockUI({message:'<h1>Espere por favor.!</h1>'});      
            var urlFoto="{{ route('guardarAsistencia') }}";
            var u8Image  = b64ToUint8Array(image);

              var formData = new FormData();
              formData.append("foto", new Blob([ u8Image ], {type: "image/jpg"}));
              formData.append("asis","{{ $asis->id }}" );
              formData.append("ninio", content);
              $.ajax({
                  url: urlFoto,
                  type: "POST",
                  data:formData,                  
                  processData: false,  // tell jQuery not to process the data
                  contentType: false,   // tell jQuery not to set contentType
                  success : function(data) {
                   
                    if(data.success){
                      notificar('success',data.success); 
                       cargaListado();             
                                           
                    }
                    if(data.info){
                        notificar('info',data.info);
                    }
                    if(data.default){
                      notificar('info',data.default);
                    } 
                  },
                  error : function(xhr, status) {
                     notificar("error","Ocurrio un error");
                  },
                  complete : function(jqXHR, status) {
                        $.unblockUI();
                  }
              });      
          
  
        }

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


        function cargaListado(){
            $("#cargaListado" ).load( "{{ route('cargaListado',$asis->id) }}",function( response, status, xhr ){
                if ( status == "error" ) {
                    notificar('warning','No se pudo cargar el listado')
                }
            }); 
        }
        cargaListado();




        //esta  funcion esta tambien es lista
        function actualizar(arg){
            var cuentaContable=$(arg).val();
            var lista=$(arg).data('lista');

            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            $.post("{{ route('actualiuzarCuentasContablesLista') }}", { cuentaContable:cuentaContable,lista:lista})
            .done(function( data ) {
                if(data.success){
                    notificar('success',data.success);
                }
                if(data.info){
                    notificar('info',data.info);
                }
                if(data.default){
                    notificar('default',data.default);
                }
                cargaListado();
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                notificar("error","Ocurrio un error");
            });
        }


        //esta funcion esta tambien en lista
        function opcion(arg){
            
            var lista=$(arg).val();
            var opcion=$(arg).data('opcion');
            var estado="no";
            if($(arg).is(':checked')){
                estado="si";
            }

            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            $.post("{{ route('actualizarOpcionLista') }}", { lista:lista,opcion:opcion,estado:estado})
            .done(function( data ) {
                if(data.success){
                    notificar('success',data.success);
                }
                if(data.info){
                    notificar('info',data.info);
                }
                if(data.default){
                    notificar('default',data.default);
                }
                cargaListado();
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                notificar("error","Ocurrio un error");
            });
        }

        //esto esta en lista tambien
        function detalle(arg){
            var asis=$(arg).data('asis');
            var detalle=$(arg).val();
            $.post("{{ route('actualizarDetalleAsistencia') }}", { asis:asis,detalle:detalle})
            .done(function( data ) {
                if(data.success){
                    $('#msg_detalle_'+asis).addClass('text-success');
                    $('#msg_detalle_'+asis).html('Guardado exitosamente');
                }
                if(data.default){
                    $('#msg_detalle_'+asis).addClass('text-danger');
                    $('#msg_detalle_'+asis).html(data.default);
                }
                
            }).always(function(){
                
            }).fail(function(){
                $('#msg_detalle_'+asis).addClass('text-danger');
                $('#msg_detalle_'+asis).html('Ocurrio un error');
            });
        }
    </script>
@endprepend

@endsection
