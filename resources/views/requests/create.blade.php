@extends('layouts.slim')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request a Stay</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="/spots/1/requests">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fullName">Full Name</label>
                                <input type="text" name="name" class="form-control" id="fullName" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="phone" name="phone" class="form-control" id="phoneNumber" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="emailAddress">Email Address</label>
                                <input type="email" name="email" class="form-control" id="emailAddress" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="emailConfirm">Confirm Email Address</label>
                                <input type="email" name="email_confirmation" class="form-control" id="emailConfirm" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="desiredDates">Desired Dates</label>
                                <input type="phone" name="dates" class="form-control" id="desiredDates" />
                            </div>
                        </div>

                        @csrf

                        <div class="text-right">
                            <a href="#" class="btn btn-mute">Cancel</a>
                            <button type="submit" class="btn btn-primary">Send My Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
