<template>
    <BannerHome />
    <Services />
    <LineAgencies/>
</template>
<script>
import BannerHome from '@/components/E-Services/Banner.vue';
import Services from '@/components/E-Services/ServicesProducts.vue';
import LineAgencies from '@/components/E-Services/LineAgencies.vue';

export default {
    components: {
        BannerHome,
        Services,
        LineAgencies
    }
};
</script>
