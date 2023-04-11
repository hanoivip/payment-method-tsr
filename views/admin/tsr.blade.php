@extends('hanoivip::admin.layouts.admin')

@section('title', 'Vietnam payment cards')

@section('content')

<table>
<tr>
	<th>ID</th>
	<th>Serial</th>
	<th>Password</th>
	<th>Type</th>
	<th>User choosen</th>
	<th>Real amount</th>
	<th>Time</th>
</tr>
@foreach ($records as $record)
<tr>
	<td>
	{{$record->mapping}}
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
</tr>
@endforeach
</table>

@for ($i=0; $i<$total; ++$i)
<a href="{{ route('ecmin.tsr', ['page' => $i]) }}">{{$i}}</a>
@endfor

@endsection
