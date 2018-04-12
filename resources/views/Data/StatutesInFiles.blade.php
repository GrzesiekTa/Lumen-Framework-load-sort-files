@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<h1>Statusy w załadowanych plikach</h1>
			@foreach ($status as $name => $element)
				<h3><b>{{$name}}</b> jest najbardziej popularny ({{$element['max_count']}}) wystpienia w : </h3>
				@foreach ($element['files'] as $f)
					{{$f}},
				@endforeach
			@endforeach
		</div>
	</div>
</div>
@endsection