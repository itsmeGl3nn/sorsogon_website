<template>
    <div class="pt-12 pb-0 pb-md-12">
      <v-container>
        <h2
          class="text-h2 text-black font-weight-bold text-center text-md-left mb-10"
          data-aos="fade-up"
          data-aos-duration="1200"
        >
          {{ title }}
        </h2>
        <v-row>
          <v-col cols="12" md="6" class="col-desc">
            <div data-aos="fade-up" data-aos-duration="1200">
              <div
                :class="`text-body-1 text-base-font-black text-center text-md-left desc mb-2 ${
                  isExpanded && 'expanded'
                }`"
                v-html="description"
              ></div>
              <p
                class="text-body-1 text-center text-md-left read-more"
                @click="isExpanded = !isExpanded"
              >
                {{ isExpanded ? "Hide" : "Read More" }}
              </p>
            </div>
          </v-col>
          <v-col cols="12" md="6">
            <v-row
              class="pl-8"
              style="height: 100%; width: 100%"
              data-aos="fade-up"
              data-aos-duration="1200"
            >
              <v-col cols="12" sm="6">
                <div style="height: 100%; width: 100%">
                  <div class="box-img-1 mb-4">
                    <v-img cover :src="home" width="100%" height="100%"></v-img>
                  </div>
                  <div class="box d-flex justify-start align-center">
                    <!-- <div class="pa-4">
                      <h2 class="text-h2 text-primary font-weight-black mb-2">Over Two</h2>
                      <p class="text-body-2 text-font-black font-weight-bold">
                        Decades of <br />
                        Experience
                      </p>
                      <h1 class="text-h1 text-font-black font-weight-black">
                        {{ number }}
                      </h1>
                      <p
                        class="text-body-2 text-font-black font-weight-medium"
                        v-html="numberDesc"
                      ></p>
                    </div> -->
                  <!-- <v-img cover :src="story1" width="100%" height="100%"></v-img> -->
                  <v-img cover :src="map" width="100%" height="100%"></v-img>
                </div>
                </div>
              </v-col>
              <v-col cols="12" sm="6">
                <div class="box-img-2">
                  <v-img cover :src="thumbnail" width="100%" height="100%"></v-img>
                </div>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </template>

  <script>

  import thumbnail from "../../../assets/pilar.png";
  import home from "../../../assets/pichome.png";
  import map from "../../../assets/MapPilar.png";
  // import story1 from "@/assets/about/story-1.png";
  // import story2 from "@/assets/about/story-2.png";

  export default {
    data() {
      return {
        isExpanded: false,
        thumbnail,
        map,
        home,
        title: "Our Story",
        description: "Pilar grew out of one the first settlements established by the Spaniards in Luzon. After establishing the very first settlement in Gibalong (now Magallanes) in the later half of the 16th century, the Spanish expeditionary force headed by Capt. Luis de Guzman, together with Augustinian friars, Fray Alonzo Jimenez & Fray Juan Orta forged on inland. The group found the place hospitable enough that they decided to establish what became known as Abucay-Catamlangan Mission, which formed the core of what was to become the town of Pilar.<br/> The lucrative Manila-Acapulco galleon trade in 1600s resulted to the establishment of one the biggest & most important Spanish shipyards in Bagatao Island, Magallanes, and just across the Abucay-Catamlagan Mission. But being shipyard proved to be extremely vulnerable to the often-bloody Moro pirate raids. The Bagatao shipyards was raided & destroyed several times by the Moro raiders forcing the Spanish authorities & shipyard owners to look for safer sites for their shipbuilding activities. <br/> Pilar site was an alternative. It offered a safe harbor being inside Panlatuan Bay , an abundant supply of timber and abaca hemp, & native labor that could be conscripted to render a free labor. <br/> The abaca hemp worldwide export boom which lasted from 1820 to the closing years of the 19th century made the Bicol area very progressive. Albay was in fact the richest province the archipelago. Even after the galleon trade ended in 1850 the shipyards in Pilar continued operation. <br/> By 1833 what is now Pilar was then known as the Visista de Santo Niño established by the inhabitants from Donsol. Three decades later the villagers of Sto.Nino & Panlatuan including other adjoining smaller villages would formally petition for the declaration of their place as a separate and independent town from Cagsaua (now Daraga ) town of Albay. <br/> Pilar was declared a separate town on August 6, 1861, as a cluster of the visitas of Sto.Nino, Panlatuan, Ynang Putiao, Sapa & Candanlogan that together met the minimum requirement of at least 500 tribute-payers.It was named Pilar in honor of the newborn princess. Pilar, daughter of Spanish King Philip | | & Queen Isabela |. <br/> A year later the town became a full-pledged parish, with Our Lady of the Pillar as its titular. Pilar became town of Sorsogon after the latter was declared a separate province in 1984.",
        // number: "12",
        // numberDesc: "12",
        // story1,
        // story2,
      };
    },
    // async created() {
    //   const res = await fetch("/dynamic/about/story.json");
    //   const file = await res.json();
    //   const dataList = file.data;
    //   // console.log(dataList[0], 'sdasf');
    //   this.title = dataList[0].ourStory;
    //   this.description = dataList[0].storyDescription;
    //   this.number = dataList[0].number;
    //   this.numberDesc = dataList[0].numberDescription;
    // },
  };
  </script>

  <style lang="scss" scoped>
  .col-desc {
    border-right: 1px solid #646464;
    @media screen and (max-width: 959px) {
      border: none;
    }
    .desc {
      max-height: 19.5em;
      overflow: hidden;
      &.expanded {
        max-height: 100%;
      }
    }
    .read-more {
      color: #02bbff;
      text-decoration: underline;
      cursor: pointer;
    }
  }
  .box-img-1 {
    width: 100%;
    height: 60%;

    // background-color: yellow;
    @media screen and (max-width: 959px) {
      height: 350px;
    }
  }
  .box-img-2 {
    width: 100%;
    height: 100%;
    background-color: black;
    @media screen and (max-width: 959px) {
      height: 500px;
    }
  }
  .box {
    // width: 100%;
    height: 37%;
    border: 2px solid #e83a8a;
    @media screen and (max-width: 959px) {
      height: 150px;
    }
  }
  </style>
