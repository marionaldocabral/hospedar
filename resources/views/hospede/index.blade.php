@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(isset($id))
                        @if($id < 10)
                            {{ 'Hospedar no Leito 0' . $id }}
                        @else
                            {{ 'Hospedar no Leito ' . $id }}
                        @endif
                    @else
                        {{ 'Hóspedes' }}
                    @endif
                </div>
                <div class="panel-body">
                    @include('admin.info')
                    <div class="form-group">
                        <div class="pull-left">
                            <a href="{{ url('/hospede/create') }}" class="btn btn-success" title="Cadastrar hóspede">
                                <i class="fa fa-plus" aria-hidden="true"></i> Novo
                            </a>
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
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Local</th>
                                    <th>Telefone</th>
                                    @if(!isset($id))
                                        <th style="width: 210px !important;">Ações</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospedes as $hospede)
                                <tr>
                                    @if(isset($id))                                    
                                        <td><a href="{{ '/leito/' . $id . '/hospede/' . $hospede->id . '/hospedar' }}">{!!$hospede->codigo!!}</a></td>
                                        <td><a href="{{ '/leito/' . $id . '/hospede/' . $hospede->id . '/hospedar' }}">{!!$hospede->nome!!}</a></td>
                                        <td><a href="{{ '/leito/' . $id . '/hospede/' . $hospede->id . '/hospedar' }}">{!!$hospede->cargo!!}</a></td>
                                        <td><a href="{{ '/leito/' . $id . '/hospede/' . $hospede->id . '/hospedar' }}">{!!$hospede->local!!}</a></td>
                                        <td><a href="{{ '/leito/' . $id . '/hospede/' . $hospede->id . '/hospedar' }}">{!!$hospede->telefone!!}</a></td>
                                    @else
                                        <td>{!!$hospede->codigo!!}</td>
                                        <td>{!!$hospede->nome!!}</td>
                                        <td>{!!$hospede->cargo!!}</td>
                                        <td>{!!$hospede->local!!}</td>
                                        <td>{!!$hospede->telefone!!}</td>
                                    @endif
                                    <td>
                                        @if(!isset($id))
                                            <a href = "{{ url('/hospede/' . $hospede->id . '/edit') }}" title="Editar">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>                                        
                                            <form method="POST" action="{{ url('/hospede/' . $hospede->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Excluir" onclick="return confirm(&quot;Confirma exclusão?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>                          
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                        {!! $hospedes->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection