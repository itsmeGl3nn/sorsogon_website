<template>
    <div class="bg-container">
        <v-container class="py-md-10 py-6">
            <v-row>
                <v-col cols="12" md="6">
                    <div>
                        <v-img class="mayor-core" :src="mayorcorners"></v-img>
                    </div>
                </v-col>
                <v-col cols="12" md="6">
                    <div class="d-flex justify-center flex-column text-white pt-md-12 pt-6">
                        <div
                            class="text-center py-6 py-md-12 text-md-h2 text-h4 font-weight-bold"
                        >
                            THE <br />
                            MAYOR'S CORNER
                        </div>
                        <div class="d-flex justify-center">
                        <a href="/mayors-corner">
                        <v-btn
                                height="50"
                                size="x-large"
                                class="text-body-2 font-weight-medium rounded-xl"
                                variant="outlined"
                                color="white"
                                >GO TO THE MAYOR'S CORNER</v-btn
                            >
                    </a>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
<script setup>
import { ref } from "vue";
import mayor3 from "/resources/assets/Mayor_Homepage.png";

const mayorcorners = ref(mayor3);
</script>

<style lang="scss" scoped>
.bg-container {
    background: url("/resources/assets/mayors-corner-bg-50.jpg");
}
</style>
