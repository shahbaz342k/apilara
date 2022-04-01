@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if(session('success'))
                    <div class="alert alert-success">
                      {{ session('success') }}
                    </div> 
            @endif
            <a href="{{ url('/') }}" class="btn btn-success"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
        </div>
    </div>
</div>
@endsection

