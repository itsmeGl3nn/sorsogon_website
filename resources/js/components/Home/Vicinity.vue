<template>
    <div class="bg-container">
        <v-container class="py-md-10 py-6">
            <v-row>
                <v-col cols="12" md="12">
                    <div
                        class="py-12 mt-4 d-flex align-center justify-center text-md-h2 text-white text-h4 font-weight-bold"
                    >
                        PILAR SORSOGON MAP
                    </div>
                    <div class="d-flex justify-center">
                        <v-btn
                            height="50"
                            size="x-large"
                            class="bg-white text-body-2 font-weight-medium rounded-xl"
                            variant="outlined"
                            color="black"
                            @click="showMap = true"
                        >
                            VIEW VICINITY
                        </v-btn>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </div>

    <v-dialog v-model="showMap" max-width="1000px">
        <v-card>
            <v-card-actions class="d-flex justify-end">
                <v-btn icon @click="showMap = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-card-actions>
            <div class="pt-8 pb-8 map-container">
                <v-img :src="map">

                </v-img>
            </div>
        </v-card>
    </v-dialog>
</template>

<script>
import map from "../../../assets/MapPilar.png";
export default {
    data() {
        return {
            showMap: false,
            map // Controls dialog visibility
        };
    },
};
</script>

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

.map-container {
    height: 500px;

    @media only screen and (max-width: 1024px) {
      height: unset;
      margin-bottom: 5px;
    }

    .map-class {
      width: 100%;
      height: 100%;
      min-height: 200px;
      border: 0;
      border-radius: 12px;
    }
  }
</style>
