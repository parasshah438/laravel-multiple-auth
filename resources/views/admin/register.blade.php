@extends('layouts.my')
@section('content')
<div class="container">
<br>
<hr>
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<div id="success_msg" class="alert alert-success"  style="display: none;"></div>
<header class="card-header">
	<h4 class="card-title mt-2">Admin Sign up</h4>
		@if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
</header>
<article class="card-body">
<form method="post" autocomplete="off" id="myfrom">
	@csrf
	<div class="form-row">
		<div class="col form-group">
			<label>Name </label>   
		  	<input type="text" class="form-control" placeholder="Name" name="name" id="name" value="{{ old('name') }}">
		  	<div class="text-danger">{{ $errors->first('name')  }}</div>
		</div>
		<div class="col form-group">
			<label>Email address</label>
			<input type="email" id="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}">
			<div class="text-danger">{{ $errors->first('email')  }}</div>
			<div id="email_error"></div>
		</div>
	</div>
	<div class="form-row">
		<div class="col form-group">
			<label>Password </label>   
		  	<input type="password" class="form-control" placeholder="Password" name="password" id="password">
		  	<div class="text-danger">{{ $errors->first('password')  }}</div>
		</div>
		<div class="col form-group">
			<label>Confirm password</label>
		  	<input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
		  	<div class="text-danger">{{ $errors->first('cpassword')  }}</div>
		</div>
	</div>
    <div class="form-group">
        <input type="submit" id="submit" class="btn btn-primary btn-block" value="Register">
    </div>                                         
</form>
</article>
<div class="border-top card-body text-center">Have an account? <a href="{{url('/admin')}}">Log In</a></div>
</div>
</div>
</div> 

<script type="text/javascript">
$(document).ready(function(){
	$('#success_msg').css('display','none');

$('#myfrom').validate({
	rules:{
		name:{
			required:true,
		},
		email:{
			required:true,
			email:true,
		},
		password:{
			required:true,
		},
		cpassword:{
			required:true,
			equalTo:"#password",
		},
	},
	messages:{
		name:{
			required:"Name is required"
		},
		email:{
			required:"Email is required",
			email:"Email address is not valid",
		},
		password:{
			required:"Password is required",
		},
		cpassword:{
			required:"Confirm password is required",
			equalTo:"Password is not match",
		},
	},
	submitHandler:function(){
		$.ajax({
			type:"POST",
			url:"{{url('admin/register')}}",
			data:$('#myfrom').serialize(),
			success:function(result){
				if(result == "email_exists"){
					return false;
				}
				else
				{	
				  $('html, body').animate({
				         scrollTop: $(".mt-2").offset().top
				     }, 800);
					$('#myfrom')[0].reset();
					$('#success_msg').show().html(result.success);
					setTimeout(function(){
						$('#success_msg').fadeOut();
					},2000);
				}

			}
		});
	}
});

$('#email').blur(function(){
	var email = $(this).val();
	var _token = $('input[name="_token"]').val();
	$.ajax({
			type:"POST",
			url:"{{ url('admin/checkemail') }}",
			data:{email:email,_token:_token},
			success:function(result){
        
				if(result == "not_unique")
				{
					$('#email_error').html('<label class="error">This Email Address is alredy registered</label>');
					$('#submit').attr('disabled', 'disabled');
				}
				else
				{
					$('#email_error').html('');
					$('#submit').attr('disabled',false);
				}
			}
	});
});
});
</script>
@endsection