@extends('layouts.main')

@section('seo-title')
<title>Login</title>
@endsection

@section('custom-css')
<!-- Custom styles for this page -->

@endsection

@section('content')
<form class="user col-md-4 offset-4" method="post" action=''>
    @csrf
    <div class="form-group mt-5">
        <label>Your Name</label>
        <input type="name" class="form-control form-control-user" name="name" value="{{ old('name') }}" >
        @if($errors->has('name'))
        <div class='text text-danger'>
             {{ $errors->first('name') }}
        </div>
        @endif
    </div>
    <div class="form-group">
        <label>Your Email</label>
        <input type="text" class="form-control form-control-user" name="email" value="{{ old('email') }}" >
        @if($errors->has('email'))
        <div class='text text-danger'>
             {{ $errors->first('email') }}
        </div>
        @endif
    </div>
    <div class="form-group">
        <label>Your Password</label>
        <input type="password" class="form-control form-control-user" name="password" >
        @if($errors->has('password'))
        <div class='text text-danger'>
             {{ $errors->first('password') }}
        </div>
        @endif
    </div>
    
    <button type="submit" class="btn btn-primary btn-user btn-block col-md-2">
         Login
    </button>
</form>
@endsection

@section('custom-js')
<!-- Custom styles for this page -->

@endsection
