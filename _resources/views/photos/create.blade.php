@extends('layouts.slim')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload a Photo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="/photos" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="photoFile">Photo</label>
                                <input type="file" name="photo" class="form-control" id="photoFile" />
                            </div>
                        </div>

                        @csrf

                        <div class="text-right">
                            <a href="#" class="btn btn-mute">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save &amp; Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
