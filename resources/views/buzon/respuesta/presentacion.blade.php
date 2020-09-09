
@if ($buzonCarta->buzon->ninio->fechaNacimiento)            
    @php
        $edad=\Carbon\Carbon::parse($ninio->fechaNacimiento)->age
    @endphp
{{-- 6244 --}}
    @if ($edad>5)            
        @include('buzon.respuesta.formularioPresentacionMayores',$buzonCarta)
    @else
        @include('buzon.respuesta.formularioPresentacionMenores',$buzonCarta)
    @endif    
@else
    @include('buzon.respuesta.formularioPresentacionMayores',$buzonCarta)
@endif

{{-- {{$buzonCarta->buzon->ninio}} --}}