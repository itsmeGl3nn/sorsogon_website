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
                            PAMS
                        </div>
                        <div class="md-2 mb-lg-6 text-body-2 ml-1 text-white">
                            PILAR APPOINTMENT MANAGEMENT SYSTEM
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
                                        v-model="reasons"
                                        color="#FFFFF"
                                        placeholder="Type your Reason of Appointment Here"
                                        label="Reason of Appointment"
                                        row-height="25"
                                        rows="3"
                                        variant="outlined"
                                        auto-grow
                                        shaped
                                    ></v-textarea>
                                    <v-select
                                        v-model="department_office"
                                        :items="officeOptions"
                                        class="text-white"
                                        placeholder="Office Department"
                                        :rules="[
                                            (v) =>
                                                !!v ||
                                                'This field cannot be empty.',
                                        ]"
                                        variant="outlined"
                                        hide-details="auto"
                                    >
                                    </v-select>

                                    <v-select
                                        v-model="time"
                                        :items="timeOptions"
                                        placeholder="Time of Appointment"
                                        class="mt-5 text-white"
                                        :rules="[
                                            (v) =>
                                                !!v ||
                                                'This field cannot be empty.',
                                        ]"
                                        variant="outlined"
                                        hide-details="auto"
                                    >
                                    </v-select>

                                    <v-menu
                                        v-model="updatedMenu"
                                        :close-on-content-click="false"
                                        location="bottom"
                                    >
                                        <template #activator="{ props }">
                                            <v-text-field
                                                clearable
                                                @click:clear="clearDate"
                                                placeholder="Select Preferred Date"
                                                label="Select Preferred Date"
                                                v-model="formattedDate"
                                                prepend-inner-icon="mdi-calendar"
                                                flat
                                                class="mt-5 text-white"
                                                variant="outlined"
                                                color="#FFFFFF"
                                                v-bind="props"
                                            >
                                            </v-text-field>
                                        </template>

                                        <v-date-picker
                                            width="600"
                                            v-model="date"
                                            @update:model-value="formatDate"
                                        ></v-date-picker>
                                    </v-menu>
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

        <v-dialog
            v-model="successDialog"
            persistent
            max-width="600"
            height="550px"
        >
            <v-card>
                <v-card-text class="text-h5 text-green">
                    Your appointment has been successfully booked with the
                    following details:
                </v-card-text>
                <v-card-text>
                    <div><strong>First Name:</strong> {{ first_name }}</div>
                    <div><strong>Last Name:</strong> {{ last_name }}</div>
                    <div><strong>Address:</strong> {{ address }}</div>
                    <div><strong>Mobile Number:</strong> {{ mobile_num }}</div>
                    <div><strong>Email:</strong> {{ email }}</div>
                    <div><strong>Department Office:</strong> {{ department_office }}</div>
                    <div><strong>Time:</strong> {{ time }}</div>
                    <div><strong>Date:</strong> {{ formattedDate }}</div>
                    <div><strong>Reason:</strong> {{ reasons }}</div>
                </v-card-text>
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
            reasons: "",
            department_office: null,
            loading: false,
            mobile_num: "",
            time: null,
            updatedMenu: false,
            date: null,
            formattedDate: "",
            timeOptions: [
                "6:00AM-7:00AM",
                "7:00AM-8:00AM",
                "8:00AM-9:00AM",
                "9:00AM-10:00AM",
                "10:00AM-11:00AM",
                "11:00AM-12:00PM",
                "12:00PM-1:00PM",
                "1:00PM-2:00PM",
                "2:00PM-3:00PM",
                "3:00PM-4:00PM",
                "4:00PM-5:00PM",
            ],
            officeOptions: [
                "Office of the Mayor",
                "Office of the Vice-Mayor and Sangguniang Bayan",
                "Office of the Municipal Human Resource & Management",
                "Office of the Municipal Treasurer",
                "Office of the Municipal Assessor",
                "Office of the Municipal Accountant",
                "Office of the Municipal Budget Officer",
                "Office of the Municipal Planning and Dev't Coordinator",
                "Office of the Municipal Engineer",
                "Office of the Municipal Health Officer",
                "Office of the Municipal Civil Registrar",
                "Office of the Municipal Administrator",
                "Office of the Municipal Agriculturist",
                "Office of the Municipal Social Welfare and Dev't Officer",
                "Office of the Municipal Disaster Risk Reduction and Mgt. Officer",
                "Office of the Public Employment Services Office Manager",
                "Office of the Gender and Development",
                "Office of the Bids and Awards Committee",
            ],

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
        formatDate(val) {
            const selectedDate = new Date(val);
            const year = selectedDate.getFullYear();
            const month = String(selectedDate.getMonth() + 1).padStart(2, "0");
            const day = String(selectedDate.getDate()).padStart(2, "0");

            // Format the date as YYYY-MM-DD
            const formatted = `${year}-${month}-${day}`;
            this.date = val;

            this.formattedDate = formatted;
        },
        closeDialog() {
            this.successDialog = false;
            this.$router.push("/");
        },

        // resetForm() {
        //     this.first_name = "";
        //     this.last_name = "";
        //     this.address = "";
        //     this.mobile_num = "";
        //     this.email = "";
        //     this.reasons = "";
        //     this.time = "";
        //     this.date = null;
        //     this.formattedDate = "";
        // },
        // clearDate() {
        //     this.preferredDate = null;
        //     this.formattedDate = "";
        // },
        async getDate() {
            const res = await axios.get("/api/booked-appointment");
            this.tableData = res.data.data; // Assuming `tableData` contains existing appointments
        },

        async checkAvailability(date, time, departmentOffice) {
            // Fetch the latest booked appointments data
            await this.getDate();

            // Check if the selected date, time, and departmentOffice combination is already booked
            const isBooked = this.tableData.some(
                (appointment) =>
                    appointment.date === date &&
                    appointment.time === time &&
                    appointment.department_office === departmentOffice
            );

            return !isBooked; // Return true if the time slot is available for the department, false if it’s taken
        },

        async submit() {
            this.loading = true;

            if (this.$refs.form.validate()) {
                // Check if the time slot is available
                const isAvailable = await this.checkAvailability(
                    this.formattedDate,
                    this.time
                );

                if (!isAvailable) {
                    this.loading = false;
                    alert(
                        "The selected time slot is already booked. Please choose a different time."
                    );
                    return;
                }

                const formData = {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    address: this.address,
                    mobile_num: this.mobile_num,
                    email: this.email,
                    department_office: this.department_office,
                    time: this.time,
                    date: this.formattedDate,
                    reasons: this.reasons,
                };

                try {
                    const response = await axios.post(
                        "/api/book-appointment",
                        formData
                    );
                    this.loading = false;
                    this.successDialog = true;
                } catch (error) {
                    console.error("Error booking appointment:", error);
                    this.loading = false;
                }
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
