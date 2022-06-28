<template>
<div>
    <div class="container-fluid p-0">
        <div class="row">
            <div id="jumbotron" class="col-12 p-0 d-flex justify-content-center align-content-center flex-wrap slider" >


                <!-- div input search -->
                <div class="input-search d-flex justify-content-center align-content-center flex-wrap position-relative">
                    <input type="text" v-model="search" id="search" name="search" placeholder="Dove vuoi andare?"
                        @keyup="autocomplete" @keypress.enter="filteredSearch" required/>
                    <div class="list-address-box">
                    <p class="hint-list" v-for="(addressHint, index) in listAddress" :key="index" @click="completer(index)">
                        {{ addressHint }}
                    </p>
                    </div>
                    <button class="align-self-center bt-search" @click="filteredSearch">
                        Cerca
                    </button>
                </div>
            </div>

            <div class="row">

                <!-- //!! FILTRI SERVIZI  -->
                <div class="my-box col-12 col-md-6 d-flex flex-column justify-content-center my-2 align-items-center">
                    <h4 class="text-uppercase">Seleziona uno o più servizi</h4>
                    <div class="d-flex col-12 col-md-4 d-flex mx-2 align-content-center ms-5" v-for="(service, index) in services" :key="index">
                        <label class="mb-1">
                            <input type="checkbox" class="my-checkbox" :name="service.service_name" :id="service.id" :value="service.id" v-model="selectedServices"/>
                            <span class="checkbox"></span>
                        </label>
                        <div class="label-service align-self-end">
                            <p class="mx-1 my-0 text-capitalize label">{{ service.service_name }}</p>
                        </div>
                    </div>
                </div>

                <!-- //% FILTRI  con il  -->
                <div class="my-box inputs col-12 col-md-6 d-flex flex-column justify-content-center my-2 align-items-center">
                    <div class="single-input mx-2">
                        <div class="label">Raggio</div>
                        <input type="number" id="distance" class="input-number" v-model="distance" />
                    </div>
                    <div class="single-input mx-2">
                        <div class="label">Stanze</div>
                        <input type="number" id="rooms" class="input-number" v-model="rooms" />
                    </div>
                    <div class="single-input mx-2">
                        <div class="label">Letti</div>
                        <input type="number" id="beds" class="input-number" v-model="beds" />
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <h6 v-if="this.filtered.length != 0" class="fs-1 fw-bolder text-capitalize m-3 text-center">La lista dei risultati</h6>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 p-0 mb-5 d-flex justify-content-center align-items-center p-4" v-for="(apartment, index) in filtered" :key="index">
                    <div class="my-card">
                        <ul class="ul">
                            <li v-for="(service, index) in apartment.services" :key="index">
                                <i v-if="service.service_name === 'piscina'" class="fa-solid fa-person-swimming"></i>
                                <i v-if="service.service_name === 'Wi-Fi'" class="fas fa-wifi"></i>
                                <i v-if="service.service_name === 'posto macchina'" class="fa-solid fa-square-parking"></i>
                                <i v-if="service.service_name === 'portineria'" class="fa-solid fa-bell-concierge"></i>
                                <i v-if="service.service_name === 'aria condizionata'" class="fa-solid fa-wind"></i>
                                <i v-if="service.service_name === 'vista mare'" class="fas fa-water"></i>
                                <i v-if="service.service_name === 'sauna'" class="fa-solid fa-hot-tub-person"></i>
                            </li>
                        </ul>
                        <img v-if="apartment.image.startsWith('https://') || apartment.image.startsWith('http://')" :src="apartment.image" alt="image"/>
                        <img v-else :src="'../storage/' + apartment.image" alt="image" />
                        <div class="con-text pb-5">
                            <h2>{{ apartment.title }}</h2>
                            <p>
                            {{ apartment.description }}
                                <button>
                                    <router-link class="text-decoration-none" :to="{ name: 'apartment-details', params: { id: apartment.id } }">
                                    Dettagli Appartamento
                                    </router-link>
                                </button>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- //# Div se la ricerca non ha results -->

                <div v-if="this.filtered.length == 0" class="text-center m-3 ms-text-end">
                    <h6 class="fs-1 fw-bolder text-capitalize">CI DISPIACE,NON CI SONO RISULTATI</h6>
                </div>
            </div>
        </div>
    </div>
    
</div>
</template>

<script>

export default {

    name: "AdvancedSearch",

    data() {
        return {
            filtered: [],
            search: "",
            rooms: 1,
            beds: 1,
            distance: 20,
            services: [],
            selectedServices: [],
            goneWrong: null,
            listService:[],
        };
    },
props: ["query"],
methods: {
    filteredSearch() {
        /* //!! ARRAY NULL PRESO CON IL V-MODEL ARGH */
        console.log(this.selectedServices);
        axios
        .get("/api/apartments/filteredsearch", {
            params: {
            location: this.search,
            rooms: this.rooms,
            beds: this.beds,
            distance: this.distance * 1000,
            services: this.selectedServices,
            },
        })
        .then((response) => {
            //console.warn(response.data.response.result);
            //console.log(this.services);
            //# condizione se result == true quindi sempre
            if (response.data.response.result === true) {
            console.log("result ok");
            this.goneWrong = null;
            this.filtered = response.data.response.data;
            if (response.data.response.data.length == 0) {
                console.log("SONO vuoto");
                this.goneWrong = "Nessun Risultato";
            } else {
                console.log("SONO UN ARRAY");
                this.goneWrong = response.data.response.data;
            }
            }
        });

    },
    getListServices(){
        this.apartment.services.forEach(element => {
            if(!this.listService.includes(element.service_name)){
            this.listService.push(element.service_name);
            }
        });
        return this.listService;
    },

    firstSearch() {
        if (this.query != null) {
        this.selectedServices = [];
        this.rooms = 1;
        this.beds = 1;
        this.distance = 20;
        this.search = this.query;
        this.filteredSearch();
        }
    },

    getServices() {
        axios.get("/api/services", {}).then((response) => {
        this.services = response.data.services;
        //console.log(response.data.services);
        });
    },

    /**
     * Funzione called by keyup event from the fourth key.
     * Insert all the addresses that match the  search inside an Array
     * through getAddress function
     */
    autocomplete() {
        if (this.search.length >= 4) {
        if (this.search.length % 2 == 0) {
            axios
            .get(
                `https://api.tomtom.com/search/2/search/${this.search}.json?countrySet=IT`,
                {
                params: {
                    key: "9mpouF1u6K6aGgZJ1Q2cybl2HR9dyJcy",
                    typeahead: true,
                    limit: 3,
                },
                }
            )
            .then((response) => {
                console.log("apiiiiiii");
                console.log(response.data.results);
                this.getAddresses(response.data.results);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
        }
    },

    getAddresses(array) {
        //# ottengo la length
        let lengthArray = array.length;
        //# reset array address
        this.listAddress = [];

        for (let i = 0; i < lengthArray; i++) {
        this.listAddress.push(
            array[i].address.municipality +
            " , " +
            array[i].address.countrySecondarySubdivision
        );
        }
    },

    /* // inserisci i suggerimenti nell'input prendendo l'index di ogni address */
    completer(index) {
        this.search = this.listAddress[index];
        this.getApartmentsFiltered();
    },
    },

    created() {
    this.firstSearch();
    },

    mounted() {
    this.getServices();
    },
};
</script>

<style lang="scss" scoped>

</style>
