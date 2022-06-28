<template>

    <div v-if="this.isSponsorized == false"  class="my-card-wrap col-3">

        <router-link class="wrapper-img mb-2 " :to="{ name: 'apartment-details', params: { id: apartment.id } }">
            <!-- //!! IMMAGINE -->
            <img  v-if="apartment.image.startsWith('https://') || apartment.image.startsWith('http://')" :src="apartment.image" alt="image" />
            <img  v-else :src="'../storage/' + apartment.image" alt="image" /> 
        </router-link>

        <!-- //!! descrizione card -->
        <div class="wrap-text ">

            <h6>{{apartment.address}}</h6>

            <p class="text-gray">
            {{apartment.daily_price}} £
            </p>
        </div>
    
    </div>

</template>

<script>
import moment from 'moment';

export default {

    name: "Apartment",

    components: {},

    props: ["apartment"],

    data: function() {

        return {

            isSponsorized: null,
        }
    },

    methods: {

        getApartmentsSponsorized() {
        
            this.apartment.apartment_sponsorship.forEach(element => {

                if(element.end_date > this.today) {

                    return  this.isSponsorized = true;
                } else {
                    this.isSponsorized = false;
                }
                
            });
        },

        getApartmentsSponsorized() {
    
            this.apartment.apartment_sponsorship.forEach(element => {

                if(element.end_date > this.today) {

                    return  this.isSponsorized = true;
                } else {

                    return  this.isSponsorized = false;
                }
            
            });
        },

        getToday(){

            return this.today = moment().format('YYYY-MM-DD hh:mm:ss') ;
        }

    },

    mounted() {
    
        this.today = moment().format('YYYY-MM-DD hh:mm:ss');      
        this.getApartmentsSponsorized();

        console.log(this.apartment.apartment_sponsorship);
        //this.getListServices();
    
    },

    watch:{

        today(){
            this.today;
        } 
    }
};
</script>

<style lang="scss" scoped>
    
    .my-card-wrap {

        width:100%;
        //height: 250px;

        img {
            
            width: 100%;
            height: 100%;
            border-radius: 13px;
        }
    }

</style>