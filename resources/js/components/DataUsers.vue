<template>
    <v-card class="pa-4">
        <div class="d-flex align-center">
            <v-row>
                <v-col cols="12">
                    <div class="d-flex justify-space-between align-center">
                        <h2 class="text-h4">List of Users</h2>
                        <div>
                            <v-btn
                                color="primary"
                                @click="openCreateModal"
                                append-icon="mdi-plus"
                                >Create User</v-btn
                            >
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in paginatedItems" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.first_name }}</td>
                    <td>{{ item.last_name }}</td>
                    <td>{{ item.role }}</td>
                    <td>{{ item.email }}</td>
                    <td>
                        <v-col>
                            <v-icon color="blue" @click="editItem(index)"
                                >mdi-eye-outline</v-icon
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

    <!-- Create User Modal -->
    <v-dialog v-model="showCreateModal" max-width="500px">
        <v-card>
            <v-card-title class="text-h5">Create User</v-card-title>
            <v-card-text>
                <!-- Form fields for creating a new user go here -->
                <v-text-field
                    label="First Name"
                    v-model="newUser.first_name"
                ></v-text-field>
                <v-text-field
                    label="Last Name"
                    v-model="newUser.last_name"
                ></v-text-field>
                <v-text-field
                    label="Role"
                    v-model="newUser.role"
                ></v-text-field>
                <!-- <v-select
                    label="Role"
                    v-model="newUser.role"
                    :items="roles"
                    item-text="name"
                    item-value="value"
                    outlined
                ></v-select> -->
                <v-text-field
                    label="Email"
                    v-model="newUser.email"
                ></v-text-field>
                <v-text-field
                    label="Password"
                    v-model="newUser.password"
                    type="password"
                ></v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="createUser">Save</v-btn>
                <v-btn text @click="showCreateModal = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    data() {
        return {
            tableData: [],
            itemsPerPage: 10,
            currentPage: 1,
            showCreateModal: false,
            roles: [
            { name: 'NORMAL ADMIN', value: 'NORMAL_ADMIN' },
            { name: 'SUPER ADMIN', value: 'SUPER_ADMIN' },
            { name: 'CONTENT ADMIN', value: 'CONTENT_ADMIN' },
        ],
            newUser: {
                first_name: "",
                last_name: "",
               role: "",
                email: "",
                password: "",
            },
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
        async createUser() {
            // Add API call to save the user
            const response = await fetch("/api/users", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(this.newUser),
            });
            const result = await response.json();

            if (response.ok) {
                this.tableData.push(result.data);
                this.showCreateModal = false;
                this.resetNewUser();
            } else {
                console.error(result.message);
            }
        },
        resetNewUser() {
            this.newUser = {
                first_name: "",
                last_name: "",
                role: "",
                email: "",
                password: "",
            };
        },
        async deleteItem(id, index) {
            if (confirm("Are you sure you want to delete this User?")) {
                try {
                    await fetch(`/api/users/${id}`, {
                        method: "DELETE",
                    });
                    const itemIndex =
                        (this.currentPage - 1) * this.itemsPerPage + index;
                    this.tableData.splice(itemIndex, 1);
                    alert("Users deleted successfully");
                } catch (error) {
                    console.error("Error deleting user:", error);
                    alert("Failed to delete user");
                }
            }
        },
        handlePageChange(page) {
            this.currentPage = page;
        },
        async getdata() {
            const res = await fetch("/api/users");
            const file = await res.json();
            this.tableData = file.data;
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
