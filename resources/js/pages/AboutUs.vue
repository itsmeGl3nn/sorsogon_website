<template>
    <BannerAbout />
    <AboutUs/>
    <MissionVission/>
</template>
<script>
import BannerAbout from '@/components/AboutUs/Banner.vue';
import AboutUs from '@/components/AboutUs/AboutUs.vue';
import MissionVission from '@/components/AboutUs/MissionAndVision.vue';

export default {
    components: {
        BannerAbout,
        AboutUs,
        MissionVission
    }
};
</script>
