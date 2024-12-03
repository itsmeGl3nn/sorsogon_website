<template>
    <v-card class="pa-4">
        <div class="d-flex align-center">
            <v-row>
                <v-col cols="12">
                    <div class="d-flex justify-space-between align-center">
                        <h2 class="text-h4">List of Home Banner Data</h2>
                        <div class="d-flex">
                            <div class="px-2 ">
                                <v-btn
                                color="primary"
                                class="px-2 "
                                @click="openCreateModal"
                                append-icon="mdi-plus"
                                >Create Data</v-btn
                            >
                        </div>
                            <div class="px-2 ">
                            <v-btn
                                color="primary"
                                @click="openArchive"
                                >Archive</v-btn
                            >
                        </div>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </div>

        <!-- Data Table to show the paginated items -->
        <v-table id="appointment-list" class="mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
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
                    <td>{{ item.title }}</td>
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

    <v-dialog v-model="showCreateModal" max-width="800px">
        <v-card>
            <v-card-title>Create Home Banner</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-text-field
                        v-model="newBanner.title"
                        label="Title"
                        required
                    ></v-text-field>
                    <v-file-input
                        v-model="newBanner.image"
                        label="Image"
                        accept="image/*"
                    ></v-file-input>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="createHomeBanner">Save</v-btn>
                <v-btn @click="showCreateModal = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-dialog v-model="showEditModal" max-width="800px">
        <v-card>
            <v-card-title>Edit Home Banner</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-text-field
                        v-model="updatenewBanner.title"
                        label="Title"
                        required
                    ></v-text-field>
                    <div class="d-flex align-center">
                        <v-img
                            v-if="
                                updatenewBanner.image &&
                                typeof updatenewBanner.image === 'string'
                            "
                            :src="updatenewBanner.image"
                            alt="Existing Image"
                            width="250"
                            height="250"
                        ></v-img>
                    </div>

                    <v-file-input
                        class="py-4"
                        v-model="updatenewBanner.image"
                        label="Upload New Image"
                        accept="image/*"
                    ></v-file-input>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="updateHomeBanner">Save</v-btn>
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
            tableData: [],
            itemsPerPage: 10,
            currentPage: 1,
            newBanner: {
                title: "",
                image: null,
            },
            updatenewBanner: {
                title: "",
                image: null,
            },
            showEditModal: false,
            showCreateModal: false,
        };
    },
    computed: {
        paginatedItems() {
            if (!this.tableData || this.tableData.length === 0) {
                return [];
            }
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
        openCreateModal() {
            this.showCreateModal = true;
        },
        openEditModal(item) {
            this.updatenewBanner = {
                id: item.id,
                title: item.title,
                image: item.image,
            };
            this.showEditModal = true;
        },

        async updateHomeBanner() {
    const formData = new FormData();
    formData.append("title", this.updatenewBanner.title);

    if (
        this.updatenewBanner.image &&
        typeof this.updatenewBanner.image !== "string"
    ) {
        formData.append("image", this.updatenewBanner.image);
    }

    try {
        const response = await axios.post(
            `/api/home-banners/${this.updatenewBanner.id}`,
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

        const index = this.tableData.findIndex(
            (item) => item.id === this.updatenewBanner.id
        );
        if (index !== -1) {
            this.tableData[index] = response.data.data;
        }

        this.showEditModal = false;
        this.resetUpdateBanner(); // Reset data object
        this.$refs.form.reset();  // Reset the form
        await this.getdata(); // Refresh the table data
    } catch (error) {
        console.error("Error updating banner:", error);
    }
}
,
        async deleteItem(id, index) {
            if (confirm("Are you sure you want to delete this Data?")) {
                try {
                    await fetch(`/api/home-banners/${id}`, {
                        method: "DELETE",
                    });
                    const itemIndex =
                        (this.currentPage - 1) * this.itemsPerPage + index;
                    this.tableData.splice(itemIndex, 1);
                    alert("Data deleted successfully");
                } catch (error) {
                    console.error("Error deleting Data:", error);
                    alert("Failed to delete Data");
                }
            }
        },
        handlePageChange(page) {
            this.currentPage = page;
        },
        openArchive() {
            this.$router.push("/archive-banner");
        },
        async getdata() {
            const res = await fetch("/api/home-banners");
            const file = await res.json();
            this.tableData = file.data;
            console.log(this.tableData);
        },
        async createHomeBanner() {
    const formData = new FormData();
    formData.append("title", this.newBanner.title);
    formData.append("image", this.newBanner.image);

    try {
        const response = await axios.post(
            "/api/home-banners",
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        );
        this.showCreateModal = false;
        this.resetUpdateBanner(); // Reset the data object
        this.$refs.form.reset();  // Reset the form itself
        await this.getdata(); // Refresh the table data
    } catch (error) {
        console.error("Error creating banner:", error);
    }
},

        resetUpdateBanner() {
            this.updatenewBanner = {
                title: "",
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
