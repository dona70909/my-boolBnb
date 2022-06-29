<template>
<div>
    <div class="container-fluid px-5" >

        <!-- //!! titolo address -->
        <div class="row mb-2 wrapper-title">
            <div class="col-12">
                <h4>{{apartment.title}}</h4>
                <p>{{apartment.address}}</p>
            </div>
        </div>


        <!-- //!! immagini-->
        <div class="row mb-4">
            <!-- //!! immagine -->
            <div class="col-6">
                <!-- <img v-if="apartment.image.startsWith('https://') || apartment.image.startsWith('http://')" :src="apartment.image" alt="image"/>
                <img v-else :src="'../storage/' + apartment.image" alt="image" />  -->
                <img class="big-img" :src="apartment.image" alt="image">
            </div>
                <img v-for="(image, index) in images" :key="index" v-show="index < 4" class="col-3 small-img" :src="image.img_url" alt="img"> 
        </div>

        <!-- //!! Deatils -->
        <div class="row wrapper-description mb-5">
            <div class="col-12">
                <div class="details-description border-bottom-2 d-flex">
                    <h6 >Numero stanze {{apartment.room_number}}</h6>
                    <h6 >Numero posti letto {{apartment.bed_number}}</h6>
                    <h6 >Numero bagni {{apartment.bath_number}}</h6>
                    <h6 > Prezzo {{apartment.daily_price}}</h6>
                    <h6 > {{apartment.squared_meters }} mq </h6>
                </div>

                <p>
                    {{apartment.description}}
                </p>
            </div>
        </div>

        <!-- //!! MAPPA -->
        <div class="row mb-4">
              <!-- // !! mappa-->
            <div class="col-12 my-map">
                <div class='map' id="map" ref="mapRef" ></div>
            </div>
        </div>

        <!-- //! container form -->
        <div class="row justify-content-center">

             <!-- //# trigger form -->
            <div class="col-12 d-flex justify-content-start mb-5">
                <button class="form-btn btn btn-small btn-primary  rounded-pill mb-3 d-flex align-items-center" @click="getDisplayNone()" @dblclick="getDisplayNone()">
                    <h6 class="text-center m-0 p-0 ">Contatta l'host</h6>
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

            images:[],
            apartmentImages:[]
        };
    },

    mounted() {

        this.email = this.$userEmail;
        this.getSingleApartment(this.$route.params.id);
        this.getImages(this.$route.params.id)

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
        },

        /* `/images/apartment/${apartmentId}`
            !!migliorare get apartments's images
        */
        getImages(apartmentId) {

            axios.get("/api/images/apartment", {

                params: {
                    apartment_id: apartmentId,
                },

            }).then( response => {

                this.images = response.data.results;
                console.log(response.data.results);
                //this.getApartmentImages();
        
            })

            .catch((error) => {
                console.error(error);
            });

        },

       

    },
};
</script>


<style lang="scss" scoped>


    .wrapper-title {

        h4 {

            font-weight: 700;
            font-size: 3rem;
        }
    }

    .map {
        width: 100%;
        height: 300px;
        border-radius: 13px;
    }
    
    /* //!! row images */
    .big-img {

        width: 100%;
        border-bottom-left-radius: 13px;
        border-top-left-radius: 13px;
    }

    .small-img {

        width: 100%;
        object-fit: cover;
        //border-radius: 50px;
        height: 200px;
        padding: 1px;
        
    }

    //!! row description

    .wrapper-description {

        .details-description {

            h6 {

                font-weight: bold;
                margin: 0 1rem;
            }
        }
    }


    /* //!! form wrap */
    .form-wrap {

        background-color: red;
        border: 2px solid black;
        border-radius: 13px;
        padding: 4rem;
    }

    
    .form-btn {

        h6 {

            font-size: 1rem;
            font-weight: 700;
        }
    }

</style>
