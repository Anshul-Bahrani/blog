@extends('layouts.app')

@section('content')

<div class="card">
	<div class="card-header">Add Post</div>

	<div class="card-body">
		<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title"
				value="{{ old('title', $post->title) }}"
				class="form-control" @error('title') is-invalid @enderror
				id="title">
				@error('title')
				<p class="text-danger">{{ $message }}</p>
				@enderror
			</div>
			<div class="form-group">
				<label for="excerpt">Excerpt</label>
				<input type="text" name="excerpt"
				value="{{ old('excerpt', $post->excerpt) }}"
				class="form-control @error('excerpt') is-invalid @enderror"
				id="excerpt">
				@error('excerpt')
				<p class="text-danger">{{ $message }}</p>
				@enderror
			</div>
			<div class="form-group">
				<label for="content">Content</label>
				<input id="content" type="hidden" name="content" value="{{ old('content', $post->content) }}">
					<trix-editor input="content"></trix-editor>

				@error('content')
				<p class="text-danger">{{ $message }}</p>
				@enderror
			</div>
			<div class="form-control">
				<label for="category_id">Category: </label>
				<select name="category_id" id="category_id">
					@foreach($categories as $category)
						@if($category->id == $post->category->id)
						<option selected value="{{ $category->id }}">{{ $category->name }}</option>
						@else
						<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="published_at">Publish At</label>
				<input type="text" name="published_at"
				value="{{ old('published_at', $post->published_at) }}"
				class="form-control @error('published_at') is-invalid @enderror"
				id="published_at">
				@error('published_at')
				<p class="text-danger">{{ $message }}</p>
				@enderror
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" name="image"
				value="{{ old('image') }}"
				class="form-control @error('image') is-invalid @enderror"
				id="image">
				@error('image')
				<p class="text-danger">{{ $message }}</p>
				@enderror
			</div>
			<div class="form-group">
				<button class="btn btn-success" type="submit">Add Post</button>
			</div>
		</form>
	</div>
</div>

@endsection

@section('page-level-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#published_at", {
            enableTime: true
        });
    </script>
@endsection
@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection