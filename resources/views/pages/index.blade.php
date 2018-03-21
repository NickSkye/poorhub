@extends('layouts.layout')

@section('content')
    <div class="container-fluid all-centered">
        <div class="row text-center">
            <div class="col-sm-2 sidenav left">
                <h1>poorHUB</h1>
            </div>
            <div class="col-sm-8">


            </div>
            <div class="col-sm-2 sidenav right">
                <div class="location">
                    <p>Select Your State: </p>
                    <select name="country" id="country">
                        @foreach(CountryState::getStates('US') as $state)
                            <option value="{{$state}}">{{ $state }}</option>
                        @endforeach
                    </select>

                    <p id="demo">Or Click The Button To Select Your Current Location</p>

                    <button onclick="getLocation()">Select Current Location</button>
                    <img src="" id="mapholder">
                </div>
            </div>

        </div>
    </div>



@endsection