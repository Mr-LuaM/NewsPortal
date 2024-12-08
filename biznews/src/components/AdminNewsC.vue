<template>
  <div class="mx-5">
    <div class="container-fluid  mt-4">
      <h2 class="text-warning mb-4">Manage News</h2>

        <!-- Search and Add News -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <input
            type="text"
            v-model="searchQuery"
            @input="applyFilters"
            class="form-control w-50"
            placeholder="Search news..."
          />
          <button class="btn btn-success" @click="openAddNewsModal">
            <i class="bi bi-plus-circle"></i> Add News
          </button>
        </div>
  
        <!-- News Table -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle">
            <thead class="bg-dark text-light">
              <tr>
                <th @click="sortBy('id')" class="sortable">#</th>
                <th @click="sortBy('title')" class="sortable">Title</th>
                <th @click="sortBy('category')" class="sortable">Category</th>
                <th @click="sortBy('author.name')" class="sortable">Author</th>
                <th @click="sortBy('views')" class="sortable">Views</th>
                <th @click="sortBy('heart_counts')" class="sortable">Likes</th>
                <th>Tags</th>
                <th @click="sortBy('is_published')" class="sortable">Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(news, index) in paginatedNews" :key="news.id">
                <td>{{ index + 1 + (currentPage - 1) * itemsPerPage }}</td>
                <td>{{ news.title }}</td>
                <td>{{ news.category }}</td>
                <td>
                  <img
                    :src="news.author.profile_picture ? `${baseUrl}/storage/${news.author.profile_picture}` : '/default-avatar.png'"
                    alt="Author"
                    class="rounded-circle me-2"
                    style="width: 30px; height: 30px;"
                  />
                  {{ news.author.name }}
                </td>
                <td>{{ news.views }}</td>
                <td>
                  <i class="bi bi-heart-fill text-danger"></i> {{ news.heart_counts }}
                </td>
                <td>
                  <span
                    v-for="tag in news.tags"
                    :key="tag.id"
                    class="badge bg-info text-dark me-1"
                  >
                    {{ tag.name }}
                  </span>
                </td>
                <td>
                  <span
                    class="badge"
                    :class="news.is_published ? 'bg-success' : 'bg-secondary'"
                  >
                    {{ news.is_published ? 'Published' : 'Draft' }}
                  </span>
                </td>
                <td>
                  <button class="btn btn-primary btn-sm me-2" @click="openEditModal(news)">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button
                    class="btn btn-sm me-2 text-white"
                    :class="news.is_published ? 'bg-success' : 'bg-danger '"
                    @click="togglePublish(news)"
                  >
                    <i :class="news.is_published == '1' ? 'bi bi-x-circle bg-red' : 'bi bi-check-circle'"></i>
                  </button>
                  <button class="btn btn-info btn-sm" @click="previewNews(news)">
                    <i class="bi bi-eye"></i> Preview
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
              <button class="page-link" @click="goToPage(currentPage - 1)">Previous</button>
            </li>
            <li
              v-for="page in totalPages"
              :key="page"
              class="page-item"
              :class="{ active: page === currentPage }"
            >
              <button class="page-link" @click="goToPage(page)">{{ page }}</button>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
              <button class="page-link" @click="goToPage(currentPage + 1)">Next</button>
            </li>
          </ul>
        </nav>

      <!-- Add News Modal -->
      <div class="modal fade" id="addNewsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add News</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="addNews">
            
                <div class="mb-3">
                  <label for="newTitle" class="form-label">Title</label>
                  <input required type="text" id="newTitle" class="form-control" v-model="newNews.title" />
                </div>
                <div class="mb-3">
                  <label for="newCategory" class="form-label">Category</label>
                  <input
                  required
                    type="text"
                    class="form-control"
                    v-model="newNews.category"
                    placeholder="Type or select a category"
                    @focus="showCategoryDropdown = true"
                    @blur="hideDropdownWithDelay('category')"
                    @input="filterCategories"
                  />
                  <div
                    v-if="showCategoryDropdown"
                    class="dropdown-menu show w-100 white-bg"
                    style="max-height: 200px; overflow-y: auto;"
                  >
                    <button
                      class="dropdown-item"
                      v-for="category in filteredCategories"
                      :key="category"
                      @click="selectCategory(category)"
                    >
                      {{ category }}
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="newTags" class="form-label">Tags</label>
                  <div class="input-group">
                    <input 
                      type="text"
                      class="form-control"
                      v-model="tagInput"
                      placeholder="Type and press Enter to add tags"
                      @keydown.enter.prevent="addTagFromInput"
                    />
                  </div>
                  <div class="mt-2">
                    <span
                      v-for="tag in newNews.tags"
                      :key="tag"
                      class="badge bg-primary me-2"
                    >
                      {{ tag }}
                      <i class="bi bi-x-circle ms-1" @click="removeTag(tag)" style="cursor: pointer;"></i>
                    </span>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="newAuthor" class="form-label">Author</label>
                  <select v-model="newNews.authorId" class="form-control">
                    <option v-for="author in authors" :key="author.id" :value="author.id">
                      {{ author.name }}
                    </option>
                  </select>
                  <button class="btn btn-secondary mt-2" type="button" @click="openAddAuthorModal">
                    Add New Author
                  </button>
                </div>
                <div class="mb-3">
                  <label for="newImage" class="form-label">Image</label>
                  <input  required type="file" class="form-control" id="newImage" @change="onImageChange" />
                </div>
                <div class="mb-3">
                  <label for="newContent" class="form-label">Content</label>
                  <div ref="addQuillEditor" style="height: 300px;"></div>
                  <input required type="hidden" name="quillContent" v-model="newNews.content" />
                 <!-- Upload Video Button -->
                  <button
                  type="button"
                  class="btn btn-primary mt-3"
                  style="position: absolute; bottom: 10px; right: 10px;"
                  @click="openVideoModal"
                >
                  <i class="bi bi-upload"></i> Generate Video Link
                </button>
                  
                </div>
                
                <button type="submit" class="btn btn-success" :disabled="loading">
                  <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                  Add News
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
<!--Upload video modal -->
<div class="modal fade" id="uploadVideoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="uploadVideo">
          <div class="mb-3">
            <label for="videoFile" class="form-label">Select Video</label>
            <input
            required
              type="file"
              id="videoFile"
              class="form-control"
              accept="video/*"
              @change="onVideoFileChange"
            />
          </div>
          <button type="submit" class="btn btn-primary" :disabled="uploadingVideo">
            <span v-if="uploadingVideo" class="spinner-border spinner-border-sm me-2"></span>
            Upload
          </button>
        </form>
        <div class="mt-3" v-if="uploadedVideoUrl">
          <p class="text-success">Video uploaded successfully!</p>
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              :value="uploadedVideoUrl"
              readonly
              
            />
            <button class="btn btn-secondary" @click="copyToClipboard">
              Copy Link
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


      <!-- Edit News Modal -->
      <div class="modal fade" id="editNewsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit News</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form v-if="currentNews" @submit.prevent="updateNews">
                <div class="mb-3">
                  <label for="editTitle" class="form-label">Title</label>
                  <input
                    type="text"
                    id="editTitle"
                    class="form-control"
                    v-model="currentNews.title"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="editCategory" class="form-label">Category</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="currentNews.category"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="editTags" class="form-label">Tags</label>
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="tagInput"
                      placeholder="Type and press Enter to add tags"
                      @keydown.enter.prevent="addTagFromInputForEdit"
                     
                    />
                  </div>
                  <div class="mt-2">
                    <span
                      v-for="tag in currentNews.tags"
                      :key="tag"
                      class="badge bg-primary me-2"
                    >
                      {{ tag.name }}
                      <i class="bi bi-x-circle ms-1" @click="removeTagForEdit(tag)" style="cursor: pointer;"></i>
                    </span>
                  </div>
                </div>          
                <div class="mb-3">
                  <label for="editAuthor" class="form-label">Author</label>
                  <select v-model="currentNews.authorId" class="form-control" required>
                    
                    <option v-for="author in authors" :key="author.id" :value="author.id">
                      {{ author.name }}
                    </option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="editImage" class="form-label">Image</label>
                  <input
                    type="file"
                    class="form-control"
                    id="editImage"
                    @change="onImageChange"
                 
                  />
                </div>
                <div class="mb-3">
                  <label for="editContent" class="form-label">Content</label>
                  <div ref="editQuillEditor" style="height: 300px;"></div>
                  <input required type="hidden" name="quillContent" v-model="currentNews.content" />
                </div>
                <button type="submit" class="btn btn-primary" :disabled="loading">
                  <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                  Save Changes
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Add Author Modal -->
      <div class="modal fade" id="addAuthorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Author</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="addAuthor">
                <div class="mb-3">
                  <label for="authorName" class="form-label">Name</label>
                  <input type="text" id="authorName" class="form-control" v-model="newAuthor.name" />
                </div>
                <div class="mb-3">
                  <label for="authorPicture" class="form-label">Profile Picture</label>
                  <input type="file" class="form-control" @change="onFileChange" />
                </div>
                <button type="submit" class="btn btn-primary" :disabled="loading">
                  <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                  Save Author
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Quill from "quill";
import "quill/dist/quill.snow.css";
import { useToast } from "vue-toastification";
export default {
  name: "AdminNews",
 
  data() {
    return {
      quillAdd: null, // Quill instance for Add News modal
      quillEdit: null, // Quill instance for Edit News modal
      newsList: [], 
      baseUrl : import.meta.env.VITE_APP_API_URL,
      filteredNews: [], // Filtered news items
      searchQuery: "", // Search input value
      sortKey: "id", // Default sort key
      sortDirection: "asc", // Default sort direction
      currentPage: 1, // Current page
      itemsPerPage: 5, // Items per page
      newNews: {
        title: "",
        category: "",
        tags: [],
        author: "",
        authorId: null,
        content: "",
        image: null,
      },
      currentNews: null,
      newAuthor: {
        name: "",
        picture: null,
      },
      categories: [],
      filteredCategories: [],
      authors: [],
      filteredAuthors: [],
      tags: [],
      filteredTags: [],
      tagInput: "",
      showCategoryDropdown: false,
      showTagDropdown: false,
      showAuthorDropdown: false,
      toast : useToast(),
      loading: false, // Tracks loading state for buttons
      uploadingVideo: false,
    uploadedVideoUrl: null,
    selectedVideoFile: null,
    };
  },computed: {
    totalPages() {
      return Math.ceil(this.filteredNews.length / this.itemsPerPage);
    },
    paginatedNews() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      return this.filteredNews.slice(start, start + this.itemsPerPage);
    },
  },
  methods: {
    // Fetch all news items
    fetchNews() {
      axios.get("/api/news/all ").then((response) => {
        this.newsList = response.data;this.applyFilters();
      });
    }, applyFilters() {
      const query = this.searchQuery.toLowerCase();
      this.filteredNews = this.newsList
        .filter(
          (news) =>
            news.title.toLowerCase().includes(query) ||
            news.category.toLowerCase().includes(query) ||
            news.author.name.toLowerCase().includes(query)
        )
        .sort((a, b) => {
          const valueA = this.getNestedValue(a, this.sortKey);
          const valueB = this.getNestedValue(b, this.sortKey);

          if (this.sortDirection === "asc") {
            return valueA > valueB ? 1 : valueA < valueB ? -1 : 0;
          } else {
            return valueA < valueB ? 1 : valueA > valueB ? -1 : 0;
          }
        });
      this.currentPage = 1; // Reset to first page
    },
    sortBy(key) {
      if (this.sortKey === key) {
        this.sortDirection = this.sortDirection === "asc" ? "desc" : "asc";
      } else {
        this.sortKey = key;
        this.sortDirection = "asc";
      }
      this.applyFilters();
    },
    getNestedValue(object, path) {
      return path.split(".").reduce((obj, key) => (obj && obj[key] !== undefined ? obj[key] : ""), object);
    },
    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },
    openVideoModal() {
  this.selectedVideoFile = null; // Reset the selected video file
  this.uploadedVideoUrl = null; // Clear the previous video URL
  this.$nextTick(() => {
    const videoModal = new bootstrap.Modal(document.getElementById("uploadVideoModal"));
    videoModal.show();
  });
},

  onVideoFileChange(event) {
    const file = event.target.files[0];
    if (file) {
      this.selectedVideoFile = file;
    }
  },
  async uploadVideo() {
    if (!this.selectedVideoFile) {
      alert("Please select a video file to upload.");
      return;
    }

    this.uploadingVideo = true;
    const formData = new FormData();
    formData.append("video", this.selectedVideoFile);

    try {
      const response = await axios.post("/api/videos/upload", formData, {
        headers: { "Content-Type": "multipart/form-data" },
      });

      if (response.data.success) {
        this.uploadedVideoUrl = response.data.url; // The URL returned by the backend
        this.toast.success("Video uploaded successfully!");
      } else {
        this.toast.error("Failed to upload video.");
      }
    } catch (error) {
      this.toast.error("An error occurred while uploading the video.");
    } finally {
      this.uploadingVideo = false;
    }
  },
  copyToClipboard() {
    navigator.clipboard.writeText(this.uploadedVideoUrl).then(() => {
      this.toast.success("Video URL copied to clipboard!");
    });
  },


    // Open Add News Modal
    openAddNewsModal() {
      this.newNews = {
        title: "",
        category: "",
        tags: [],
        author: "",
        authorId: null,
        content: "",
        image: null,
      };
      this.$nextTick(() => {
        if (!this.quillAdd) {
          const container = this.$refs.addQuillEditor;
          if (container) {
            this.quillAdd = new Quill(container, {
              theme: "snow",
              modules: {
                toolbar: [
                  [{ header: "1" }, { header: "2" }, { font: [] }],
                  [{ list: "ordered" }, { list: "bullet" }],
                  ["bold", "italic", "underline", "strike"],
                  [{ align: [] }],
                  ["link", "image", "video"],
                ],
              },
            });
            this.quillAdd.on("text-change", () => {
              this.newNews.content = this.quillAdd.root.innerHTML;
            });
          }
        } else {
          this.quillAdd.root.innerHTML = ""; // Clear content
        }
      });
      new bootstrap.Modal(document.getElementById("addNewsModal")).show();
    },
    openAddAuthorModal() {
    this.newAuthor = {
      name: "",
      picture: null,
    };
    this.$nextTick(() => {
      new bootstrap.Modal(document.getElementById("addAuthorModal")).show();
    });
  },
    // Add News
    async addNews() {
      this.loading = true;
      const formData = new FormData();
      formData.append("title", this.newNews.title);
      formData.append("category", this.newNews.category);
      formData.append("content", this.quillAdd.root.innerHTML);
      formData.append("authorId", this.newNews.authorId);
      formData.append("tags", this.newNews.tags);
      console.log("Tags being sent:", this.newNews.tags);

      if (this.newNews.image) {
        formData.append("image", this.newNews.image);
      }

      try {
        await axios.post("/api/news", formData);
        this.toast.success("News added successfully!");
        this.fetchNews();
        new bootstrap.Modal(document.getElementById("addNewsModal")).hide();
      } catch (error) {
         this.toast.error("Failed to add news.", "danger");
      } finally {
        this.loading = false;
      }
    },

    // Open Edit News Modal
    openEditModal(news) {
      this.currentNews = { ...news };
      this.currentNews.image = null;
      this.$nextTick(() => {
        if (!this.quillEdit) {
          const container = this.$refs.editQuillEditor;
          if (container) {
            this.quillEdit = new Quill(container, {
              theme: "snow",
              modules: {
                toolbar: [
                  [{ header: "1" }, { header: "2" }, { font: [] }],
                  [{ list: "ordered" }, { list: "bullet" }],
                  ["bold", "italic", "underline", "strike"],
                  [{ align: [] }],
                  ["link", "image"],
                ],
              },
            });
            this.quillEdit.on("text-change", () => {
              this.currentNews.content = this.quillEdit.root.innerHTML;
            });
          }
        }
        if (this.quillEdit) {
          this.quillEdit.root.innerHTML = this.currentNews.content || ""; // Load existing content
        }
      });
      new bootstrap.Modal(document.getElementById("editNewsModal")).show();
    },

    // Update News
    async updateNews() {
  this.loading = true;

  const formData = new FormData();
  formData.append("title", this.currentNews.title);
  formData.append("content", this.quillEdit.root.innerHTML);
  formData.append("authorId", this.currentNews.authorId);
  formData.append("category", this.currentNews.category || "");
  formData.append("tags", JSON.stringify(this.currentNews.tags));

  if (this.currentNews.image) {
    formData.append("image", this.currentNews.image);
  }

  console.log("FormData content:");
  formData.forEach((value, key) => console.log(`${key}:`, value));

  try {
    const response = await axios.post(`/api/news/${this.currentNews.id}`, formData);
    this.toast.success("News updated successfully!");
    this.fetchNews();
    new bootstrap.Modal(document.getElementById("editNewsModal")).hide();
  } catch (error) {
    console.error("Error:", error.response?.data || error.message);
    this.toast.error("Failed to update news.", "danger");
  } finally {
    this.loading = false;
  }
}
,

    // Toggle Publish Status
    async togglePublish(news) {
      const updatedStatus = !news.is_published;
      try {
        await axios.put(`/api/news/${news.id}/publish`, { is_published: updatedStatus });
        this.fetchNews();
         this.toast.success(updatedStatus ? "News published!" : "News unpublished!");
      } catch (error) {
         this.toast.error("Failed to update publish status.", "danger");
      }
    },

    // Add Author
    async addAuthor() {
      this.loading = true;
      const formData = new FormData();
      formData.append("name", this.newAuthor.name);
      if (this.newAuthor.picture) {
    formData.append("profile_picture", this.newAuthor.picture);
  }
      try {
        await axios.post("/api/authors", formData);
        this.fetchAuthors();
         this.toast.success("Author added successfully!");
         new bootstrap.Modal(document.getElementById("addAuthorModal")).hide();
        } catch (error) {
         this.toast.error("Failed to add author.", "danger");
      } finally {
        this.loading = false;
      }
    },

    // Toast Management
    showToast(message, type = "success") {
      this.toast.message = message;
      this.toast.type = type;
      this.toast.visible = true;
      setTimeout(() => {
        this.toast.visible = false;
      }, 3000);
    },

    // Dropdown and Tag Management
    filterCategories() {
      const query = this.newNews.category.toLowerCase();
      this.filteredCategories = this.categories.filter((category) =>
        category.toLowerCase().includes(query)
      );
    },
    selectCategory(category) {
      this.newNews.category = category;
      this.showCategoryDropdown = false;
    },
    filterTags() {
      const query = this.tagInput.toLowerCase();
      this.filteredTags = this.tags.filter((tag) => tag.toLowerCase().includes(query));
    },
    addTagFromInput() {
  const tag = this.tagInput.trim();
  if (tag && !this.newNews.tags.includes(tag)) {
    this.newNews.tags.push(tag); // Add tag
  }
  this.tagInput = ""; // Clear input
  console.log("Tags being sent:", this.newNews.tags);

},  addTagFromInputForEdit() {
  const tag = this.tagInput.trim();
  if (tag && !this.currentNews.tags.some((t) => t.name === tag)) {
    this.currentNews.tags.push({ name: tag }); // Add new tag as object
  }
  this.tagInput = ""; // Clear input
},
removeTagForEdit(tag) {
  this.currentNews.tags = this.currentNews.tags.filter((t) => t.name !== tag.name);
},


