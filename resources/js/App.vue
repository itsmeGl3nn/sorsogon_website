<template>
    <v-app>
        <v-layout full-height style="overflow: unset;">

      <router-view name="left-nav"></router-view>

      <v-main style="height: 250px">
        <router-view name="top-nav"></router-view>
        <router-view ></router-view>

      </v-main>
    </v-layout>
    </v-app>
</template>

<script>
import { Profile } from './stores/profilestate';

export default {
name: 'App',
  created() {
    const profileStore = Profile();
    profileStore.loadStorageData();
  }
};
</script>
