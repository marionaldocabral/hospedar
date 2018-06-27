@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show hospede
    </h1>
    <form method = 'get' action = '{!!url("hospede")!!}'>
        <button class = 'btn blue'>hospede Index</button>
    </form>
    <table class = 'highlight bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>codigo : </i></b>
                </td>
                <td>{!!$hospede->codigo!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>nome : </i></b>
                </td>
                <td>{!!$hospede->nome!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>cargo : </i></b>
                </td>
                <td>{!!$hospede->cargo!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>local : </i></b>
                </td>
                <td>{!!$hospede->local!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>telefone : </i></b>
                </td>
                <td>{!!$hospede->telefone!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection