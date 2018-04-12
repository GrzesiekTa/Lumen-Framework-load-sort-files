@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<h1>Filtruj po grupie</h1>
				@foreach ($getGroups as $key => $element)
				<a href="{{route('GetOrderByGroup', ['id' => $element]) }}">{{$element}}</a>
				@endforeach
				<h3>Najbardziej popularne kraje ({{$mostPopularCountriesInGroup->max_count}})zamówienia:
					@foreach ($mostPopularCountriesInGroup->countries as $singleCountry)
					<b>{{$singleCountry.','}}</b>
					@endforeach
				</h3>
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Customer</th>
								<th scope="col">Country</th>
								<th scope="col">Order</th>
								<th scope="col">Status</th>
								<th scope="col">Group</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($ordersByGroupNumber as $key =>$elemnet)
								<tr>
									<th>{{$key}}</th>
									<td>{{$elemnet['Customer']}}</td>
									<td>{{$elemnet['Country']}}</td>
									<td>{{$elemnet['Order']}}</td>
									<td>
										@if (isset($elemnet['Status']))
											{{$elemnet['Status']}}
										@endif
									</td>
									<td>{{$elemnet['Group']}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection