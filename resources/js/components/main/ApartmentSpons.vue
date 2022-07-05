<template>

  
  <div v-if="this.isSponsorized == true" class="my-card-wrap col-3 ">

    <router-link class="wrapper-img mb-2 " :to="{ name: 'apartment-details', params: { id: apartment.id } }">
         <!-- //!! IMMAGINE -->
        <div v-show="images.length > 1"  v-for="(image,index) in images" :key="index" class="corusel-images-wrapper">
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

        <!-- show the front image if carousel is empty or equal to one -->
        <div v-show="images.length === 0 || images.length === 1" class="mb-3 wrapper-front-image">
            <img v-if="apartment.image.startsWith('https://') || apartment.image.startsWith('http://')" :src="apartment.image" alt="image"/>
            <img v-else :src="'../storage/' + apartment.image" alt="image" /> 

            <!-- <div class="wrapper-stars">
                <div  v-for="(sponsor, index) in apartment.apartment_sponsorship" :key="index + 1">
                  <div v-if="new Date(sponsor.end_date) > Date.now() ">
                    <i class="bi bi-star-fill"></i>
                  </div>
                </div>
            </div> -->
        </div>

        <div class="wrapper-stars">
            <div  v-for="(sponsor, index) in apartment.apartment_sponsorship" :key="index + 1">
              <div v-if="new Date(sponsor.end_date) > Date.now() ">
                <i class="bi bi-star-fill"></i>
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

  name: "ApartmentSpons",

  props: ["apartment"],

  data: function () {
    return {

        listService:[],
        isSponsorized: null,

        images:[],
        allImages:[],
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

    //# da modificare non viene chiamata
    getAllImages() {

      this.images.forEach(img => {

        this.allImages.push(img.img_url); 
      })

      this.allImages.push(this.apartment.image);

      return this.allImages;
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
    //console.log(this.images);
    
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

        position: absolute;
        bottom: 100px;
        right: 0;
        padding: 0 .3rem;
      }

      .button-wrapper-right {

        position: absolute;
        bottom: 100px;
        left: 0;
        padding: 0 .3rem;
      }


    }


    .my-card-wrap {

      position: relative;
      //height: 300px;

      .wrapper-stars {

        position:absolute;
        bottom: 230px;
        left: 20px;
        padding: 0 .3rem;

        .bi-star-fill {

          color: rgb(233, 199, 10);

          &:hover {
            color: rgb(255, 217, 0);
          }
        }
      }
    } 

</style>
