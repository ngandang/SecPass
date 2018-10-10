@if(isset($error))
@foreach($error as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
@extends('login')