@extends('main')
@section('title', '| Edit post')
@section('stylesheets')
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
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put', 'files' => true]) !!}
		<div class="col-md-8">
			<div class="form-group">
				{{ Form::label('title', 'Title:')}}
				{{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
			</div>
			<div class="form-group">
				{{ Form::label('slug', 'Slug:')}}
				{{ Form::text('slug', null, ['class' => 'form-control']) }}
			</div>
			<div class="form-group">
				{{ Form::label('category_id', 'Category:')}}
				{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
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
				{{ Form::label('body', 'Body:')}}
				{{ Form::textarea('body', null, ['class' => 'form-control']) }}
			</div>		
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created at:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Updated at:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
				<div class="row">
					<div class="col-md-6">
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-md-6">
						{{ Form::submit('Sava Changes', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
@endsection
@section('scripts')
	{!! Html::script('select2-4.0.3/js/select2.min.js') !!}
	<script type="text/javascript">
		$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
	</script>
@endsection