@extends('adminlte::page')

@section('title', 'Administration panel')

@section('content_header')
    <h1>Modify Role</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" name='name'
                        placeholder="Name of the role" 
                        value="{{ $role->name }}" >

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
                    <input type="checkbox" name="permissions[]" id="" 
                    value="{{ $permission->id }}" 
                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} 
                    class="mr-1">
                   {{ $permission->description }}
                </label>
            </div>
            @endforeach
            <input type="submit" value="Modify role" class="btn btn-primary">
        </form>
    </div>
</div>

@endsection
