<template>
    <v-row class="pa-4">
      <v-col cols="12" md="12">
        <ArchiveComplaint></ArchiveComplaint>
      </v-col>
    </v-row>
  </template>

  <script>
  import ArchiveComplaint from '../components/ArchiveComplaint.vue';
import DataList from '../components/DataList.vue'

  export default {
    components: {
        ArchiveComplaint,
    },
    computed: {

    },
    mounted() {
      console.log("Mounted Test")
    }
  }
  </script>
