@extends('adminlte::page')

@section('title', 'Administration panel')

@section('content_header')
<h2>Administration of categories</h2>
@endsection

@section('content')

@if(session('success-create'))
    <div class="alert alert-info">
        {{ session('success-create') }}
    </div>
@elseif(session('success-update'))
    <div class="alert alert-info">
        {{ session('success-update') }}
    </div>
@elseif(session('success-delete'))
    <div class="alert alert-info">
        {{ session('success-delete') }}
    </div>
@endif

<div class="card">
    @can('categories.create')
    <div class="card-header">
        <a class="btn btn-primary" href="{{ route('categories.create') }}">Create categories</a>
    </div>
    @endcan
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Featured</th>
                </tr>
            </thead>

            <tbody>
            @foreach($categories as $category)     
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <input type="checkbox" name="status" id="status" 
                        class="form-check-input ml-3"
                        {{ $category->status ? 'checked="checked"' : ''  }}
                        disabled>
                    </td>
                    <td>
                        <input type="checkbox" name="is_featured" id="is_featured" 
                        class="form-check-input ml-4"
                        {{ $category->is_featured ? 'checked="checked"' : ''  }}
                        disabled>
                    </td>

                    @can('categories.edit')
                    <td width="10px"><a href="{{ route('categories.edit', $category->slug) }}"
                            class="btn btn-primary btn-sm mb-2">Edit</a></td>
                   @endcan
                   
                   @can('categories.destroy')
                    <td width="10px">
                        <form action="{{ route('categories.destroy', $category->slug) }}" method="POST">
                            @csrf 
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="text-center mt-3">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection