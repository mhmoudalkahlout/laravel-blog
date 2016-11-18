@extends('main')
@section('title', '| Tags')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="well">
				{!! Form::open(['route' => 'tags.store', 'class' => 'form-horizontal']) !!}
				<div class="form-group">
					<div class="col-md-2">
						{{ Form::label('name', 'Tag name:', ['class' => 'control-label']) }}
					</div>
					<div class="col-md-8">
						{{ Form::text('name', null, ['class' => 'form-control']) }}	
					</div>
					<div class="col-md-2">
						{{ Form::submit('Add a tag', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>All Tags</h1>
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach ($tags as $tag)
						<tr>
							<td>{{ $tag->id }}</td>
							<td style="font-weight: bold"><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
							<td>
								{{ Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) }}
									{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs', 'onClick' => 'return confirm("You are about to delete a record. This cannot be undone. Are you sure?");'])}}
								{{ Form::close() }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	$tags->links(); !!}
			</div>
		</div>
	</div>
@endsection