<template>
    <div id="app">
      <TopHeader />
      <LogoNavbar />
<AdminNews/>
  
    </div>
  </template>
  
  <script>
  import TopHeader from "../components/TopHeader.vue";
  import LogoNavbar from "../components/LogoNavbar.vue";
import AdminNews from "@/components/AdminNews.vue";

  
  export default {
    name: "App",
    components: {
      TopHeader,
      LogoNavbar,
      AdminNews

    },
  };
  </script>
  