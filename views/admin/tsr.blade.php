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

{{ $records->links() }}

@endsection
