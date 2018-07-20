@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            @if($leito->id < 10)
                <div class="panel-heading">
                    <b>Leito {!! '0' . $leito->id !!}</b>
                    <div class="pull-right">
                            @if($eHospede['status'] == true && $eHospede['leito'] < 10)
                                <b style="color: red">{{' (Leito Atual: 0' . $eHospede['leito'] . ')'}}</b>
                            @elseif($eHospede['status'] == true)
                                <b style="color: red">{{' (Leito Atual: ' . $eHospede['leito'] . ')'}}</b>
                            @else
                                <input type="checkbox" id="reserva" value="0">Reserva
                            @endif
                    </div>
                </div>
            @else
                <div class="panel-heading">
                    <b>Leito {!! $leito->id !!}</b>
                    <div class="pull-right">
                        @if($eHospede['status'] == true && $eHospede['leito'] < 10)
                            <b style="color: red">{{' (Leito Atual: 0' . $eHospede['leito'] . ')'}}</b>
                        @elseif($eHospede['status'] == true)
                            <b style="color: red">{{' (Leito Atual: ' . $eHospede['leito'] . ')'}}</b>
                        @else
                            <input type="checkbox" id="reserva" value="0">Reserva
                        @endif
                    </div>
                </div>
            @endif
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-borderless">          
                        <tbody>
                            <tr>
                                <th class="col-md-2"> Código </th><td class="col-md-10"> {!!$hospede->codigo!!} </td>
                            </tr>
                            <tr>
                                <th class="col-md-2"> Nome </th><td class="col-md-10"> {!!$hospede->nome!!} </td>
                            </tr>
                            <tr>
                                <th class="col-md-2"> Cargo </th><td class="col-md-10"> {!!$hospede->cargo!!} </td>
                            </tr>
                            <tr>
                                <th class="col-md-2"> Local </th><td class="col-md-10"> {!!$hospede->local!!} </td>
                            </tr>
                            <tr>
                                @if($hospede->telefone != NULL)
                                    <th class="col-md-2"> Telefone </th><td class="col-md-10"> {!!$hospede->telefone!!} </td>
                                @else
                                    <th class="col-md-2"> Telefone </th><td class="col-md-10"> - </td>
                                @endif
                            </tr>
                            @if($chegada != NULL)
                                <tr>
                                    <th class="col-md-2"> Chegada </th><td class="col-md-10"> {!!$chegada!!} </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <form method="POST" action="{{ url('/leito/' . $leito->id . '/hospede/' . $hospede->id . '/hospedar') }}" accept-charset="UTF-8" enctype="multipart/form-data" id="form">
                        {{ csrf_field() }}
                        <div class="form-group" style="margin-top: 6px;">
                             <div class="pull-left">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check" aria-hidden="true"></i> Salvar
                                </button>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/home') }}" class="btn btn-danger">
                                    <i class="fa fa-ban" aria-hidden="true"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function(){
                            $('#reserva').click(function(){
                                if($('#reserva').val() == 1){
                                    $('#reserva').val(0)
                                    $('#form').attr('action','{{ url('/leito/' . $leito->id . '/hospede/' . $hospede->id . '/hospedar') }}')
                                }
                                else{
                                    $('#reserva').val(1)
                                    $('#form').attr('action','{{ url('/leito/' . $leito->id . '/hospede/' . $hospede->id . '/reservar') }}')
                                }
                            })
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection