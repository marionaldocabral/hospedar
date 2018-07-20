@extends('layouts.app')
@section('content')
<div class = 'container'>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo Pedido de Reserva
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('/pedido') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row {{ $errors->has('leito') ? 'has-error' : ''}}">
                            <label for="leito" class="col-md-4 control-label">{{ 'Leito' }}</label>
                            <div class="col-md-12">
                                <select name="leito_id" id="leito" name="leito" class="form-control" required>
                                    @foreach($leitos as $leito)
                                        @if($leito->id < 10)
                                            <option>{{'0'. $leito->id}}</option>
                                        @else
                                            <option>{{$leito->id}}</option>
                                        @endif
                                    @endforeach                                                               
                                </select>
                                {!! $errors->first('leito', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('hospede_codigo') ? 'has-error' : ''}}">
                            <label for="hospede_codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
                            <div class="col-md-12">
                                <input type="number" name="hospede_codigo" id="hospede_codigo" class="form-control" required>
                                {!! $errors->first('hospede_codigo', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('hospede_nome') ? 'has-error' : ''}}">
                            <label for="hospede_nome" class="col-md-4 control-label">{{ 'Nome' }}</label>
                            <div class="col-md-12">
                                <input type="text" name="hospede_nome" id="nome" class="form-control" required autofocus>   
                                {!! $errors->first('hospede_nome', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('hospede_cargo') ? 'has-error' : ''}}">
                            <label for="hospede_cargo" class="col-md-4 control-label">{{ 'Cargo' }}</label>
                            <div class="col-md-12">
                                <select name="hospede_cargo" id="cargo" class="form-control" required autofocus>
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
                                {!! $errors->first('hospede_cargo', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('local') ? 'has-error' : ''}}">
                            <label for="hospede_local" class="col-md-4 control-label">{{ 'Local' }}</label>
                            <div class="col-md-12">
                                <input type="text" name="hospede_local" id="local" class="form-control" required autofocus>                                
                                {!! $errors->first('hospede_local', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row {{ $errors->has('hospede_telefone') ? 'has-error' : ''}}" id="divtel">
                            <label for="telefone" class="col-md-4 control-label">{{ 'Telefone' }}</label>
                            <div class="col-md-12">
                                <input type="number" name="hospede_telefone" id="telefone" class="form-control" required autofocus>
                                {!! $errors->first('hospede_telefone', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <label class="col-md-4 control-label">Restrições</label>
                            <dir class="col-md-12">
                                <input type="checkbox" name="diabetes" value="Diabetes">Diabetes
                                <input type="checkbox" name="pressao" value="Pressão Alta" style="margin-left: 15px">Pressão Alta
                                <input type="checkbox" name="epilepsia" value="Epilepsia" style="margin-left: 15px">Eplepsia                                
                            </dir>                            
                        </div>
                        <br>
                        <div class="row {{ $errors->has('hospede_email') ? 'has-error' : ''}}">
                            <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
                            <div class="col-md-12">
                                <input type="email" name="hospede_email" id="email" class="form-control" autofocus required>                    
                                {!! $errors->first('hospede_email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 6px;">
                             <div class="pull-left">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check" aria-hidden="true"></i> Enviar
                                </button>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/') }}" class="btn btn-danger">
                                    <i class="fa fa-ban" aria-hidden="true"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function(){
                            $('.btn-success').attr('disabled','');
                            $('#hospede_codigo').keyup(function(){
                                if($(this).val().length == 7){
                                    $('.btn-success').removeAttr('disabled');
                                    var url = '/hospede/' + $('#hospede_codigo').val() + '/busca';
                                    $.get(url, function(data, status){
                                        if(status == 'success' && data['codigo'] != null){
                                            $('#nome').val(data['nome'])
                                            $('#cargo').val(data['cargo'])
                                            $('#local').val(data['local'])
                                            $('#telefone').val(data['telefone'])
                                        }
                                    })                                  
                                }
                                else{
                                    $('#nome').val('')
                                    $('#cargo').val('')
                                    $('#local').val('')
                                    $('#telefone').val('')
                                    $('.btn-success').attr('disabled','');
                                }
                            })
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection