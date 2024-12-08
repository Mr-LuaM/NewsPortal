<template>
  <div>
    <!-- Logo Section -->
    <div class="logo-section bg-white py-3 px-5">
      <div class="d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <div class="h1 text-warning mb-0">
          <strong>BIZ<span class="text-dark">NEWS</span></strong>
        </div>
        <!-- Optional Ad Space or Placeholder -->
        <div></div>
      </div>
    </div>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
      <div class="w-100">
        <button
          class="navbar-toggler"
          type="button"
          @click="toggleNavbar"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse"
          :class="{ show: isNavbarOpen }"
          id="navbarNav"
        >
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <router-link
                class="nav-link"
                :class="{ 'text-warning active': $route.path === '/' }"
                to="/"
              >
                Home
              </router-link>
            </li>
            <li class="nav-item">
              <router-link
                class="nav-link"
                :class="{ 'text-warning active': $route.path === '/news/category' }"
                to="/news/category"
              >
                Category
              </router-link>
            </li>
            <li class="nav-item dropdown" v-if="isAdminLoggedIn">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                :class="{ 'text-warning active': $route.path === '/admin/news' }"
                role="button"
                @click="toggleDropdown"
                :aria-expanded="isDropdownOpen"
              >
                Manage
              </a>
              <ul class="dropdown-menu" :class="{ show: isDropdownOpen }">
                <li>
                  <router-link
                    class="dropdown-item"
                    to="/admin/news"
                  >
                    Manage News
                  </router-link>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item text-danger" @click="logout">Logout</a>
                </li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" @submit.prevent="searchByTag">
            <input
              v-model="searchQuery"
              class="form-control me-2"
              type="search"
              placeholder="Keyword"
              aria-label="Search"
            />
            <button class="btn btn-warning" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "LogoNavbar",
  data() {
    return {
      isNavbarOpen: false,
      isDropdownOpen: false,
      searchQuery: "", // For the search input
    };
  },
  computed: {
    isAdminLoggedIn() {
      return !!localStorage.getItem("adminToken");
    },
  },
  methods: {
    toggleNavbar() {
      this.isNavbarOpen = !this.isNavbarOpen;
    },
    toggleDropdown() {
      this.isDropdownOpen = !this.isDropdownOpen;
    },
    async handleLogout() {
      try {
        this.hideModal();
        await axios.post("api/admin/logout");
        localStorage.removeItem("adminToken");
        this.$router.push("/admin/login");
      } catch (error) {
        console.error(error);
        alert("An error occurred during logout.");
      }
    },
    searchByTag() {
      if (this.searchQuery.trim()) {
        this.$router.push({ path: "/browse/tag", query: { tag: this.searchQuery } });
      }
    },
  },
};
</script>
<style scoped>
.logo-section {
  font-size: 2rem; /* Matches the size of the logo text */
}

.navbar {
  width: 100%; /* Ensure navbar spans the full width */
}

/* Add transition effects for smooth opening/closing */
.collapse {
  transition: height 0.3s ease;
}

.dropdown-menu {
  display: none;
  position: absolute;
}

.dropdown-menu.show {
  display: block;
}
</style>
