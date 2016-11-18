@extends('main')
@section('title', '| Edit comment')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Edit comment</h1>
			{{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}
				<div class="row">
					<div class="col-md-6 form-group">
						{{ Form::label('name', 'Name') }}
						{{ Form::text('name', null, ['class' => 'form-control', 'disabled' => '']) }}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('email', 'Email') }}
						{{ Form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}
					</div>
					<div class="col-md-12 form-group">
						{{ Form::label('comment', 'Comment') }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows'=>'3']) }}
					</div>
					<div class="col-md-12 form-group">
						{{ Form::submit('Edit comment', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection