<template>
  <div style="background-color: #000;" class="d-flex justify-content-center align-items-center vh-100 ">
    <div class=" text-light p-4 rounded shadow-lg w-100" style="max-width: 400px; background-color: #3a3a3a;">
      <!-- Logo/Title -->
      <div class="text-center mb-4">
        <h1 class="text-warning">Biz<span class="text-light">News</span></h1>
        <p class="small text-secondary">Admin Login</p>
      </div>

      <!-- Login Form -->
      <form @submit.prevent="handleLogin">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            v-model="email"
            id="email"
            class="form-control"
            placeholder="Enter your email"
            required
          />
          <small v-if="error.email" class="text-danger">{{ error.email }}</small>
        </div>
        <div class="mb-3 position-relative">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <input
              :type="showPassword ? 'text' : 'password'"
              v-model="password"
              id="password"
              class="form-control"
              placeholder="Enter your password"
              required
            />
            <button
              type="button"
              class="btn btn-outline-secondary"
              @click="togglePassword"
            >
              <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
            </button>
          </div>
          <small v-if="error.password" class="text-danger">{{ error.password }}</small>
        </div>
        <button class="btn btn-warning w-100 fw-bold" type="submit">Login</button>
        <small v-if="error.general" class="text-danger d-block mt-2 text-center">{{ error.general }}</small>
      </form>

      <!-- Footer -->
      <div class="text-center mt-4 small text-secondary">
        © 2024 BizNews Admin Portal
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminLogin",
  data() {
    return {
      email: "",
      password: "",
      showPassword: false,
      error: {
        email: "",
        password: "",
        general: "",
      },
    };
  },
  methods: {
    togglePassword() {
      this.showPassword = !this.showPassword;
    },
    async handleLogin() {
      this.error = { email: "", password: "", general: "" }; // Reset errors

      if (!this.email) {
        this.error.email = "Email is required.";
        return;
      }

      if (!this.password) {
        this.error.password = "Password is required.";
        return;
      }

      try {
        const response = await axios.post("api/admin/login", {
          email: this.email,
          password: this.password,
        });

        if (response.data.success) {
          localStorage.setItem("adminToken", response.data.token);
          this.$router.push("/");
        } else {
          this.error.general = response.data.message || "Login failed. Try again.";
        }
      } catch (error) {
        console.error(error);
        this.error.general =
          error.response?.data?.message || "Login failed. Please check your credentials.";
      }
    },
  },
};
</script>
