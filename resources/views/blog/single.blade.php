@extends('main')
@section('title', "| $post->title")
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{ $post->title }}</h1>
			<div class="well">
				<p>{{ $post->body }}</p>
			</div>
		</div>
	</div>
@endsection