@extends('layouts.app')

@section('title', '- Dettagli appartamento')

@section('content')
    <section class="container-fluid my-messages-section">

        <div class="row wrapper-intro mb-4">
            <div class="col-12">
                <h4 class="title">{{$apartment->title}}</h4>
                <h4 class="address">{{$apartment->address}}</h4>
            </div>
        </div>

        <div class="row justify-content-center messages-wrapper">
            <ul class="col-3 list-unstyled list-messages">
                @forEach($messages as $key => $msg )
                    <li class="message-item p-2">
                        <h6 class="email-item">{{$msg->email}}</h6>
                        <p class="created-at-item">{{$msg->created_at}}</p>
                    </li>
                @endforeach
            </ul>

            @if (count($messages) > 0)
                <div class="col-8 box-messages">
                    @forEach($messages as $key => $msg )
                        <div class="box-message p-4 mb-2">
                            <h6 class="email">From {{$msg->email}}</h6>
                            <h6 class="name">{{$msg->name}} {{$msg->surname}}</h6>
                            <p class="msg-content">{{$msg->message_content}}</p>
                            <p class="box-msg-date">{{$msg->created_at}}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-8">
                    <h2 class="empty-message">Non ci sono messaggi da mostrare</h2>
                </div>
            @endif
            
        </div>
    </section>
@endsection

@section('script')
<script>

    console.log('ci sono');

    const deleteForms = document.querySelectorAll('.delete-form');
    

    deleteForms.forEach(singleForm => {
        singleForm.addEventListener('submit', function (event) {
            event.preventDefault(); // § blocchiamo l'invio del form
            userConfirmation = window.confirm(`Sei sicuro di voler eliminare ${this.getAttribute('apartment-title')}?`);
            if (userConfirmation) {
                this.submit();
            }
        })
    });

    let messagesList = document.querySelectorAll('.message-item');
    let boxMessages = document.querySelector('.box-message');

    console.log(boxMessages);

    let activeClick = null;
    let activBox = null;
    console.log(messagesList);

    

    messagesList.forEach( (message, index) => {
        
        message.addEventListener('click', function() {

            console.log('click');
            this.activeClick = index;
            console.log(this.activeClick);

            boxMessages.innerHtml = `
                <h6>viao</h6>
                <p>cokoas</p>
                <p>sapkm</p>
            `

        })
    });

    /*  boxMessages.forEach((boxMsg, index) => {

        boxMsg.addEventListener('click', function() {

            console.log('click');
            this.activeBox = index;
            console.log(this.activeBox);
        }) 
        
    }) */

</script>
@endsection

@section('style')
    <link rel="stylesheet"  href="{{ asset('css/messages.css') }}" >
@endsection

