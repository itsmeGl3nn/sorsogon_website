<template>
    <swiper
        :modules="modules"
        :loop="true"
        :effect="'fade'"
        :autoplay="{
            delay: 6000,
            disableOnInteraction: false,
        }"
        :pagination="{
            el: '.swiper-pagination',
            clickable: true,
        }"
        class="position-relative section-class"
    >
        <swiper-slide
            v-for="(item, index) in items"
            :key="index"
            class="bg-class h-100 w-100"
            :style="{
                background: 'url(' + item.backgroundImage + ')',
                backgroundPosition: 'right top',
            }"
        >
            <v-container class="h-100 d-flex flex-column justify-center">
                <v-row class="h-100">
                    <v-col cols="10" lg="4" align-self="center">
                        <v-sheet color="transparent" class="pr-5">
                            <!-- Display additional content if needed -->
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>
        </swiper-slide>
    </swiper>
</template>

<script setup>
import { ref, onMounted } from "vue";

import { Navigation, Pagination, Autoplay, EffectFade } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

// Array to store items for Swiper
const items = ref([]);

// Swiper modules
const modules = [Navigation, Autoplay, Pagination, EffectFade];

// // Function to fetch data from the API
// const fetchData = async () => {
//     try {
//         const response = await fetch("/api/home-banners");
//         const data = await response.json();

//         items.value = data.data.map((banner) => ({
//             backgroundImage: banner.image,
//         }));
//     } catch (error) {
//         console.error("Error fetching banner data:", error);
//     }
// };

onMounted(async () => {
    const res = await fetch("/api/home-banners");
    const file = await res.json();
    console.log(items.value);
    items.value = file.data.map((banner) => ({
        backgroundImage: banner.image,
    }));
});
</script>

<style lang="scss" scoped>
$x-breakpoint: 600px;

.section-class {
    height: 100vh;
    position: relative;

    .bg-class {
        background-size: cover !important;
        background-repeat: no-repeat !important;

        @media screen and (max-width: $x-breakpoint) {
            background-size: cover !important;
        }
    }

    @media screen and (max-width: $x-breakpoint) {
        height: 370px;
    }
}
</style>
