<template>
  <div id="app">
    <TopHeader />
    <LogoNavbar />

    <!-- Global Loading Spinner -->
    <div v-if="isLoading" class="loading-container d-flex justify-content-center align-items-center">
      <div class="spinner-border text-warning" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Main Content -->
    <div v-show="!isLoading" class="content-container">
      <FeaturedSection @loaded="onChildLoaded" />
      <FeaturedNews @loaded="onChildLoaded" />
      <div class="row mt-4 px-2">
        <div class="col-lg-8">
          <LatestNews @loaded="onChildLoaded" />
        </div>
        <div class="col-lg-4">
          <TrendingNewsTags @loaded="onChildLoaded" />
        </div>
      </div>
      <Footer />
    </div>
  </div>
</template>

<script>
import TopHeader from "../components/TopHeader.vue";
import LogoNavbar from "../components/LogoNavbar.vue";
import FeaturedSection from "../components/FeaturedSection.vue";
import FeaturedNews from "../components/FeaturedNews.vue";
import LatestNews from "../components/LatestNews.vue";
import TrendingNewsTags from "../components/TrendingNewsTags.vue";
import Footer from "../components/Footer.vue";

export default {
  name: "Home",
  components: {
    TopHeader,
    LogoNavbar,
    FeaturedSection,
    FeaturedNews,
    LatestNews,
    TrendingNewsTags,
    Footer,
  },
  data() {
    return {
      isLoading: true, // Loading state for the entire app
      childrenLoaded: 0, // Tracks how many children have reported "loaded"
      totalChildren: 4, // Number of children expected to emit "loaded"
    };
  },
  methods: {
    onChildLoaded() {
      this.childrenLoaded++;
      if (this.childrenLoaded === this.totalChildren) {
        this.isLoading = false; // Finish loading when all children have loaded
      }
    },
  },
};
</script>

<style scoped>
/* Full-screen loading container */
.loading-container {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f8f9fa; /* Light grey background for the loading screen */
}

/* Content container to control overall width */
.content-container {
  margin: 0 auto; /* Centers the content */
  overflow-x: hidden; /* Prevents horizontal scrolling */
}

/* Preventing overextending layouts */
.row {
  margin-right: 0;
  margin-left: 0;
}

.col-lg-8,
.col-lg-4 {
  padding: 0 15px; /* Ensure spacing between columns */
}

/* Optional spinner customization */
.spinner-border {
  width: 3rem;
  height: 3rem;
}
</style>
