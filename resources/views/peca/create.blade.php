@extends('layouts.app')
@section('content')
<div class = 'container'>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo Serviço de Lavanderia
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('/peca') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row {{ $errors->has('tipo') ? 'has-error' : ''}}">
                            <label for="tipo" class="col-md-4 control-label">{{ 'Tipo' }}</label>
                            <div class="col-md-12">
                                <select name="tipo" id="tipo" class="form-control" required autofocus>
                                    <option>Blusa</option>
                                    <option>Calça</option>
                                    <option>Camisa</option>
                                    <option>Gravata</option>
                                    <option>Paletó</option>                  
                                    <option>Saia</option>
                                    <option>Vestido</option>
                                    <option>Outro</option>
                                </select>
                                {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('servico') ? 'has-error' : ''}}">
                            <label for="servico" class="col-md-4 control-label">{{ 'Serviço' }}</label>
                            <div class="col-md-12">
                                <select name="servico" id="servico" class="form-control" required autofocus>
                                    <option>Lavar</option>
                                    <option>Passar</option>
                                    <option>Reparar</option>                                    
                                </select>
                                {!! $errors->first('servico', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <input type="hidden" name="hospede_id" value="{{ $id }}">
                        <div class="form-group" style="margin-top: 6px;">
                             <div class="pull-left">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check" aria-hidden="true"></i> Criar
                                </button>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('hospede/' . $id . '/peca') }}" class="btn btn-danger">
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
