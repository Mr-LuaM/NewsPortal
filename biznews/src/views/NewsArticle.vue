<template>
    <div id="app">
      <TopHeader />
      <LogoNavbar />
      <NewsDetails />

  
    </div>
  </template>
  
  <script>
  import TopHeader from "../components/TopHeader.vue";
  import LogoNavbar from "../components/LogoNavbar.vue";
  import NewsDetails from "../components/NewsDetails.vue";

  
  export default {
    name: "App",
    components: {
      TopHeader,
      LogoNavbar,
      NewsDetails
    },
  };
  </script>
  