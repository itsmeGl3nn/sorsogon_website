<template>
    <div class="bg-class h-120 w-120" :style="backgroundStyle">
        <v-container class="py-md-8 py-4 h-100">
            <v-row>

                <v-col col="12" md="6">
                    <v-card
                        min-height="600px"
                        class="primary-gradient-bg pa-5 pa-sm-10 pa-md-12 pa-lg-16"
                    >
                        <div
                            class="text-h4 text-md-3 text-white font-weight-bold"
                        >
                            PCMS
                        </div>
                        <div class="md-2 mb-lg-6 text-body-2 ml-1 text-white">
                            PILAR COMPLAINT MANAGEMENT SYSTEM
                        </div>
                        <v-form ref="form" v-model="formValid">
                            <v-row>
                                <v-col cols="12" md="12">
                                    <v-text-field
                                        v-model="first_name"
                                        label="First Name"
                                        placeholder="Type your First Name"
                                        flat
                                        variant="outlined"
                                        color="#FFFFF"
                                        rounded="lg"
                                        id="first_name"
                                        class="mt-5 text-white"
                                        :rules="[
                                            (v) =>
                                                !!v ||
                                                'This field cannot be empty.',
                                        ]"
                                        hide-details="auto"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="last_name"
                                        label="Last Name"
                                        placeholder="Type your Last Name"
                                        flat
                                        variant="outlined"
                                        color="#FFFFF"
                                        rounded="lg"
                                        id="last_name"
                                        class="mt-5 text-white"
                                        :rules="[
                                            (v) =>
                                                !!v ||
                                                'This field cannot be empty.',
                                        ]"
                                        hide-details="auto"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="address"
                                        label="Address"
                                        placeholder="Type your Address"
                                        flat
                                        variant="outlined"
                                        color="#FFFFF"
                                        rounded="lg"
                                        id="address"
                                        class="mt-5 text-white"
                                        :rules="[
                                            (v) =>
                                                !!v ||
                                                'This field cannot be empty.',
                                        ]"
                                        hide-details="auto"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="mobile_num"
                                        label="Mobile Number"
                                        placeholder="Type your Mobile Number"
                                        flat
                                        variant="outlined"
                                        color="#FFFFF"
                                        rounded="lg"
                                        id="mobile_num"
                                        class="mt-5 text-white"
                                        :rules="[
                                            (v) =>
                                                !!v ||
                                                'This field cannot be empty.',
                                            (v) =>
                                                /^\d{11}$/.test(v) ||
                                                'Please enter a valid phone number',
                                        ]"
                                        hide-details="auto"
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="email"
                                        label="Email"
                                        placeholder="Type your Email Address"
                                        flat
                                        variant="outlined"
                                        color="#FFFFF"
                                        rounded="lg"
                                        id="email"
                                        class="mt-5 text-white"
                                        :rules="[
                                            (v) =>
                                                !v ||
                                                /^[\w+.-]*@[\w+.-]*\.[\w]{2,3}$/.test(
                                                    v
                                                ) ||
                                                'Please enter a valid email',
                                        ]"
                                        hide-details="auto"
                                    ></v-text-field>

                                    <v-textarea
                                        class="mt-5 text-white"
                                        v-model="complaint"
                                        color="#FFFFF"
                                        placeholder="Type your Complaint Here"
                                        label="Complaint"
                                        row-height="25"
                                        rows="3"
                                        variant="outlined"
                                        auto-grow
                                        shaped
                                    ></v-textarea>
                                    <v-file-input
                                        color="#FFFFF"
                                        variant="outlined"
                                        rounded="lg"
                                        class="mt-5 text-white"
                                        v-model="proof"
                                        label="Upload proof image"
                                        accept="image/*"
                                    ></v-file-input>
                                </v-col>
                            </v-row>
                            <div class="d-flex justify-center pt-6">
                                <v-btn
                                    width="200"
                                    height="50"
                                    size="x-large"
                                    class="text-body-2 font-weight-bold bg-white"
                                    variant="outlined"
                                    color="black"
                                    :disabled="!formValid || loading"
                                    :loading="loading"
                                    @click="submit"
                                    >Submit</v-btn
                                >
                            </div>
                        </v-form>
                    </v-card>
                </v-col>
                <v-col col="12" md="6">
                    <!-- <div class="text-h3 text-white pt-4">
                        REPORT A COMPLAINT
                    </div>
                    <div class="text-body-2 pt-4 text-white">
                        The Municipality of Pilar, Sorsogon is committed to providing excellent service to our
                        residents. To
                        achieve this, we have implemented a Complaint Management System. This system allows residents to
                        easily report issues and concerns they encounter within the municipality. By logging a
                        complaint,
                        you're helping us identify areas for improvement and ensure a safe and enjoyable community for
                        everyone.
                    </div> -->
                </v-col>
            </v-row>
        </v-container>
        <v-dialog v-model="successDialog" persistent max-width="600" height="300px">
            <v-card>
                <v-card-title class="headline text-h3 text-green">Success</v-card-title>
                <v-card-text class="text-h5"
                    >Your Complaint has been successfully added.</v-card-text
                >
                <v-card-actions>
                    <v-btn color="primary" @click="closeDialog">OK</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
import backgroundImage from "/resources/assets/bgget.png";
import axios from "axios";

export default {
    data() {
        return {
            backgroundImage,
            formValid: false,
            first_name: "",
            last_name: "",
            address: "",
            email: "",
            proof: "",
            complaint: "",
            loading: false,
            mobile_num: "",
            successDialog: false,
        };
    },
    computed: {
        backgroundStyle() {
            return {
                background: `linear-gradient(to right, rgba(10, 0, 255, 0.2), rgba(20, 0, 255, 0.2), rgba(20, 0, 255, 0.2), rgba(20, 0, 255, 0)), url(${this.backgroundImage})`,
                backgroundSize: "cover",
            };
        },
    },
    methods: {
        closeDialog() {
            this.successDialog = false;
            this.resetForm();
            this.$router.push("/");
        },

        resetForm() {
            // Clear form data
            this.first_name = "";
            this.last_name = "";
            this.address = "";
            this.mobile_num = "";
            this.email = "";
            this.complaint = "";
            this.proof= "";
        },
        async submit() {
            this.loading = true;
            if (this.$refs.form.validate()) {
                const formData = {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    address: this.address,
                    mobile_num: this.mobile_num,
                    email: this.email,
                    proof: this.proof,
                    complaint: this.complaint,
                };

                const response = await axios.post("/api/complaints", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.loading = false;
                this.successDialog = true;

            } else {
                this.loading = false;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
$xm-breakpoint: 600px;

.section-class {
    height: 100vh;
    position: relative;

    .bg-class {
        background-size: cover !important;
        background-repeat: no-repeat !important;

        @media screen and (max-width: $xm-breakpoint) {
            background-size: cover !important;
        }
    }

    @media screen and (max-width: $xm-breakpoint) {
        height: 370px;
    }
}

.primary-gradient-bg {
    background: transparent linear-gradient(114deg, #0d2c96 0%, #306e8a) !important;
}
</style>
