@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Hóspede</div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('/hospede/' . $hospede->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="row {{ $errors->has('codigo') ? 'has-error' : ''}}">
                            <label for="codigo" class="col-md-4 control-label">{{ 'Código' }}</label>
                            <div class="col-md-12">
                                <input class="form-control" name="codigo" type="number" id="codigo" value="{{ $hospede->codigo }}" required autofocus>
                                {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('nome') ? 'has-error' : ''}}">
                            <label for="nome" class="col-md-4 control-label">{{ 'Nome' }}</label>
                            <div class="col-md-12">
                                <input class="form-control" name="nome" type="text" id="nome" value="{{ $hospede->nome }}" required autofocus>
                                {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('cargo') ? 'has-error' : ''}}">
                            <label for="cargo" class="col-md-4 control-label">{{ 'Cargo' }}</label>
                            <div class="col-md-12">
                                <select name="cargo" id="cargo" class="form-control" required autofocus>
                                    <option>{{ $hospede->cargo }}</option>
                                    @if($hospede->cargo != 'Administrador')
                                        <option>Administrador</option>
                                    @endif
                                    @if($hospede->cargo != 'Ancião')
                                        <option>Ancião</option>
                                    @endif
                                    @if($hospede->cargo != 'Cooperador de Jovens e Menores')
                                        <option>Cooperador de Jovens e Menores</option>
                                    @endif
                                    @if($hospede->cargo != 'Cooperador do Ofício Ministerial')
                                        <option>Cooperador do Ofício Ministerial</option>
                                    @endif
                                    @if($hospede->cargo != 'Diácono')
                                        <option>Diácono</option>
                                    @endif
                                    @if($hospede->cargo != 'Encarregado Local')
                                        <option>Encarregado Local</option>
                                    @endif
                                    @if($hospede->cargo != 'Encarregado Regional')
                                        <option>Encarregado Regional</option>
                                    @endif
                                    @if($hospede->cargo != 'Músico')
                                        <option>Músico</option>
                                    @endif
                                    @if($hospede->cargo != 'Organista')
                                        <option>Organista</option>
                                    @endif
                                    @if($hospede->cargo != 'Outro')
                                        <option>Outro</option>
                                    @endif
                                </select>
                                {!! $errors->first('cargo', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('local') ? 'has-error' : ''}}">
                            <label for="local" class="col-md-4 control-label">{{ 'Local' }}</label>
                            <div class="col-md-12">
                                <input class="form-control" name="local" type="text" id="local" value="{{ $hospede->local }}" required autofocus>
                                {!! $errors->first('local', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('telefone') ? 'has-error' : ''}}">
                            <label for="telefone" class="col-md-4 control-label">{{ 'Telefone' }}</label>
                            <div class="col-md-12">
                                <input class="form-control" name="telefone" type="number" id="telefone" value="{{ $hospede->telefone }}" autofocus>
                                {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <label class="col-md-4 control-label">Restrições</label>
                            <dir class="col-md-12">
                                @if(sizeof($rest_diabetes) != 0)
                                    <input type="checkbox" name="diabetes" value="Diabetes" checked>Diabetes
                                @else
                                    <input type="checkbox" name="diabetes" value="Diabetes">Diabetes
                                @endif
                                @if(sizeof($rest_pressao) != 0)
                                    <input type="checkbox" name="pressao" value="Pressão Alta" style="margin-left: 15px" checked>Pressão Alta
                                @else
                                    <input type="checkbox" name="pressao" value="Pressão Alta" style="margin-left: 15px">Pressão Alta
                                @endif
                                @if(sizeof($rest_epilepsia) != 0)
                                    <input type="checkbox" name="epilepsia" value="Epilepsia" style="margin-left: 15px" checked>Eplepsia
                                @else
                                    <input type="checkbox" name="epilepsia" value="Epilepsia" style="margin-left: 15px">Eplepsia
                                @endif
                            </dir>                            
                        </div>
                        <div class="form-group" style="margin-top: 6px;">
                            <div class="pull-left">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check" aria-hidden="true"></i> Gravar
                                </button>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/hospede/') }}" class="btn btn-danger">
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