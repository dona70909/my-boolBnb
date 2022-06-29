@extends('layouts.app')

@section('title', '- Dashboard')

@section('content')

    {{-- !!! LINK SOPRA  --}}
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-12 text-center col-md-6 d-md-flex">
                <h4 class=" mb-0 mt-0">Benvenuto/a {{Auth::user()['name']}} !</h4>
            </div>
            <div class="col-12 col-md-6">
                <div class="d-flex justify-content-center mt-2 mt-md-0">
                    <div class="box m-0" style=" width: 300px">
                        <a class=" text-decoration-none d-flex justify-content-center fs-5 d-md-flex" href="{{route('admin.apartments.create')}}">
                            Crea un appartamento
                            <div id="icon"><i class="fas fa-arrow-right"></i></div>
                        </a>
                    </div>
                </div>
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
        
        <table class="table table-hover">
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
                            @if(count($apartment->apartmentSponsorship) === 0)
                                <button class="btn btn-outline-primary text-decoration-none">
                                    <a class="text-decoration-none ms-sponsorizza" href="{{ route('admin.sponsorize', $apartment->id) }}">
                                        Sponsorizza
                                    </a>
                                </button>
                            @else
                            {{-- !! modifica link --}}
                                <p>
                                    Appartamento sponsorizzato
                                </p>
                            @endif
                        </td>

                        <td>
                            <a type="button" class="btn btn-primary" href="{{route('admin.apartments.show',$apartment->id)}}">Detail</a>
                        </td>
                        <td>
                            <a href="{{ route("admin.apartments.edit", $apartment->id) }}" type="button" class="btn btn-secondary">Edit</a>
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
    <style>
        thead {

            background-color: blue;
            color:white;
        }
    </style>
@endsection
