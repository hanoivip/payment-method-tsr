@extends('hanoivip::admin.layouts.admin')

@section('title', 'Vietnam payment cards')

@section('content')

<style type="text/css">
	table tr td{
		border: 1px solid;
	}
	table tr th{
		border: 1px solid;
	}
</style>

<form method="post" action="{{ route('ecmin.tsr') }}">
{{ csrf_field() }}
Find by serial: <input type="text" name="serial" id="serial" value="" />
<button type="submit">Filter</button>
</form>

<table>
<tr>
	<th>Trans</th>
	<th>Serial</th>
	<th>Password</th>
	<th>Type</th>
	<th>User choosen</th>
	<th>Real amount</th>
	<th>Time</th>
	<th>Action</th>
</tr>
@foreach ($records as $record)
<tr>
	<td>{{$record->trans}}
	</td>
	<td>{{$record->serial}}
	</td>
	<td>{{$record->password}}
	</td>
	<td>
	{{$record->cardtype}}
	</td>
	<td>
	{{$record->dvalue}}
	</td>
	<td>
	{{$record->value}}
	</td>
	<td>
	{{$record->created_at}}
	</td>
	<td>
		<form method="POST" action="{{ route('ecmin.vpcard.check') }}">
                {{ csrf_field() }}
            <input id="receipt" name="receipt" type="hidden" value="{{ $record->trans }}">
            <button type="submit" class="btn btn-primary">Check</button>
        </form>
	</td>
</tr>
@endforeach
</table>

{{ $records->links() }}

@endsection
