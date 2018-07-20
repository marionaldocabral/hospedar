@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Index')
@section('content')

<div class = 'container'>
    <h1>
        restricao Index
    </h1>
    <div class="row">
        <form class = 'col s3' method = 'get' action = '{!!url("restricao")!!}/create'>
            <button class = 'btn red' type = 'submit'>Create New restricao</button>
        </form>
    </div>
    <table>
        <thead>
            <th>hospede_id</th>
            <th>tipo</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($restricaos as $restricao) 
            <tr>
                <td>{!!$restricao->hospede_id!!}</td>
                <td>{!!$restricao->tipo!!}</td>
                <td>
                    <div class = 'row'>
                        <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/restricao/{!!$restricao->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/restricao/{!!$restricao->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                        <a href = '#' class = 'viewShow btn-floating orange' data-link = '/restricao/{!!$restricao->id!!}'><i class = 'material-icons'>info</i></a>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $restricaos->render() !!}

</div>
@endsection