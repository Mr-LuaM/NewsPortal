<template>
    <div class="container-fluid my-5">
      <div class="row">
        <!-- Latest News Section -->
        <div class="col-lg-8">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-uppercase"><span class="border-start border-4 border-warning px-2"></span>Latest News</h4>
            <a href="#" class="text-decoration-none text-warning">View All</a>
          </div>
          <div class="row g-4">
            <div v-for="n in 2" :key="n" class="col-md-6">
              <div class="card border-0 shadow">
                <img src="../assets/demo.png" class="card-img-top" alt="News Image" />
                <div class="card-body">
                  <span class="badge bg-warning text-dark mb-2">Business</span>
                  <h5 class="card-title">Lorem Ipsum Dolor Sit Amet Elit...</h5>
                  <p class="text-muted small">Jan 01, 2045</p>
                  <p class="card-text small">Dolor lorem eos dolor duo et eirmod sea. Dolor sit magna rebmu clita rebmu dolor stet amet justo</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                      <img src="../assets/demo.png" class="rounded-circle me-2" alt="Author" width="30" height="30" />
                      <small class="text-muted">John Doe</small>
                    </div>
                    <div>
                      <small class="text-muted me-3"><i class="bi bi-eye"></i> 12345</small>
                      <small class="text-muted"><i class="bi bi-chat"></i> 123</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Right Sidebar -->
        <div class="col-lg-4">
          <!-- Trending News -->
          <div class="mb-4">
            <h5 class="text-uppercase"><span class="border-start border-4 border-warning px-2"></span>Trending News</h5>
            <ul class="list-unstyled mt-3">
              <li v-for="n in 5" :key="n" class="d-flex mb-3 align-items-center">
                <img src="../assets/demo.png" class="rounded me-3" alt="Trending News" width="80" height="80" />
                <div>
                  <span class="badge bg-warning text-dark mb-1">Business</span>
                  <h6 class="mb-0">Lorem Ipsum Dolor Sit Amet Elit...</h6>
                  <p class="text-muted small mb-0">Jan 01, 2045</p>
                </div>
              </li>
            </ul>
          </div>
  
          <!-- Tags Section -->
          <div>
            <h5 class="text-uppercase"><span class="border-start border-4 border-warning px-2"></span>Tags</h5>
            <div class="mt-3">
              <span v-for="tag in ['Politics', 'Business', 'Corporate', 'Health', 'Education', 'Science', 'Foods', 'Travel']" :key="tag" class="badge bg-light text-dark border me-2 mb-2">
                {{ tag }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "NewsSection",
  };
  </script>
  
  <style scoped>
  .card-img-top {
    object-fit: cover;
    height: 200px;
  }
  
  h4, h5 {
    font-weight: bold;
  }
  
  .badge {
    font-size: 0.8rem;
  }
  
  .card-body {
    font-size: 0.9rem;
  }
  
  ul {
    padding-left: 0;
  }
  </style>
  