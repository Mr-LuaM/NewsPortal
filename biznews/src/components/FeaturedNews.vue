<template>
    <div class="featured-news-section container-fluid py-3">
      <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-3 px-4">
          <h4 class="text-uppercase fw-bold">Featured News</h4>
          <div class="d-flex align-items-center">
            <button
              class="btn btn-outline-secondary btn-sm me-2"
              @click="scrollLeft"
            >
              <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-outline-secondary btn-sm" @click="scrollRight">
              <i class="bi bi-chevron-right"></i>
            </button>
          </div>
        </div>
  
        <!-- News Items Section -->
        <div
          ref="newsContainer"
          class="d-flex overflow-hidden position-relative"
          style="scroll-snap-type: x mandatory;"
        >
          <div
            v-for="(item, index) in featuredNews"
            :key="index"
            class="card bg-dark text-white border-0 me-3"
            style="flex: 0 0 calc(20% - 1rem); scroll-snap-align: start;"
          >
            <img
              :src="item.image"
              class="card-img no-radius"
              alt="Featured News"
            />
            <div class="card-img-overlay d-flex flex-column justify-content-end p-2 gradient-overlay">
              <span class="badge bg-warning text-dark mb-1 px-2 py-1">
                {{ item.category }}
              </span>
              <h6 class="card-title m-0 text-truncate">{{ item.title }}</h6>
              <p class="card-text small">{{ item.date }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "FeaturedNews",
    data() {
      return {
        featuredNews: [
          {
            image: "src/assets/demo.png",
            category: "Business",
            title: "Lorem Ipsum Dolor Sit Amet Elit...",
            date: "Jan 01, 2045",
          },
          {
            image: "src/assets/demo.png",
            category: "Technology",
            title: "Exploring the Latest Trends in Tech...",
            date: "Jan 02, 2045",
          },
          {
            image: "src/assets/demo.png",
            category: "Health",
            title: "Tips for Maintaining a Healthy Lifestyle...",
            date: "Jan 03, 2045",
          },
          {
            image: "src/assets/demo.png",
            category: "Science",
            title: "Discoveries that Changed the World...",
            date: "Jan 04, 2045",
          },
          {
            image: "src/assets/demo.png",
            category: "Education",
            title: "Innovative Learning Techniques in 2045...",
            date: "Jan 05, 2045",
          },
        ],
      };
    },
    methods: {
      scrollLeft() {
        const container = this.$refs.newsContainer;
        container.scrollBy({ left: -container.clientWidth, behavior: "smooth" });
      },
      scrollRight() {
        const container = this.$refs.newsContainer;
        container.scrollBy({ left: container.clientWidth, behavior: "smooth" });
      },
    },
  };
  </script>
  
  <style scoped>

  .card-img {
    object-fit: cover;
    height: 200px;
  }
  
  .card-title {
    font-size: 0.9rem;
  }
  
  .card-text {
    font-size: 0.8rem;
  }
  
  .gradient-overlay {
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0.8) 100%);
    border-radius: 0;
  }
  </style>
  