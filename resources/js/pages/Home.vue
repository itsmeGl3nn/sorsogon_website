<template>
    <BannerHome />
    <MayorsCorners />
    <Pilarmap/>
    <NewsList/>
</template>
<script>
import BannerHome from '@/components/Home/Banner.vue';
import MayorsCorners from '@/components/Home/MayorsCorner.vue';
import Pilarmap from '@/components/Home/Vicinity.vue';
import NewsList from '../components/Home/NewsListHome.vue';

export default {
    components: {
        BannerHome,
        MayorsCorners,
        Pilarmap,
        NewsList
    }
};
</script>
