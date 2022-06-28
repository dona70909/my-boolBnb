<template>
<div class="container-fluid mt-4 pe-0">
    <div class="row pe-0">
        <div class="about-section">
            <h1>About Us</h1>
            <h4>Da sempre appassionati del mondo Tech</h4>
        </div>

        <!-- card about us -->

        <div class="row pe-0 row-cols-1 row-cols-md-3 row-cols-lg-5 g-4">
            <div class="col">
                <div class="card h-100">
            <img src="../../../public/img/Donatella_Campaniello.jpg" alt="Image of Campaniello"/>
            <div class="card-body">
                <h5 class="card-title">Donatella Campaniello</h5>
                <p class="card-text">Jr Full Stack Web Developer</p>
                <p>
                    <a href="https://github.com/dona70909">Github</a>
                </p>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                <a class="bottone" href="https://www.linkedin.com/in/donatella-campaniello-8a3a75177/">
                    Contattaci su Linkedin
                </a>
                </small>
            </div>
        </div>
        </div>
        <div class="col">
            <div class="card h-100">
            <img src="../../../public/img/francesco_Giordani.jpeg" alt="Image of Giordani"/>
            <div class="card-body">
                <h5 class="card-title">Francesco Giordani</h5>
                <p class="card-text">Jr Full Stack Web Developer</p>
                <p>
                    <a href="https://github.com/Ezy93">Github</a>
                </p>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                <a class="bottone" href="https://www.linkedin.com/in/francesco-giordani-37b9a318b/">
                    Contattaci su Linkedin
                </a>
                </small>
            </div>
        </div>
        </div>
        <div class="col">
            <div class="card h-100">
            <img class="img-fluid" src="../../../public/img/Francesco_Capriolo.jpeg" alt="Image of Capriolo"/>
            <div class="card-body">
                <h5 class="card-title">Francesco Capriolo</h5>
                <p class="card-text">Jr Full Stack Web Developer</p>
                <p>
                    <a href="https://github.com/Francesco-Capriolo">Github</a>
                </p>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                <a class="bottone" href="https://www.linkedin.com/in/francesco-capriolo-web-developer/">
                    Contattaci su Linkedin
                </a>
                </small>
            </div>
        </div>
        </div>
        <div class="col">
            <div class="card h-100">
            <img src="../../../public/img/Mattia_Portanti.jpeg" alt="Image of Portanti"/>
            <div class="card-body">
                <h5 class="card-title">Mattia Portanti</h5>
                <p class="card-text">Jr Full Stack Web Developer</p>
                <p><a href="https://github.com/tiiaaaa">Github</a></p>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                <a class="bottone"  href="https://www.linkedin.com/in/mattia-portanti-740667241/">
                    Contattaci su Linkedin
                </a>
                </small>
            </div>
        </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="../../../public/img/Vittorio_campese.jpeg" alt="Image of Campese"/>
                <div class="card-body">
                    <h5 class="card-title">Vittorio Campese</h5>
                    <p class="card-text">Jr Full Stack Web Developer</p>
                    <p><a href="https://github.com/Vitto2623">Github</a></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                    <a class="bottone" href="https://www.linkedin.com/in/vittorio-campese-366b7b222/">
                        Contattaci su Linkedin
                    </a>
                    </small>
                </div>
            </div>
        </div>
    </div>
   
    </div>
</div>
</template>

<script>

export default {
    name: "Aboutus",

};
</script>

<style lang="scss" scoped>
//jumbo

.about-section {
    padding: 50px;
    text-align: center;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background: linear-gradient(50deg, #0751f1, #fff, #0751f1);
    //background-color: #0751f1;
    color: white;
}
h1,
h2,
h4 {
  font-weight: 700;
  text-align: center;
  font-family: Hack, sans-serif;
  text-transform: uppercase;
  background: linear-gradient(90deg, #000, #b7b7b7, #000);
  background-size: auto;
  background-clip: border-box;
  letter-spacing: 5px;
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  background-size: 80%;
  -webkit-animation: shine-data-v-520b5d54 12s linear infinite;
  animation: shine-data-v-520b5d54 5s linear infinite;
  position: relative;
  //background-repeat: no-repeat;
}

h1 {
  font-size: 60px;
}

.h4 {
  font-size: 40px;
}

@keyframes shine {
  0% {
    background-position-x: -500%;
  }
  100% {
    background-position-x: 500%;
  }
}

//card

img {
  object-fit: cover;
  height: 340px;
  border-radius: 20px 20px 0 0;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
  border-radius: 20px;
  transition: all 0.25s ease;
  backface-visibility: hidden;
  &:hover {
    transform: scale(1.1);
  }
  &:hover::after {
    height: 200px;
  }
}

.bottone {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #0751f1;
  text-align: center;
  cursor: pointer;
  width: 100%;
  transition: all 0.25s ease;
  backface-visibility: hidden;
  &:hover {
    transform: scale(1.1);
    background: linear-gradient(50deg, #0751f1, #fff, #0751f1);
    color: #000;
  }
}

.row {
  margin-bottom: 50px;
}
.row a {
  text-decoration-line: none;
  border-radius: 20px;
}

@media screen and(max-width: 956px) {
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        margin: 8px;
        border-radius: 20px;
        transition: all 0.25s ease;
        backface-visibility: hidden;
        &:hover {
            transform: scale(0.9);
        }
        &:hover::after {
            height: 200px;
    }
}
}

</style>
