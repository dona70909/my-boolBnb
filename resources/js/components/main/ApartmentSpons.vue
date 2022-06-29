<template>

  
  <div v-if="this.isSponsorized == true" class="my-card-wrap col-3">

    <router-link class="wrapper-img mb-2 " :to="{ name: 'apartment-details', params: { id: apartment.id } }">
         <!-- //!! IMMAGINE -->
          <img  v-if="apartment.image.startsWith('https://') || apartment.image.startsWith('http://')" :src="apartment.image" alt="image" />
          <img  v-else :src="'../storage/' + apartment.image" alt="image" /> 
    </router-link>

    <!--  <button @click="scrollRight()">
        avanti
    </button>

    <button @click="scrollLeft()">
      indietro
    </button> -->

    <!-- 
        <div  v-for="(image,index) in apartmentImages" :key="index" class="corusel-images">
          <div v-show="index == counter" class="box">
              <img  v-if="image.img_url.startsWith('https://') || image.img_url.startsWith('http://')" :src="image.img_url" alt="image" />
              <img  v-else :src="'../storage/' + img_url" alt="image" /> 
          </div>  
        </div>
    -->

    <!-- //!! descrizione card -->
    <div class="wrap-text ">

      <h6>{{apartment.address}}</h6>

      <p class="text-gray">
        {{apartment.daily_price}} £
      </p>
    </div>

    <div  v-for="(sponsor, index) in apartment.apartment_sponsorship" :key="index">
          <div v-if="new Date(sponsor.end_date) > Date.now() ">
            <i class="bi bi-star-fill"></i>
          </div>
    </div>

   


  </div>

</template>

<script>
export default {

  name: "ApartmentSpons",

  props: ["apartment"],

  data: function () {
    return {

        listService:[],
        isSponsorized: null,
        images:[],
        apartmentImages:[],
        counter:0,
    }
  },

  methods: {

    getListServices(){
        this.apartment.services.forEach(element => {
            if(!this.listService.includes(element.service_name)){
              this.listService.push(element.service_name);
            }
        });
        return this.listService;
    },

    getApartmentsSponsorized() {
    
        this.apartment.apartment_sponsorship.forEach(element => {

          if(new Date(element.end_date) > Date.now()) {

            return  this.isSponsorized = true;
          } else {

            return this.isSponsorized = false;
          }
          
        });
    },

    /* `/api/images/${this.apartment.id}` */
    getImages() {
      axios.get("/api/images/").then( response => {

          //console.log(response.data.results);
          this.images = response.data.results;

          this.getApartmentImages();

      })

      .catch((error) => {
        console.error(error);
      });
    },

    getApartmentImages() {

      if(this.images.length > 0) {

        this.images.forEach(image => {

            if(image.apartment_id == this.apartment.id) {

              this.apartmentImages.push(image);
            }

        })
      }

      return this.apartmentImages;
    },

    scrollLeft(){
      if(this.counter == 0){
          this.counter = this.apartmentImages.length - 1;
        
      } else {
          this.counter--;
      }
    },


    scrollRight(){
        if(this.counter == this.apartmentImages.length - 1){
            this.counter = 0;
        } else{
            this.counter++;
        }
    },


  },

  created() {
    
    this.getApartmentsSponsorized();
    this.getImages();
    //this.getApartmentImages();
  
    //console.log(this.getApartmentImages(this.apartment.id));

    
  },

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
