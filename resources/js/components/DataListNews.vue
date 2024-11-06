<template>
    <v-card class="pa-4">
        <div class="d-flex align-center">
            <v-row>
                <v-col cols="12">
                    <div class="d-flex justify-space-between align-center">
                        <h2 class="text-h4">List of News and Advisories Data</h2>
                        <div>
                            <v-btn
                                color="primary"
                                @click="openCreateModal"
                                append-icon="mdi-plus"
                                >Create Data</v-btn
                            >
                        </div>
                    </div>
                </v-col>
            </v-row>
        </div>

        <!-- Data Table to show the paginated items -->
        <v-table id="news-list" class="mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Content</th>
            <th>Author</th>
            <th>Category</th>
            <th>External Link</th>
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
            <td>{{ item.description }}</td>
            <td>{{ item.content }}</td>
            <td>{{ item.author }}</td>
            <td>{{ item.category }}</td>
            <td>{{ item.external}}</td>
            <td>
                <v-col>
                    <v-icon color="blue" @click="openEditModal(item)">
                        mdi-file-edit-outline
                    </v-icon>

                    <v-icon color="red" @click="deleteItem(item.id, index)">
                        mdi-delete
                    </v-icon>
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
            <v-card-title>Create News</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-text-field v-model="newNews.title" label="Title" required></v-text-field>
                    <v-textarea v-model="newNews.description" label="Description"></v-textarea>
                    <v-textarea v-model="newNews.content" label="Content" required></v-textarea>
                    <v-text-field v-model="newNews.author" label="Author" required></v-text-field>
                    <v-text-field v-model="newNews.external" label="External Link" required></v-text-field>
                    <v-file-input v-model="newNews.image" label="Image" accept="image/*"></v-file-input>
                    <v-text-field v-model="newNews.category" label="Category" required></v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="createNews">Save</v-btn>
                <v-btn @click="showCreateModal = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <!-- Edit News Modal with Textarea -->
    <v-dialog v-model="showEditModal" max-width="800px">
        <v-card>
            <v-card-title>Edit News</v-card-title>
            <v-card-text>
                <v-form ref="form">
                    <v-text-field v-model="updateNews.title" label="Title" required></v-text-field>
                    <v-textarea v-model="updateNews.description" label="Description"></v-textarea>
                    <!-- Replaced CKEditor with a Textarea -->
                    <v-textarea v-model="updateNews.content" label="Content" required></v-textarea>
                    <v-text-field v-model="updateNews.author" label="Author" required></v-text-field>
                    <v-text-field v-model="updateNews.external" label="External Link" required></v-text-field>

                    <div class="d-flex align-center">
                        <v-img v-if="updateNews.image && typeof updateNews.image === 'string'" :src="updateNews.image" alt="Existing Image" width="250" height="250"></v-img>
                    </div>
                    <v-file-input class="py-4" v-model="updateNews.image" label="Upload New Image" accept="image/*"></v-file-input>
                    <v-text-field v-model="updateNews.category" label="Category" required></v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="updateNews">Save</v-btn>
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
            newNews: {
                title: "",
                description: "",
                content: "",
                author: "",
                external: "",
                image: null,
                category: "",
            },
            updateNews: {
                title: "",
                description: "",
                content: "",
                external: "",
                image: null,
                category: "",
            },
            showEditModal: false,
            showCreateModal: false,
        };
    },
    computed: {
    paginatedItems() {
        if (!Array.isArray(this.tableData) || this.tableData.length === 0) {
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
            this.updateNews = { ...item }; // Updating form with existing item data
            this.showEditModal = true;
        },
        handlePageChange(page) {
            this.currentPage = page;
        },
        async getdata() {
            // Replace with your actual API call to get news data
            const res = await axios.get("/api/news");
            this.tableData = res.data.data;
        },
        async createNews() {
            const formData = new FormData();
            formData.append("title", this.newNews.title);
            formData.append("description", this.newNews.description);
            formData.append("content", this.newNews.content);
            formData.append("author", this.newNews.author);
            formData.append("external", this.newNews.external);
            formData.append("category", this.newNews.category);
            if (this.newNews.image) {
                formData.append("image", this.newNews.image);
            }

            try {
                await axios.post("/api/news", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });

                this.newNews = {
            title: "",
            description: "",
            content: "",
            author: "",
            external: "",
            image: null,
            category: "",
        };
                this.showCreateModal = false;
                await this.getdata();
            } catch (error) {
                console.error("Error creating news:", error);
            }
        },
        async updateNews() {
            const formData = new FormData();
            formData.append("title", this.updateNews.title);
            formData.append("description", this.updateNews.description);
            formData.append("content", this.updateNews.content);
            formData.append("author", this.updateNews.author);
            formData.append("external", this.updateNews.external);
            formData.append("category", this.updateNews.category);
            if (this.updateNews.image) {
                formData.append("image", this.updateNews.image);
            }

            try {
                await axios.put(`/api/news/${this.updateNews.id}`, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.showEditModal = false;
                await this.getdata();
            } catch (error) {
                console.error("Error updating news:", error);
            }
        },
        async deleteItem(id, index) {
            if (confirm("Are you sure you want to delete this Data?")) {
                try {
                    await axios.delete(`/api/news/${id}`);
                    this.tableData.splice(index, 1);
                    alert("Data deleted successfully");
                } catch (error) {
                    console.error("Error deleting data:", error);
                    alert("Failed to delete data");
                }
            }
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
