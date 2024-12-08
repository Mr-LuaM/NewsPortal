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
        <a
          v-if="!isLoggedIn"
          href="#"
          @click.prevent="redirectToLogin"
          class="text-light text-decoration-none"
        >
          Login
        </a>
        <button
          v-else
          class="btn btn-link text-light text-decoration-none p-0"
          @click="showModal"
        >
          Logout
        </button>
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

    <!-- Logout Confirmation Modal -->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      aria-labelledby="logoutModalLabel"
      aria-hidden="true"
      ref="logoutModal"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-black" id="logoutModalLabel">Confirm Logout</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="hideModal"
            ></button>
          </div>
          <div class="modal-body text-black">Are you sure you want to log out?</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              @click="hideModal"
            >
              Cancel
            </button>
            <button type="button" class="btn btn-danger" @click="handleLogout">
              Logout
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from "bootstrap";
import axios from "axios";
export default {
  name: "TopHeader",
  data() {
    return {
      modalInstance: null, // Holds the Bootstrap modal instance
    };
  },
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem("adminToken");
    },
  },
  mounted() {
    // Initialize the modal when the component is mounted
    this.modalInstance = new Modal(this.$refs.logoutModal);
  },
  methods: {
    redirectToLogin() {
      this.$router.push("/admin/login");
    },
    showModal() {
      if (this.modalInstance) {
        this.modalInstance.show();
      }
    },
    hideModal() {
      if (this.modalInstance) {
        this.modalInstance.hide();
      }
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
  },
};
</script>

<style scoped>
.top-header {
  width: 100%;
}
</style>
