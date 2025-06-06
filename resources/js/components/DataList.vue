<template>
    <v-card class="pa-4">
        <div class="d-flex align-center">
            <v-row>
                <v-col cols="12">
                    <div class="d-flex justify-space-between align-center">
                        <h2 class="text-h4">List of Complaints</h2>
                        <div>
                            <v-btn
                                color="primary"
                                @click="openArchive"
                                >Archive</v-btn
                            >
                        </div>
                    </div>
                </v-col>
            </v-row>
        </div>

        <!-- Data Table to show the paginated items -->
        <v-table id="anchor-dataset-list" class="mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Complaint</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Proof</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(item, index) in paginatedItems" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.first_name }}</td>
                    <td>{{ item.last_name }}</td>
                    <td>{{ item.address }}</td>
                    <td>{{ item.complaint }}</td>
                    <td>{{ item.mobile_num }}</td>
                    <td>{{ item.email }}</td>
                    <td>
                        <img
                            :src="item.proof"
                            alt="Image"
                            width="250"
                            height="250"
                        />
                    </td>
                    <!-- <td class="status">On Going</td> -->
                    <td>
                        <v-col>
                            <v-icon color="blue" @click="editItem(index)"
                                >mdi-eye-outline</v-icon
                            >
                            <v-icon color="red" @click="deleteItem(item.id, index)">mdi-delete</v-icon>
                        </v-col>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <div class="ma-5">
            <v-row>
                <v-col cols="11">
                    <v-pagination
                        v-model="currentPage"
                        :length="totalPages"
                        @input="handlePageChange"
                        rounded="circle"
                    ></v-pagination>
                </v-col>
            </v-row>
        </div>

        <v-dialog v-model="isArchiveModalOpen" max-width="1200px">
        <v-card >
            <v-card-title>
                <span class="text-h5">Archived Complaints</span>
                <v-spacer></v-spacer>
                <v-btn icon @click="closeArchiveModal">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Complaint</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in archivedComplaints" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item.first_name }}</td>
                            <td>{{ item.last_name }}</td>
                            <td>{{ item.address }}</td>
                            <td>{{ item.complaint }}</td>
                            <td>{{ item.mobile_num }}</td>
                            <td>{{ item.email }}</td>
                        </tr>
                    </tbody>
                </table>
            </v-card-text>
        </v-card>
    </v-dialog>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            tableData: [],
            archivedComplaints: [],
            itemsPerPage: 3,
            currentPage: 1,

        };
    },
    computed: {
        paginatedItems() {
            if (!this.tableData || this.tableData.length === 0) {
                return []; }
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.tableData.slice(start, start + this.itemsPerPage);
        },

        totalPages() {
            return Math.ceil(this.tableData.length / this.itemsPerPage);
        },
    },
    async created() {
        await this.getdata();
    },
    methods: {
        editItem(index) {
            console.log("Edit item:", index);
        },
        async deleteItem(id, index) {
            if (confirm("Are you sure you want to delete this complaint?")) {
                try {
                    await fetch(`/api/complaints/${id}`, {
                        method: 'DELETE',
                    });
                    const itemIndex = (this.currentPage - 1) * this.itemsPerPage + index;
                    this.tableData.splice(itemIndex, 1);
                    alert("Complaint deleted successfully");
                } catch (error) {
                    console.error("Error deleting complaint:", error);
                    alert("Failed to delete complaint");
                }
            }
        },
        handlePageChange(page) {
            this.currentPage = page;
        },
        async getdata() {
            const res = await fetch("/api/complaints-list");
            const file = await res.json();
            this.tableData = file.data;
        },
        openArchive() {
            this.$router.push("/complaint-archive");
        },

    },
};
</script>

<style scoped>
.v-icon {
    cursor: pointer;
}

::v-deep .v-data-table__wrapper {
    overflow-y: hidden;
}
</style>
