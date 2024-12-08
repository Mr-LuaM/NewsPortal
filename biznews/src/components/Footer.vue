<template>
    <footer class="footer bg-dark text-light py-4 mt-4 pt-4">
      <div class="container-fluid mx-5">
        <div class="row">
          <!-- About Section -->
          <div class="col-md-4 mb-3">
            <h5 class="text-uppercase text-warning">About BizNews</h5>
            <p class=" text-white small">
              BizNews is your trusted source for the latest news across various categories. Stay informed with credible and timely updates from around the world.
            </p>
          </div>
  
          <!-- Quick Links -->
          <div class="col-md-4 mb-3">
            <h5 class="text-uppercase text-warning">Quick Links</h5>
            <ul class="list-unstyled">
              <li>
                <router-link to="/" class="text-decoration-none text-light">Home</router-link>
              </li>
              <li>
                <router-link to="/news/category" class="text-decoration-none text-light">Categories</router-link>
              </li>
              <li>
                <router-link to="/browse/tag" class="text-decoration-none text-light">Browse by Tags</router-link>
              </li>
            </ul>
          </div>
  
          <!-- Follow Us -->
          <div class="col-md-4 mb-3">
            <h5 class="text-uppercase text-warning">Follow Us</h5>
            <div class="d-flex">
              <a
                href="https://www.facebook.com"
                target="_blank"
                class="text-light me-3"
                aria-label="Facebook"
              >
                <i class="bi bi-facebook fs-4"></i>
              </a>
              <a
                href="https://twitter.com"
                target="_blank"
                class="text-light me-3"
                aria-label="Twitter"
              >
                <i class="bi bi-twitter fs-4"></i>
              </a>
              <a
                href="https://www.instagram.com"
                target="_blank"
                class="text-light me-3"
                aria-label="Instagram"
              >
                <i class="bi bi-instagram fs-4"></i>
              </a>
              <a
                href="https://www.linkedin.com"
                target="_blank"
                class="text-light"
                aria-label="LinkedIn"
              >
                <i class="bi bi-linkedin fs-4"></i>
              </a>
            </div>
          </div>
        </div>
  
        <!-- Bottom Section -->
        <div class="text-center border-top border-secondary pt-3">
          <p class="small text-white mb-0">
            &copy; 2024 BizNews. All Rights Reserved.
          </p>
        </div>
      </div>
    </footer>
  </template>
  
  <script>
  export default {
    name: "Footer",
  };
  </script>
  
  <style scoped>
  .footer a:hover {
    color: #ffc107 !important; /* Highlight links on hover */
  }
  
  .footer a {
    transition: color 0.3s ease;
  }
  
  .footer .bi {
    transition: transform 0.3s ease;
  }
  
  .footer .bi:hover {
    transform: scale(1.1);
  }
  </style>
  