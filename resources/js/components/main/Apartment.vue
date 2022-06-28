<template>
    
    <div class="
            col-12 col-md-6 col-lg-4 col-xl-3
            p-0
            mb-5
            d-flex
            justify-content-center
            align-items-center
            px-4
            py-4
            "
            v-if="apartment.sponsorships.length == false"
        >
            <div class="my-card">
                <ul class="ul">
                    <li v-for="(services, index) in apartment.services" :key="index">
                    <i
                        v-if="services.service_name === 'piscina'"
                        class="fa-solid fa-person-swimming"
                    ></i>
                    <i v-if="services.service_name === 'Wi-Fi'" class="fas fa-wifi"></i>
                    <i
                        v-if="services.service_name === 'posto macchina'"
                        class="fa-solid fa-square-parking"
                    ></i>
                    <i
                        v-if="services.service_name === 'portineria'"
                        class="fa-solid fa-bell-concierge"
                    ></i>
                    <i
                        v-if="services.service_name === 'aria condizionata'"
                        class="fa-solid fa-wind"
                    ></i>
                    <i
                        v-if="services.service_name === 'vista mare'"
                        class="fas fa-water"
                    ></i>
                    <i
                        v-if="services.service_name === 'sauna'"
                        class="fa-solid fa-hot-tub-person"
                    ></i>
                    </li>
                </ul>
                <img
                    v-if="
                    apartment.image.startsWith('https://') ||
                    apartment.image.startsWith('http://')
                    "
                    :src="apartment.image"
                    alt="image"
                />
                <img v-else :src="'../storage/' + apartment.image" alt="image" />
                <div class="con-text pb-5">
                    <h2>{{ apartment.title }}</h2>
                    <p>
                    {{ apartment.description }}
                    <button>
                        <router-link
                        class="text-decoration-none"
                        :to="{ name: 'apartment-details', params: { id: apartment.id } }"
                        >
                        Dettagli Appartamento
                        </router-link>
                    </button>
                    </p>
                </div>
            </div>

        </div>
      
</template>

<script>
export default {
    name: "Apartment",

    components: {},

    props:{
        apartment: Object
    },
};
</script>

<style lang="scss" scoped>

.my-card{
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
    transition: all .25s ease;
    backface-visibility: hidden;
    &:hover{
        transform: scale(.9);
    }
    &:hover::after{
        height: 280px;
    }
}

.my-card:hover .con-text p{
    margin-bottom: 0px;
    opacity: 1;
}

.my-card:hover img{
    transform: scale(1.25);
}

.my-card:hover .ul{
    transform: translate(0);
    opacity: 1;
}

.my-card:after{
    width: 100%;
    content: '';
    left: 0px;
    bottom: 0px;
    height: 150px;
    position: absolute;
    background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,1)100%);
    z-index: 20;
    transition: all .25s ease;
}

.my-card img{
    height: 100%;
    z-index: 10;
    transition: all .25s ease;
}

.my-card .con-text{
    z-index: 30;
    position: absolute;
    bottom: 0px;
    color: #fff;
    padding: 20px;
    padding-bottom: 30px;
}

.my-card .con-text p{
    font-size: .8rem;
    opacity: 0;
    margin-bottom: -170px;
    transition: all .25s ease;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex-direction: column;
}

.my-card .con-text p button{
    padding: 7px 17px;
    border-radius: 12px;
    background: transparent;
    border: 2px solid #fff;
    color: #fff;
    margin-top: 10px;
    margin-left: auto;
    cursor: pointer;
    transition: all .25s ease;
    font-family: poppins;
    font-size: .75rem;
    outline: none;
}

.my-card .con-text p button:hover{
    background: #fff;
    color: #000;
}

.ul{
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
    transition: all .25s ease;
}

.ul li{
    background: #fff;
    list-style: none;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: .7;
    transition: all .25s ease;
    backface-visibility: hidden;
}

.ul li:last-child{
    border-radius: 0px 0px 12px 12px;   
}

.ul li:first-child{
    border-radius: 0px 0px 12px 12px;   
}

.ul li:hover{
    opacity: 1;
    transform: translate(-7px, -4px);
    border-radius: 6px;
}

.ul li i{
    font-size: 1.4rem;
    color: #000;
}
</style>
