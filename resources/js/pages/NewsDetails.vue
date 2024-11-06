<template>
    <div v-if="blog">  <!-- Ensure the blog data is available before passing to the child -->
      <NewsDetails :blog="blog"/>
    </div>
    <div v-else>Loading...</div> <!-- Show a loading state until the blog is available -->
  </template>

  <script>
  import NewsDetails from '../components/News/NewsDetails.vue';
  import axios from 'axios';

  export default {
    components: {
      NewsDetails
    },
    data() {
      return {
        blog: null, // Data to store the fetched blog
      };
    },
    created() {
      const blogTitle = this.$route.params.title;  // Get the dynamic route param (title)
      this.fetchBlogDetails(blogTitle );  // Fetch blog details
    },
    methods: {
      async fetchBlogDetails(title) {
        try {
          const response = await axios.get(`/api/news/${title}`);
          this.blog = response.data.data;  // Store the fetched blog in the 'blog' data
        } catch (error) {
          console.error('Error fetching blog details:', error);
        }
      }
    }
  };
  </script>
