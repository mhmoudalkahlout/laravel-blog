@extends('main')
@section('title', '| create post')
@section('stylesheets')
	{!! Html::style('dist/css/parsley.css') !!}
	{!! Html::style('select2-4.0.3/css/select2.min.css') !!}
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>
  		tinymce.init({ 
  			selector:'textarea',
  			menubar: false 
  		});
  	</script>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create a new blog</h1>
			<hr>
			{!! Form::open(array('route' => 'posts.store', 'data-parsely-validate' => '', 'files' => true)) !!}
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
					{{ Form::label('tags', 'Tags:') }}
					{{ Form::select('tags[]', $tags, null, array('class' => 'form-control select2-multi', 'multiple' => 'multiple')) }}
				</div>
				<div class="form-group">
					{{ Form::label('featured_image', 'Featured image:') }}
					{{ Form::file('featured_image') }}
				</div>
				<div class="form-group">
					{{ Form::label('body', 'Post body:') }}
					{{ Form::textarea('body', null, array('class' => 'form-control')) }}
				</div>
				{{ Form::submit('Create post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => '')) }}
			{!! Form::close() !!}
		</div>
	</div>
@endsection
@section('scripts')
	{!! Html::script('dist/js/parsley.min.js') !!}
	{!! Html::script('select2-4.0.3/js/select2.min.js') !!}
	<script type="text/javascript">
		$(function () {
		  $("[data-parsely-validate]").parsley();
		});
	</script>
	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>
@endsection
