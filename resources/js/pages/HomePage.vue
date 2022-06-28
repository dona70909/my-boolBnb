<template>
<div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 p-0 d-flex justify-content-center align-content-center flex-wrap slider" id="jumbotron">

                <!--//!! slider jumbotron -->

                <div class="slider">
                    <div class="slide">
                        <img src="https://cdn2.hometogo.net/assets/media/pics/1500_500/6118eee48197f.jpg" />
                    </div>
                    <div class="slide">
                        <img src="https://images7.alphacoders.com/344/thumb-1920-344344.jpg" />
                    </div>
                    <div class="slide">
                        <img src="https://cdn2.hometogo.net/assets/media/pics/1500_500/6119e4cb74e03.jpg"/>
                    </div>
                    <div class="slide">
                        <img src="https://cdn2.hometogo.net/assets/media/pics/1500_500/6119c32183a5d.jpg" />
                    </div>
                </div>

                <!-- //!! div input search -->

                <div class="input-search d-flex justify-content-center align-content-center flex-wrap position-relative">
                    <input type="text" v-model="search" id="search" name="search" placeholder="Dove vuoi andare?" @keyup="autocomplete" @keypress.enter="getApartmentsFiltered" required/>
                    <div class="list-address-box">
                    <p class="hint-list" v-for="(addressHint, index) in listAddress" :key="index" @click="completer(index)">
                        {{ addressHint }}
                    </p>
                    </div>
                    <button class="align-self-center" @click="getApartmentsFiltered">
                        Cerca
                    </button>
                </div>
            </div>

            <!-- //!! non muovere Appartamenti sponsorizzati -->
            <div class="content my-5 ms-2">
                <h2>Sponsorizzati</h2>
                <h2>Sponsorizzati</h2>
            </div>
            <ApartmentSpons v-for="(apartment, index) in apartments" :key="'primo' + index" :apartment="apartment" :endDate="apartment.apartment_sponsorship[0]"/>
        </div>
    </div>
<NavMobile />
</div>
</template>

<script>
import ApartmentSpons from "../components/ApartmentSpons.vue";
import NavMobile from "../components/NavMobile.vue";
// qui facciamo la chiamata API e passiamo i props alla pagina Apartment
export default {
    name: "HomePage",
    components: {
        NavMobile,
        ApartmentSpons,
    },
    data() {
        return {
        listAddress: [],
        apartments: [],
        search: "",
        filteredApartments: [],
        };
    },
    methods: {
        getApartments() {
        axios
            .get("/api/apartments")
            .then((result) => {
            //console.log(result.data.results);
            this.apartments = result.data.results;
            console.log(this.apartments);
            })
            .catch((error) => {
            console.error(error);
            });
        },

        //# Function chiamata ogmi volta che premo enter o clicco sul pulsante search
        //% invece di filtrare solo , deve rimandarmi alla pagina advamced search
        getApartmentsFiltered() {
            this.$router.push({
                name: "advancedsearch",
                params: {
                query: this.search,
                },
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

    mounted() {
        this.getApartments();
    },
};
</script>

<style lang="scss" scoped>
body{
        background: linear-gradient(45deg, #fff, #3F5EFB);
    }

#jumbotron {
    width: 100%;
    height: 550px;
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

//input search

.input-search {
    z-index: 2;
    display: flex;
}

button {
    border-radius: 50px;
    padding: 0.4rem 1.2rem;
    border: none;
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
//titolo appartamenti sponsorizzati

@import url("https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900");
.content {
    position: relative;
    font-family: "Poppins", sans-serif;
}

.content h2 {
    color: #fff;
    font-size: 3em;
    position: absolute;
    transform: translate(0%, -50%);
}

.content h2:nth-child(1) {
    color: transparent;
    -webkit-text-stroke: 2px #03a9f4;
}

.content h2:nth-child(2) {
    color: #03a9f4;
    animation: animate 4s ease-in-out infinite;
}

@keyframes animate {
    0%,
    100% {
        clip-path: polygon(
        0% 45%,
        16% 44%,
        33% 50%,
        54% 60%,
        70% 61%,
        84% 59%,
        100% 52%,
        100% 100%,
        0% 100%
        );
    }

    50% {
        clip-path: polygon(
        0% 60%,
        15% 65%,
        34% 66%,
        51% 62%,
        67% 50%,
        84% 45%,
        100% 46%,
        100% 100%,
        0% 100%
        );
    }
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
</style>
