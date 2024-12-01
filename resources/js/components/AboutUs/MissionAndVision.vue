<template>
    <div class="pt-12 pb-0 pb-md-12">
      <v-container>
        <v-row>
          <v-col cols="12" md="6" data-aos="fade-up" data-aos-duration="1200">
            <v-img cover :src="thumbnail">
              <div
                class="d-flex justify-center align-center"
                style="height: 100%; width: 100%"
              >
                <!-- <div
                  class="circle"
                  @click="
                    dialog = true;
                    size = [window.innerWidth, window.innerHeight];
                  "
                >
                  <div class="blur d-flex align-center justify-center pa-8 pa-md-16">
                    <v-icon color="white" size="100px" class="icon-play">mdi-play</v-icon>
                  </div>
                </div> -->
              </div>
            </v-img>
          </v-col>
          <v-col cols="12" md="6">
            <div>
              <h2
                class="text-h2 text-black font-weight-bold mb-2"
                data-aos="fade-up"
                data-aos-duration="1200"
              >
                Mission and Vission
              </h2>
              <p
                class="text-body-1 text-base-font-black lh-45 mb-5"
                data-aos="fade-up"
                data-aos-duration="1200"
              >
                {{ datas.missionVisionDescription }}
              </p>
              <div>
                <div class="d-flex mb-8" data-aos="fade-up" data-aos-duration="1200">
                  <span class="icon-wrapper">
                    <v-icon size="x-large" icon="mdi-numeric-1" color="#02BBFF"></v-icon>
                  </span>
                  <div class="pl-4">
                    <p class="font-custom-body text-font-black font-weight-bold">
                      {{ datas.missionHeadline }}
                    </p>
                    <p class="text-body-1 text-base-font-black lh-45">
                      {{ datas.missionDescription }}
                    </p>
                  </div>
                </div>
                <div class="d-flex" data-aos="fade-up" data-aos-duration="1200">
                  <span class="icon-wrapper">
                    <v-icon size="x-large" icon="mdi-numeric-2" color="#02BBFF"></v-icon>
                  </span>
                  <div class="pl-4">
                    <p class="font-custom-body text-font-black font-weight-bold">
                      {{ datas.visionHeadline }}
                    </p>
                    <p class="text-body-1 text-base-font-black lh-45">
                      {{ datas.visionDescription }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </v-col>
<!--
          <v-dialog v-model="dialog" width="auto" fullscreen="" class="px-0">
            <v-card>
              <v-card-text>
                <object
                  data="https://www.youtube.com/embed/q8v9uXRxkiw?autoplay=1"
                  :width="size[0] - 50"
                  :height="size[1] - 100"
                ></object>
              </v-card-text>
              <v-card-actions>
                <v-btn color="primary" block @click="dialog = false">Close Video</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog> -->
        </v-row>
      </v-container>
    </div>
  </template>

  <script>
  import thumbnail from "/resources/assets/maxresdefault.jpg";

  export default {
    data() {
      return {
        thumbnail,
        dialog: false,
        size: [],
        datas: {
          missionVisionHeadline: "",
          missionVisionDescription: "",
          missionHeadline: "Mission",
          missionDescription: "To uplift the quality of life of pilareños thorugh excelent local goveenance, futher development of a well-equipped municipal port, eco-tourism, agri-based industry and human resources with active participation of all stakeholders.",
          visionHeadline: "Vission",
          visionDescription: "A center of excelence in local governance and an ideal transhipment point  with empowered  people living in a life-enhancing  evironment guided by devine providence.",
        },
      };
    },
    mounted() {
      window.onresize = () => {
        this.size = [window.innerWidth, window.innerHeight];
      };
      this.size = [window.innerWidth, window.innerHeight];
    },
    // async created() {
    //   const res = await fetch("/dynamic/about/mission.json");
    //   const file = await res.json();
    //   const dataList = file.data;
    //   this.datas.missionVisionHeadline = dataList[0].missionVisionHeadline || "";
    //   this.datas.missionVisionDescription = dataList[0].missionVisionDescription || "";
    //   this.datas.missionHeadline = dataList[0].missionHeadline || "";
    //   this.datas.missionDescription = dataList[0].missionDescription || "";
    //   this.datas.visionHeadline = dataList[0].visionHeadline || "";
    //   this.datas.visionDescription = dataList[0].visionDescription || "";
    // },
  };
  </script>

  <style lang="scss" scoped>
  .icon-wrapper {
    height: 25px;
    width: 25px;
    border: 1px solid #02bbff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .placeholder-box {
    height: 400px;
    min-width: 300px;
    max-width: 500px;
    background: #111215;
    @media screen and (max-width: 959px) {
      max-width: 100%;
    }
  }

  .v-responsive__content {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .icon-play {
    &:hover {
      cursor: pointer;
    }
  }
  </style>
