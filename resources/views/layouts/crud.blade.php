@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-8">
            @include('includes.table')
        </div>
        <div class="col-xl-4">
            @include('includes.form')
        </div>
    </div>
    @if($crud === 'articles')
        <div class="row">
            <div class="col-xl-12">
                @include('includes.tableWarehouse')
            </div>
        </div>
    @endif
@endsection
