<template>
  <div class="top-header bg-dark text-light py-1 d-none d-lg-block">
    <div class="d-flex justify-content-between align-items-center px-5">
      <!-- Left: Date -->
      <div class="small">
        Monday, January 1, 2045
      </div>

      <!-- Center: Links -->
      <div class="small">
        <a href="#" class="text-light text-decoration-none me-3">Advertise</a>
        <a href="#" class="text-light text-decoration-none me-3">Contact</a>
        <a href="#" class="text-light text-decoration-none">Login</a>
      </div>

      <!-- Right: Social Media Icons -->
      <div>
        <a href="#" class="text-light text-decoration-none me-2"><i class="bi bi-twitter"></i></a>
        <a href="#" class="text-light text-decoration-none me-2"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-light text-decoration-none me-2"><i class="bi bi-linkedin"></i></a>
        <a href="#" class="text-light text-decoration-none me-2"><i class="bi bi-instagram"></i></a>
        <a href="#" class="text-light text-decoration-none me-2"><i class="bi bi-google"></i></a>
        <a href="#" class="text-light text-decoration-none"><i class="bi bi-youtube"></i></a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TopHeader",
};
</script>

<style scoped>
.top-header {
  width: 100%;
}
</style>
