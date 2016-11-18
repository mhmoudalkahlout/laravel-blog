@extends('main')
@section('title', '| Categories')
@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>All Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>action</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($categories as $category)
						<tr>
							<td>{{ $category->id }}</td>
							<td style="font-weight: bold">{{ $category->name }}</td>
							<td>
								{!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
									<button type="submit" class="btn btn-danger" onClick="return confirm('You are about to delete a record. This cannot be undone. Are you sure?');">
									    <i class="fa fa-trash-o link-black"></i> Delete
									</button>
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-5 col-md-offset-1">
			<div class="well">
				{!! Form::open(['route' => 'categories.store']) !!}
					<h3>add category</h3>
					<div class="form-group">
						{{ Form::label('name', 'Category name:') }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}	
					</div>
					<div class="form-group">
						{{ Form::submit('Add new category', ['class' => 'btn btn-success btn-block']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			{!!	$categories->links(); !!}
		</div>
	</div>
@endsection