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
                            <a href="{{ url('/leito/remove') }}" class="btn btn-danger" title="Remover beliche">
                                <i class="fa fa-minus" aria-hidden="true"></i> 2
                            </a>
                            <a href="{{ url('/leito/create') }}" class="btn btn-success" title="Adicionar beliche">
                                <i class="fa fa-plus" aria-hidden="true"></i> 2
                            </a>
                            <button type="button" class="btn btn-info" id="btn-hidden" style="margin-left: 10px" title="Ocultar livres"><i class="fa fa-eye-slash" id="eye"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
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
                                        @if($leito->hospede_id == NULL)
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
                                        @else
                                            @if($leito->id < 10)
                                                <td>{!! '0' . $leito->id !!}</td>
                                            @else
                                                <td>{!! $leito->id !!}</td>
                                            @endif
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
                $('#btn-hidden').click(function(){
                    $('.leitovazio').toggle();
                    $('#eye').toggleClass('fa-eye-slash');
                    $('#eye').toggleClass('fa-eye');
                    if($('#btn-hidden').attr('title') == 'Ocultar livres'){
                        $('#btn-hidden').attr('title', 'Mostrar livres');
                    }
                    else{
                        $('#btn-hidden').attr('title', 'Ocultar livres');
                    }

                });
            });
        </script>
    </div>
@endsection