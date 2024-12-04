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
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link active text-warning" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#">Single News</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle text-light"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="#">Contact</a>
            </li>
          </ul>
          <form class="d-flex">
            <input
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
export default {
  name: "LogoNavbar",
};
</script>

<style scoped>
.logo-section {
  font-size: 2rem; /* Matches the size of the logo text */
}

.navbar {
  width: 100%; /* Ensure navbar spans the full width */
}
</style>
