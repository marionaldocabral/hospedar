@extends('layouts.app')

@section('content')
<div class="panel-body">
    @include('admin.info')
</div>
<div class="container">
    <div class="row">
        <div class="col-auto">
            <div class="panel panel-default">
                <div class="panel-heading panel-body">
                    <div class="pull-left" style="width: 20%;">
                        <div style="width: 10px; height: 10px; background-color: green; display: inline-flex; margin-right: 3px"></div>
                        @if($qtdLeitosLivres < 10)
                            {{ 'Leitos Livres: 0' . $qtdLeitosLivres }}
                        @else
                            {{ 'Leitos Livres: ' . $qtdLeitosLivres }}
                        @endif
                    </div>
                    <div style="display: inline-flex; width: 60%; justify-content: center;">
                        Adm: {{$adm}} <span style="width: 15px"></span>
                        Anc: {{$anc}} <span style="width: 15px"></span>
                        CJM: {{$cjm}} <span style="width: 15px"></span>
                        COM: {{$com}} <span style="width: 15px"></span>
                        Dcn: {{$dcn}} <span style="width: 15px"></span>
                        ELc: {{$elc}} <span style="width: 15px"></span>
                        ERg: {{$erg}} <span style="width: 15px"></span>
                        Mus: {{$mus}} <span style="width: 15px"></span>
                        Org: {{$org}} <span style="width: 15px"></span>
                        Out: {{$out}}
                    </div>
                    <div class="pull-right" style="width: 20%; text-align: right;">
                        @if($qtdLeitosOcupados < 10)
                            {{ 'Leitos Ocupados: 0' . $qtdLeitosOcupados }}
                        @else
                            {{ 'Leitos Ocupados: ' . $qtdLeitosOcupados }}
                        @endif
                        <div style="width: 10px; height: 10px; background-color: red; display: inline-flex; margin-left: 3px"></div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">                            
                            <tbody>
                                <tr>
                                @foreach($leitosSuperiores as $leito)
                                    @if($leito->status == 1)
                                        @if($leito->hospede_id == NULL)
                                            <td style="border-top: none">
                                                <a data-toggle="modal" data-target=".bd-example-modal-sm" data-placement="top" title="Leito Livre" id="{{$leito->id}}" class="leito">
                                                    <div style="width: 22px; height: 60px; background-color: green; color: white; text-align: center;vertical-align: middle; display: table-cell;">
                                                        @if($leito->id < 10)
                                                            {{ '0' . $leito->id}}
                                                        @else
                                                            {{ $leito->id}}
                                                        @endif
                                                    </div>
                                                </a>
                                            </td>
                                        @else
                                            <td style="border-top: none">
                                                <a data-toggle="tooltip" data-placement="top" title="{{ $leito->hospede->nome . ', ' . $leito->hospede->cargo . ' de ' . $leito->hospede->local}}" href="{{ url('/leito/' . $leito->id) }}" id="{{$leito->id}}" class="leito">
                                                    <div style="width: 22px; height: 60px; background-color: red; color: white; text-align: center; vertical-align: middle; display: table-cell;">
                                                        @if($leito->id < 10)
                                                            {{ '0' . $leito->id}}
                                                        @else
                                                            {{ $leito->id}}
                                                        @endif                                                    
                                                    </div>
                                                </a>
                                            </td>
                                        @endif
                                    @endif
                                @endforeach
                                </tr> 
                            </tbody>
                            
                            <tbody>                                
                                <tr>
                                @foreach($leitosInferiores as $leito)                                    
                                    @if($leito->status == 1)
                                        @if($leito->hospede_id == NULL)
                                            <td>
                                                <a data-toggle="modal" data-target=".bd-example-modal-sm" title="Leito Livre" id="{{$leito->id}}" class="leito">
                                                    <div style="width: 22px; height: 60px; background-color: green; color: white; text-align: center; vertical-align: middle; display: table-cell;">
                                                        @if($leito->id < 10)
                                                            {{ '0' . $leito->id}}
                                                        @else
                                                            {{ $leito->id}}
                                                        @endif
                                                    </div>
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <a title="{{ $leito->hospede->nome . ', ' . $leito->hospede->cargo . ' de ' . $leito->hospede->local}}" href="{{ url('/leito/' . $leito->id) }}" id="{{$leito->id}}" class="leito">
                                                    <div style="width: 22px; height: 60px; background-color: red; color: white; text-align: center; vertical-align: middle; display: table-cell;">
                                                        @if($leito->id < 10)
                                                            {{ '0' . $leito->id}}
                                                        @else
                                                            {{ $leito->id}}
                                                        @endif                                                        
                                                    </div>
                                                </a>
                                            </td>
                                        @endif
                                    @endif
                                @endforeach
                                </tr> 
                            </tbody>
                        </table>
                    </div>         
                </div>
            </div>
        </div>
        <!-- janela flutuante -->
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Código do cartão</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" class="form-control" id="campo_leito">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Código:</label>
                            <input type="text" class="form-control" id="campo_codigo" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
                    <button id="bt_procurar" type="button" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Procurar</button>
                </div>
            </div>
          </div>
        </div>
        <script>
            $(document).ready(function(){
                $('.leito').click(function(){
                    $('#campo_leito').val($(this).attr('id'));
                    $('#campo_codigo').trigger('focus');
                });
                $('#bt_procurar').click(function(){
                    if($('#campo_codigo').val() == ''){
                        alert('Digite o código do cartão de identificação do hóspede.')
                    }
                    else if($('#campo_codigo').val() == '0000000'){
                        url = 'leito/' + $('#campo_leito').val() + '/hospede/' + $('#campo_codigo').val() + '/create';
                        window.location.href = url;
                    }
                    else{
                        var url = 'hospede/' + $('#campo_codigo').val() + '/busca';
                        $.get(url, function(data, status){
                            if(status == 'success' && data['codigo'] != null){
                                url = 'leito/' + $('#campo_leito').val() + '/hospede/' + data['id'];
                                window.location.href = url;
                            }
                            else{
                                url = 'leito/' + $('#campo_leito').val() + '/hospede/' + $('#campo_codigo').val() + '/create';
                                window.location.href = url;
                            }
                        });
                    }                    
                });
            });
        </script>
    </div>
</div>
@endsection

