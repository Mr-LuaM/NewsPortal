<template>
  <div id="app">
    <TopHeader />
    <LogoNavbar />
    <FeaturedSection />
    <FeaturedNews />
    <LatestNews/>

  </div>
</template>

<script>
import TopHeader from "../components/TopHeader.vue";
import LogoNavbar from "../components/LogoNavbar.vue";
import FeaturedSection from "../components/FeaturedSection.vue";
import FeaturedNews from "../components/FeaturedNews.vue";
import LatestNews from "../components/LatestNews.vue";

export default {
  name: "App",
  components: {
    TopHeader,
    LogoNavbar,
    FeaturedSection,FeaturedNews,LatestNews
  },
};
</script>
