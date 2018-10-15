@extends('layouts.master')

@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
        @include('layouts.includes.subheader')
</div>
<!-- BEGIN: Content -->
<div class="m-content">
        Hiện các password yếu, quá hạn, lịch sử hoạt động
</div>
<!-- END: Content -->

@endsection

@section('pageSnippets')
<script src="{{ asset('app/js/dashboard.js') }}" type="text/javascript"></script>
@endsection
