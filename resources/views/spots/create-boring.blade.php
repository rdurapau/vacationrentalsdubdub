@extends('layouts.slim')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Submit Your Property</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="/spots">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="ownerName">Owner's Full Name</label>
                                <input type="text" name="owner_name" class="form-control" id="ownerName" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="propertyWebsite">Property Website</label>
                                <input type="url" name="website" class="form-control" id="propertyWebsite" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="addressStreet">Street Address</label>
                                <input type="text" name="address1" class="form-control" id="addressStreet" />
                            </div>

                            <div class="form-group col-md-3">
                                <label for="addressCity">City</label>
                                <input type="text" name="city" class="form-control" id="addressCity" />
                            </div>

                            <div class="form-group col-md-2">
                                <label for="addressState">State</label>
                                <input type="text" name="state" class="form-control" id="addressState" />
                            </div>

                            <div class="form-group col-md-2">
                                <label for="addressPostalCode">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" id="addressPostalCode" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="emailAddress">Email Address</label>
                                <input type="email" name="email" class="form-control" id="emailAddress" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="emailConfirm">Confirm Email Address</label>
                                <input type="email" name="email_confirm" class="form-control" id="emailConfirm" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="phone" name="phone" class="form-control" id="phoneNumber" />
                            </div>
                        </div>

                        <hr />

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Property Name</label>
                                <input type="text" name="name" class="form-control" id="name" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="price">Price per Night</label>
                                <input type="text" name="price" class="form-control" id="price" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc">Example textarea</label>
                            <textarea name="desc" class="form-control" id="desc" rows="3"></textarea>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="termsAgree">
                            <label class="form-check-label" for="termsAgree">I Have Read & Agree to the SweetSpot <a href="#">Terms of Service</a></label>
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
