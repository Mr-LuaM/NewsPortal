import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/Home.vue";
import AdminLogin from "../views/AdminLogin.vue";
import AdminNews from "../views/AdminNews.vue";
import AdminAccounts from "../views/AdminAccounts.vue";
import NewsArticle  from "../views/NewsArticle.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/news/::id", // Dynamic route for a specific news article
    name: "NewsArticle",
    component: NewsArticle,
    props: true, // Pass route params as props to the component
  },
  {
    path: "/admin/login",
    name: "AdminLogin",
    component: AdminLogin,
  },
  {
    path: "/admin/news",
    name: "AdminNews",
    component: AdminNews,
  },  
  {
    path: "/admin/accounts",
    name: "AdminAccounts",
    component: AdminAccounts,
  },




  {
    path: "/:catchAll(.*)",
    redirect: "/admin/login", // Redirect unknown routes to admin login
  },
  
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

// // Global Navigation Guard
// router.beforeEach((to, from, next) => {
//   const isAuthenticated = !!localStorage.getItem("adminToken");

//   // Check for protected route
//   if (to.meta.requiresAuth && !isAuthenticated) {
//     next("/admin/login"); // Redirect to login if not authenticated
//   } else if (to.name === "AdminLogin" && isAuthenticated) {
//     next("/admin/dashboard"); // Prevent logged-in users from accessing login
//   } else {
//     next(); // Proceed normally
//   }
// });

export default router;