removeTag(tag) {
  this.newNews.tags = this.newNews.tags.filter((t) => t !== tag); // Remove tag
},




    // Fetch Data
    fetchAuthors() {
      axios.get("/api/authors").then((response) => {
        this.authors = response.data;
        this.filteredAuthors = [...this.authors];
      });
    },
    fetchCategories() {
      axios.get("/api/categories").then((response) => {
        this.categories = response.data;
        this.filteredCategories = [...this.categories];
      });
    },
    fetchTags() {
      axios.get("/api/tags").then((response) => {
        this.tags = response.data.map((tag) => tag.name);
        this.filteredTags = [...this.tags];
      });
    },

    onFileChange(event) {
  const file = event.target.files[0];
  if (file) {
    this.newAuthor.picture = file;
  }
},
previewNews(news) {
    // Redirect to the news preview page
    this.$router.push({ name: "NewsArticle", params: { id: news.id } });
  },
    onImageChange(event) {
      if (event.target.files.length > 0) {
        if (this.currentNews) {
          this.currentNews.image = event.target.files[0];
        } else {
          this.newNews.image = event.target.files[0];
        }
      }
    },
  },
  mounted() {
    this.fetchCategories();
    this.fetchTags();
    this.fetchAuthors();
    this.fetchNews();

  },
};
</script>



<style scoped>
.table {
  margin-top: 20px;
}
.badge {
  font-size: 0.9rem;
}
.white-bg {
  background-color: #ffffff;
}
</style>
