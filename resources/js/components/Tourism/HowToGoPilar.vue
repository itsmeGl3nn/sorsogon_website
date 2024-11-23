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
              <div class="text-primary text-h5">{{ item.content }}</div>
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

  export default {
    components: { TitleCombo },
    data() {
      return {
        dataList: [
          {
            content: "From Manila by Air: Take Philippine Airlines or Cebu Pacific to Legazpi City, then an air-conditioned van to Pilar (50 minutes). Alternatively, take Asean Spirit or Cebu Pacific to Masbate City, followed by the 9:30 AM Montenegro Fast Craft trip to Pilar.",
            image: "https://via.placeholder.com/300x200.png?text=Manila+to+Pilar",
          },
          {
            content: "From Manila by Land: From Araneta Center Bus Terminal in Cubao, Quezon City, take buses that directly travel to Pilar. Similar options are available from Pasay City Bus Terminal.",
            image: "https://via.placeholder.com/300x200.png?text=Manila+Bus+to+Pilar",
          },
          {
            content: "From Cebu City by Air: Fly Cebu Pacific from Mactan International Airport to Legazpi City, then take a van ride to Pilar.",
            image: "https://via.placeholder.com/300x200.png?text=Cebu+to+Pilar",
          },
          {
            content: "From Cebu City by Sea: Take Roro from Bogo, Cebu to Cataingan or Cawayan in Masbate. From there, take Roro or Fastcraft to Pilar.",
            image: "https://via.placeholder.com/300x200.png?text=Cebu+Roro+to+Pilar",
          },
          {
            content: "From Roxas City by Sea: Take a passenger outrigger from Roxas City Port to Milagros, Balod, or Mandaon in Masbate. Then transfer to a van for a one-hour trip to Pilar.",
            image: "https://via.placeholder.com/300x200.png?text=Roxas+City+to+Pilar",
          },
        ],
      };
    },
  };
  </script>

  <style lang="scss" scoped>
  .bg-get {
    background-image: url("../../../assets/bgget.png");
    background-position: right center;
  }
  </style>
