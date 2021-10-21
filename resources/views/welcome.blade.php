@extends('layouts.app')
@section('content')
    <div class="container" style="max-width: 900px">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    @foreach ($posts as $post)
                        <div class="card-body">
                            <div class="card-title">
                                <div class="d-flex">
                                    <img src="{{ $user->avatar }}" class="rounded-circle w-25" alt=""
                                        style="max-width: 40px">
                                    <div class="h5 ms-2">{{ $user->pseudo }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="image">
                            <img src="{{ asset('images/photoprofile.jpg') }}" alt="" class="w-100">
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="like me-3">
                                    <ion-icon name="heart-outline" style="font-size: 30px"></ion-icon>
                                </div>
                                <div class="like me-3">
                                    <ion-icon name="chatbubble-outline" style="font-size: 30px"></ion-icon>
                                    </ion-icon>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex">
                                <img src="{{ $post->user->avatar }}" class="rounded-circle w-25" alt=""
                                    style="max-width: 40px">
                                <div class="h5 ms-2">{{ $post->user->pseudo }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="image">
                        <img src="{{ asset('images/photoprofile.jpg') }}" alt="" class="w-100">
                    </div>

                    <div class="card-body">
                        <div class="d-flex">
                            <div class="like me-3">
                                <ion-icon name="heart-outline" onclick="like(this)" value="{{ $post->id }}"
                                    style="font-size: 30px"></ion-icon>
                                {{ count($post->likes) }}
                            </div>
                            <div class="like me-3">
                                <ion-icon name="chatbubble-outline" style="font-size: 30px"></ion-icon>
                                </ion-icon>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <div class="info ms-3">
                    <div class="d-flex">
                        <img src="{{ $user->avatar }}" class="rounded-circle w-25" style="max-width: 60px" alt="">
                        <div class="ms-4">
                            <h6>{{ $user->name }}</h6>
                            <a href="{{ route('home', $user->pseudo) }}" class="ms-5">Mon profil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script>
        function like(el) {
            console.log(el);
            let id = console.log(el.getAttribute('value'));
            $.post('{{ route('like.store') }}', {
                _token: '{{ csrf_token() }}',
                post_id: id
            }, function($data) {
                console.log(data);
            })
        }
    </script>
@endsection

@endsection
