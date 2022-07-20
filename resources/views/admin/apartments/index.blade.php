@extends('layouts.app')

@section('title', '- Dashboard')

@section('content')

    {{-- !!! LINK SOPRA  --}}
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-12 wrapper-intro">
                @if (str_ends_with(Auth::user()['name'], 'a')) 
                    <h4> Benvenuta {{Auth::user()['name']}}</h4>
                @else
                    <h4> Benvenuto {{Auth::user()['name']}}</h4>
                @endif
                <p>
                    Rivedi i tuoi appartamenti 
                </p>
            </div>
        </div>
    </div>

    {{-- # Message to the index  --}}
    <section class="container-fluid">
        {{-- !!message success --}}
        <div class="row justify-content-center">
            @if (\Session::has('message'))
            <div class=" col-8 mt-5">
                <div class="alert alert-success alert-dismissable ">
                    <button type="button" class="btn text-success p-0" data-dismiss="alert" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                    {!! \Session::get('message') !!}
                </div>
            </div>
            @endif
        </div>
    </section>

    {{-- # Message DELETE --}}

    <section class="container-fluid" >
        {{-- !!message success --}}
        <div class="row justify-content-center">
            @if (\Session::has('status'))
            <div class="col-8 mt-5">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="btn text-danger" data-dismiss="alert" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                    {!! \Session::get('status') !!}
                </div>
            </div>
            @endif
        </div>
    </section>


    {{-- !! TABELLA --}}
    <section class="container-fluid">
        
        <table class="table table-hover " id="my-table">
            <thead class="text-center">
                <tr>
                    <th scope="row" >Id</th>
                    <th >Titolo</th>
                    <th >m^2</th>
                    <th >N. stanze</th>
                    <th >Indirizzo</th>
                    <th></th>
                    <th></th>
                    <th></th> 
                    <th></th> 
                </tr>
            </thead>

            <tbody>
                @foreach ($apartments as $key => $apartment)
                    <tr class="text-center">
                        <th scope="row">{{$apartment->id}}</th>
                        <td>{{$apartment->title}}</td>
                        <td>{{$apartment->squared_meters}}</td>
                        <td>{{$apartment->room_number}}</td>
                        <td>{{$apartment->address}}</td>

                        {{-- #trigger sponsor check for sponsorships after --}}
                        <td>
                            {{-- @dump($apartment->apartmentSponsorship) --}}
                            @php
                                $expired = array_filter($apartment->apartmentSponsorship->toArray(), function($item) {
                                    return $item['end_date'] > "2022-07-20";
                                })
                            @endphp

                            @if (count($expired) > 0)
                                
                                <p>
                                    Appartamento sponsorizzato
                                </p>
                            @else 
                                <button class="my-table-btn btn text-decoration-none">
                                    <a class="text-decoration-none ms-sponsorizza" href="{{ route('admin.sponsorize', $apartment->id) }}">
                                        Sponsorizza
                                    </a>
                                </button>
                            @endif
                        </td>

                        <td>
                            <button class="btn my-table-btn" type="button">
                                <a  href="{{route('admin.apartments.show',$apartment->id)}}">Detail</a>
                            </button>
                        </td>
                        <td>
                            <button class="btn my-table-btn" type="button">
                                <a href="{{ route("admin.apartments.edit", $apartment->id) }}">Edit</a>
                            </button>
                        </td>

                        {{-- !! DELETE trigger modal btn--}}
                        <td>
                            <button data-toggle="modal" data-target="#modal-delete-{{$apartment->id}}" type="button" class="btn btn-danger" >
                                <i class="fa-solid fa-trash-can p-1 py-2"></i>
                            </button>
                        </td>
                    </tr>


                    {{-- !! modal delete --}}
                    <div class="modal fade"  id="modal-delete-{{$apartment->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete2" aria-hidden="true" >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Sicuro di voler cancellare {{$apartment->title}}?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annulla</button>

                                    <form
                                        action="{{route('admin.apartments.destroy', $apartment)}}"
                                        method="post"
                                        class="delete-form"
                                        apartment-title="{{$apartment->title}}"
                                        >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Cancella
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
        
    </section>
@endsection

{{-- % script delet message  --}}
@section('script')
@endsection

@section('style')
    <link rel="stylesheet"  href="{{ asset('css/table.css') }}" >
@endsection
