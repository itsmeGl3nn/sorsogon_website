<template>
    <v-container class="py-md-12 py-6 mt-4">
      <h2
        class="text-secondary text-h5 text-lg-h4 text-xl-h2 font-weight-bold mb-3"
      >
        {{ headline }}
      </h2>
      <div
        class="text-primary text-body-1 text-md-body-large text-xl-subtitle-1 font-weight-regular mb-8 w-100 w-md-75"
      >
        {{ subTitle }}
      </div>
      <v-row class="px-3 d-none d-md-flex">
        <v-col cols="12" md="3" v-for="item in filteredProducts" :key="item.id">
          <v-card
            flat
            rounded="lg"
            variant="outlined"
            class="card-class"
            v-resize="sendHeight"
          >
            <v-img
              :height="392"
              :max-width="'auto'"
              :lazy-src="item.backgroundImage"
              :src="item.backgroundImage"
              contain
              position="center"
              :alt="`${item.title} featured image`"
              class="card-image d-flex align-end"
            >
              <v-card-item>
                <h5
                  class="text-subtitle-3 text-xl-subtitle-2 font-weight-medium mb-3 text-white"
                  :style="{ minHeight: '48px' }"
                >
                  {{ item.title }}
                </h5>
                <div
                  class="text-white text-body-14 text-xl-body-1 pb-2"
                  ref="contentRef"
                >
                  <span v-if="item.description.length > 80"
                    >{{ item.description.substring(0, 80) }}...</span
                  >
                  <span v-else>{{ item.description }}</span>
                </div>
                <a
                    :href="`${item.link}`"
                    :aria-label="`Go to ${item.title} page`"
                  >
                  <v-btn
                    color="primary"
                    class="text-body-2 text-xl-body-14"
                    height="40"
                    > {{ item.button}}</v-btn
                  >
                </a>
              </v-card-item>
            </v-img>
          </v-card>
        </v-col>
      </v-row>
      <v-row class="px-3 d-flex d-md-none">
        <swiper
          :modules="modules"
          :loop="true"
          :pagination="{
            el: '.swiper-pagination',
            clickable: true,
          }"
          :navigation="{
            prevEl: '.swiper-button-prev',
            nextEl: '.swiper-button-next',
          }"
          :slidesPerView="1"
          class="mySwiper"
        >
          <swiper-slide
            v-for="(item, index) in filteredProducts"
            :key="index"
            lazy="true"
          >
            <v-card
              flat
              rounded="lg"
              variant="outlined"
              class="card-class"
              v-resize="sendHeight"
            >
              <v-img
                :height="392"
                :max-width="'auto'"
                :lazy-src="item.backgroundImage"
                :src="item.backgroundImage"
                cover
                position="center"
                :alt="`${item.title} featured image`"
                class="card-image d-flex align-end"
              >
                <v-card-item>
                  <h5 class="text-body-large font-weight-medium mb-3 text-white">
                    {{ item.title }}
                  </h5>
                  <div
                    class="text-white text-body-14 pb-2"
                    ref="contentRef"
                    :style="smAndUp ? `height: ${height}px` : ''"
                  >
                    <span v-if="item.description.length > 80"
                      >{{ item.description.substring(0, 80) }}...</span
                    >
                    <span v-else>{{ item.description }}</span>
                  </div>
                  <a
                    :href="`${item.link}`"
                    :aria-label="`Go to ${item.title} page`"
                  >
                  <v-btn
                    color="primary"
                    class="text-body-2 text-xl-body-14"
                    height="40"
                    > {{ item.button}}</v-btn
                  >
                  </a>
                </v-card-item>
              </v-img>
            </v-card>
          </swiper-slide>
          <div class="swiper-button-prev" id="prevButton"></div>
          <div class="swiper-button-next" id="nextButton"></div>
        </swiper>
      </v-row>
    </v-container>
  </template>

  <script>
  import book from "../../../assets/appoint.jpg";
  import com from "../../../assets/complain.jpg";
  import { Navigation, Pagination, Autoplay } from "swiper/modules";
  import { Swiper, SwiperSlide } from "swiper/vue";
  import "swiper/css";
  import "swiper/css/navigation";
  import "swiper/css/pagination";
  import { useDisplay } from "vuetify";
