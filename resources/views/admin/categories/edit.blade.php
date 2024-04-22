@extends('adminlte::page')

@section('title', 'Modify category')

@section('content_header')
<h2>Modify category</h2>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <div class="form-group"><input type="hidden" name="id" value="{{ $category->id }}"></div>

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" id="name" name='name' placeholder="Category name" 
                value="{{ $category->name }}">

                @error('name')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" class="form-control" id="slug" name='slug' 
                placeholder="slug" value="{{ $category->slug }}" readonly>

                @error('slug')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Change image</label>
                <input type="file" class="form-control-file mb-2" id="image" name='image'>

                <div class="rounded mx-auto d-block">
                    <img src="{{ asset('storage/'.$category->image) }}" style="width: 250px">
                </div>

                @error('image')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>


            <label for="">Status</label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Private</label>
                    <input class="form-check-input ml-2" type="radio" 
                    name='status' id="status" value="0"
                    {{ ($category->status == 0) ? 'checked' : '' }}>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Public</label>
                    <input class="form-check-input ml-2" type="radio" 
                    name='status' id="status" value="1"
                    {{ ($category->status == 1) ? 'checked' : '' }}>
                </div>

                @error('status')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>

            <label for="">Featured</label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">No</label>
                    <input class="form-check-input ml-2" type="radio" 
                    name='is_featured' id="is_featured" value="0"
                    {{ ($category->is_featured == 0) ? 'checked' : '' }}>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label">Yes</label>
                    <input class="form-check-input ml-2" type="radio" 
                    name='is_featured' id="is_featured" value="1"
                    {{ ($category->is_featured == 1) ? 'checked' : '' }}>
                </div>

                @error('is_featured')
                <span class="text-danger">
                    <span>*{{ $message }}</span>
                </span>
                @enderror
            </div>
            <input type="submit" value="Modify category" class="btn btn-primary">    
        </form>

    </div>
</div>
@endsection


@section('js')
 <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
            });
    </script>
@endsection

