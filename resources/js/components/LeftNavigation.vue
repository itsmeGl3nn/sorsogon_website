<template>
    <v-navigation-drawer
        :rail="rail"
        permanent
        style="position: fixed"
        id="left-drawer-parent"
    >
        <v-list-item
            :title="`${profile.firstName} ${profile.lastName}`"
            :subtitle="profile.email"
            nav
        ></v-list-item>
        <v-divider></v-divider>

        <v-list density="compact" nav id="trigger-nav">
            <!-- CMS Section -->
            <v-list-item :class="`${rail && 'px-0'}`" v-if="canAccessCms">
                <v-card elevation="0" class="pa-0">
                    <v-card-text class="pa-0">
                        <div
                            class="d-flex justify-space-between align-center"
                            v-if="!rail"
                        >
                            <p>CMS</p>
                            <v-btn
                                :icon="
                                    show ? 'mdi-chevron-up' : 'mdi-chevron-down'
                                "
                                @click="show = !show"
                                size="x-small"
                                variant="text"
                            ></v-btn>
                        </div>
                        <div class="d-flex justify-center align-center" v-else>
                            <v-tooltip
                                :text="`${show ? 'Hide CMS' : 'Show CMS'}`"
                            >
                                <template v-slot:activator="{ props }">
                                    <v-btn
                                        :icon="
                                            show
                                                ? 'mdi-chevron-up'
                                                : 'mdi-chevron-down'
                                        "
                                        @click="show = !show"
                                        size="x-small"
                                        v-bind="props"
                                    ></v-btn>
                                </template>
                            </v-tooltip>
                        </div>
                    </v-card-text>
                    <v-expand-transition>
                        <div v-if="show">
                            <div id="left-nav-cms">
                                <template v-for="(item, i) in cmsData" :key="i">
                                    <v-list-item
                                        class="px-0"
                                        :title="item.title"
                                        data-aos="fade-right"
                                        data-aos-duration="600"
                                        :data-aos-delay="i * 100"
                                        data-aos-anchor="#trigger-nav"
                                        @click="$router.push(item.path)"
                                    >
                                        <v-tooltip
                                            activator="parent"
                                            location="end"
                                            v-if="rail"
                                            >{{ item.title }}</v-tooltip
                                        >
                                    </v-list-item>
                                </template>
                            </div>
                        </div>
                    </v-expand-transition>
                </v-card>
            </v-list-item>

            <!-- Other Tabs Based on Role -->
            <v-list-item
                v-if="canAccessAppointment"
                prepend-icon="mdi mdi-account-file"
                title="Appointment"
                value="appointment"
                @click="$router.push('/data-appointment')"
            ></v-list-item>
            <v-list-item
                v-if="canAccessComplaints"
                prepend-icon="mdi mdi-bell-alert-outline"
                title="Complaints"
                value="complaint"
                @click="$router.push('/data-complaint')"
            ></v-list-item>
            <v-list-item
                v-if="canAccessUsers"
                prepend-icon="mdi-account-group-outline"
                title="Users"
                value="users"
                @click="$router.push('/users')"
            ></v-list-item>

            <!-- Expand Button -->
            <v-list-item
                id="left-nav-resize"
                data-aos="fade-right"
                data-aos-duration="600"
                data-aos-delay="600"
                data-aos-anchor="#trigger-nav"
                :prepend-icon="rail ? 'mdi-chevron-right' : 'mdi-chevron-left'"
                title="Expand"
                value="expand"
                @click="rail = !rail"
            ></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import { Profile } from "../stores/profilestate.js";
import { computed, onMounted, ref } from "vue";

export default {
    setup() {
        const profileStore = Profile();

        const profile = computed(() => profileStore);
        const show = ref(false);
        const cmsData = ref([
            { title: "Home", type: "text", path: "/users" },
            { title: "About", type: "text", path: "/data-complaint" },
            { title: "News", type: "text", path: "/users" },
            { title: "Tourism Services", type: "text", path: "/users" },
            { title: "Help Center", type: "text", path: "/users" },
        ]);

        const userRole = computed(() => profileStore.role);

        // Role-based access logic
        const canAccessCms = computed(
            () =>
                userRole.value === "SUPER_ADMIN" ||
                userRole.value === "CONTENT_ADMIN"
        );
        const canAccessAppointment = computed(
            () =>
                userRole.value === "SUPER_ADMIN" ||
                userRole.value === "NORMAL_ADMIN"
        );
        const canAccessComplaints = computed(
            () =>
                userRole.value === "SUPER_ADMIN" ||
                userRole.value === "NORMAL_ADMIN"
        );
        const canAccessUsers = computed(() => userRole.value === "SUPER_ADMIN");

        onMounted(() => {
            profileStore.loadStorageData();
        });

        return {
            rail: false,
            profile,
            show,
            cmsData,
            canAccessCms,
            canAccessAppointment,
            canAccessComplaints,
            canAccessUsers,
        };
    },
};
</script>

<style lang="scss" scoped>
.v-list-item--density-default {
    min-height: 65px;
}
</style>
