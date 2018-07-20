@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('admin.info')                    
                    <div class="form-group">
                        <div class="pull-right">
                            <a href="{{ url('/') }}" class="btn btn-warning" title="Home">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="table-responsive">
                        <div class="alert alert-success" role="alert">
                            Sua solicitação foi registrada com sucesso!<br>
                            Você receberá um email de confirmação caso a solicitação seja deferida.
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection