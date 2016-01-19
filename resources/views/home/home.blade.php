@extends('baselayout')

@section('title')
	Home
@stop

@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="content">
			@foreach ($items as $item)
				<div class="title">{{$item->field1}}</div>
				<div class="title">{{$item->field2}}</div>
			@endforeach
		</div>
	</div>
</div>



@stop