<template>
    <div class="news-article" v-if="article">
      <!-- Image Section -->
      <div class="image-container">
        <img :src="`${baseUrl}/storage/${article.image}`" alt="News Image" class="article-image" />
      </div>
  
      <!-- Article Content -->
      <div class="content-container">
        <div class="meta-info">
          <span class="category" :class="`category-${article.category?.toLowerCase()}`">
            {{ article.category }}
          </span>
          <span class="date">{{ formatDate(article.published_at || article.created_at) }}</span>
        </div>
  
        <h1 class="title">{{ article.title }}</h1>
  
        <div class="author-info">
          <img
            :src="`${baseUrl}/storage/${article.author?.profile_picture}`"
            alt="Author"
            class="author-image"
          />
          <span class="author-name">{{ article.author?.name }}</span>
        </div>
  
        <div class="description" v-html="article.content"></div>
  
        <!-- Metrics Section -->
        <div class="metrics">
          <span class="views">Views: {{ article.views }}</span>
          <button class="heart-button" @click="addHeart">
            <i class="bi bi-heart-fill"></i> {{ article.heart_counts }}
          </button>
        </div>
      </div>
    </div>
    <div v-else class="loading">Loading...</div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "NewsArticle",
    data() {
      return {
        article: null, // Holds the article data
        baseUrl: import.meta.env.VITE_APP_API_URL || "http://localhost", // API Base URL
      };
    },
    methods: {
      async fetchArticle() {
        try {
          const articleId = this.$route.params.id; // Get the article ID from the route
          const response = await axios.get(`${this.baseUrl}/api/news/${articleId}`); // Fetch from the backend
          this.article = response.data;
        } catch (error) {
          console.error("Error fetching the article:", error);
        }
      },
      async addHeart() {
        try {
          const articleId = this.article.id;
          // Increment the heart count locally
          this.article.heart_counts += 1;
  
          // Send the updated heart count to the backend
          await axios.post(`${this.baseUrl}/api/news/${articleId}/heart`, {
            heart_counts: this.article.heart_counts,
          });
  
          console.log("Heart count updated successfully");
        } catch (error) {
          console.error("Error updating heart count:", error);
        }
      },
      formatDate(date) {
        const options = { year: "numeric", month: "short", day: "2-digit" };
        return new Date(date).toLocaleDateString(undefined, options);
      },
    },
    mounted() {
      this.fetchArticle(); // Fetch article when the component is mounted
    },
  };
  </script>
  
  <style scoped>
  .news-article {
    max-width: 800px;
    margin: 40px auto;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .image-container {
    width: 100%;
  }
  
  .article-image {
    display: block;
    width: 100%;
    height: auto;
  }
  
  .content-container {
    padding: 20px;
  }
  
  .meta-info {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: 14px;
    color: #666;
  }
  
  .meta-info .category {
    background-color: #f1c40f;
    color: #fff;
    padding: 5px 10px;
    border-radius: 4px;
    text-transform: uppercase;
    font-weight: bold;
    margin-right: 10px;
    font-size: 12px;
  }
  
  .meta-info .date {
    color: #999;
  }
  
  .category-business {
    background-color: #f1c40f;
  }
  
  .category-religion {
    background-color: #3498db;
  }
  
  .category-politics {
    background-color: #e74c3c;
  }
  
  .title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
  }
  
  .author-info {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }
  
  .author-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
  }
  
  .author-name {
    font-size: 16px;
    font-weight: bold;
  }
  
  .description {
    font-size: 16px;
    color: #555;
    line-height: 1.6;
  }
  
  .metrics {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    font-size: 16px;
    color: #555;
  }
  
  .heart-button {
    display: flex;
    align-items: center;
    border: none;
    background: none;
    color: #e74c3c;
    font-size: 16px;
    cursor: pointer;
  }
  
  .heart-button i {
    margin-right: 5px;
  }
  
  .loading {
    text-align: center;
    font-size: 18px;
    color: #888;
    margin: 20px 0;
  }
  </style>
  