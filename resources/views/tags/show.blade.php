@extends('main')
@section('title', "| $tag->name Tag")
@section('content')
	
	<div class="row">
		<div class="col-md-8">
			<h1>{{$tag->name }} Tag <small class="badge">{{ $tag->posts()->count() }} Posts</small></h1>
		</div>
		<div class="col-md-2 col-md-offset-2">
			<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-block" style="margin-top: 20px">Edit</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Tsgs</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($tag->posts as $post)
						<tr>
							<td>{{ $post->id }}</td>
							<td>{{ $post->title }}</td>
							<td>
								@foreach ($post->tags as $tag)
									<a href="{{ route('tags.show', $tag->id) }}" class="label label-default">{{ $tag->name }}</a>
								@endforeach
							</td>
							<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-xs">View</a></td>
						</tr>
					@endforeach
					
				</tbody>
			</table>
		</div>
	</div>

@endsection