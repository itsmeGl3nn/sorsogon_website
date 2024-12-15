<template>
    <BannerHome />
    <MayorsCorners />
    <Pilarmap/>
    <NewsList/>
    <Emergency/>
</template>
<script>
import BannerHome from '@/components/Home/Banner.vue';
import MayorsCorners from '@/components/Home/MayorsCorner.vue';
import Pilarmap from '@/components/Home/Vicinity.vue';
import NewsList from '../components/Home/NewsListHome.vue';
import Emergency from '../components/Home/EmegencyHotline.vue';

export default {
    components: {
        BannerHome,
        MayorsCorners,
        Pilarmap,
        NewsList,
        Emergency
    }
};
</script>
