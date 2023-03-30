@extends('hanoivip::layouts.app')

@section('title', 'Nạp game với thẻ cào.')

@section('content')

@if (!empty($guide))
	<p>{{$guide}}</p>
@endif

<form method="post" action="{{route('newtopup.do')}}">
{{ csrf_field() }}
	<input type="hidden" id="trans" name="trans" value="{{$trans}}"/>
	Card type: <select id="cardtype" name="cardtype">
		@foreach (Config::get('payment.tsr.telco_static') as $cardtype => $title))
			<option value="{{$cardtype}}">{{$title}}</option>
		@endforeach 
	</select>
	Card serial: <input id="cardseri" name="cardseri" value=""/>
	Card password: <input id="cardpass" name="cardpass" value=""/>
	Card amount: <select id="dvalue" name="dvalue">
		@foreach (Config::get('payment.tsr.values_static') as $value => $title)
			<option value="{{$value}}">{{$title}}</option>
		@endforeach
	</select>
	<button type="submit">OK</button>
</form>

@endsection
