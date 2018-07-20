@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show restricao
    </h1>
    <form method = 'get' action = '{!!url("restricao")!!}'>
        <button class = 'btn blue'>restricao Index</button>
    </form>
    <table class = 'highlight bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>hospede_id : </i></b>
                </td>
                <td>{!!$restricao->hospede_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>tipo : </i></b>
                </td>
                <td>{!!$restricao->tipo!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection