@extends('layouts.app')

@section('title', '- Edita appartamento')

@section('content')
    <section class="container-fluid">
        <div class="row justify-content-center wrapper-form">
            <form action="{{route('admin.apartments.update',$apartment)}}" method="POST" enctype="multipart/form-data" class="col-12 d-flex flex-wrap">
                @csrf
                @method('PUT')

                <div class="form left col-6 mb-5">

                    <div class="box-title d-flex flex-column mb-4">
                        {{-- %title --}}
                        <label for="title">Inserisci un titolo per il tuo appartamento*</label>
                        <input class="border-none" type="text" name="title" name="title" value="{{$apartment->title}}"
                        placeholder="Inserisci il titolo">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="box-description d-flex flex-column mb-4">

                        {{-- % app description --}}
                        <label for="description">Descrizione appartamento * </label>
                        <textarea class="" rows="5" cols="4"  type="text" name="description" class="form-control" id="description" placeholder="Inserisci la descrizione" required>{{$apartment->description}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="box-services mb-4">
                        {{-- # servizi --}}
                        <h6 >Servizi * (Inserisci almeno un campo) </h6>
                        <div class="all-services-box d-flex justify-content-between">
                            @foreach ($services as $service)
                                <div class="d-flex flex-wrap align-items-center">
                                    <label class="badge bg-primary my-0 my-badge" for="service">{{$service->service_name}}</label>
                                    <input class="services mx-1" type="checkbox" id="service" name="services[]" value="{{$service->id}}">
                                </div>
                            @endforeach
                        </div>

                        @error('services')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="box-number-services">


                        <div class="box-quantity box-quantity-left d-flex justify-content-around">
                            {{-- # stanze  --}}
                            <div class="box-number-room ">
                                <div class="my-form-label" for="room_number"> Numero stanze * </div>
                                <input type="text" id="room_number"  name="room_number" placeholder="Numero stanze" value="{{$apartment->room_number}}" required>
                                @error('room_number')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- & mq --}}
                            <div class="box-mq">
                                <div class="my-form-label" for="squared_meters" > Specifica metri quadri * </div>
                                <input type="text" id="squared_meters" name="squared_meters" value="{{$apartment->squared_meters}}" required placeholder="Specifica i metri quadrati">
                                @error('squared_meters')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="box-quantity box-quantity-right d-flex justify-content-around">
                            <div class="box-number-beds">
                                {{-- # letti --}}
                                <div class="my-form-label" for="bed_number"> Numero letti * </div>
                                <input type="text" id="bed_number" name="bed_number" placeholder="Numero letti" value="{{$apartment->bed_number}}" required>
                                @error('bed_number')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        
                            <div  class="box-number-bathroom">
                                {{-- # bagni --}}
                                <div class="my-form-label" for="bath_number"> Numero bagni *  </div>
                                <input type="text"   id="bath_number" name="bath_number" placeholder="Bathroom" value="{{$apartment->bath_number}}" required>
                                @error('bath_number')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                            
                    </div>

                </div>


                <div class="col-6 form-right mb-5">
                    <div class="box-img mb-4">
                        {{-- %image --}}
                        <label for="image">Image * </label>
                        <input type="file" class="form-control"  id="image"  name="image"  required>
                        @error('image')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="box-images mb-5">
                        {{-- %images --}}
                        {{-- click here or drag here your images for preview and set userprofile_picture data --}}
                        <label for="singleImage">Inserisci altre immagini</label>
                        <input type="file" class="form-control" id="singleImage"  name="images[]" multiple >
                        
                        @error('image')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="box-addresses d-flex flex-column">
                        {{--  & address + hints --}}
                        <label class="form-check-label" for="address"> Indirizzo * </label>
                        <input autocomplete="on"  placeholder="Es. Via del corso" type="text" class=" h-50" id="address" name="address" value="{{$apartment->address}}" required>
                        {{-- % lista suggerimenti   --}}
                        <ul id="addressList" class="suggested-address">
                        </ul>
                    </div>

                    <div class="box-price d-flex flex-column mb-4">
                        {{-- # price --}}
                        <label class="form-check-label" for="daily_price"> Prezzo giornaliero *</label>
                        <input type="text" id="daily_price"  name="daily_price"  placeholder=" prezzo giornaliero €" value="{{ $apartment->daily_price }}" required>
                        @error('daily_price')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="box-visibility ">
                        {{-- && visibilità --}}
                        <label class="form-check-label" for="is_visible"> Visible * </label>
                        <input type="checkbox" id="is_visible" name="is_visible" required>
                        @error('is_visible')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            
                <div class="col-12 d-flex justify-content-end">
                    <button class="col-2 btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('style')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset ('js/apartmentsCreate.js')}}" defer></script>
@endsection
