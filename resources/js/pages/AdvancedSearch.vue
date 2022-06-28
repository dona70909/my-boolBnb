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
*{
    //font-family: "Dank Mono", ui-monospace, monospace;
}
.container-fluid{
    //background: linear-gradient(45deg, #96b0bb, #3F5EFB);
}

#jumbotron {
    width: 100%;
    height: 500px;
    background: url("https://www.azamara.com/sites/default/files/heros/cagliari-sardinia-italy-1800x1000.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    #search {
        border-radius: 50px;
        width: 300px;
        height: 40px;
        border: 1px solid lightgrey;
        margin: 7px;
        padding: 20px;
    }
}

//slider jumbotron

.slider {
    position: absolute;
    background: url("https://www.azamara.com/sites/default/files/heros/cagliari-sardinia-italy-1800x1000.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    overflow: hidden;
    height: 100%;
    width: 100%;
}

.slide,
.slide img {
  position: absolute;
  top: 0;
  left: 0%;
  height: 100%;
  width: 100%;
}

.slide {
    transform: translateX(100%);
 -webkit-animation: slide 25s infinite linear;
}
.slide:nth-child(2) {
  -webkit-animation-delay: 5s;
}
.slide:nth-child(3) {
  -webkit-animation-delay: 10s;
}
.slide:nth-child(4) {
  -webkit-animation-delay: 15s;
}
@-webkit-keyframes slide {
  5% {
    transform: translateX(0); /* 1s 6s 11s 16s */
  }
  25% {
    transform: translateX(0); /* 5s 10s 14s 19s */
  }
  40% {
    transform: translateX(-100%); /* 6s 11s 16s 20s */
  }
  100% {
    transform: translateX(-100%);
  }
}

//input search

.input-search {
    z-index: 2;
    display: flex;
}

button {
    border-radius: 50px;
    padding: 0.4rem 1.2rem;
    border: none;
    background-color: #24c747;
    &:hover{
        background-color: #3F5EFB;
        transition: 1s;
    }
}
.input-search {
    position: relative;

    .list-address-box {
        width: 75%;
        position: absolute;
        top: 48px;
        background-color: #03a9f4;
        border-radius: 20px;
        left: 10px;
    }
}

.hint-list {
    margin: 0;
    padding: 1rem;

    &:hover {
        background-color: #fff;
        border-radius: 20px;
        cursor: pointer;
    }
}

@media screen and (max-width: 367px) {
    .input-search {
        position: relative;
        .list-address-box {
            width: 77%;
            top: 48px;
            left: 45px;
        }
    }
}

//input number rooms

.input-number{
    border-radius: 20px;
    border: 1px solid #3F5EFB;
    width: 70%;
}


//select checkbox services

label{
    margin-left:5px;
    display: block;
    width: 25px;
    height: 25px;
    cursor: pointer;
}

.my-checkbox{
    position: absolute;
    transform: scale(0);

    &:checked ~ .checkbox{
        transform: rotate(45deg);
        width: 10px;
        margin-left: 3px;
        border-color: #24c747;
        border-top-color: transparent;
        border-left-color: transparent;
        border-radius: 0;
    }
}

.checkbox{
    display: block;
    width: inherit;
    height: inherit;
    border: 3px solid #434343;
    border-radius: 6px;
    transition: all 0.375s;
}
/*
.my-box {
  border: 5px inset #3F5EFB;
} */

 h6 {
    background: linear-gradient(
        to right,
        hsl(98 100% 62%),
        hsl(204 100% 59%)
      );
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
}
.label{
    font-size: 20px ;
}
/* button {
  border-radius: 50px;
  padding: 0.4rem 1.2rem;
  border: none;
}
.input-searc-box {
  position: relative;

  .list-address-box {
    position: absolute;
    bottom: 0;
  }
}
 */

 //card

.my-card {
  width: 450px;
  height: 400px;
  background: #000;
  border-radius: 30px;
  overflow: hidden;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.25s ease;
  backface-visibility: hidden;
  &:hover {
    transform: scale(0.9);
  }
  &:hover::after {
    height: 280px;
  }
}

.my-card:hover .con-text p {
  margin-bottom: 0px;
  opacity: 1;
}

.my-card:hover img {
  transform: scale(1.25);
}

.my-card:hover .ul {
  transform: translate(0);
  opacity: 1;
}

.my-card:after {
  width: 100%;
  content: "";
  left: 0px;
  bottom: 0px;
  height: 150px;
  position: absolute;
  background: linear-gradient(
    180deg,
    rgba(0, 0, 0, 0) 0%,
    rgba(0, 0, 0, 1) 100%
  );
  z-index: 20;
  transition: all 0.25s ease;
}

.my-card img {
  height: 100%;
  z-index: 10;
  transition: all 0.25s ease;
}

.my-card .con-text {
  z-index: 30;
  position: absolute;
  bottom: 0px;
  color: #fff;
  padding: 20px;
  padding-bottom: 30px;
}

.my-card .con-text p {
  font-size: 0.8rem;
  opacity: 0;
  margin-bottom: -170px;
  transition: all 0.25s ease;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  flex-direction: column;
}

.my-card .con-text p button {
  padding: 7px 17px;
  border-radius: 12px;
  background: transparent;
  border: 2px solid #fff;
  color: #fff;
  margin-top: 10px;
  margin-left: auto;
  cursor: pointer;
  transition: all 0.25s ease;
  font-family: poppins;
  font-size: 0.75rem;
  outline: none;
}

.my-card .con-text p button:hover {
  background: #fff;
  color: #000;
}

.ul {
  position: absolute;
  right: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  z-index: 40;
  border-radius: 14px;
  padding-left: 0px;
  padding-top: 8px;
  padding-bottom: 8px;
  top: 0px;
  opacity: 0;
  transform: translate(100%);
  transition: all 0.25s ease;
}

.ul li {
  background: #fff;
  list-style: none;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0.7;
  transition: all 0.25s ease;
  backface-visibility: hidden;
}

.ul li {
  border-radius: 12px 12px 12px 12px;
}

.ul li:hover {
  opacity: 1;
  transform: translate(-7px, -4px);
  border-radius: 6px;
}

.ul li i {
  font-size: 1.4rem;
  color: #000;
}

@media screen and (max-width: 990px) {
    .ms-text-end{
        padding-bottom: 70px;
    }
}
</style>
