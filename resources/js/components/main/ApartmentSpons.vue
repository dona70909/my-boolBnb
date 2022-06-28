<template>

  
  <div v-if="this.isSponsorized == true" class="my-card-wrap col-3 ">

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

    <div v-for="(sponsor, index) in apartment.apartment_sponsorship" :key="index">
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


  },

  mounted() {
    
    this.getApartmentsSponsorized();
    
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
