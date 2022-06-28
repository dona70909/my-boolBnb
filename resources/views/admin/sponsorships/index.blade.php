@extends('layouts.app')

@section('title', 'Sponsorship')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>pannello sponsorships</h1>
            <ul>

                {{--  @dump($sponsorships) --}}
                {{-- @foreach ($sponsorships->apartmentSponsorship as $item)
                    <li>
                        {{$item}}
                    </li>
                @endforeach   --}}
            </ul>
        </div>
    </div>
@endsection