@extends('hanoivip::layouts.app')

@section('title', 'Nạp game với thẻ cào.')

@section('content')

@if (!empty($guide))
	<p>{{$guide}}</p>
@endif

@if ($errors->has('error'))
	<p>{{$errors->first('error')}}</p>
@endif

<form method="post" action="{{route('newtopup.do')}}">
{{ csrf_field() }}
	<input type="hidden" id="trans" name="trans" value="{{$trans}}"/>
	Card type: <select id="cardtype" name="cardtype">
		@foreach (Config::get('payment.tsr.telco_static') as $cardtype => $title))
			<option value="{{$cardtype}}">{{$title}}</option>
		@endforeach 
	</select>
	Card serial: <input id="cardseri" name="cardseri" value="{{ old('cardseri') }}"/>
	@if ($errors->has('cardseri'))
		<label style="color: red;">({{ $errors->first('cardseri') }})</label>
	@endif 
	Card password: <input id="cardpass" name="cardpass" value="{{ old('cardpass') }}"/>
	@if ($errors->has('cardpass'))
		<label style="color: red;">({{ $errors->first('cardpass') }})</label>
	@endif 
	Card amount (choose wrong will be penaltied): <select id="dvalue" name="dvalue">
		<option value="">Choose card value </option>
		@foreach (Config::get('payment.tsr.values_static') as $value => $title)
			<option value="{{$value}}" {{ old('dvalue') == $value ? 'selected' : '' }}>{{$title}}</option>
		@endforeach
	</select>
	@if ($errors->has('dvalue'))
		<label style="color: red;">({{ $errors->first('dvalue') }})</label>
	@endif 
	<button type="submit">OK</button>
</form>

@endsection
