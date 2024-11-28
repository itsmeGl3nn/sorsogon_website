<template>
    <BannerAbout />
    <About/>
    <MissionVission/>
    <OurStory/>
</template>
<script>
import BannerAbout from '@/components/AboutUs/Banner.vue';
import About from '@/components/AboutUs/About.vue';
import MissionVission from '@/components/AboutUs/MissionAndVision.vue';
import OurStory from '@/components/AboutUs/OurStory.vue';

export default {
    components: {
        BannerAbout,
        About,
        MissionVission,
        OurStory
    }
};
</script>
