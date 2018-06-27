@extends('layouts.app')
@section('content')
<div class = 'container'>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo Colaborador
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('/colaborador') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row {{ $errors->has('nome') ? 'has-error' : ''}}">
                            <label for="nome" class="col-md-4 control-label">{{ 'Nome' }}</label>
                            <div class="col-md-12">
                                <input type="text" name="nome" id="nome" class="form-control">                                
                                {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('telefone') ? 'has-error' : ''}}">
                            <label for="telefone" class="col-md-4 control-label">{{ 'Telefone' }}</label>
                            <div class="col-md-12">
                                <input type="number" name="telefone" id="telefone" class="form-control">                              
                                {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('funcao') ? 'has-error' : ''}}">
                            <label for="funcao" class="col-md-4 control-label">{{ 'Função' }}</label>
                            <div class="col-md-12">
                                <select class="form-control" name="funcao" id="funcao">
                                    <option>Triagem</option>
                                    <option>Lavanderia</option>
                                    <option>Limpeza</option>
                                    <option>Segurança</option>
                                    <option>Cozinha</option>
                                    <option>Garçon</option>
                                </select>
                                {!! $errors->first('funcao', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 6px;">
                             <div class="pull-left">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check" aria-hidden="true"></i> Criar
                                </button>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/colaborador') }}" class="btn btn-danger">
                                    <i class="fa fa-ban" aria-hidden="true"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection