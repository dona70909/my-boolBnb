<template>

    <div v-if="this.isSponsorized == false"  class="my-card-wrap col-3">

        <router-link class="wrapper-img mb-2 " :to="{ name: 'apartment-details', params: { id: apartment.id } }">
             <!-- //!! IMMAGINE -->
        <div  v-for="(image,index) in images" :key="index" class="corusel-images-wrapper">
            <div v-show="index == counter" class="card-carousel">

                <img v-if="image.img_url.startsWith('https://') || image.img_url.startsWith('http://')" :src="image.img_url" alt="image"/>
                <img v-else :src="'../storage/' + image.img_url" alt="image" /> 

                <div class="wrapper-buttons d-flex justify-content-between">

                    <div class="button-wrapper-left ">
                        <button class="btn-scroll mx-1" @click.prevent="scrollLeft()">
                            <i class="bi bi-chevron-left"></i>
                        </button> 
                    </div>  

                    <div class="button-wrapper-right">
                        <button class="btn-scroll mx-1" @click.prevent="scrollRight()">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>

                </div>
            </div>  
        </div>

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


export default {

    name: "Apartment",

    

    props: ["apartment"],

    data: function() {

        return {

            isSponsorized: null,
            counter:0,
            images:[],
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



        getImages(apartmentId) {

            axios.get("/api/images/apartment", {

                params: {
                    apartment_id: apartmentId,
                },

            }).then( response => {

                this.images = response.data.results;
                //console.log(this.images);
                
            })

            .catch((error) => {
                console.error(error);
            });

        },

        scrollLeft(){
            
            if(this.counter == 0){
                this.counter = this.images.length - 1;
                
            } else {
                this.counter--;
            }
        },


        scrollRight(){

            if(this.counter == this.images.length - 1){
                this.counter = 0;
            } else{
                this.counter++;
            }
        },

    },

    created() {
    
        this.getApartmentsSponsorized();
        this.getImages(this.apartment.id);
    
    },

};
</script>

<style lang="scss" scoped>
    
    .my-card-wrap {

        width:100%;
        //height: 250px;

        img {
            
            width: 100%;
            height: 200px;
            border-radius: 13px;
        }
    }

    .btn-scroll {

        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: none;
        background-color: rgb(24, 8, 253);

        display: flex;
        justify-content: center;
        align-items: center;

        .bi {

            font-size: .6rem;
            font-weight: 700;
            color: white;
        }
    }

    .card-carousel {

        position: relative;

        

        .button-wrapper-left {

            position: relative;
            bottom: 100px;
            //display: none;
        }

        .button-wrapper-right {

            position: relative;
            bottom: 100px;
            //display: none;
        }
    }

</style>