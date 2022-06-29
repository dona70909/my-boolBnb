<template>
<div>
    <div class="container-fluid px-5" >

        <!-- //!! titolo address -->
        <div class="row mb-2">
            <div class="col-12">
                <h4>{{apartment.title}}</h4>
                <p>{{apartment.address}}</p>
            </div>
        </div>


        <!-- //!! immagine-->
        <div class="row mb-4">
            <!-- //!! immagine -->
            <div class="col-4">
                <!-- <img v-if="apartment.image.startsWith('https://') || apartment.image.startsWith('http://')" :src="apartment.image" alt="image"/>
                <img v-else :src="'../storage/' + apartment.image" alt="image" />  -->
                <img :src="apartment.image" alt="image">
            </div>
            <div class="col-8">
                <div class="col-2">img</div>
                <div class="col-2">img</div>
                <div class="col-2">img</div>
                <div class="col-2">img</div>
            </div>
        </div>

        <!-- //!! Deatils -->
        <div class="row wrapper-description mb-3">
            <div class="col-6">
                <div class="details-description border-bottom-2 d-flex justify-content-around">
                    <h6 >Numero stanze {{apartment.room_number}}</h6>
                    <h6 >Numero posti letto {{apartment.bed_number}}</h6>
                    <h6 >Numero bagni {{apartment.bath_number}}</h6>
                    <h6 > Prezzo {{apartment.price}}</h6>
                </div>

                <p>
                    {{apartment.description}}
                </p>
            </div>
        </div>

        <!-- //!! MAPPA -->
        <div class="row mb-4">
              <!-- // !! mappa-->
            <div class="col-5 my-map">
                <div class='map' id="map" ref="mapRef" ></div>
            </div>
        </div>

        <!-- //! container form -->
        <div class="row justify-content-center">

             <!-- //# trigger form -->
            <div class="col-12 d-flex justify-content-start ">
                <button class="btn btn-small btn-primary  rounded-pill mb-3 " @click="getDisplayNone()" @dblclick="getDisplayNone()">
                    <h6 class="text-center">Contatta l'host</h6>
                </button>
            </div>

            <div class="col-5">
                <!-- //#form -->
                <form v-show="this.isNone == true"  @submit.prevent="sendMessage" class="form-wrap">

                    <div class="container-form-group-name d-flex justify-content-between">
                        <div class="form-group mx-2">
                            <label for="name" class="col-form-label">Nome</label>
                            <input type="text"  class="form-control error"  v-model="name" id="name" placeholder="Nome"   />
                        </div>
                        
                        <div class="form-group mx-2">
                            <label for="surname" class="col-form-label">Cognome </label>
                            <input type="text"  class="form-control error"   v-model="surname"  id="surname"  placeholder="Cognome"  />
                        </div>
                    </div>

                    <div class="form-group mx-2">
                        <label for="email" class="col-form-label">Email *</label>
                        <input type="text" class="form-control error" v-model="email" id="email"  placeholder="la tua email" required/>
                    </div>

                    <div class="form-group mx-2">
                        <label for="message_content" class="col-form-label">Messaggio *</label>
                        <textarea class="form-control error" v-model="message_content" id="message_content"  cols="30"  rows="4"  placeholder="Write your message" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mx-2">Submit</button>
                </form>

                <!-- //# message sent  -->
                <div id="form-message-success" v-if="this.isSent === true">
                    Il tuo messaggio è stato inviato correttamente,grazie!
                </div>
                
            </div>
        </div>
    
    </div>
    
</div>
</template>


<script>
import tt from '@tomtom-international/web-sdk-maps';

export default {


    name: "ApartmentDetails",

    data: function () {
        return {
            apartment: [],
            map: null,
            name:"",
            surname:"",
            email:"",
            message_content:"",
            isSent:false,

            isNone:false,
        };
    },

    mounted() {
        this.email = this.$userEmail;
        console.warn(this.$route.params.id);
        this.getSingleApartment(this.$route.params.id);
        //this.initializeMap();

    },

    methods: {

        getSingleApartment(apartmentId) {
            axios.get(`http://localhost:8000/api/apartments/single/${apartmentId}`).then((result) => {
                
                this.apartment = result.data;
                
                this.initializeMap(this.apartment.lat,this.apartment.lng);

                //console.log(this.initializeMap(this.apartment.lat,this.apartment.lng));
            })
            .catch((error) => {
                console.warn(error);
            });
        },

        initializeMap(lat,lon) {

            const map = tt.map({
                key: "9mpouF1u6K6aGgZJ1Q2cybl2HR9dyJcy",
                container: this.$refs.mapRef,
                center: [lon, lat],
                zoom: 9,
                //style: 'tomtom://vector/1/basic-main',
            });

            new tt.Marker().setLngLat([lon, lat]).addTo(map);


            this.map = Object.freeze(map);
        },
        
        sendMessage() {
            axios.post('/api/message', {
            'name':this.name,
            'surname':this.surname,
            'email':this.email,
            'message_content':this.message_content,
            'apartment_id':this.apartment.id,
            })
            .then((response) => {
            if(!response.data.success) {
                //#check invio
                this.errors = response.data.errors;
            } else {
                //# svuoto i campi dopo l'invio
                this.isSent= true,
                this.name = "",
                this.surname = "",
                this.email = '';
                this.message_content = '';
            }
            })
        },


        getDisplayNone() {

            if(this.isNone == false) {

                this.isNone = true;

            } else {

                this.isNone = false;
            } 
        }
    },
};
</script>


<style lang="scss" scoped>

    #marker {

        background-image: url('https://i.picsum.photos/id/799/200/300.jpg?hmac=q6DulPHgFwTpoeoXzeVRLJ7-2cd-K69VyeJoIpUM5eg');

        background-size: cover;

        width: 50px;

        height: 70px;

    }

    .map {

        height: 300px;
        border-radius: 13px;
    }
    
    /* //!! row images */
    img {

        width: 100%;
        border-bottom-left-radius: 13px;
        border-top-left-radius: 13px;
    }

    .wrapper-description {

        .details-description {

            h6 {

                font-weight: bold;
            }
        }
    }

    .form-wrap {

        background-color: red;
        border: 2px solid black;
        border-radius: 13px;
        padding: 4rem;
    }
</style>
