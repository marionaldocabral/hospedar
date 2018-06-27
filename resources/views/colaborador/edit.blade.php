@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Colaborador</div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('/colaborador/' . $colaborador->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="row {{ $errors->has('nome') ? 'has-error' : ''}}">
                            <label for="nome" class="col-md-4 control-label">{{ 'Nome' }}</label>
                            <div class="col-md-12">
                                <input class="form-control" name="nome" type="text" id="nome" value="{{ $colaborador->nome }}" required>
                                {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('funcao') ? 'has-error' : ''}}">
                            <label for="funcao" class="col-md-4 control-label">{{ 'Função' }}</label>
                            <div class="col-md-12">
                                <select class="form-control" name="funcao" id="funcao">
                                    <option>{{ $colaborador->funcao }}</option>
                                    @if($colaborador->funcao != 'Cozinha')
                                        <option>Cozinha</option>
                                    @endif
                                    @if($colaborador->funcao != 'Garçon')
                                        <option>Garçon</option>
                                    @endif
                                    @if($colaborador->funcao != 'Lavanderia')
                                        <option>Lavanderia</option>
                                    @endif
                                    @if($colaborador->funcao != 'Limpeza')
                                        <option>Limpeza</option>
                                    @endif
                                    @if($colaborador->funcao != 'Segurança')
                                        <option>Segurança</option>
                                    @endif
                                    @if($colaborador->funcao != 'Triagem')
                                        <option>Triagem</option>
                                    @endif                                    
                                </select>
                                {!! $errors->first('funcao', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('telefone') ? 'has-error' : ''}}">
                            <label for="telefone" class="col-md-4 control-label">{{ 'Telefone' }}</label>
                            <div class="col-md-12">
                                <input class="form-control" name="telefone" type="number" id="telefone" value="{{ $colaborador->telefone }}" required>
                                {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 6px;">
                            <div class="pull-left">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check" aria-hidden="true"></i> Gravar
                                </button>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/colaborador/') }}" class="btn btn-danger">
                                    <i class="fa fa-ban" aria-hidden="true"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection