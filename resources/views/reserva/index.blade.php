@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reservas
                </div>
                <div class="panel-body">
                    @include('admin.info')
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
                                    <th>Leito</th>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Local</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th style="width: 210px !important;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservas as $reserva)
                                <tr>
                                    @if($reserva->leito_id < 10)
                                        <td>{{'0' . $reserva->leito_id}}</td>
                                    @else
                                        <td>{{$reserva->leito_id}}</td>
                                    @endif
                                    <td>{{$reserva->hospede_codigo}}</td>
                                    <td>{{$reserva->hospede_nome}}</td>
                                    <td>{{$reserva->hospede_cargo}}</td>
                                    <td>{{$reserva->hospede_local}}</td>
                                    <td>{{$reserva->hospede_telefone}}</td>
                                    <td>{{$reserva->hospede_email}}</td>
                                    <td>
                                        <form method="POST" action="{{ url('/reserva/' . $reserva->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Negar" onclick="return confirm(&quot;Confirma o cancelamento da reserva?&quot;)">
                                                <i class="fa fa-ban" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ url('/reserva/' . $reserva->id . '/confirma') }}" accept-charset="UTF-8" style="display:inline">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-success btn-sm" title="Confirmar" onclick="return confirm(&quot;Confirma a reserva?&quot;)">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
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