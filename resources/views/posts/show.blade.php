@extends('main')
@section('title', '| show post')
@section('content')
	<div class="row">
		<div class="col-md-8">
			@if ($post->featured_image && file_exists(public_path('images/'.$post->featured_image)))
				<img src="{{ asset('images/' . $post->featured_image) }}" alt="post image" class="thumbnail" style="width: 100%; height: 100%">
			@endif
			<h1>{{ $post->title }}</h1>
			<p class="lead">{!! $post->body !!}</p>
			<hr>
			<div class="tags">
				@foreach ($post->tags as $tag)
					<span class="label label-default">
						{{ $tag->name }}
					</span>
				@endforeach
			</div>
			<div id="comments-backend" style="margin-top: 50px">
				<h4>Comments <small>{{ $post->comments()->count() }} total</small></h4>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Comment</th>
							<td style="width: 70px"></td>
						</tr>
					</thead>
					<tbody>
						@foreach ($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
							<tr>
								<td>{{ $comment->name }}</td>
								<td>{{ $comment->email }}</td>
								<td>{{ $comment->comment }}</td>
								<td>
									<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary" style="float: left; margin-right: 5px;"><span class="glyphicon glyphicon-pencil"></span></a>
									{{ Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comment->id]]) }}
										<button type="submit" class="btn btn-xs btn-danger" onClick = 'return confirm("You are about to delete a record. This cannot be undone. Are you sure?");'>
										  <i class="glyphicon glyphicon-trash"></i>
										</button>
						            {{ Form::close() }}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<label>URL:</label>
					<p><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></p>
				</dl>
				<dl class="dl-horizontal">
					<label>Category:</label> {{ $post->category->name }}
				</dl>
				<dl class="dl-horizontal">
					<label>Created at:</label>
					<p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Updated at:</label>
					<p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
				</dl>
				<div class="row">
					<div class="col-md-6">
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
					</div>
					<div class="col-md-6">
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
						{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-block', 'onClick' => 'return confirm("You are about to delete a record. This cannot be undone. Are you sure?");')) !!}
						{!! Form::close() !!}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						{!! Html::linkRoute('posts.index', 'back to posts', array($post->id), array('class' => 'btn-h1-spacing btn btn-default btn-block')) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
