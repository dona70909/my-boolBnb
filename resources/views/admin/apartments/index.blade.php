@extends('layouts.app')

@section('title', '- Dashboard')

@section('content')

    {{-- !!! LINK SOPRA  --}}
    <div class="container-fluid d-flex justify-content-center align-items-center my-cont">
        <div class="row">
            <div class="col-12 text-center col-md-6 d-md-flex">
                <h4 class=" mb-0 mt-0" style=" color:deepskyblue">Benvenuto/a {{Auth::user()['name']}} !</h4>
            </div>
            <div class="col-12 col-md-6">
                <div class="d-flex justify-content-center mt-2 mt-md-0">
                    <div class="box m-0" style=" width: 300px">
                        <a class=" text-decoration-none d-flex justify-content-center fs-5 d-md-flex" style="color:deepskyblue" href="{{route('admin.apartments.create')}}">Crea un appartamento
                            <div id="icon"><i class="fas fa-arrow-right"></i></div><span style="vertical-align: text-bottom;">+</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- # Message index --}}
    <div class="container-fluid">
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
    </div>

    {{-- # Message DELETE --}}

    <div class="container-fluid" >
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
    </div>


    {{-- !! TABELLA --}}
    <section class="container-fluid" id="container-index">
        <div class="row py-2 d-flex justify-content-center">
            {{-- # TABELLA  --}}
            <div class="col-12">
                    <table class="table my-table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 200px"><h4>Titolo Appartamento</h4></th>
                                <th scope="col"><h4>Immagine</h4></th>
                                <th scope="col"><h4>Metri quadrati</h4></th>
                                <th scope="col"><h4>Numero stanze</h4></th>
                                <th scope="col"><h4>Indirizzo</h4></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" style="color:deepskyblue">
                            @foreach ($apartments as $key => $apartment)
                                <tr>
                                    <td><h4>{{$apartment->title}}</h4></td>
                                    {{-- % upload con link  --}}
                                    @if(str_starts_with($apartment->image, 'https://') || str_starts_with($apartment->image, 'http://'))
                                        <td><img class="rounded my-img" src="{{ $apartment->image }}" alt="image of {{$apartment->title}}"></td>
                                    @else
                                        <td><img class="rounded my-img" src="{{ asset('/storage') . '/' . $apartment->image }}" alt="image of {{$apartment->title}}"></td>
                                    @endif
                                    <td><h4>{{$apartment->squared_meters}}</h4></td>
                                    <td><h4>{{$apartment->room_number}}</h4></td>
                                    <td><h4>{{$apartment->address}}</h4></td>

                                    {{-- #trigger sponsor check for sponsorships after --}}
                                    <td class="">
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
                                        <a type="button" class="btn btn-outline-success" href="{{route('admin.apartments.show',$apartment->id)}}">Detail</a>
                                    </td>
                                    <td>
                                        <a href="{{ route("admin.apartments.edit", $apartment->id) }}" type="button" class="btn btn-outline-warning">Edit</a>
                                    </td>

                                    {{-- !! DELETE trigger modal btn--}}
                                    <td>
                                        <button data-toggle="modal" data-target="#modal-delete-{{$apartment->id}}" type="button" class="btn btn-outline-danger" >
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
                </div>



                {{--  # CARD CHE ESCONO DA MOBILE VIA MEDIA QUERY --}}
                    @foreach ($apartments as $key => $apartment)
                        <div class="card my-card m-4 p-0" style="width: 18rem;">
                            @if(str_starts_with($apartment->image, 'https://') || str_starts_with($apartment->image, 'http://'))
                                <img class="rounded card-img-top" src="{{ $apartment->image }}" alt="image of {{$apartment->title}}">
                            @else
                                <img class="rounded card-img-top" src="{{ asset('/storage') . '/' . $apartment->image }}" alt="image of {{$apartment->title}}">
                            @endif
                            <div class="card-body">
                                <label for="title">Titolo Annuncio:</label>
                                <h5 class="card-title fs-6">{{$apartment->title}}</h5>
                                <label for="squared_meters">Metri quadrati:</label>
                                <p class="card-text">{{$apartment->squared_meters}}</p>
                                <label for="room_number">Numero stanze:</label>
                                <p class="card-text">{{$apartment->room_number}}</p>
                                <label for="address">Indirizzo:</label>
                                <p class="card-text m-1">{{$apartment->address}}</p>
                                <div class=" d-flex justify-content-center align-items-center">

                                    <a type="button" class="btn btn-outline-primary" href="{{ route('admin.sponsorize', $apartment->id) }}">
                                        Sponsor
                                    </a>

                                    <a type="button" class="btn btn-outline-success" href="{{route('admin.apartments.show',$apartment->id)}}">Detail</a>

                                    <a href="{{ route("admin.apartments.edit", $apartment->id) }}" type="button" class="btn btn-outline-warning">Edit</a>

                                    {{-- !!delete --}}
                                    <button data-toggle="modal" data-target="#modal-delete-{{$apartment->id}}" type="button" class="btn btn-outline-danger" >
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

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
                                                            cancella
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection

{{-- % script delet message  --}}
@section('script')
@endsection

@section('style')
    {{--  <link href="{{ asset('css/modal.css') }}" rel="stylesheet"> --}}
@endsection
