<template>
    <BannerHome />
    <OurOfficer/>
    <MayorsCorners />
    <NewsList/>
</template>
<script>
import BannerHome from '@/components/Home/Banner.vue';
import MayorsCorners from '@/components/Home/MayorsCorner.vue';
import OurOfficer from '@/components/OurOffices/OurOfficer.vue';
import NewsList from '../components/Home/NewsListHome.vue';

export default {
    components: {
        BannerHome,
        MayorsCorners,
        OurOfficer,
        NewsList
    }
};
</script>
