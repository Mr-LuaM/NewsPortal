<template>
    <div class="trending-news-tags ">
      <!-- Trending News -->
      <div class="mb-4">
        <h5 class="text-uppercase">
          <span class="border-start border-4 border-warning px-2"></span>Trending News
        </h5>
        <ul class="list-unstyled mt-3">
          <li v-for="trend in trendingNews" :key="trend.id" class="d-flex mb-3 align-items-center">
            <router-link :to="`/news/${trend.id}`" class="d-flex text-decoration-none text-dark">
              <img :src="trend.image" class="rounded me-3" alt="Trending News" width="80" height="80" />
              <div>
                <span class="badge bg-warning text-dark mb-1">{{ trend.category }}</span>
                <h6 class="mb-0 text-truncate">{{ trend.title }}</h6>
                <p class="text-muted small mb-0">{{ trend.date }}</p>
              </div>
            </router-link>
          </li>
        </ul>
      </div>
  
      <!-- Tags Section -->
      <div>
        <h5 class="text-uppercase">
          <span class="border-start border-4 border-warning px-2"></span>Tags
        </h5>
        <div class="mt-3">
          <router-link
            v-for="tag in tags"
            :key="tag"
            :to="`/browse/tag?tag=${tag}`"
            class="badge bg-light text-dark border me-2 mb-2 text-decoration-none"
          >
            {{ tag }}
          </router-link>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "TrendingNewsTags",
    data() {
      return {
        trendingNews: [],
        tags: [],
        baseUrl: import.meta.env.VITE_APP_API_URL,
      };
    },
    mounted() {
      this.fetchTrendingNews();
      this.fetchTags();
    },
    methods: {
      async fetchTrendingNews() {
        try {
          const { data } = await axios.get(
            `${this.baseUrl}/api/news?limit=5&sort_by=views&order=desc`
          );
          this.trendingNews = this.processNewsData(data);
        } catch (error) {
          console.error("Error fetching trending news:", error);
        }
      },
      async fetchTags() {
        try {
          const { data } = await axios.get(`${this.baseUrl}/api/tags`);
          this.tags = data.map((tag) => tag.name);
        } catch (error) {
          console.error("Error fetching tags:", error);
          this.tags = [];
        } finally {
          this.$emit("loaded");
        }
      },
      processNewsData(data) {
        return data.map((item) => ({
          id: item.id,
          image: `${this.baseUrl}/storage/${item.image}`,
          category: item.category || "General",
          title: item.title || "Untitled",
          date: new Date(item.published_at).toLocaleDateString("en-US", {
            month: "short",
            day: "2-digit",
            year: "numeric",
          }),
        }));
      },
    },
  };
  </script>
  
  <style scoped>
  .card-img-top {
    object-fit: cover;
    height: 200px;
  }
  
  h4,
  h5 {
    font-weight: bold;
  }
  
  .badge {
    font-size: 0.8rem;
    cursor: pointer;
  }
  
  .card-body {
    font-size: 0.9rem;
  }
  
  ul {
    padding-left: 0;
  }
  
  .text-truncate {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
  </style>
  