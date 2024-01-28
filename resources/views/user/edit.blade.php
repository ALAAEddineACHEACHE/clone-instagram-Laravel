@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 shadow-sm py-4">
                <div class="card shadow-sm py-4">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>Update my profile</h5>
                        </div>
                        <form action="{{ route('profile.edit', $user->pseudo) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group row mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                                @error('name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group row mb-3">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" name="pseudo" id="pseudo"
                                    class="form-control @error('pseudo') is-invalid @enderror"
                                    value="{{ $user->pseudo }}">
                                @error('pseudo')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group row mb-3">
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" id="avatar"
                                    class="form-control custom-select @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group row mb-3">
                                <textarea name="biography" id="" cols="30" rows="5"
                                    class="form-control @error('biography') is-invalid @enderror"
                                    placeholder="decrivez vous">{{ $user->biography }}</textarea>
                                @error('biography')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group row mb-3">
                                <button type="submit" class="btn-lg btn-primary">Update profile</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
            {{-- Password --}}
            <div class="col-md"></div>
            <div class="col-md-5 shadow-sm py-4">
                <div class="card">
                    <div class="card-title">
                        <h5>Update password</h5>
                    </div>

                </div>
                <form method="POST" action="{{ route('password.update', $user->pseudo) }}">
                    @method('PUT')
                    @csrf
                    <label for="old_passowrd">
                        <h5>Old password</h5>
                    </label>
                    <div class="form-group row mb-3">
                        <input type="password" name="old_password" placeholder="******" id="old_password">
                    </div>
                    <div class="form-group row mb-3">
                        <label for="new_passowrd">
                            <h5>New password</h5>
                        </label>
                        <input type="password" name="new_password" placeholder="******" id="new_password">
                    </div>
                    <label for="confirm_passowrd">
                        <h5>Confirm password</h5>
                    </label>
                    <div class="form-group row mb-3">
                        <input type="password" name="confirm_password" placeholder="******" id="confirm_password">
                    </div>
                    <div class="form-group row mb-3">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
