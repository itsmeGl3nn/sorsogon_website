<template>
    <div class="py-12">
        <v-container>
            <div class="swiper-container">
                <swiper
                    class="swiper"
                    :modules="modules"
                    :pagination="{ clickable: true }"
                    :space-between="2"
                    :autoplay="{
                        delay: 10000,
                        disableOnInteraction: false,
                    }"
                    @slide-change="slideChange"
                >
                    <swiper-slide
                        v-for="(detail, index) in details"
                        :key="index"
                        style="height: auto"
                    >
                        <v-row no-gutters>
                            <v-col cols="12" md="6" class="d-flex align-center">
                                <div
                                    class="text-center text-md-left"
                                    data-aos="fade-up"
                                    data-aos-duration="1200"
                                >
                                    <h2
                                        class="text-h2 font-weight-bold text-black text-center text-md-left mb-6"
                                    >
                                        {{ detail.headline }}
                                    </h2>
                                    <div
                                        class="text-body-1 text-black"
                                        style="position: relative"
                                    >
                                        <p>{{ detail.description }}</p>
                                        <p
                                            class="text-base-font-black"
                                            style="position: absolute; top: 0"
                                        >
                                            <VueWriter
                                                v-if="activeIndex == index"
                                                :array="[detail.description]"
                                                :typeSpeed="10"
                                                :iterations="1"
                                            ></VueWriter>
                                        </p>
                                    </div>
                                </div>
                            </v-col>
                            <v-col cols="12" md="6">
                                <div
                                    class="d-flex justify-center align-center pa-8"
                                    data-aos="fade-up"
                                    data-aos-duration="1200"
                                >
                                    <div class="img-holder">
                                        <v-img
                                            :src="detail.image"
                                            :eager="true"
                                            cover
                                            alt="life"
                                            class="img-placeholder"
                                            ref="img-placeholder"
                                        ></v-img>
                                        <div class="img-shadow"></div>
                                    </div>
                                </div>
                            </v-col>
                        </v-row>
                    </swiper-slide>
                </swiper>
            </div>
        </v-container>
    </div>
</template>

<script>
import { Pagination, Autoplay, EffectFade } from "swiper/modules";

import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";

import thumbnail from "/resources/assets/maxresdefault.jpg";
import VueWriter from "vue-writer";

export default {
    components: {
        Swiper,
        SwiperSlide,
        VueWriter,
    },
    setup() {
        return {
            modules: [Pagination, Autoplay, EffectFade],
        };
    },
    data() {
        return {
            activeIndex: 0,
            thumbnail,
            details: [
                {
                    headline: "PHYSICAL FEATURES",
                    description: "Pilar is located at the northwestern part of the province of Sorsogon which is at the southernmost tip of the Bicol Peninsula. It lies at 12 degrees 56' and 44 latitude and 123 degrees,39' and 52'' longitude. it is 57 kilometers road distance from the provincial capital of Sorsogon and 47 kilometers south of the Regional Center of Legazpi City in Albay province. It is bounded on the north by the province of Albay; on the east by the municipality of Castilla; on the south by Pilar Bay; and on the west by the municipality of Donsol.  By bus, Manila –Pilar travel time is 9 to 10 hours; by airplane,Manila-Legazpi is one hour plus a one-hour car-ride from Legazpi-Pilar.",
                    image: thumbnail,
                },
                {
                    headline: "ECONOMIC PROFILE",
                    description: "Despite efforts on diversification, Pilar’s agricultural economy remains to be heavily dependent on the monoculture of coconut which is planted to more than 70% of its total land area. As such, it is a major supplier of copra in the coconut oil milling industry in Bicol yet coconut farmers remain to be below the threshold level. Next to coconut. Rice is produced in 11% of its land, which is about 2,730 hectares but only 483 hectares are irrigated. Corn and root crops are also planted in upland farms as an alternative to rice.",
                    image: thumbnail,
                },
            ],
        };
    },
    created() {
        //this.getData();
    },
    computed: {},
    methods: {
        //   async getData() {
        //     const res = await fetch("/dynamic/homepage/about.json");
        //     const file = await res.json();
        //     const dataList = file.data;
        //     this.details = dataList;

        //     const resA = await fetch("/dynamic/homepage/numbers.json");
        //     const fileA = await resA.json();
        //     const dataListA = fileA.data;
        //     this.stats = dataListA;
        //   },
        slideChange(e) {
            this.activeIndex = e.activeIndex;
        },
    },
};
</script>

<style lang="scss" scoped>
.cd-headline {
    word-break: break-all;
}
.cd-headline.clip span {
    display: inline-block;
}

.cd-headline.clip .cd-words-wrapper {
    // overflow: hidden;
    vertical-align: top;
    word-break: break-all;
}

.cd-words-wrapper {
    display: inline-block;
    position: relative;
    text-align: left;
}

.cd-words-wrapper .is-typed {
    display: inline-block;
    position: absolute;
    white-space: nowrap;
    left: 0;
    top: 0;
}

:deep(.is-typed) {
    span.cursor {
        display: inline-block;
        width: 3px;
        background-color: #000000;
        animation: blink 1s infinite;
    }
    span.cursor.typing {
        animation: none;
    }
    @keyframes blink {
        49% {
            background-color: var(--text-m-white);
        }
        50% {
            background-color: transparent;
        }
        99% {
            background-color: transparent;
        }
    }
}

:deep(.swiper) {
    .swiper-wrapper {
        min-height: 285px;
        box-sizing: inherit;
    }
    .swiper-pagination {
        position: relative;
        text-align: left;
        // padding-right: 24px !important;
        // padding-left: 24px !important;
        @media screen and (max-width: 959px) {
            text-align: center;
            margin-top: 20px;
        }
    }
    .swiper-pagination-bullet {
        background: #9d9fa8;
    }
    .swiper-pagination-bullet-active {
        border: none;
        background: #606060;
    }
}

.img-holder {
    position: relative;
    border-radius: 10px;
    width: 100%;
    height: 100%;

    .img-placeholder {
        border-radius: 10px;
        z-index: 2;
    }

    .img-shadow {
        top: 0;
        left: 0;
        position: absolute;
        border-radius: 10px;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, #2196f3, #2196f3, #0e3955);
        transform: rotate(8deg);
        z-index: 1;
    }
}
</style>
