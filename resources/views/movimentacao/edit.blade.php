@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Edit')
@section('content')

<div class = 'container'>
    <h1>
        Edit movimentacao
    </h1>
    <form method = 'get' action = '{!!url("movimentacao")!!}'>
        <button class = 'btn blue'>movimentacao Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("movimentacao")!!}/{!!$movimentacao->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="input-field col s6">
            <input id="tipo" name = "tipo" type="text" class="validate" value="{!!$movimentacao->
            tipo!!}"> 
            <label for="tipo">tipo</label>
        </div>
        <div class="input-field col s6">
            <input id="data" name = "data" type="text" class="validate" value="{!!$movimentacao->
            data!!}"> 
            <label for="data">data</label>
        </div>
        <div class="input-field col s6">
            <input id="hora" name = "hora" type="text" class="validate" value="{!!$movimentacao->
            hora!!}"> 
            <label for="hora">hora</label>
        </div>
        <div class="input-field col s6">
            <input id="hospede_id" name = "hospede_id" type="text" class="validate" value="{!!$movimentacao->
            hospede_id!!}"> 
            <label for="hospede_id">hospede_id</label>
        </div>
        <button class = 'btn red' type ='submit'>Update</button>
    </form>
</div>
@endsection