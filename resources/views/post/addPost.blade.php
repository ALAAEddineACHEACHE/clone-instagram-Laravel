@extends('layouts.app')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('post.store') }}">
        @csrf
        <h1>Add a Post</h1>
        <div class="form-group row mb-3">
            <label for="avatar"><strong>Add Photo</strong></label>
            <input type="file" name="photo" id="photo" class="form-control custom-select">
            @error('photo')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror

        </div>
        <div class="form-group row mb-3">
            <label for="description"><strong>Add description</strong></label>
            <textarea name="description" id="" cols="5" rows="3" class="form-control "
                placeholder="describe the post that you want to add"></textarea>
        </div>
        <div class="form-group row mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer le
                poste</button>
        </div>
    </form>
@endsection
