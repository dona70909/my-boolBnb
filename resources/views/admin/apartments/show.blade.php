@extends('layouts.app')

@section('title', '- Dettagli appartamento')

@section('content')

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

    {{-- # contenuto show --}}
    <div class="container-fluid my-cont px-md-5" id="show-apartment">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="mb-3 me-5"><label style="color:deepskyblue">Titolo Annuncio: </label> <br> {{$apartment->title}}</h3>
            </div>
            <div class="col-12">
                <h3 class=" me-5"><label style="color:deepskyblue">Indirizzo dell'appartamento:</label> <br> {{$apartment->address}}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-5 col-lg-5">
                @if(str_starts_with($apartment->image, 'https://') || str_starts_with($apartment->image, 'http://'))
                    <img class="w-100" src="{{ $apartment->image }}" alt="image of {{$apartment->title}}">
                @else
                    <img  class=" w-100" src="{{ asset('/storage') . '/' . $apartment->image }}" alt="image of {{$apartment->title}}">
                @endif
            </div>
            <div class="col-12 col-md-7 col-lg-7 mt-4 mt-sm-4 mt-md-0">
                <h1 style="color:deepskyblue">Descrizione Dell'appartamento:</h1>
                <p class=" fs-4">{{$apartment->description}}</p>
            </div>
        </div>
        <div class="container-fluid px-2 text-md-center mt-5" style="padding: 50px 0px; background-color:rgb(214, 231, 236); box-shadow: 5px 5px 15px 5px rgba(78,78,78,0.53)"">
            <div class="row py-2 d-lg-flex justify-content-center align-item-start">
                <div class="col-12 py-2 text-center text-sm-center col-md-12 col-lg-2">
                    <label class="color"><h3>Servizi Appartamento:</h3></label>
                    @foreach ($apartment->services as $service)
                        <h5>{{$service->service_name}}</h5>
                    @endforeach
                </div>
                <div class="col-12 py-2 text-center text-sm-center col-md-12 col-lg-2">
                    <label class="color"><h3>Metri quadrati:</h3></label>
                    <h5>{{$apartment->squared_meters}}</h5>
                </div>
                <div class="col-12 py-2 text-center text-sm-center col-md-12 col-lg-2">
                    <label class="color"><h3>Numero stanze:</h3></label>
                    <h5>{{$apartment->room_number}}</h5>
                </div>
                <div class="col-12 py-2 text-center text-sm-center col-md-12 col-lg-2">
                    <label class="color"><h3>Posti letto:</h3></label>
                    <h5>{{$apartment->bed_number}}</h5>
                </div>
                <div class="col-12 py-2 text-center text-sm-center col-md-12 col-lg-2">
                    <label class="color"><h3>Numero bagni:</h3></label>
                    <h5>{{$apartment->bath_number}}</h5>
                </div>
                <div class="col-12 py-2 text-center text-sm-center col-md-12 col-lg-2">
                    <label class="color"><h3>Prezzo giornaliero:</h3></label>
                    <h5>{{$apartment->daily_price}} €</h5>
                </div>
            </div>
            <!--CONTROLLO VISIBILITA' APPARTAMENTO -->
            <div class="container-fluid">
                <div class="row py-2"  style="background-color:rgb(214, 231, 236);">
                    <div class="col-12 text-center text-sm-center d-md-flex justify-content-center align-items-center">
                        <label style="color:deepskyblue"><h3 class="me-4">L'appartamento è attualmente:</h3></label>
                        @if ($apartment->is_visible == true)
                            <h5>Visibile</h5>
                        @else
                            <h5>Non visibile</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--SEZIONE INFERIORE MESSAGGI UTENTI -->
        @if (count($messages) > 0)
        <h4 class="mt-5"><h4 style="color: red; display: inline">Messaggi non letti: </h4>{{count($messages)}}</h4>
                @forEach($messages as $message)
                    <div class="fluid-container mt-4" id="scoped-comments">

                        <div class="row  d-flex justify-content-center">

                            <div class="col-md-8">

                                <div class="headings d-flex justify-content-between align-items-center mb-3">
                                    <h5></h5>

                                    <div class="buttons">
                                        <span class="badge bg-white d-flex flex-row align-items-center">
                                            <span class="text-primary">Comment "ON"</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                            </div>
                                        </span>
                                    </div>

                                </div>

                                <div class="card p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="user d-flex flex-row align-items-center me-5">
                                            <span><h5 class="font-weight-bold text-primary me-1">{{$message->name}}:</h5> <small class="font-weight-bold fs-6">{{$message->message_content}}</small></span>
                                        </div>
                                        <small>Inviato il {{date_format($message->created_at, 'd-m-Y H:i:s')}}</small>
                                    </div>

                                    <div class="action d-flex justify-content-between mt-2 align-items-center">

                                        <div class="reply px-4">
                                            <small>Remove</small>
                                            <span class="dots"></span>
                                            <small>Reply</small>
                                            <span class="dots"></span>
                                            <small>Translate</small>
                                        </div>

                                        <div class="icons align-items-center">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-check-circle-o check-icon"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h4 class="mt-4">L'appartamento selezionato, non ha ricevuto alcun messaggio.</h4>
        @endif
    </div>
@endsection

@section('script')
<script>
    console.log('ci sono');

    const deleteForms = document.querySelectorAll('.delete-form');
    console.log( document.querySelectorAll('.delete-form'));

    deleteForms.forEach(singleForm => {
        singleForm.addEventListener('submit', function (event) {
            event.preventDefault(); // § blocchiamo l'invio del form
            userConfirmation = window.confirm(`Sei sicuro di voler eliminare ${this.getAttribute('apartment-title')}?`);
            if (userConfirmation) {
                this.submit();
            }
        })
    });
</script>
@endsection

