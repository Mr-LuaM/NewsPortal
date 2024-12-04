<template>
  <div class="featured-section container-fluid">
    <div class="row g-0 align-items-stretch" style="height: 600px;">
      <!-- Main Image Section with Carousel -->
      <div class="col-lg-8 h-100">
        <div id="mainCarousel" class="carousel slide h-100" data-bs-ride="carousel">
          <div class="carousel-inner h-100">
            <div
              v-for="(item, index) in slides"
              :key="index"
              :class="['carousel-item', { active: index === 0 }]"
              class="h-100"
            >
              <div class="card bg-dark text-white border-0 position-relative h-100">
                <img
                  :src="item.image"
                  class="card-img h-100 w-100 no-radius"
                  alt="Main Featured"
                />
                <div class="card-img-overlay d-flex flex-column justify-content-end p-4 gradient-overlay">
                  <span class="badge bg-warning text-dark mb-2 px-3 py-2">{{ item.category }}</span>
                  <h4 class="card-title">{{ item.title }}</h4>
                  <p class="card-text small">{{ item.date }}</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Carousel Controls -->
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#mainCarousel"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#mainCarousel"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <!-- Side Images Section -->
      <div class="col-lg-4 h-100">
        <div class="row g-0 h-100">
          <div v-for="(side, index) in sideImages" :key="index" class="col-6 col-lg-6 h-50">
            <div class="card bg-dark text-white border-0 position-relative h-100">
              <img
                :src="side.image"
                class="card-img h-100 w-100 no-radius"
                alt="Side Featured"
              />
              <div class="card-img-overlay d-flex flex-column justify-content-end p-2 gradient-overlay">
                <span class="badge bg-warning text-dark mb-1 px-2 py-1">{{ side.category }}</span>
                <h6 class="card-title m-0">{{ side.title }}</h6>
                <p class="card-text small">{{ side.date }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Breaking News Section -->
    <div class="bg-dark text-white d-flex justify-content-between align-items-center px-5 py-2 mt-0">
      <span class="badge bg-warning text-dark me-2 px-3 py-2">Breaking News</span>
      <div class="flex-grow-1 text-truncate px-2">
        {{ breakingNews }}
      </div>
      <div class="d-flex align-items-center">
        <button class="btn btn-outline-light btn-sm me-1">
          <i class="bi bi-chevron-left"></i>
        </button>
        <button class="btn btn-outline-light btn-sm">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "FeaturedSection",
  data() {
    return {
      slides: [], // For carousel slides
      sideImages: [], // For side image cards
      breakingNews: "", // Breaking news text
    };
  },
  mounted() {
    this.fetchFeaturedData();
  },
  methods: {
    async fetchFeaturedData() {
      try {
        const { data } = await axios.get("/api/news"); // Adjust the endpoint as per your backend
        // Assuming API returns an array of news articles with attributes: title, content, image, category, date
        const mainNews = data.slice(0, 3); // First 3 for the carousel
        const sideNews = data.slice(3, 7); // Next 4 for side images

        this.slides = mainNews.map((news) => ({
          image: news.image,
          category: news.category,
          title: news.title,
          date: news.published_at || "Unknown Date",
        }));

        this.sideImages = sideNews.map((news) => ({
          image: news.image,
          category: news.category,
          title: news.title,
          date: news.published_at || "Unknown Date",
        }));

        this.breakingNews = data[0]?.content.substring(0, 100) || "No breaking news available.";
      } catch (error) {
        console.error("Error fetching featured data:", error);
      }
    },
  },
};
</script>

<style scoped>
.card-img {
  object-fit: cover;
  border-radius: 0 !important;
}

.card-title {
  font-size: 1.1rem;
  font-weight: bold;
  color: white;
}

.card-text {
  font-size: 0.875rem;
  color: white;
}

.badge {
  font-size: 0.75rem;
}

.row.g-0 {
  gap: 0 !important;
}

.gradient-overlay {
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 0.7) 100%);
  border-radius: 0;
}

.bg-dark {
  background-color: #000 !important;
}

.container-fluid {
  padding: 0 !important;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  filter: invert(1); /* Make controls visible on dark backgrounds */
}
</style>
