@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<h1>{{$limit}} największych zamówień leków</h1>
			@foreach ($best_orders as $key => $element)
			<h3>{{$key}}: {{$element}} zamówień</h3>
			@endforeach
			
		</div>
	</div>
</div>
@endsection