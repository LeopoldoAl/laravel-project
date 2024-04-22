@extends('adminlte::page')

@section('title', 'Administration Panel')

@section('content_header')
<h1>Create New Role</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf 
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" name='name' placeholder="Role name"
                    value="{{ old('name') }}">

                @error('name')
                <span class="alert-red">
                    <span>*{{ $message }}</span>
                </span>
                @enderror

            </div>
            <h3>Permissions list</h3>
            @foreach($permissions as $permission)
            <div>
                <label>
                    <input type="checkbox" name="permissions[]" id="" value="{{ $permission->id }}" class="mr-1">
                    {{ $permission->description }}
                </label>
            </div>
            @endforeach
            <input type="submit" value="Create role" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection
