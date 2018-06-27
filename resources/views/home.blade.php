@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-14">
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
                            <thead>
                                <tr>
                                    @foreach($leitosSuperiores as $leitos)
                                        @if($leitos->id < 10)
                                            <th>{{ '0' . $leitos->id}}</th>
                                        @else
                                            <th>{{ $leitos->id}}</th>
                                        @endif
                                    @endforeach                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @foreach($leitosSuperiores as $leito)                                    
                                    @if($leito->status == 1)
                                        @if($leito->hospede_id == NULL)
                                            <td><a href="{{ url('/leito/' . $leito->id) }}"><div style="width: 20px; height: 50px; background-color: green"></div></a></td>
                                        @else
                                            <td><a href="{{ url('/leito/' . $leito->id) }}"><div style="width: 20px; height: 50px; background-color: red"></div></a></td>
                                        @endif
                                    @else
                                        <td><div style="width: 20px; height: 50px; background-color: lightgray"></div></td>
                                    @endif
                                @endforeach
                                </tr> 
                            </tbody>
                            
                            <tbody>                                
                                <tr>
                                @foreach($leitosInferiores as $leito)                                    
                                    @if($leito->status == 1)
                                        @if($leito->hospede_id == NULL)
                                            <td><a href="{{ url('/leito/' . $leito->id) }}"><div style="width: 20px; height: 50px; background-color: green"></div></a></td>
                                        @else
                                            <td><a href="{{ url('/leito/' . $leito->id) }}"><div style="width: 20px; height: 50px; background-color: red"></div></a></td>
                                        @endif
                                    @else
                                        <td><div style="width: 20px; height: 50px; background-color: lightgray"></div></td>
                                    @endif
                                @endforeach
                                </tr> 
                            </tbody>
                            <thead>                                
                                <tr>
                                    @foreach($leitosInferiores as $leitos)
                                        @if($leitos->id < 10)
                                            <th style="border-bottom: none; border-width: 2px">{{ '0' . $leitos->id}}</th>
                                        @else
                                            <th  style="border-bottom: none; border-width: 2px">{{ $leitos->id}}</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>         
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

