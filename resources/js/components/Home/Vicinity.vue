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
                <iframe
                    title="Pilar Map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15536.243576513513!2d123.59780391473468!3d12.920196890880219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33ab5d7fca0e3f8f%3A0x108bc1b423fc96f2!2sPilar%2C%20Sorsogon!5e0!3m2!1sen!2sph!4v1696355070123!5m2!1sen!2sph"
                    class="map-class pl-md-1"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    data() {
        return {
            showMap: false, // Controls dialog visibility
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
