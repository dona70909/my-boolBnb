<template>
<div>
    <div class="container-fluid px-3 py4 mt-5">
        <!-- //!! titolo address -->
        <div class="row">
            <div class="col-12 my-bg">
                <h1>{{ apartment.title }}</h1>
            </div>
            <div class="col-12">
                <h2>{{ apartment.address }}</h2>
            </div>
        </div>
        <!-- //!! immagine e mappa -->
        <div class="row">
            <!-- //!! immagine -->
            <div class="col-12 col-md-6 my-img-bg">
                <!--  <img v-if="apartment.image.startsWith('https://') || apartment.image.startsWith('http://')" :src="apartment.image" alt="image"/>
                <img v-else :src="'../storage/' + apartment.image" alt="image" /> -->
                <img :src="apartment.image" :alt="apartment.title" />
            </div>
            <!-- // !! mappa-->
            <div class="col-12 col-md-6 mt-5 mt-md-1 my-map">
                <div class="map" id="map" ref="mapRef"></div>
            </div>
        </div>
        <!-- //!! FORM -->
        <div class="row mt-5 mb-5">
            <div class="col-12 col-md-10">
                <h1>Descrizione dell'appartmento:</h1>
                <p class="fs-4">
                {{ apartment.description }}
                </p>
            </div>
            <!-- //# container form -->
            <div class="row my-3">
                <div class="container">
                    <div class="row align-items-stretch no-gutters contact-wrap">
                        <div class="col">
                            <div class="form h-100">
                                <!-- //# title form -->
                                <h3>Invia un messaggio</h3>
                                <!-- //#form -->
                                <form  @submit.prevent="sendMessage" class="mb-5">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-5">
                                            <label for="" class="col-form-label">Nome</label>
                                            <input type="text"  class="form-control error"  v-model="name" id="name" placeholder="Nome"   />
                                        </div>
                                        <div class="col-md-6 form-group mb-5">
                                            <label for="" class="col-form-label">Cognome </label>
                                            <input type="text"  class="form-control error"   v-model="surname"  id="surname"  placeholder="Cognome"  />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-5">
                                            <label for="" class="col-form-label">Email *</label>
                                            <input type="text" class="form-control error" v-model="email" id="email"  placeholder="la tua email" required/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group mb-5">
                                            <label for="message_content" class="col-form-label">Messaggio *</label>
                                            <textarea class="form-control error" v-model="message_content" id="message_content"  cols="30"  rows="4"  placeholder="Write your message" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <!-- //# message sent  -->
                                <div id="form-message-warning mt-2"></div>
                                <div id="form-message-success" v-if="this.isSent === true">
                                    Il tuo messaggio è stato inviato correttamente,grazie!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <NavMobile />
</div>
</template>
<script>
import tt from "@tomtom-international/web-sdk-maps";
import NavMobile from "../components/NavMobile.vue";
export default {
    name: "ApartmentDetails",
    components: {
        NavMobile,
    },
    data: function () {
        return {
            apartment: [],
            map: null,
            name:"",
            surname:"",
            email:"",
            message_content:"",
            isSent:false,
        };
    },
    mounted() {
        this.email = this.$userEmail;
        console.warn(this.$route.params.id);
        this.getSingleApartment(this.$route.params.id);
    },
    methods: {
        getSingleApartment(apartmentId) {
            axios
            .get(`http://localhost:8000/api/apartments/single/${apartmentId}`)
            .then((result) => {
                console.log(result.data);
                this.apartment = result.data;
                console.log(this.apartment.lat);
                console.log(this.apartment.lng);
                this.initializeMap(this.apartment.lat,this.apartment.lng);
                console.log('mappa');
                console.log(this.initializeMap(this.apartment.lat,this.apartment.lng));
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
            });
            new tt.Marker()
            .setLngLat([lon, lat])
            .addTo(map);
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
    },
};
</script>
<style lang="scss" scoped>
img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.my-img-bg,.my-map{
    height: 600px;
    border-radius: 20px;
}
img, .map{
    border-radius: 20px;
}
.map{
    height: 100%;
    width: 100%;
}
@media screen and(max-width: 991px) {
    .my-img-bg,.my-map{
    height: 400px;
}
}
h1{
    color:#3F5EFB ;
}
.content {
  padding: 7rem 0;
}
.container {
  max-width: 960px;
}
.contact-wrap {
  -webkit-box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
}
.contact-wrap .form {
  background: #fff;
}
.contact-wrap .form{
  padding: 40px;
}
.btn-primary{
    border-radius: 10px;
}
</style>
