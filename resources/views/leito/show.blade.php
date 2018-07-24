@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            @if($leito->id < 10)
                <div class="panel-heading">
                    <b>Leito {!! '0' . $leito->id !!}</b>
                    @if($leito->status == 2)
                        <b style="color: #FACC2E">(Reserva)</b>
                    @endif
                </div>
            @else
                <div class="panel-heading">
                    <b>Leito {!! $leito->id !!}</b>
                    @if($leito->status == 2)
                        <b style="color: #FACC2E">(Reserva)</b>
                    @endif
                </div>
            @endif
            <dir class="panel-body">
                @if($leito->status == 3)
                    <div class="pull-left">
                        <a href="{{ url('hospede/' . $leito->hospede_id) . '/peca' }}" class="btn btn-success">
                            <i class="fa fa-tags" aria-hidden="true"></i> Lavanderia
                        </a>
                    </div>
                @endif
                <div class="pull-right">
                    <a href="{{ url('/home') }}" class="btn btn-warning">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>            
            </dir>
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
                            @if(sizeof($restricoes) != 0)
                                <tr>
                                    <th class="col-md-2"> Restrições </th>
                                    <td class="col-md-10">
                                        @foreach($restricoes as $restricao)
                                            {{$restricao->tipo . '; '}}
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <form method="POST" action="{{ url('/leito/' . $leito->id . '/hospede/' . $hospede->id . '/liberar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group" style="margin-top: 6px;">
                             <div class="pull-left">
                                <button class="btn btn-danger" type="submit" onclick="return confirm(&quot;Deseja liberar o leito?&quot;)">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Liberar
                                </button>
                            </div>
                        </div>
                    </form>
                    @if($leito->status == 2)
                    <form method="POST" action="{{ url('/leito/' . $leito->id . '/hospede/' . $hospede->id . '/confirmar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="pull-right" style="margin-left: 10px">
                            <button class="btn btn-success" type="submit" onclick="return confirm(&quot;Deseja confirmar a reserva?&quot;)">
                                    <i class="fa fa-check" aria-hidden="true"></i> Confirmar
                                </button>
                            </div>                        
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection