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
                    <select name="country" id="country">
                        @foreach(CountryState::getStates('US') as $state)
                            <option value="{{$state}}">{{ $state }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>



@endsection