@extends('layouts.admin_app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teacher Dashboard</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    Hello {{ ucfirst(Auth::guard('teachers')->user()->name) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
