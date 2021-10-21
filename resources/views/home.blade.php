@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="img-profile text-center">
                    <img style="height: 200px;" class="rounded-circle" src="{{ $user->avatar }}" alt="">
                </div>

            </div>
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <strong>
                        {{ $user->name }}</strong>
                    <button type="button" class="btn-sm btn-primary " style="margin-left: 20px;">S'abonner</button>
                    <div class="justify-content">
                        <a href="{{ route('profile.edit', $user->pseudo) }}"><button type="button"
                                class="btn-sm btn-primary" style="margin-left: 20px;">Edit</button></a>

                    </div>
                </div>
                <div class="d-flex mt-3">
                    <div class="me-3"> <strong> {{ count($user->posts) }} </strong> publications
                        {{ count($user->posts) > 1 ? 's' : '' }}</div>
                    <div class="me-3"><strong> 3368</strong> abonnées</strong></div>
                    <div class="me-3"><strong>104</strong> abonnements</div>

                </div>
                <strong>{{ $user->pseudo }}</strong>
                <br>
                Founder of Laravel,Space piligrim {{ $user->biography }}
                <br>

                <br>

            </div>
            <hr style="margin:10px;">
        </div>
        <div class="container">
            <img style="height:400px;" src="{{ asset('images/photoprofile.jpg') }}" alt="">
            <img style="height:400px;" src="{{ asset('images/photoprofile.jpg') }}" alt="">
            <img style="height:400px;" src="{{ asset('images/photoprofile.jpg') }}" alt="">
            <img style="height:400px;" src="{{ asset('images/photoprofile.jpg') }}" alt="">
            <img style="height:400px;" src="{{ asset('images/photoprofile.jpg') }}" alt="">
            <img style="height:400px;" src="{{ asset('images/photoprofile.jpg') }}" alt="">
            <img style="height:400px;" src="{{ asset('images/photoprofile.jpg') }}" alt="">
            <img style="height:400px;" src="{{ asset('images/photoprofile.jpg') }}" alt="">
            {{-- @foreach ($posts as $post) --}}
            <img style="height:400px;" src="" alt="">
            {{-- @endforeach --}}


        </div>












    </div>
@endsection
