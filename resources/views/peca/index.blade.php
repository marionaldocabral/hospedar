@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Serviço de Lavanderia</div>
                <div class="panel-body">
                    @include('admin.info')
                    <div class="form-group">
                        @if(isset($leito))
                            <div class="pull-left">
                                <a href="{{ url('hospede/' . $leito->hospede_id . '/peca/create') }}" class="btn btn-success" title="Cadastrar colaborador">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Novo
                                </a>
                            </div>
                        @endif
                        <div class="pull-right">
                            @if(isset($leito))
                                <a href="{{ url('leito/' . $leito->id) }}" class="btn btn-warning" title="Home">
                            @else
                                <a href="{{ url('home') }}" class="btn btn-warning" title="Home">
                            @endif
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Serviço</th>
                                        @if(!isset($leito))
                                            <th>Nome</th>
                                        @endif
                                    <th style="width: 210px !important;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pecas as $peca)
                                <tr>
                                    <td>{!!$peca->tipo!!}</td>
                                    <td>{{$peca->servico}}</td>
                                    @if(!isset($leito))
                                        @foreach($hospedes as $hospede)
                                            @if($hospede->id == $peca->hospede_id)
                                                <td>{!!$hospede->nome!!}</td>
                                            @endif
                                        @endforeach                                        
                                    @endif
                                    <td> 
                                        @if(isset($leito))
                                            <form method="POST" action="{{ url('hospede/' . $leito->hospede_id . '/peca/' . $peca->id . '/remove') }}" accept-charset="UTF-8" style="display:inline">
                                                
                                        @else
                                            <form method="POST" action="{{ url('peca/' . $peca->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                        @endif                                            
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir" onclick="return confirm(&quot;Confirma exclusão?&quot;)">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>                          
                                        </form>        
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection