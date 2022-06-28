<template>
    <div class="container-fluid ">

        <div class="row mb-5 justify-content-center">
            <div class="col-8">

                <div class="container-input-search d-flex justify-content-center">

                    <input class="input-bar" type="text" v-model="search" id="search" name="search" placeholder="Dove vuoi andare?" @keyup="autocomplete" @keypress.enter="getApartmentsFiltered" required/>
                    <!--//# solo di prova -->
                    <button class="align-self-center" @click="getApartmentsFiltered">
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

        <!-- //!! QUI APPARTAMENTI SPONSORIZZATI -->
        <div class="row mb-5 justify-content-center row-wrap-cards">
            <ApartmentSpons v-for="(apartment, index) in apartments" :key="index" :apartment="apartment" />
            
        </div>
    </div>
</template>

<script>
import ApartmentSpons from "../components/main/ApartmentSpons.vue";


export default {

    name: "HomePage",

    components: {

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

        axios.get("/api/apartments").then((result) => {
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
                
                this.listAddress.push(array[i].address.streetName +" , " +  array[i].address.municipality );
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
    
    //# cards wrapper
    .row-wrap-cards {
        gap: 5rem 1rem;
    }

    //#style search bar
    
    input{

        width: 100%;
        border-radius: 13px;
        padding: 1rem;
        border: 3px solid blue;

        &:focus {

            border: 3px solid blue;
            outline: none;
        }

        button {

            border: 3px solid blue;
            background:blue;
            color:white;
        }
    }

</style>
