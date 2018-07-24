@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Edit')
@section('content')

<div class = 'container'>
    <h1>
        Edit peca
    </h1>
    <form method = 'get' action = '{!!url("peca")!!}'>
        <button class = 'btn blue'>peca Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("peca")!!}/{!!$peca->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="input-field col s6">
            <input id="tipo" name = "tipo" type="text" class="validate" value="{!!$peca->
            tipo!!}"> 
            <label for="tipo">tipo</label>
        </div>
        <div class="input-field col s6">
            <input id="hospede_id" name = "hospede_id" type="text" class="validate" value="{!!$peca->
            hospede_id!!}"> 
            <label for="hospede_id">hospede_id</label>
        </div>
        <button class = 'btn red' type ='submit'>Update</button>
    </form>
</div>
@endsection