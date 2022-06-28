<template>

    <div class="container-fluid ">

        <!-- //!! row ricerca -->
        <div class="row mb-5 justify-content-center">
            <div class="col-8">

                <div class="container-input-search d-flex justify-content-center">

                    <input class="input-bar" type="text" v-model="search" id="search" name="search" placeholder="Dove vuoi andare?" @keyup="autocomplete" @keypress.enter="filteredSearch" required/>
                    <!--//# solo di prova -->
                    <button class="align-self-center" @click="filteredSearch">
                        <i class="bi bi-search"></i>
                    </button>

                </div>

                <ul class="wrapper-hints-address" v-for="(addressHint, index) in listAddress" :key="index" @click="completer(index)">
                    <li class="hint-item" >
                        {{ addressHint }}
                    </li>
                </ul>

            </div>
        </div>

        <!-- //!! row filtri -->
        <div class="row justify-content-center mb-3">
            <div class="col-9 d-flex">
                <!-- //# FILTRI SERVIZI checkboxes  -->
                <div class="d-flex px-2" v-for="(service, index) in services" :key="index">

                    <input type="checkbox" class="my-checkbox" :name="service.service_name" :id="service.id" :value="service.id" v-model="selectedServices"/>

                    <div class="label-service px-2 align-self-center">
                        <p class="text-capitalize label">{{ service.service_name }}</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- //!! FILTRI  default-->
        <div class="row justify-content-center mb-5">
            <div class="col-8 d-flex justify-content-between">

                <div class="single-input ">
                    <div class="label">Raggio</div>
                    <input type="number" id="distance" class="input-number" v-model="distance" />
                </div>
                <div class="single-input ">
                    <div class="label">Stanze</div>
                    <input type="number" id="rooms" class="input-number" v-model="rooms" />
                </div>
                <div class="single-input ">
                    <div class="label">Letti</div>
                    <input type="number" id="beds" class="input-number" v-model="beds" />
                </div>

            </div>
        </div>

        <!-- //!! Apartment -->
        <div class="row justify-content-center wrapper-apartments">
            <ApartmentSpons v-for="(apartment, index) in filtered" :key="index"  :apartment="apartment" />
            <Apartment v-for="(apartment, index) in filtered" :key="'ap'+index"  :apartment="apartment" />
        </div>

        <!-- //!! Div se la ricerca non ha results -->
        <div v-show="this.filtered.length == 0" class="row justify-content-center text-center">
            <div class="col-12">
                <h6 class="fs-1 fw-bolder text-uppercase">Ci dispiace ma la ricerca non ha prodotto risultati</h6>
            </div>
        </div>
        
    </div>
    

</template>

<script>

import Apartment from "../components/main/Apartment.vue";
import ApartmentSpons from "../components/main/ApartmentSpons.vue";

export default {

    name: "AdvancedSearch",

    components : {

        Apartment,
        ApartmentSpons
    },

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
            listAddress:[],
        };
    },

    props: ["query"],

    methods: {

        filteredSearch() {
            axios.get("/api/apartments/filteredsearch", {
                params: {
                    location: this.search,
                    rooms: this.rooms,
                    beds: this.beds,
                    distance: this.distance * 1000,
                    services: this.selectedServices,
                },
            })
            .then((response) => {
                //# condizione se result == true quindi sempre
                if (response.data.response.result === true) {

                    console.log("result ok");
                    this.goneWrong = null;
                    this.filtered = response.data.response.data;

                    if (response.data.response.data.length == 0) {
                        this.goneWrong = "Nessun Risultato";

                    } else {
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
    
    /* //# gap between cards  */
    .wrapper-apartments {

        gap: 5rem 1rem;
    }
</style>
