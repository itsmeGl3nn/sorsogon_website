<template>
    <v-card class="pa-4">
      <div class="d-flex align-center">
        <v-row>
          <v-col cols="12">
            <div class="d-flex justify-space-between align-center">
              <h2 class="text-h4">List of Users</h2>
              <div>
                <v-btn color="primary" @click="createData" append-icon="mdi-plus">Create Data</v-btn>
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
                <v-icon color="red" @click="deleteItem(item.id, index)">mdi-delete</v-icon>
              </v-col>
            </td>
          </tr>
        </tbody>
      </v-table>

      <div class="ma-5">
        <v-row>
          <v-col cols="11">
            <v-pagination v-model="currentPage" :length="totalPages" @input="handlePageChange" rounded="circle"></v-pagination>
          </v-col>
        </v-row>
      </div>
    </v-card>


  </template>

<script>
export default {
    data() {
        return {
            tableData: [],
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
        deleteItem(index) {
            console.log("Delete item:", index);
            const itemIndex =
                (this.currentPage - 1) * this.itemsPerPage + index;
            this.tableData.splice(itemIndex, 1);
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
