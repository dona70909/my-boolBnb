@extends('layouts.app')

@section('content')


<div class="container-fluid" id="dropin-container">
    <div class="row justify-content-center">
        {{-- dimensione del form --}}
        <form id="payment-form" class="col-6" action="{{route('payment')}}"  method='post'>
            @csrf
            @method('POST')
            <div class="form-group my-2">
                <h1 class="text-center">{{$apartment->title}}</h1>
                @foreach ($sponsorships as $sponsorship)
                    <div class="pacchettiSponsor m-3 d-flex">


                        <input class="mx-3" type="radio" id="spons" name="sponsorship" value="{{$sponsorship->id}}" required />
                        <div class="typeSponsor">
                            <span>Tipologia: {{$sponsorship->name}}</span>
                            <span>Prezzo: {{$sponsorship->price}} euro</span>
                            <span>Durata: {{$sponsorship->duration_time}} ore</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="">
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin">

                    </div>
                </div>
                <div>

                    <input id="apartment" name="apartment" value="{{$apartment->id}}" type="hidden" />
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                </div>
            </div>

            @php
                /*  use Carbon\Carbon;
                use App\Models\Sponsorship;

                $sponsorship->start_date = Carbon::now();
                $sponsorsArray = Sponsorship::all()->toArray();
                $key = array_search($sponsorship->sponsorship_id, array_column($sponsorsArray,'id'));

                $sponsorship->end_date = date('Y-m-d H:i:s', strtotime(Carbon::parse($sponsorship->start_date). ' + '. strval( $sponsorsArray[$key]['duration_time']) . 'hours')); */
            @endphp


            <div class="d-flex justify-content-between">
                <button  class="btn btn-outline-success me-2" type="submit">
                    Sponsorizza
                </button>
                <button type="button" class="btn btn-outline-info">
                    <a href="{{route('admin.apartments.index')}}" >Torna alla Dashboard</a>
                </button>
            </div>
        </form>
    </div>
</div>


@endsection

@section('script')
<script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
<script>
    // $todayDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";
    braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
    }, function (createErr, instance) {
        if (createErr) {
        console.log('Create Error', createErr);
        return;
        }
        form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
            if (err) {
            console.log('Request Payment Method Error', err);
            return;
            }
            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
        });
        });
    });
</script>
@endsection

@section('style')
    <link href="{{ asset('css/sponsors.css') }}" rel="stylesheet">
@endsection