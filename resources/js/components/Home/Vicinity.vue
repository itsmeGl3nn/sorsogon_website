<template>
    <div class="bg-container">
        <v-container class="py-md-10 py-6">
            <v-row class="">
                <v-col cols="12" md="12">
                    <div
                        class="py-12 mt-4 d-flex align-center justify-center text-md-h2 text-white text-h4 font-weight-bold"
                    >
                        PILAR SORSOGON MAP
                    </div>
                    <div class="d-flex justify-center">
                        <a href="/mayors-corner">
                            <v-btn
                                height="50"
                                size="x-large"
                                class="bg-white text-body-2 font-weight-medium rounded-xl"
                                variant="outlined"
                                color="black"
                                >VIEW VICINITY</v-btn
                            >
                        </a>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script></script>

<style lang="scss" scoped>
.bg-container {
    background: linear-gradient(
            90deg,
            rgba(0, 0, 0, 0.54),
            rgba(255, 255, 255, 0.2)
        ),
        url("/resources/assets/map.jpg") no-repeat center center;
    background-size: cover;
    height: 60vh;
}
</style>
