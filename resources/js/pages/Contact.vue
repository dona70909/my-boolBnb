<template>
  <div>
    <div class="container-fluid mt-5">
      <div class="row mb-5">
        <div class="container">
          <div class="row align-items-stretch no-gutters contact-wrap">
            <div class="col-md-8">
              <div class="form h-100">
                <h3>Send us a message</h3>
                <form
                  class="mb-5"
                  method="post"
                  id="contactForm"
                  name="contactForm"
                  novalidate="novalidate"
                >
                  <div class="row">
                    <div class="col-md-6 form-group mb-5">
                      <label for="" class="col-form-label">Name *</label>
                      <input
                        type="text"
                        class="form-control error"
                        name="name"
                        id="name"
                        placeholder="Your name"
                        aria-required="true"
                        aria-invalid="true"
                      /><label id="name-error" class="error" for="name"
                        >Please enter your name</label
                      >
                    </div>
                    <div class="col-md-6 form-group mb-5">
                      <label for="" class="col-form-label">Email *</label>
                      <input
                        type="text"
                        class="form-control error"
                        name="email"
                        id="email"
                        placeholder="Your email"
                        aria-required="true"
                      /><label id="email-error" class="error" for="email"
                        >Please enter a valid email address</label
                      >
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group mb-5">
                      <label for="" class="col-form-label">Phone</label>
                      <input
                        type="text"
                        class="form-control"
                        name="phone"
                        id="phone"
                        placeholder="Phone #"
                      />
                    </div>
                    <div class="col-md-6 form-group mb-5">
                      <label for="" class="col-form-label">Company</label>
                      <input
                        type="text"
                        class="form-control"
                        name="company"
                        id="company"
                        placeholder="Company  name"
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group mb-5">
                      <label for="message" class="col-form-label"
                        >Message *</label
                      >
                      <textarea
                        class="form-control error"
                        name="message"
                        id="message"
                        cols="30"
                        rows="4"
                        placeholder="Write your message"
                        aria-required="true"
                      ></textarea
                      ><label id="message-error" class="error" for="message"
                        >Please enter a message</label
                      >
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <input
                        type="submit"
                        value="Send Message"
                        class="btn btn-primary py-2 px-4"
                      />
                      <span class="submitting "></span>
                    </div>
                  </div>
                </form>
                <!-- <div id="form-message-warning mt-4"></div>
                <div id="form-message-success d-none">
                  Your message was sent, thank you!
                </div> -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="contact-info h-100">
                <h3>Contact Information</h3>
                <p class="mb-5">
                  We are at your disposal
                </p>
                <ul class="list-unstyled">
                  <li class="d-flex">
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="text ms-1"
                      >Via Terminillo	00141	Roma	Lazio	06	H501</span
                    >
                  </li>
                  <li class="d-flex">
                    <i class="fas fa-phone"></i>
                    <span class="text ms-1">+39 348 80 81 801</span>
                  </li>
                  <li class="d-flex">
                    <i class="fas fa-envelope"></i>
                    <span class="text ms-1">info@ourboolbnb.com</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <NavMobile />
  </div>
</template>

<script>
import NavMobile from "../components/NavMobile.vue";
export default {
  name: "Contact",
  components: {
    NavMobile,
  },
};
</script>

<style lang='scss' scoped>
.content {
  padding: 7rem 0;
}
.container {
  max-width: 960px;
}
.contact-wrap {
  -webkit-box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
}
.contact-wrap .form {
  background: #fff;
}
.contact-wrap .contact-info {
  background: #35477d;
}
.contact-wrap .contact-info {
  color: rgba(255, 255, 255, 0.5);
}
.contact-wrap .form,
.contact-wrap .contact-info {
  padding: 40px;
}
.list-unstyled {
  padding-left: 0;
  list-style: none;
}
.contact-wrap .contact-info ul li {
  margin-bottom: 15px;
  color: rgba(255, 255, 255, 0.5);
}

.contact-wrap .contact-info ul li .wrap-icon {
  font-size: 20px;
  color: #fff;
  margin-top: 5px;
}

.btn-primary{
    border-radius: 10px;
}
.form-message-success{
    display: none;
}
</style>
