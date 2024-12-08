<template>
    <div class="container my-5">
      <h2 class="text-center mb-4">Browse News by Tag: "{{ tag }}"</h2>
  
      <!-- News List -->
      <div v-if="newsList.length" class="row g-4">
        <div v-for="news in newsList" :key="news.id" class="col-md-4">
          <div class="card border-0 shadow h-100" @click="goToNews(news.id)" style="cursor: pointer;">
            <img :src="news.image" class="card-img-top" alt="News Image" />
            <div class="card-body">
              <h5 class="card-title text-truncate text-dark">{{ news.title }}</h5>
              <div class="d-flex align-items-center mb-2">
                <img
                  :src="news.authorImage"
                  alt="Author Image"
                  class="rounded-circle me-2"
                  style="width: 30px; height: 30px; object-fit: cover;"
                />
                <p class="text-muted small mb-0">By {{ news.author }}</p>
              </div>
              <p class="text-muted small">{{ news.date }}</p>
            </div>
          </div>
        </div>
      </div>
  
      <!-- No News Fallback -->
      <div v-else class="text-center">
        <h5 class="text-muted">No news available for this tag.</h5>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "BrowseByTag",
    data() {
      return {
        tag: "", // The tag being searched
        newsList: [], // List of news articles for the tag
      };
    },
    async created() {
      this.tag = this.$route.query.tag; // Get the tag from query parameter
      await this.fetchNewsByTag();
    },
    watch: {
      // React to route changes to fetch new data
      "$route.query.tag": "fetchNewsByTag",
    },
    methods: {
      async fetchNewsByTag() {
        try {
          const tag = this.$route.query.tag;
          const baseUrl = import.meta.env.VITE_APP_API_URL;
          const response = await axios.get(`${baseUrl}/api/news?tag=${tag}`);
          this.newsList = response.data.map((item) => ({
            id: item.id,
            title: item.title || "Untitled",
            image: `${baseUrl}/storage/${item.image || "default-image.jpg"}`,
            date: new Date(item.published_at).toLocaleDateString("en-US", {
              month: "short",
              day: "2-digit",
              year: "numeric",
            }),
            summary: (item.content || "").substring(0, 100) + "...",
            author: item.author?.name || "Unknown Author",
            authorImage: `${baseUrl}/storage/${item.author?.profile_picture || "default-avatar.png"}`,
          }));
        } catch (error) {
          console.error("Error fetching news by tag:", error);
          this.newsList = []; // Fallback to empty list
        }
      },
      goToNews(newsId) {
        this.$router.push(`/news/${newsId}`);
      },
    },
  };
  </script>
  
  <style scoped>
  .card-img-top {
    object-fit: cover;
    height: 200px;
  }
  
  .card-title {
    font-size: 1.1rem;
    font-weight: bold;
  }
  
  .card-body {
    font-size: 0.9rem;
  }
  
  .text-truncate {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
  </style>
  