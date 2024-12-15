<template>
    <v-container class="container-y">
        <div class="text-start text-md-center">
            <div class="text-secondary text-h6 font-weight-bold mb-2">
                {{ headline }}
            </div>
            <div
                class="text-primary text-h5 text-primary text-lg-h4 text-xl-h2 font-weight-medium mb-4"
            >
                {{ subTitle }}
            </div>
        </div>
        <v-row no-gutters class="justify-center mt-4 my-t-12">
            <v-col
                cols="12"
                sm="12"
                md="4"
                class="d-flex justify-center justify-space-evenly"
                data-aos="fade-up"
                data-aos-duration="1200"
                data-aos-delay="800"
                v-for="(item, index) in chooseus"
                :key="index"
            >
                <div>
                    <v-card
                        :width="300"
                        flat
                        v-resize="sendHeight"
                        class="d-flex justify-space-evenly pa-2"
                    >
                        <div class="d-flex flex-column">
                            <div class="py-6">
                                <v-img
                                    height="120"
                                    width="190"
                                    contain
                                    :src="item.icon"
                                    position="center"
                                    class="mx-auto"
                                    :alt="`${item.title} image`"
                                ></v-img>
                            </div>
                            <div
                                class="text-body-large text-md-subtitle-2 font-weight-medium pb-2"
                            >
                                {{ item.title }}
                            </div>
                            <div class="text-body-2">

                                <p>
                                    <strong>Contact No.:</strong>
                                    {{ item.contactNo }}
                                </p>
                            </div>
                        </div>
                    </v-card>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import temp1 from "../../../assets/new/bfp.gif";
import temp2 from "../../../assets/new/health.gif";
import temp3 from "../../../assets/new/mdrrm.gif";
import temp4 from "../../../assets/new/pnp.gif";
import temp5 from "../../../assets/new/mayors.gif";
import temp6 from "../../../assets/new/pcg.gif";

export default {
    name: "WhyChooseUs",
    component: [],
    data() {
        return {
            headline: "Emegency Hotline",
            chooseus: [
                {
                    title: "Pilar Fire Station (BFP)",
                    contactNo: "0946-340-6968",
                    icon: temp1,
                },
                {
                    title: "Pilar Health Unit",
                    contactNo: "0931-056-2572",
                    icon: temp2, // Add icon if available
                },
                {
                    title: "Pilar MDRRM Office",
                    contactNo: "0947-813-3933",
                    icon: temp3, // Add icon if available
                },
                {
                    title: "Pilar Police (PNP)",
                    contactNo: "0998-598-6070",
                    icon: temp4, // Add icon if available
                },
                {
                    title: "Mayor's Office",
                    contactNo: "0981-017-8391 / (056)2113828",
                    icon: temp5, // Add icon if available
                },
                {
                    title: "Philippine Coast Guard",
                    contactNo: "0921-417-3765",
                    icon: temp6, // Add icon if available
                },
            ],
            divHeights: [],
        };
    },
    computed: {
        highestDivHeight() {
            const numbers = this.divHeights;
            return Math.max(...numbers);
        },
    },
    mounted() {
        this.sendHeight();
    },
    methods: {
        sendHeight() {
            this.$nextTick(() => {
                const ref = this.$refs.contentRef;
                if (ref) {
                    this.$emit("divHeight", ref.clientHeight);
                }
            });
        },
    },
};
</script>

<style></style>
