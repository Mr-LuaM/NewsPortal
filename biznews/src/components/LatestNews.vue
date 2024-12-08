<template>
  <div class="container-fluid my-5">
    <div class="row">
      <!-- Latest News Section -->
      <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="text-uppercase">
            <span class="border-start border-4 border-warning px-2"></span>Latest News
          </h4>
          <router-link to="/news" class="text-decoration-none text-warning">View All</router-link>
        </div>
        <div class="row g-4">
          <div v-for="news in latestNews" :key="news.id" class="col-md-6">
            <div class="card border-0 shadow" @click="goToNews(news.id)" style="cursor: pointer;">
              <img :src="news.image" class="card-img-top" alt="News Image" />
              <div class="card-body">
                <span class="badge bg-warning text-dark mb-2">{{ news.category }}</span>
                <h5 class="card-title text-truncate">{{ news.title }}</h5>
                <p class="text-muted small">{{ news.date }}</p>
                <p class="card-text small text-truncate">{{ news.summary }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <img
                      :src="news.author.image"
                      class="rounded-circle me-2"
                      alt="Author"
                      width="30"
                      height="30"
                    />
                    <small class="text-muted">{{ news.author.name }}</small>
                  </div>
                  <div>
                    <small class="text-muted me-3"><i class="bi bi-eye"></i> {{ news.views }}</small>
                    <small class="text-muted"><i class="bi bi-chat"></i> {{ news.comments }}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Sidebar -->
      <div class="col-lg-4">
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
            <span
              v-for="tag in tags"
              :key="tag"
              class="badge bg-light text-dark border me-2 mb-2"
            >
              {{ tag }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "NewsSection",
  data() {
    return {
      latestNews: [], // Array to store latest news
      trendingNews: [], // Array to store trending news
      tags: [], // Array to store tags
    };
  },
  mounted() {
    this.fetchNewsData();
    this.fetchTags();
  },
  methods: {
    async fetchNewsData() {
      const baseUrl = import.meta.env.VITE_APP_API_URL;
      try {
        const { data } = await axios.get(`${baseUrl}/api/news`);
        const articles = data.map((item) => ({
          id: item.id,
          image: `${baseUrl}/storage/${item.image}`,
          category: item.category || "General",
          title: item.title || "Untitled",
          date: new Date(item.published_at).toLocaleDateString("en-US", {
            month: "short",
            day: "2-digit",
            year: "numeric",
          }),
          summary: item.content.substring(0, 100) + "...",
          author: {
            name: item.author?.name || "Unknown",
            image: `${baseUrl}/${item.author?.profile_picture || "default-avatar.png"}`,
          },
          views: item.views || 0,
          comments: item.heart_counts || 0,
        }));

        this.latestNews = articles.slice(0, 4); // Latest news
        this.trendingNews = articles.slice(4, 9); // Trending news
      } catch (error) {
        console.error("Error fetching news data:", error);
      }
    },
    async fetchTags() {
      const baseUrl = import.meta.env.VITE_APP_API_URL;
      try {
        const { data } = await axios.get(`${baseUrl}/api/tags`);
        this.tags = data.map((tag) => tag.name);
      } catch (error) {
        console.error("Error fetching tags:", error);
        this.tags = []; // Fallback to empty tags
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

h4,
h5 {
  font-weight: bold;
}

.badge {
  font-size: 0.8rem;
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
