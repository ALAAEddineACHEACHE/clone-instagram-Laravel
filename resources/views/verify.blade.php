@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        <form action="{{ route('verify') }}" method="POST">
                            @csrf
                            <div class="form-group row-mb-3">
                                <label for="code" class="col-md-4">
                                    Your code :
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="code" class="form-control" placeholder="XXXXX" id="">
                                </div>
                            </div>
                            <div class="form-group row-mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Verify My account</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
