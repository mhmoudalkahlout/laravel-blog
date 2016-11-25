@extends('main')
<?php $title = htmlspecialchars($post->title); ?>
@section('title', "| $title")
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@if ($post->featured_image && file_exists(public_path('images/'.$post->featured_image)))
				<img src="{{ asset('images/' . $post->featured_image) }}" alt="post image" class="thumbnail" style="width: 100%; height: 100%">
			@endif
			<h1>{{ $post->title }}</h1>
			<h3>Posted in: {{ $post->Category->name }}</h3>
			<div class="well">
				<p>{!! $post->body !!}</p>
			</div>
			<div class="tags">
				@foreach ($post->tags as $tag)
					<span class="label label-default">
						{{ $tag->name }}
					</span>
				@endforeach
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="comment-title"><i class="glyphicon glyphicon-comment"></i><span class="badge"> {{ $post->comments()->count() }}</span> comments</h3>
			@foreach ($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
				<div class="comment">
					<div class="auther-info">
						<img src="{{  "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $comment->email ) ) ) ."?d=mm" }}" class="auther-image">
						<div class="auther-name">
							<h4>{{ $comment->name }}</h4>
							<p class="auther-time">{{ date('F nS, Y - g:iA', strtotime($comment->created_at)) }}</p>
						</div>
						<div class="comment-content">
							{{ $comment->comment }}
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<div class="row" id="comment-form">
		<div class="col-md-8 col-md-offset-2">
			{{ Form::open(['route'=>['comments.store', $post->id], 'method'=>'POST']) }}
				<div class="row">
					<div class="col-md-6 form-group">
						{{ Form::label('name', 'Name') }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}
					</div>
					<div class="col-md-6 form-group">
						{{ Form::label('email', 'Email') }}
						{{ Form::text('email', null, ['class' => 'form-control']) }}
					</div>
					<div class="col-md-12 form-group">
						{{ Form::label('comment', 'Comment') }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows'=>'3']) }}
					</div>
					<div class="col-md-12 form-group">
						{{ Form::submit('Add comment', ['class' => 'btn btn-success']) }}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection