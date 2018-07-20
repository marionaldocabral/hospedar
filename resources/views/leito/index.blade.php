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
                            <input type="checkbox" id="livres" style="margin-left: 10px" checked>Livres
                            <input type="checkbox" id="ocupados" style="margin-left: 10px" checked>Ocupados
                            <input type="checkbox" id="reservas" style="margin-left: 10px" checked>Reservas
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <a href="{{ url('/leito/remove') }}" class="btn btn-danger" title="Remover beliche">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/leito/create') }}" class="btn btn-success" title="Adicionar beliche">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/home') }}" class="btn btn-warning" title="Home" style="margin-left: 20px">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leitos as $leito)
                                    <tr>
                                        @if($leito->status == 1)
                                            @if($leito->id < 10)
                                                <td class="leitovazio">{!! '0' . $leito->id !!}</td>
                                            @else
                                                <td class="leitovazio">{!! $leito->id !!}</td>
                                            @endif
                                            <td class="leitovazio"></td>
                                            <td class="leitovazio"></td>
                                            <td class="leitovazio"></td>
                                            <td class="leitovazio"></td>
                                            <td class="leitovazio"></td>
                                        @elseif($leito->status == 2)
                                            @if($leito->id < 10)
                                                <td class="leitoreservado">{!! '0' . $leito->id !!}</td>
                                            @else
                                                <td class="leitoreservado">{!! $leito->id !!}</td>
                                            @endif
                                            @foreach($hospedes as $hospede)
                                                @if($hospede->id == $leito->hospede_id)
                                                    <td class="leitoreservado" style="color: #FACC2E">{!!$hospede->codigo!!}</td>
                                                    <td class="leitoreservado" style="color: #FACC2E">{!!$hospede->nome!!}</td>
                                                    <td class="leitoreservado" style="color: #FACC2E">{!!$hospede->cargo!!}</td>
                                                    <td class="leitoreservado" style="color: #FACC2E">{!!$hospede->local!!}</td>
                                                    <td class="leitoreservado" style="color: #FACC2E">{!!$hospede->telefone!!}</td>
                                                    @break
                                                @endif
                                            @endforeach
                                        @elseif($leito->status == 3)
                                            @if($leito->id < 10)
                                                <td class="leitoocupado">{!! '0' . $leito->id !!}</td>
                                            @else
                                                <td class="leitoocupado">{!! $leito->id !!}</td>
                                            @endif
                                            @foreach($hospedes as $hospede)
                                                @if($hospede->id == $leito->hospede_id)
                                                    <td class="leitoocupado">{!!$hospede->codigo!!}</td>
                                                    <td class="leitoocupado">{!!$hospede->nome!!}</td>
                                                    <td class="leitoocupado">{!!$hospede->cargo!!}</td>
                                                    <td class="leitoocupado">{!!$hospede->local!!}</td>
                                                    <td class="leitoocupado">{!!$hospede->telefone!!}</td>
                                                    @break                                  
                                                @endif
                                            @endforeach
                                        @endif
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#livres').click(function(){
                    $('.leitovazio').toggle();
                });
                $('#ocupados').click(function(){
                    $('.leitoocupado').toggle();
                });
                $('#reservas').click(function(){
                    $('.leitoreservado').toggle();
                });
            });
        </script>
    </div>
@endsection