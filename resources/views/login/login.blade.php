@extends('baselayout')

@section('title')
	Login
@stop

@section('content')

<div class="row">
	<br>
	<div class="col-md-6">
		<br>
		<h2>Log in</h2>
		<p>Hi, here you can login to your account. Just fill in the form and press Sign In button.</p>
		<br>
		

		{!! Form::open(array('url' => 'users/login','class'=>'form')) !!}

		<br>{!! Form::label('email', 'E-Mail Address') !!}
		{!! Form::text('email', null, array('class' => 'form-control','placeholder' => 'example@gmail.com')) !!}
		<br>{!! Form::label('password', 'Password') !!}
		{!! Form::password('password', array('class' => 'form-control')) !!}
		<br>
		{!! Form::submit('Sign In' , array('class' => 'btn btn-primary')) !!}
		
		{!! Form::close() !!}
		<br>
	</div>
</div>

@stop