@extends('main')
@section('title', '| create post')
@section('stylesheets')
	{!! Html::style('dist/css/parsley.css') !!}
@endsection
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create a new blog</h1>
			<hr>
			{!! Form::open(array('route' => 'posts.store', 'data-parsely-validate' => '')) !!}
				<div class="form-group">
					{{ Form::label('title', 'Title:') }}
					{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'data-parsley-maxlength' => '255')) }}
				</div>
				<div class="form-group">
					{{ Form::label('slug', 'Slug:') }}
					{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'data-parsley-minlength' => '5', 'data-parsley-maxlength' => '255')) }}
				</div>
				<div class="form-group">
					{{ Form::label('category_id', 'Category:') }}
					{{ Form::select('category_id', $categories, null, array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('body', 'Post body:') }}
					{{ Form::textarea('body', null, array('class' => 'form-control', 'required' => '')) }}
				</div>
				{{ Form::submit('Create post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => '')) }}
			{!! Form::close() !!}
		</div>
	</div>
@endsection
@section('scripts')
	{!! Html::script('dist/js/parsley.min.js') !!}
	<script type="text/javascript">
		$(function () {
		  $("[data-parsely-validate]").parsley();
		});
	</script>
@endsection
