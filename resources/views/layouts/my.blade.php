<!DOCTYPE html>
<html>
<head>
	<style type="text/css">.error{color:red}</style>		
	<script src="{{ asset('public/js/jquery.min.js') }}"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{asset('public/js/jquery.validate.js')}}"></script>
	<!------ Include the above in your HEAD tag ---------->
<title></title>
</head>
<body>
 @yield('content')
</body>
</html>
<script type="text/javascript">
$(".alert-success,.alert-danger").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(1000);
});
</script>