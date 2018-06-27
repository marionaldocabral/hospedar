@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show movimentacao
    </h1>
    <form method = 'get' action = '{!!url("movimentacao")!!}'>
        <button class = 'btn blue'>movimentacao Index</button>
    </form>
    <table class = 'highlight bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>tipo : </i></b>
                </td>
                <td>{!!$movimentacao->tipo!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>data : </i></b>
                </td>
                <td>{!!$movimentacao->data!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>hora : </i></b>
                </td>
                <td>{!!$movimentacao->hora!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>hospede_id : </i></b>
                </td>
                <td>{!!$movimentacao->hospede_id!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection