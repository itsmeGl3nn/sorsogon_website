<template>
    <v-container class="my-16" id="blogList">
        <v-row>
            <v-col cols="12" md="12">
                <div class="d-flex flex-column flex-md-row justify-space-between align-center">
                    <div>
                        <div class="text-secondary text-h6 font-weight-bold mb-2">
                            NEWS AND ANNOUNCEMENT
                        </div>
                        <div class="text-h5 text-primary text-lg-h4 text-xl-h2 font-weight-medium mb-4">
                            Discover our latest news and updates
                        </div>
                    </div>
                    <div class="text-center text-md-end">
                        <a
                            href="/news-announcement"
                            class="view-btn text-primary text-decoration font-weight-bold text-body-1 text-md-body-large text-xl-subtitle-3"
                            aria-label="Go to blogs page"
                        >
                            VIEW ALL
                        </a>
                    </div>
                </div>
            </v-col>
        </v-row>

        <v-row>
            <v-col
                cols="12"
                md="4"
                v-for="(blog, i) in blogs"
                :key="i"
                data-aos="fade-up"
                data-aos-duration="1200"
            >
                <div class="d-flex flex-column justify-space-between" style="height: 100%">
                    <div>
                        <div class="img-wrapper mb-4">
                            <v-img
                                class="img-content elevation-2"
                                cover
                                rounded="lg"
                                width="100%"
                                :src="blog.image"
                            ></v-img>
                        </div>
                        <div class="d-flex flex-wrap align-center mt-2 mb-2">
                            <div

                                class="bg-primary rounded-xl px-4 py-1 mr-1 mb-1 text-uppercase text-caption"
                            >
                                {{ blog.category }}
                            </div>
                            <div class="font-weight-bold ml-1 text-primary">
                                by {{ blog.author }}
                            </div>
                        </div>
                        <div class="text-subtitle-2 font-weight-bold mb-2 text-primary" style="font-family: 'Poppins', sans-serif">
                            {{ blog.title }}.
                        </div>
                        <div class="text-body-1">
                            {{
                                blog.description.length > 100
                                    ? blog.description.slice(0, 150) + "..."
                                    : blog.description
                            }}
                        </div>
                    </div>
                    <div class="mb-8">
                        <template v-if="blog.external">
                            <a :href="blog.external" target="_blank">
                                <v-btn
                                    style="opacity: 0.87"
                                    variant="plain"
                                    append-icon="mdi-chevron-right"
                                    class="font-weight-bold pa-0 mt-6 text-black"
                                    >READ MORE</v-btn
                                >
                            </a>
                        </template>

                        <v-btn
                            v-else
                            style="opacity: 1"
                            variant="plain"
                            append-icon="mdi-chevron-right"
                            class="font-weight-bold pa-0 mt-6"
                        :href="`/news/${blog.title}`"
                            >READ MORE</v-btn
                        >
                    </div>
                </div>
            </v-col>
        </v-row>

        <v-pagination
            class="mt-10"
            v-model="currentPage"
            :total-visible="7"
            :length="meta.totalPages"
            @input="changePage"
        >
            <template #prev>
                <v-btn
                    @click="previousPage"
                    height="100%"
                    :disabled="currentPage === 1"
                    :class="{ 'disabled-btn': currentPage === 1 }"
                >
                    <v-icon>mdi-chevron-left</v-icon>
                    Previous
                </v-btn>
            </template>
            <template #next>
                <v-btn
                    @click="nextPage"
                    height="100%"
                    :disabled="currentPage === meta.totalPages"
                    :class="{ 'disabled-btn': currentPage === meta.totalPages }"
                >
                    Next
                    <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </template>
        </v-pagination>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    components: {},
    setup() {
        return {};
    },
    data() {
        return {
            currentPage: 1,
            meta: {
                totalPages: 5,
            },
            blogs: [], // Initialize empty blogs array
        };
    },
    watch: {
        currentPage() {
            this.getBlogs(this.currentPage); // Refetch blogs when page changes
        },
    },
    created() {
        this.getBlogs(this.currentPage); // Fetch initial blogs
    },
    methods: {
        async getBlogs(page) {
    try {
        const response = await axios.get('/api/news', {
            params: {
                page: page,
                limit: 10,
            },
        });

        console.log(response.data); // Log the data to verify

        this.blogs = response.data.data; // Set blogs data
        this.meta.totalPages = response.data.meta.totalPages; // Set total pages
    } catch (error) {
        console.error('Error fetching news:', error);
    }
},

        changePage(page) {
            this.currentPage = page;
        },
        nextPage() {
            if (this.currentPage < this.meta.totalPages) {
                this.currentPage++;
                this.getBlogs(this.currentPage);
            }
        },
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.getBlogs(this.currentPage);
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.disabled-btn {
    opacity: 0.5 !important;
}

* {
    font-family: "Poppins", sans-serif;
}

.view-btn {
    color: #5F91C8;
}

.pagination-button {
    border: 1px solid #ccc; /* Adjust border color and size as needed */
}
.img-wrapper {
    position: relative;
    width: 100%;
    padding-top: 70%; /* 1:1 aspect ratio */
    overflow: hidden;
}

.img-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

::v-deep {
    .v-pagination .v-btn {
        border: 1px solid #d0d5dd; /* Set border properties */
        font-weight: 800 !important;
        color: #1e293b !important;
    }

    .v-pagination button {
        border: 1px solid #d0d5dd !important;
    }
}
</style>
