<template>
    <BannerHome />
    <NewsList/>
    <Pilarmap/>
</template>
<script>
import BannerHome from '@/components/Home/Banner.vue';
import NewsList from '../components/News/NewsList.vue';

import Pilarmap from '@/components/Home/Vicinity.vue';
export default {
    components: {
        BannerHome,
        NewsList,
        Pilarmap
    }
};
</script>
