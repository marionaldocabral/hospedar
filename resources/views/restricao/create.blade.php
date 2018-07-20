@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Create')
@section('content')

<div class = 'container'>
    <h1>
        Create restricao
    </h1>
    <form method = 'get' action = '{!!url("restricao")!!}'>
        <button class = 'btn blue'>restricao Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("restricao")!!}'>
        <input type = 'hidden' name = '_token' value = '{{ Session::token() }}'>
        <div class="input-field col s6">
            <input id="hospede_id" name = "hospede_id" type="text" class="validate">
            <label for="hospede_id">hospede_id</label>
        </div>
        <div class="input-field col s6">
            <input id="tipo" name = "tipo" type="text" class="validate">
            <label for="tipo">tipo</label>
        </div>
        <button class = 'btn red' type ='submit'>Create</button>
    </form>
</div>
@endsection