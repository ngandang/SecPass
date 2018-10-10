@extends('layouts.master')
@include('errors.note')
@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
        @include('layouts.includes.subheader')
</div>
<!-- BEGIN: Content -->

<!-- END: Content -->

@endsection

@section('pageSnippets')
<script src="{{ asset('app/js/dashboard.js') }}" type="text/javascript"></script>
@endsection