<template>
    <div class="bg-get pb-12">
      <v-container>
        <v-row class="py-12">
          <v-col cols="12" md="12">
            <TitleCombo main="Get to Pilar: Your Travel Options" main-color="black"></TitleCombo>
          </v-col>
        </v-row>
        <template v-for="(item, i) in dataList" :key="i">
          <v-row style="overflow-x: hidden" :class="{
            'flex-sm-row-reverse': (i + 1) % 2
          }" class="py-2">
            <v-col cols="12" md="7" :data-aos="(i + 1) % 2 ? 'fade-left' : 'fade-right'" data-aos-duration="1200" :data-aos-delay="200 * (i + 1)">
              <div class="text-primary text-h5">{{ item.desc }}</div>
            </v-col>
            <v-col cols="12" md="5" :data-aos="(i + 1) % 2 ? 'fade-right' : 'fade-left'" data-aos-duration="1200" :data-aos-delay="200 * (i + 1)">
              <v-img class="rounded-lg" :src="item.image"></v-img>
            </v-col>
          </v-row>
        </template>
      </v-container>
    </div>
  </template>

  <script>
  import TitleCombo from '@/components/staples/TitleCombo.vue';
  import axios from 'axios'; // Ensure axios is imported

  export default {
    components: { TitleCombo },
    data() {
      return {
        dataList: [], // The data to display
      };
    },
    mounted() {
      // Fetch the tourism data when the component is mounted
      this.getTourism();
    },
    methods: {
      async getTourism() {
        try {
          const res = await axios.get("/api/tourism"); // API request to fetch tourism data
          if (res.data && res.data.data) {
            this.dataList = res.data.data; // Set the dataList with the fetched data
          }
        } catch (error) {
          console.error("Error fetching tourism data:", error);
        }
      },
    },
  };
  </script>

  <style lang="scss" scoped>
  .bg-get {
    background-image: url("../../../assets/bgget.png");
    background-position: right center;
  }
  </style>
