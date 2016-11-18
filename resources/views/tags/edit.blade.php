@extends('main')
@section('title', '| Edit tag')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="well">
				{{ Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
				<div class="form-group">
					<div class="col-md-2">
						{{ Form::label('name', 'Tag name:', ['class' => 'control-label']) }}
					</div>
					<div class="col-md-8">
						{{ Form::text('name', null, ['class' => 'form-control']) }}	
					</div>
					<div class="col-md-2">
						{{ Form::submit('Edit', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection