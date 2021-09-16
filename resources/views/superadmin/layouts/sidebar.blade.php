@extends('layouts.app')

<!-- sidebar content -->
<div id="sidebar" class="col-md-4">
    @include('includes.sidebar')
</div>
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Super Admin Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        This is Admin Dashboard. You must be super privileged to be here !
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
