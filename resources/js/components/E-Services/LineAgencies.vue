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
                        class="d-flex justify-space-between pa-2"
                    >
                        <div class="d-flex flex-column">
                            <div class="py-6">
                                <v-img
                                    height="120"
                                    width="190"
                                    contain
                                    :src="item.icon"
                                    position="left"
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
                                    <strong>Contact Person:</strong>
                                    {{ item.contactPerson }}
                                </p>
                                <p>
                                    <strong>Contact No.:</strong>
                                    {{ item.contactNo }}
                                </p>
                                <p><strong>Email:</strong> {{ item.email }}</p>
                                <p>
                                    <strong>Office Address:</strong>
                                    {{ item.officeAddress }}
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
import dilg from "../../../assets/new/dilg.png";
import pao from "../../../assets/new/pao.png";
import postal from "../../../assets/new/post.png";
import dar from "../../../assets/new/dar.png";
import comelec from "../../../assets/new/comelec.png";
import water from "../../../assets/new/water.png";
import marine  from "../../../assets/new/maritime.png";
import court from "../../../assets/new/court.png";
export default {
    name: "WhyChooseUs",
    component: [],
    data() {
        return {
            headline: "GOVERNMENT",
            subTitle: "Local Line Agencies",
            chooseus: [
                {
                    title: "Department of the Interior and Local Government",
                    contactPerson: "Edcela L. Gubia",
                    contactNo: "09301083758",
                    email: "dilg5pilar@gmail.com",
                    officeAddress: "Brgy. Banuyo, Pilar, Sorsogon",
                    icon: dilg, // Replace with actual image URL
                },
                {
                    title: "Public Attorney's Office",
                    contactPerson: "Atty. Dulcisimo Marana Jr.",
                    contactNo: "09205301185",
                    email: "pao_pilar@yahoo.com",
                    officeAddress: "Brgy. Banuyo, Pilar, Sorsogon",
                    icon: pao,
                },
                {
                    title: "Postal Corp.",
                    contactPerson: "Amanda Alvares (OIC)",
                    contactNo: "09121534826",
                    email: "",
                    officeAddress: "Brgy. Banuyo, Pilar, Sorsogon",
                    icon: postal,
                },
                {
                    title: "Municipal Agrarian Reform Office",
                    contactPerson: "Alvin M. Luces",
                    contactNo: "09171493826",
                    email: "maropilar.sor@gmail.com",
                    officeAddress: "Brgy. Banuyo, Pilar, Sorsogon",
                    icon: dar,
                },
                {
                    title: "COMELEC Office",
                    contactPerson: "Ma. Claire S. Laceda",
                    contactNo: "09487995791",
                    email: "oeo_comelec_pilarsorsogon@gmail.com",
                    officeAddress: "Brgy. Banuyo, Pilar, Sorsogon",
                    icon: comelec,
                },
                {
                    title: "Pilar Water District Office",
                    contactPerson: "Clouie Ann F. Capati",
                    contactNo: "09462928265",
                    email: "pilarwaterdistrict@yahoo.com",
                    officeAddress: "Brgy. Marifosque, Pilar, Sorsogon",
                    icon: water,
                },
                {
                    title: "Pilar MPP-PNP Maritime Group",
                    contactPerson: "PMAJ Lawrence Martinez",
                    contactNo: "09989707303",
                    email: "marpol_sorsogon@yahoo.com",
                    officeAddress: "Brgy. Binanuahan, Pilar, Sorsogon",
                    icon: marine,
                },
                {
                    title: "Municipal Trial Court",
                    contactPerson: "Edna Millano",
                    contactNo: "09193352931",
                    email: "mtc2plrOOO@judiciary.gov.ph",
                    officeAddress: "Brgy. Binanuahan, Pilar, Sorsogon",
                    icon: court,
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
