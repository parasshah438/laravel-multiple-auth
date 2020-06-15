@extends('layouts.my')
@section('content')
<div class="container">
<br>
<hr>


<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">Sign up</h4>
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
			<label>First name </label>   
		  	<input type="text" class="form-control" placeholder="Enter yout First Name" name="firstname" value="{{$students_data->firstname}}">
		  	<div class="text-danger">{{ $errors->first('firstname')  }}</div>
		</div>
		<div class="col form-group">
			<label>Last name</label>
		  	<input type="text" class="form-control" placeholder="Enter yout Last Name" name="lastname" value="{{$students_data->lastname}}">
		  	<div class="text-danger">{{ $errors->first('lastname') }}</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col form-group">
			<label>Email address</label>
			<input type="email" class="form-control" placeholder="Enter yout Email Address" name="email" value="{{$students_data->email}}">
			<div class="text-danger">{{ $errors->first('email')  }}</div>
		</div>	
		<div class="col form-group">
		  	<label>Mobile Number </label>   
		  	<input type="text" class="form-control" placeholder="Enter yout Mobile number" name="number" id="number" value="{{$students_data->number}}">
		  	<div class="text-danger">{{ $errors->first('number')  }}</div>
		</div>
	</div>
	<div class="form-group">
		<label>Gender</label>
		<div class="col form-group">
		  <input type="radio" name="gender" value="Male" @if($students_data->gender == "Male") checked  @endif>
		  <span class="form-check-label"> Male </span>
		  <input  type="radio" name="gender" value="Female" @if($students_data->gender == "Female") checked  @endif>
		  <span class="form-check-label"> Female</span>
		</div>
	</div>
	<div class="form-group">
		<label>Programming Language</label>
		<div class="col form-group">
			@php

			$languages = explode(",",$students_data->language);
			 @endphp
		  <input type="checkbox" name="language[]" value="PHP" @if(in_array('PHP',$languages)) checked  @endif>
		  <span class="form-check-label"> PHP </span>
		 
		  <input  type="checkbox" name="language[]" value=".NET" @if(in_array('.NET',$languages)) checked  @endif>
		  <span class="form-check-label"> .NET</span>

		  <input  type="checkbox" name="language[]" value="JAVA" @if(in_array('JAVA',$languages)) checked  @endif>
		  <span class="form-check-label"> JAVA</span>

		  <input  type="checkbox" name="language[]" value="PYTHON" @if(in_array('PYTHON',$languages)) checked  @endif>
		  <span class="form-check-label"> PYTHON</span>
		</div>
		<div class="text-danger">{{ $errors->first('language')  }}</div>
	</div>
	<div class="form-row">
		<div class="col form-group">
			<label>Password </label>   
		  	<input type="password" class="form-control" placeholder="Enter yout Password" name="password" id="password">
		  	<div class="text-danger">{{ $errors->first('password')  }}</div>
		  	<div class="text-danger msg" style="display: none;"> If you don't want to change password... please leave them empty</div>
		</div>
		<div class="col form-group">
			<label>Confirm password</label>
		  	<input type="password" class="form-control" placeholder="Enter yout Confirm Password" name="cpassword">
		  	<div class="text-danger">{{ $errors->first('cpassword')  }}</div>
		</div>
	</div>
	<div class="form-group">
		  <label>Country</label>
		  <select id="country_id" name="country_id" class="form-control">
		    <option value=""> Choose...</option>
		     @foreach($countries as $countries_value)
		     @if($countries_value->id == $students_data->country_id)
		     	<option value="{{$countries_value->id}}" selected="selected">{{$countries_value->name}}</option>
		     @else
		     	<option value="{{$countries_value->id}}" >{{$countries_value->name}}</option>
		     @endif	
		     @endforeach
		  </select>
		<div class="text-danger">{{ $errors->first('country_id')  }}</div>
	</div>	  
	<div class="form-group">	
		 <label>State</label>
		  <select id="state_id" name="state_id" class="form-control state_info">
		    <option value=""> Choose state</option>
		      
		  </select>
		<div class="text-danger">{{ $errors->first('state_id')  }}</div>
	</div>	  
	<div class="form-group">	
		  <label>City                                                                                                                                                        </label>
		  <select id="city_id" name="city_id" class="form-control">
		  	 <option value=""> Choose city</option>
		  </select>
		<div class="text-danger">{{ $errors->first('city_id')  }}</div>  
	</div>	  
	<div class="form-group">
		<label>Address</label>
		<textarea class="form-control" placeholder="Enter yout Address" name="address">{{$students_data->address}}</textarea>
		<div class="text-danger">{{ $errors->first('address')  }}</div>
	</div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Register  </button>
    </div>                                         
</form>
</article>
<div class="border-top card-body text-center">Have an account? <a href="">Log In</a></div>
</div>
</div>
</div> 

<script type="text/javascript">


$(document).ready(function() {

select_state();
select_city();

$('#password').focus(function(){
	$('.msg').show();
});
$('#password').blur(function(){
	$('.msg').css('display','none');
});

   
$('#country_id').change(function(){
var country_id = $(this).val();    
if(country_id){
    $.ajax({
       type:"GET",
       url:"{{ url('student/get_state')}}",
       data:{country_id:country_id},
       success:function(result){               
        if(result){
            $("#state_id").empty();
            $("#state_id").append('<option value="">Select state</option>');
            $.each(result,function(key,value){
                $("#state_id").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }else{
           $("#state_id").empty();
        }
       }
    });
}else{
    $("#state_id").empty();
    }      
});

$('#state_id').change(function(){
var state_id = $(this).val();    
if(state_id){
    $.ajax({
       type:"GET",
       url:"{{ url('student/get_city')}}",
       data:{state_id:state_id},
       success:function(result){               
        if(result){
            $("#city_id").empty();
            $("#city_id").append('<option>Select city</option>');
            $.each(result,function(key,value){
                $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }else{
           $("#city_id").empty();
        }
       }
    });
}else{
    $("#city_id").empty();
    }      
});
});
	
function select_state(){
var country_id = $('#country_id').val();
var country = "<?php echo $students_data->state_id; ?>";
$.ajax({
   type:"GET",
   url:"{{ url('student/get_state')}}",
   data:{country_id:country_id},
   async:false,
   success:function(result){               
    if(result){
        $("#state_id").empty();
        $("#state_id").append('<option value=" ">Select state</option>');
        $.each(result,function(key,value){
            $("#state_id").append('<option value="'+value.id+'">'+value.name+'</option>');
            $("#state_id").val(country);
        });
    }else{
       $("#state_id").empty();
    }
   }
});
}

function select_city(){
var state_id = $('#state_id option:selected').val();
var city = "<?php echo $students_data->city_id; ?>";
  $.ajax({
       type:"GET",
       url:"{{ url('student/get_city')}}",
       data:{state_id:state_id},
       success:function(result){               
        if(result){
            $("#city_id").empty();
            $("#city_id").append('<option value=" ">Select city</option>');
            $.each(result,function(key,value){
                $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                $("#city_id").val(city);
            });
        }else{
           $("#city_id").empty();
        }
       }
    });
}
</script>
@endsection