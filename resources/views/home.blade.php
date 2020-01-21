@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Spots</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($spots as $spot)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $spot->media[0]->getFullUrl() }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $spot->name }}</h5>
                                <h6 class="card-title">${{ $spot->price }}</h6>
                                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                            </div>
                            <!-- <ul class="list-group list-group-flush">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul> -->
                            <div class="card-body">
                                <a href="/spots/{{$spot->id}}" class="card-link">Edit</a>
                                <!-- <a href="#" class="card-link">Another link</a> -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
