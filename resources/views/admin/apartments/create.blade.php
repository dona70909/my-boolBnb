@extends('layouts.app')

@section('title', '- Inserisci un nuovo appartamento')

@section('content')
    <section class="container-fluid my-cont" id="form-css">
        <div class="row  my-row">
            <!--NUOVO FORM-->
            <div class="form-container">
                <div class="section animated bounceInLeft cont-sm">
                    <div class="brandname">
                        <a class="my-text" data-text="BoolBNB" href="{{ url('/') }}">
                            BoolBNB
                        </a>
                    </div>
                    <div class="contact">
                        <h3 style="color: blue">Crea il tuo appartamento</h3>
                            <form action="{{route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data" class="d-flex flex-column flex-md-column">
                                @csrf
                                <div class=" d-flex flex-column justify-content-center align-content-center">
                                    <p class=" py-md-3">
                                        <label for="title" style="font-size: 0.85rem">Inserisci un titolo per il tuo appartamento*</label>
                                        <input type="text" name="title" style="height: 35px" name="title" value="{{ old('title') ? old('title') : '' }}"
                                        placeholder="Inserisci il titolo">
                                        @error('title')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                    <p class=" py-md-3">
                                        <label for="image" style="font-size: 0.85rem">Image * </label>
                                        <input type="file" class="form-control" class=" h-50" id="image"  name="image" required>
                                        @error('image')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                    <p class=" py-md-3">
                                        <label for="description" style="font-size: 0.85rem">Descrizione appartamento * </label>
                                        <textarea rows="4" cols="4"  type="text" name="description" class="form-control" id="description" placeholder="Inserisci la descrizione" required> {{ old('description') ? old('description') : '' }}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                    <p class=" py-md-3">
                                        <label class="form-check-label" for="squared_meters" style="font-size: 0.85rem;"> Specifica metri quadri * </label>
                                        <input type="text" id="squared_meters" style="height: 35px" name="squared_meters" value="{{ old('squared_meters') ? old('squared_meters') : '' }}" required placeholder="Specifica i metri quadrati">
                                        @error('squared_meters')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                    <p class=" py-md-3">
                                        <label class="form-check-label" for="address"> Indirizzo * </label>
                                        <input autocomplete="on" style="height: 35px" placeholder="Es. Via del corso" type="text" class=" h-50" id="address" name="address" value="{{ old('address') ? old('address') : '' }} " required>
                                        {{-- % lista suggerimenti   --}}
                                        <ul id="addressList" class="suggested-address" style="color: blue; background-color: aqua; cursor:pointer; padding: 0px 10px;"></ul>
                                    </p>
                                    <p class=" py-md-3">
                                        <label class="form-check-label" for="room_number"> Numero stanze * </label>
                                        <input type="text" id="room_number" style="height: 35px" name="room_number" placeholder="Numero stanze" value="{{ old('room_number') ? old('room_number') : '' }}" required>
                                        @error('room_number')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                    <p class=" py-md-3">
                                        <label class="form-check-label" for="bed_number"> Numero letti * </label>
                                        <input type="text" style="height: 35px" id="bed_number" name="bed_number" placeholder="Numero letti" value="{{ old('bed_number') ? old('bed_number') : '' }}" required>
                                        @error('bed_number')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                    <p class=" py-md-3">
                                        <label class="form-check-label" for="bath_number"> Numero bagni *  </label>
                                        <input type="text" style="height: 35px"  id="bath_number" name="bath_number" placeholder="Bathroom" value="{{ old('bath_number') ? old('bath_number') : '' }}" required>
                                        @error('bath_number')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                    <p class=" py-md-3 w-25">
                                        <label class="form-check-label" for="is_visible"> Visible * </label>
                                        <input type="checkbox" id="is_visible" name="is_visible" checked required>
                                        @error('is_visible')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                    <p class=" py-md-3">
                                        <label class="form-check-label" for="daily_price"> Prezzo giornaliero *</label>
                                        <input type="text" id="daily_price" style="height: 35px" name="daily_price" checked placeholder=" prezzo giornaliero €" value="{{ old('daily_price') ? old('daily_price') : '' }}" required>
                                        @error('daily_price')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>

                                </div>

                                <!--SERVIZI -->
                                <h6 style="color: blue;">Servizi * (Inserisci almeno un campo) </h6>
                                <div class=" d-flex flex-column justify-content-start margin-">
                                    <p>
                                        @foreach ($services as $service)
                                            <div class="d-flex justify-content-center align-items-center">
                                                <label for="service" class="my-3 w-100">{{$service->service_name}}</label>
                                                <input class="services" type="checkbox" id="service" name="services[]" value="{{$service->id}}">
                                            </div>
                                        @endforeach

                                        @error('services')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </p>
                                </div>
                                    <p class="full">
                                        <button style=" width: 100px">Submit</button>
                                    </p>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection



@section('script')
<script type="text/javascript" src="{{ URL::asset ('js/apartmentsCreate.js')}}" defer></script>
@endsection
