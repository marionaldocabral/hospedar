@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Leitos
                </div>
                <div class="panel-body">
                    @include('admin.info')
                    <div class="form-group">
                        <div class="pull-left">
                            <a href="{{ url('/leito/remove') }}" class="btn btn-danger">
                                <i class="fa fa-minus" aria-hidden="true"></i> 2
                            </a>
                            <a href="{{ url('/leito/create') }}" class="btn btn-success">
                                <i class="fa fa-plus" aria-hidden="true"></i> 2
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <a href="{{ url('/home') }}" class="btn btn-warning">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Local</th>
                                    <th>Telefone</th>
                              <!--      <th style="width: 210px !important;">Ações</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leitos as $leito)
                                <tr>
                                    @if($leito->id < 10)
                                        <td>{!! '0' . $leito->id !!}</td>
                                    @else
                                        <td>{!! $leito->id !!}</td>
                                    @endif
                                    @if($leito->hospede_id == NULL)
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @else
                                        @foreach($hospedes as $hospede)
                                            @if($hospede->id == $leito->hospede_id)
                                                <td>{!!$hospede->codigo!!}</td>
                                                <td>{!!$hospede->nome!!}</td>
                                                <td>{!!$hospede->cargo!!}</td>
                                                <td>{!!$hospede->local!!}</td>
                                                <td>{!!$hospede->telefone!!}</td>
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                               <!--     <td>
                                        <a href = "{{ url('/leito/' . $leito->id . '/edit') }}" title="Editar">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <form method="POST" action="{{ url('/leito/' . $leito->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir" onclick="return confirm(&quot;Confirma exclusão?&quot;)">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td> -->
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