//   import { urlFormat } from "../utils/urlFormatter";

  export default {
    name: "Our Services",
    components: {
      Swiper,
      SwiperSlide,
    },
    data() {
      const { smAndDown, md, smAndUp } = useDisplay();
      return {
        products: [
        {
      "id": 1,
      "title": "Report an Issue or Concern",
      "description": "Have a problem or suggestion? Let us know.",
      "backgroundImage": com,
      "featuredProduct": true,
      "button":  "Report Now",
      "link": "/file-complaint"
    },
    {
      "id": 2,
      "title": "Schedule a Meeting",
      "description": "Need to meet with us? Book an appointment now.",
     "backgroundImage": book,
      "featuredProduct": true,
      "button":  "Book Now",
       "link": "/appointment"
    },
    // {
    //   "id": 3,
    //   "title": "Product 3",
    //   "description": "This is a short description of Product 3.",
    //   "backgroundImage": "https://picsum.photos/200/300",
    //   "featuredProduct": true,
    //   "button":  "Learn More",
    //    "link": "/appointment"
    // },
    // {
    //   "id": 4,
    //   "title": "Product 4",
    //   "description": "This is a short description of Product 4.",
    //   "backgroundImage": "https://picsum.photos/200/300",
    //   "featuredProduct": true,
    //   "button":  "Learn More",
    //    "link": "/appointment"
    // },
    // {
    //   "id": 5,
    //   "title": "Product 5",
    //   "description": "This is a short description of Product 5. Again, this description is longer to demonstrate truncation when displayed in the UI.",
    //   "backgroundImage": "/images/product5.jpg",
    //   "featuredProduct": false,
    //   "button":  "Learn More",
    //    "link": "/appointment"
    // },
        ],
        divHeights: [],
        modules: [Navigation, Autoplay, Pagination],
        smAndDown,
        md,
        smAndUp,
        headline: "Our E-Services: Your Government, Your Way",
        subTitle: "Experience the convenience of government services at your fingertips. Our online platform offers a wide range of services, from paying taxes to renewing licenses, all accessible from the comfort of your home. Save time, reduce paperwork, and enjoy a more efficient interaction with your government.",
      };
    },
    async created() {
    //   const res = await fetch("/dynamic/products/products.json");
    //   const file = await res.json();
    //   this.products = file.data;
    },
    computed: {
      highestDivHeight() {
        const numbers = this.divHeights;
        return Math.max(...numbers);
      },
      filteredProducts() {
        return this.products.filter((product) => product.featuredProduct);
      },
    },
    mounted() {
      this.sendHeight();
      this.fetchHeader();
    },
    methods: {
      updateDivHeight(height) {
        this.divHeights = [...this.divHeights, height];
        this.$nextTick(() => {
          this.$forceUpdate();
        });
      },
      sendHeight() {
        this.$nextTick(() => {
          const ref = this.$refs.contentRef;
          if (ref) {
            this.$emit("divHeight", ref.clientHeight);
          }
        });
      },
      async fetchHeader() {
        const res = await fetch("/dynamic/home/productsheader.json");
        const file = await res.json();
        const item = file.data[0];
        this.headline = item.headline;
        this.subTitle = item.subHeadline;
      },
    },
  };
  </script>

  <style lang="scss" scoped>
  $xm-breakpoint: 600px;
  $sm-breakpoint: 960px;
  $md-breakpoint: 1280px;
  $mx-breakpoint: 1024px;
  $lg-breakpoint: 1920px;
  $xl-breakpoint: 2560px;

  .swiper-slide {
    width: 70% !important;

    @media screen and (max-width: $sm-breakpoint) {
      width: 90% !important;
    }
  }

  ::v-deep {
    .swiper-button-prev,
    .swiper-button-next {
      color: #ffffff;
    }

    .swiper-button-prev:after,
    .swiper-button-next:after {
      font-size: 25px;
    }
  }

  .card-class {
    border: 1px solid #7fabac7b;
  }

  .card-image:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    background: linear-gradient(
      -160deg,
      rgba(255, 255, 255, 0) 7.22%,
      rgba(0, 0, 0, 0.04) 41.35%,
      rgba(0, 0, 0, 0.46) 75.99%
    );
    height: 100%;
    width: 100%;
    z-index: -1;
  }

  .swiper-slide {
    width: 100% !important;
  }
  </style>
