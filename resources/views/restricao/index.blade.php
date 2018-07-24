@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Restrições</div>
                <div class="panel-body">
                    <div class="form-group">
                        <a href="{{ url('home') }}" class="btn btn-warning" title="Home">
                           <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                        </a>
                    </div>
                    <br/><br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospedes as $hospede)
                                    @foreach($restricaos as $restricao)
                                        @if($restricao->hospede_id == $hospede->id)
                                            <tr>
                                                <td>{{$hospede->nome}}</td>
                                                <td>{{$restricao->tipo}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection