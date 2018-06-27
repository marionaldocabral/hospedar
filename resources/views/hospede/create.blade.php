@extends('layouts.app')
@section('content')
<div class = 'container'>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo Hóspede
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('/hospede') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row {{ $errors->has('codigo') ? 'has-error' : ''}}">
                            <label for="codigo" class="col-md-4 control-label">{{ 'Código' }}</label>
                            <div class="col-md-12">
                                <input type="number" name="codigo" id="codigo" class="form-control" required autofocus>                              
                                {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('nome') ? 'has-error' : ''}}">
                            <label for="nome" class="col-md-4 control-label">{{ 'Nome' }}</label>
                            <div class="col-md-12">
                                <input type="text" name="nome" id="nome" class="form-control" required autofocus>   
                                {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('cargo') ? 'has-error' : ''}}">
                            <label for="cargo" class="col-md-4 control-label">{{ 'Cargo' }}</label>
                            <div class="col-md-12">
                                <select name="cargo" id="cargo" class="form-control" required autofocus>
                                    <option>Administrador</option>
                                    <option>Ancião</option>
                                    <option>Cooperador de Jovens e Menores</option>
                                    <option>Cooperador do Ofício Ministerial</option>                  
                                    <option>Diácono</option>
                                    <option>Encarregado Local</option>
                                    <option>Encarregado Regional</option>
                                    <option>Músico</option>
                                    <option>Organista</option>
                                    <option>Outro</option>
                                </select>
                                {!! $errors->first('cargo', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('local') ? 'has-error' : ''}}">
                            <label for="local" class="col-md-4 control-label">{{ 'Local' }}</label>
                            <div class="col-md-12">
                                <input type="text" name="local" id="local" class="form-control" required autofocus>                                
                                {!! $errors->first('local', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('telefone') ? 'has-error' : ''}}">
                            <label for="telefone" class="col-md-4 control-label">{{ 'Telefone' }}</label>
                            <div class="col-md-12">
                                <input type="number" name="telefone" id="telefone" class="form-control" title="Campo opcional" autofocus>                    
                                {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 6px;">
                             <div class="pull-left">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check" aria-hidden="true"></i> Criar
                                </button>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/hospede') }}" class="btn btn-danger">
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