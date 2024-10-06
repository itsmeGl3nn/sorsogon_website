<template>
    <BannerHome />
    <NewsList/>
</template>
<script>
import BannerHome from '@/components/Home/Banner.vue';
import NewsList from '../components/News/NewsList.vue';

export default {
    components: {
        BannerHome,
        NewsList
    }
};
</script>
