<template>
    <v-card class="pa-4">
        <div class="d-flex align-center">
            <v-row>
                <v-col cols="12">
                    <div class="d-flex justify-space-between align-center">
                        <h2 class="text-h4">List of Municipal Officer Data</h2>
                        <div>
                            <v-btn
                                color="primary"
                                @click="openCreateModal"
                                append-icon="mdi-plus"
                                >Create Officer</v-btn
                            >
                        </div>
                    </div>
                </v-col>
            </v-row>
        </div>

        <!-- Data Table to show the paginated items -->
        <v-table id="officer-list" class="mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(item, index) in paginatedItems" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>
                        <img
                            :src="item.image"
                            alt="Image"
                            width="250"
                            height="250"
                        />
                    </td>
                    <td>{{ item.full_name }}</td>
                    <td>{{ item.position }}</td>
                    <td>{{ item.department }}</td>
                    <td>
                        <v-col>
                            <v-icon color="blue" @click="openEditModal(item)"
                                >mdi-file-edit-outline</v-icon
                            >

                            <v-icon
                                color="red"
                                @click="deleteItem(item.id, index)"
                                >mdi-delete</v-icon
                            >
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
    </v-card>

    <!-- Create Officer Modal -->
    <v-dialog v-model="showCreateModal" max-width="800px">
        <v-card>
            <v-card-title>Create Officer</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-text-field
                        v-model="newOfficer.full_name"
                        label="Name"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="newOfficer.position"
                        label="Position"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="newOfficer.department"
                        label="Department"
                        required
                    ></v-text-field>
                    <v-file-input
                        v-model="newOfficer.image"
                        label="Image"
                        accept="image/*"
                    ></v-file-input>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="createOfficer">Save</v-btn>
                <v-btn @click="showCreateModal = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <!-- Edit Officer Modal -->
    <v-dialog v-model="showEditModal" max-width="800px">
        <v-card>
            <v-card-title>Edit Officer</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-text-field
                        v-model="updateOfficer.full_name"
                        label="Name"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="updateOfficer.position"
                        label="Position"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="updateOfficer.department"
                        label="Department"
                        required
                    ></v-text-field>

                    <div class="d-flex align-center">
                        <v-img
                            v-if="updateOfficer.image && typeof updateOfficer.image === 'string'"
                            :src="updateOfficer.image"
                            alt="Existing Image"
                            width="250"
                            height="250"
                        ></v-img>
                    </div>

                    <v-file-input
                        class="py-4"
                        v-model="updateOfficer.image"
                        label="Upload New Image"
                        accept="image/*"
                    ></v-file-input>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="updateOfficerData">Save</v-btn>
                <v-btn @click="showEditModal = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            officers: [], // List of officers
            itemsPerPage: 10,
            currentPage: 1,
            newOfficer: {
                full_name: "",
                position: "",
                department: "",
                image: null,
            },
            updateOfficer: {
                id: null,
                full_name: "",
                position: "",
                department: "",
                image: null,
            },
            showEditModal: false,
            showCreateModal: false,
        };
    },
    computed: {
        paginatedItems() {
            if (!this.officers || this.officers.length === 0) {
                return [];
            }
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.officers.slice(start, start + this.itemsPerPage);
        },

        totalPages() {
            return Math.ceil(this.officers.length / this.itemsPerPage);
        },
    },
    async created() {
        await this.getOfficers();
    },
    methods: {
        openCreateModal() {
            this.showCreateModal = true;
        },
        openEditModal(item) {
            this.updateOfficer = {
                id: item.id,
                full_name: item.full_name,
                position: item.position,
                department: item.department,
                image: item.image,
            };
            this.showEditModal = true;
        },

        // Create a new officer
        async createOfficer() {
            const formData = new FormData();
            formData.append("full_name", this.newOfficer.full_name);
            formData.append("position", this.newOfficer.position);
            formData.append("department", this.newOfficer.department);
            formData.append("image", this.newOfficer.image);

            try {
                const response = await axios.post("/api/municipal-officers", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.showCreateModal = false;
                this.resetNewOfficer();
                await this.getOfficers(); // Refresh the table data
            } catch (error) {
                console.error("Error creating officer:", error);
            }
        },

        // Update officer data
        async updateOfficerData() {
            const formData = new FormData();
            formData.append("full_name", this.updateOfficer.full_name);
            formData.append("position", this.updateOfficer.position);
            formData.append("department", this.updateOfficer.department);

            if (
                this.updateOfficer.image &&
                typeof this.updateOfficer.image !== "string"
            ) {
                formData.append("image", this.updateOfficer.image);
            }

            try {
                const response = await axios.post(
                    `/api/municipal-officers/${this.updateOfficer.id}`,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                        params: {
                            _method: "PUT",
                        },
                    }
                );

                const index = this.officers.findIndex(
                    (officer) => officer.id === this.updateOfficer.id
                );
                if (index !== -1) {
                    this.officers[index] = response.data.data;
                }

                this.showEditModal = false;
                this.resetUpdateOfficer();
                await this.getOfficers();
            } catch (error) {
                console.error("Error updating officer:", error);
            }
        },

        // Delete an officer
        async deleteItem(id, index) {
            if (confirm("Are you sure you want to delete this officer?")) {
                try {
                    await axios.delete(`/api/municipal-officers/${id}`);
                    this.officers.splice(index, 1);
                    alert("Officer deleted successfully");
                } catch (error) {
                    console.error("Error deleting officer:", error);
                    alert("Failed to delete officer");
                }
            }
        },

        // Handle page changes in pagination
        handlePageChange(page) {
            this.currentPage = page;
        },

        // Get officers data
        async getOfficers() {
            try {
                const res = await axios.get("/api/municipal-officers");
                this.officers = res.data.data;
            } catch (error) {
                console.error("Error fetching officers:", error);
            }
        },

        // Reset form fields after creating an officer
        resetNewOfficer() {
            this.newOfficer = {
                full_name: "",
                position: "",
                department: "",
                image: null,
            };
        },

        // Reset the edit form
        resetUpdateOfficer() {
            this.updateOfficer = {
                id: null,
                full_name: "",
                position: "",
                department: "",
                image: null,
            };
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
