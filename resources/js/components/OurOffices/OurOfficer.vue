<template>
    <div>
        <v-container class="container-y">
            <v-row>
                <v-col cols="12" md="4" align-self="center">
                    <div
                        class="text-md-body-text text-body-1 text-primary font-weight-semibold pt-12"
                    >
                        {{ sectionTitle }}
                    </div>
                    <div class="py-4 text-md-h3 text-h4 font-weight-black">
                        {{ heading }}
                    </div>
                    <p
                        class="custom-gray text-md-body-text text-body-1 font-weight-medium pb-4"
                    >
                        {{ description }}
                    </p>
                    <div class="custom-divider"></div>
                </v-col>
                <v-col cols="12" md="8">
                    <swiper
                        :modules="swiperOptions.modules"
                        :navigation="swiperOptions.navigation"
                        :pagination="swiperOptions.pagination"
                        :slidesPerView="swiperOptions.slidesPerView"
                        :spaceBetween="swiperOptions.spaceBetween"
                        :breakpoints="swiperOptions.breakpoints"
                        class="mySwiper"
                        @slideChange="onSlideChange"
                        ref="swiperRef"
                    >
                        <swiper-slide
                               v-for="(officer, index) in officers"
                            :key="index"
                            :lazy="true"
                        >
                            <div class="py-4 px-2 justify-center d-flex">
                                <v-card
                                    rounded="xl"
                                    :height="smAndUp ? 420 : 580"
                                    :width="300"
                                    variant="flat"
                                    class="card-container"
                                >
                                    <v-img
                                        :src="officer.image"
                                        :height="smAndUp ? 300 : 400"
                                        cover
                                        :alt="`${officer.name} ${officer.position} image`"
                                    ></v-img>
                                    <v-card-item class="text-center pt-8">
                                        <div
                                            class="text-md-body-text text-body-1 font-weight-medium"
                                        >
                                            {{ officer.full_name }}
                                        </div>
                                        <div
                                            class="text-md-body-text text-body-1 font-weight-medium"
                                        >
                                            {{ officer.position }}
                                        </div>
                                        <div
                                            class="text-md-body-text text-body-1 font-weight-medium"
                                        >
                                            {{ officer.department }}
                                        </div>
                                    </v-card-item>
                                </v-card>
                            </div>
                        </swiper-slide>
                    </swiper>
                    <div class="custom-pagination"></div>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Autoplay, EffectFade } from "swiper/modules";
import { useDisplay } from "vuetify";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/effect-fade";
const sectionTitle = ref("Meet Our Municipal Mayor and Officer");
const heading = ref("Leadership that Inspires");
const description = ref(
    "Our experienced and visionary leaders are the driving force behind our success, shaping the future of our Municipality."
);

const { name } = useDisplay();
const { smAndUp } = useDisplay();
const modules = [Navigation, Autoplay, EffectFade, Pagination];
const officers = ref([]);


const leadersLength = computed(() => {
    return officers.value.length;
});

const swiperRef = ref(null);
const swiperOptions = ref({
    modules: [Navigation, Pagination],
    navigation: {
        prevEl: "#prev-btn",
        nextEl: "#next-btn",
    },
    pagination: {
        el: ".custom-pagination",
        clickable: true,
        bulletClass: "swiper-pagination-bullet",
        bulletActiveClass: "swiper-pagination-bullet-active",
    },
    slidesPerView: 1,
    spaceBetween: 0,
    breakpoints: {
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        1280: {
            slidesPerView: 3,
            spaceBetween: 5,
        },
        1920: {
            slidesPerView: 3,
            spaceBetween: 5,
        },
    },
});

watch(
    leadersLength,
    () => {
        switch (name.value) {
            case "xl":
                swiperOptions.value.slidesPerView = 4;
                break;
            case "lg":
                swiperOptions.value.slidesPerView = 3;
                break;
            case "md":
                swiperOptions.value.slidesPerView = 3;
                break;
            default:
                swiperOptions.value.slidesPerView = 1;
        }
    },
    { deep: true }
);

onMounted(async () => {
    try {
        const response = await fetch("/api/municipal-officers?page=1&limit=10");
        const data = await response.json();

        // Map response data to align with Swiper slide structure
        officers.value = data.data.map((officer) => ({
            full_name: officer.full_name,
            position: officer.position,
            department: officer.department,
            image: officer.image, // Already processed with full URL by the backend
        }));
    } catch (error) {
        console.error("Error fetching municipal officer data:", error);
    }
});
</script>

<style lang="scss">
.card-container {
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.custom-pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;

    .swiper-pagination-bullet {
        width: 15px;
        height: 15px;
        background-color: #ebebeb;
        border-radius: 50%;
        margin: 0 5px;
        cursor: pointer;
        opacity: 1;
    }

    .swiper-pagination-bullet-active {
        background-color: #092f6b;
    }
}

.custom-divider {
    width: 100px;
    border: 2px solid #092f6b;
}
</style>
