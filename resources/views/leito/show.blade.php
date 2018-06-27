@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            @if($leito->id < 10)
                <div class="panel-heading"><b>Leito {!! '0' . $leito->id !!}</b></div>
            @else
                <div class="panel-heading"><b>Leito {!! $leito->id !!}</b></div>
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
                            <tr>
                                <th class="col-md-2"> Chegada </th><td class="col-md-10"> {!!$chegada!!} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pull-left">                    
                    <a href="{{ url('/leito/' . $leito->id . '/hospede/' . $hospede->id . '/liberar') }}" class="btn btn-danger" onclick="return confirm(&quot;Deseja liberar o leito?&quot;)">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Liberar
                    </a>                    
                </div>
                <div class="pull-right">
                    <a href="{{ url('/home') }}" class="btn btn-warning">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection