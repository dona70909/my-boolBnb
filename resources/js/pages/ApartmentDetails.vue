<template>
<div class="container-fluid px-5 ">
        
        <!-- //!! titolo address -->
        <div class="row mb-2 wrapper-title">
            <div class="col-12">
                <h4>{{apartment.title}}</h4>
                <p>{{apartment.address}}</p>
            </div>
        </div>


        <!-- //!! immagini-->
        <div class="row mb-4 row-wrapper-images">

            <!-- //# immagine left -->
            <div  class="col-6">
                <!-- <img class="big-img" v-if="apartment.image.startsWith('https://') || apartment.image.startsWith('http://')" :src="apartment.image" alt="image"/>
                <img  class="big-img" v-else :src="'../storage/' + apartment.image" alt="image" />  --> 
                <img class="big-img" :src="apartment.image" alt="image">  
            </div>

            <!-- //# images right -->
            <div class="d-flex flex-wrap col-6 p-0">
                <div class="d-flex  column-right w-100">
                    <img v-for="(image, index) in images" :key="index" v-show="index < 2" class="small-img" :src="image.img_url" alt="img"> 
                </div>

                <div class="d-flex column-left w-100">
                    <img v-for="(image, index) in images" :key="index" v-show="index < 4 && index >= 2" class="small-img" :src="image.img_url" alt="img"> 
                </div>
            </div>
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

        <!-- //!! MAP-->
        <div class="row mb-4">
              <!-- // !! map-->
            <div class="col-12 my-map">
                <div class='map' id="map"  ref="mapRef"></div>
            </div>
        </div>

        <!-- //! container form -->
        <div class="row justify-content-center">

             <!-- //# trigger form -->
            <div class="col-12 d-flex justify-content-start mb-5">
                <button type="button" data-toggle="modal" data-target="#form-contact" class="form-btn btn btn-small btn-primary  mb-3 d-flex align-items-center my-btn" @click="getDisplayNone()" @dblclick="getDisplayNone()">
                    <h6 class="text-center m-0 p-0 ">Contatta l'host</h6>
                </button>
            </div>

            <div class="col-6">                
                <!-- Modal -->
                <div class="modal fade" id="form-contact" tabindex="-1" role="dialog" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Contatta l'host</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <!-- alert message  -->
                                <div v-if="alert" class="alert-success alert-dismissable" v-text="alert">
                                </div>

                                 <!-- //#form -->
                                <form v-show="this.isNone == true"  @submit.prevent="sendMessage">
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
                                            <input type="text" class="form-control error" v-model="email" id="email"  placeholder="La tua email" required/>
                                        </div>

                                        <div class="form-group mx-2">
                                            <label for="message_content" class="col-form-label">Messaggio *</label>
                                            <textarea class="form-control error" v-model="message_content" id="message_content"  cols="30"  rows="4"  placeholder="Write your message" required></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary my-btn mx-2">Submit</button>
                                </form>
                            </div>
                        </div>
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
            
            response: "",
            //map: {},
            name:"",
            surname:"",
            email:"",
            message_content:"",

            isSent:false,

            isNone:false,

            images:[],
            alert: null
            
        };
    },

    created() {

        this.email = this.$userEmail;
        console.warn(this.$route.params.id)
        console.warn(this.apartment.image);
        this.getSingleApartment(this.$route.params.id);
        this.getImages(this.$route.params.id)

    },

    methods: {

        getSingleApartment(apartmentId) {
            axios.get(`http://localhost:8000/api/apartments/single/${apartmentId}`).then((result) => {
                
                this.apartment = result.data;
                

                console.log('sono qui');
                console.log(this.apartment.image)
                this.initializeMap(this.apartment.lat,this.apartment.lng);
    
            })
            .catch((error) => {
                console.warn(error);
            });
        },

        initializeMap(lat,lon) {

            //const tt = window.tt; 

            this.map = tt.map({
                key: "9mpouF1u6K6aGgZJ1Q2cybl2HR9dyJcy",
                container: this.$refs.mapRef,
                center: [lon, lat],
                zoom: 9,
                
            });

            console.warn(this.map);

            new tt.Marker().setLngLat([lon, lat]).addTo(this.map);


            this.map = Object.freeze(this.map);
        },

        emptyMap() {

              //const tt = window.tt; 

            this.map = tt.map({
                key: "9mpouF1u6K6aGgZJ1Q2cybl2HR9dyJcy",
                container: this.$refs.mapRef,
                center: [12.5674, 41.8719],
                zoom: 5,
                
            });

            //console.warn(this.map);

            new tt.Marker().setLngLat([lon, lat]).addTo(this.map);


            this.map = Object.freeze(this.map);


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
                
                this.alert = response.data.alert_sent;

                /* this.$router.push({

                    name: 'apartment-details',
                    params: { 
                        id: this.apartment.id 
                    }
                }); */
                
                
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
                //console.log(response.data.results);
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

    .row-wrapper-images {

            //height: 450px;
    
            /* //!! row images */
            .big-img {

                width: 100%;
                border-bottom-left-radius: 13px;
                border-top-left-radius: 13px;
                //height: 200px;
            }

            .column-left {

                gap: .5rem .5rem;
            }

            .column-right {

                gap: .5rem .5rem;

                
            }

            .small-img {

                width: 100%;
                object-fit: cover;
                border-radius: 13px;
                height: 190px;
            }


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

        background-color: white;
        border: 1px solid black;
        border-radius: 13px;
        padding: 2rem;
        box-shadow:1rem 1rem #003580;
    }

    
    .form-btn {

        h6 {

            font-size: 1rem;
            font-weight: 700;
        }
    }

    .my-btn {

        box-shadow: .5rem .5rem #febb02;
    }



</style>
