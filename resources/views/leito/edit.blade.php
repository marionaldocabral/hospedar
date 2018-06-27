@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Edit')
@section('content')

<div class = 'container'>
    <h1>
        Edit leito
    </h1>
    <form method = 'get' action = '{!!url("leito")!!}'>
        <button class = 'btn blue'>leito Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("leito")!!}/{!!$leito->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="input-field col s6">
            <input id="numero" name = "numero" type="text" class="validate" value="{!!$leito->
            numero!!}"> 
            <label for="numero">numero</label>
        </div>
        <div class="input-field col s6">
            <input id="hospede_id" name = "hospede_id" type="text" class="validate" value="{!!$leito->
            hospede_id!!}"> 
            <label for="hospede_id">hospede_id</label>
        </div>
        <button class = 'btn red' type ='submit'>Update</button>
    </form>
</div>
@endsection