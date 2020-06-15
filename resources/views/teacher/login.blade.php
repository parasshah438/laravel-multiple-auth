@extends('layouts.my')
@section('content')
<div class="container">
<br>
<hr>
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">Teacher Login</h4>
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
</header>
<article class="card-body">
<form method="post" autocomplete="off" id="loginform">
	@csrf
	<div class="form-row">
		<div class="col form-group">
			<label>Email Address</label>   
		  	<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email Address" autofocus>
            <span class="invalid-feedback" role="alert">      
                    {{ $errors->first('email') }}
            </span>
		</div>
		<div class="col form-group">
			<label>Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">
            <span class="invalid-feedback" role="alert">      
                    {{ $errors->first('password') }}
            </span>
		</div>
	</div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Login  </button>
        <div class="border-top card-body text-center">Dont't have an account?<a href="{{url('/teacher/register')}}"> Sign Up</a></div>
    </div>                                         
</form>
</article>
</div>
</div>
</div> 
<script type="text/javascript">
$('#loginform').validate({
	rules:{
		email:{
			required:true,
		},
		password:{
			required:true,
		},
	},
	messages:{
		email:{
			required:"Email is required",
		},
		password:{
			required:"Password is required",
		},
	},
	
});
</script>
@endsection


