@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Movimentação
                </div>
                <div class="panel-body">
                    @include('admin.info')
                    <div class="form-group">
                        <div class="pull-left">
                            <input type="checkbox" id="chegada" style="margin-left: 10px" checked>Chegada
                            <input type="checkbox" id="partida" style="margin-left: 5px" checked>Partida 
                        </div>
                        <div class="pull-right">
                            <a href="{{ url('/home') }}" class="btn btn-warning" title="Home">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Dia</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Tipo</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Localidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimentacaos as $movimentacao)
                                    <tr>
                                        <td>{{$dia[$movimentacao->id]}}</td>               
                                        <td>{!!$movimentacao->data!!}</td>
                                        <td>{!!$movimentacao->hora!!}</td>
                                        <td class="{{$movimentacao->tipo}}">{!!$movimentacao->tipo!!}</td>
                                        @foreach($hospedes as $hospede)
                                            @if($movimentacao->hospede_id == $hospede->id)
                                                <td>{!!$hospede->nome!!}</td>
                                                <td>{!!$hospede->cargo!!}</td>
                                                <td>{!!$hospede->local!!}</td>
                                                @break
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                        {!! $movimentacaos->render() !!}
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#chegada').click(function(){
                    $('.chegada').parent().toggle();
                });
                $('#partida').click(function(){
                    $('.partida').parent().toggle();
                });
            });
        </script>
    </div>
@endsection