<template>
    <swiper
      :effect="'fade'"
      :autoplay="{
        delay: 6000,
        disableOnInteraction: false,
      }"
      :modules="modules"
      :loop="true"
      :pagination="{
        el: '.swiper-pagination',
        clickable: true,
      }"
      :navigation="{
        prevEl: '#prevButton',
        nextEl: '#nextButton',
      }"
      ref="mySwiper"
      class="position-relative section-class"
    >
      <swiper-slide
        v-for="(item, index) in items"
        :key="index"
        class="bg-class h-100 w-100"
        :style="{
          background: 'url(' + item.backgroundImage + ')',
          backgroundPosition: 'top center',
        }"
      >
        <v-container class="h-100 d-flex flex-column justify-center">
          <v-row class="h-100">
            <v-col cols="10" lg="4" align-self="center">
              <v-sheet color="transparent" class="pr-5">
                <!-- <div
                  v-html="item.headline"
                  class="dynamic-v-html-wrapper text-h5 text-md-h4 text-xl-h2 font-weight-bold text-white mb-3 pr-4 pr-md-0"
                ></div> -->
                <!-- <div class="d-flex flex-column flex-sm-row pt-4">
                  <a :href="item.buttonLink" aria-label="Go to inquire page">
                    <v-btn-secondary>{{ item.buttonLabel }}</v-btn-secondary>
                  </a>
                </div> -->
              </v-sheet>
            </v-col>
          </v-row>
        </v-container>
      </swiper-slide>
    </swiper>
  </template>

  <script setup>
  import { ref } from "vue";
  import { Navigation, Pagination, Autoplay, EffectFade } from "swiper/modules";
  import { Swiper, SwiperSlide } from "swiper/vue";
  import "swiper/css";
  import "swiper/css/navigation";
  import "swiper/css/pagination";
  import banner from "/resources/assets/maxresdefault.jpg";
  import banner2 from "/resources/assets/pichome.png";
  const items = ref([
    { backgroundImage: banner, headline: "About Us" },
    { backgroundImage: banner2, headline: "About Us" },
    // Add more items as needed
  ]);

  const modules = [Navigation, Autoplay, Pagination, EffectFade];
  </script>

  <style lang="scss" scoped>
  $xm-breakpoint: 600px;

  .section-class {
    height: 100vh;
    position: relative;

    .bg-class {
      background-size: cover !important;
      background-position: top !important;
      background-repeat: no-repeat !important;

      @media screen and (max-width: $xm-breakpoint) {
        background-size: cover !important;
      }
    }

    @media screen and (max-width: $xm-breakpoint) {
      height: 370px;
    }
  }
  </style>
