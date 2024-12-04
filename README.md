
# NewsPortal

A dynamic and responsive news portal application designed with inspiration from [BizNews by ThemeWagon](https://themewagon.github.io/biznews/). While not a one-to-one replica, it incorporates the core visual and structural elements to provide an attractive, user-friendly interface. Built using **Laravel** for the backend and **Vue.js** for the frontend, this project showcases a carousel for main headlines, categorized news sections, trending news, and tags in a clean and modern design.

This project also serves as a practical exercise in understanding and implementing design principles by recreating an existing UI. By analyzing and adapting the features of a well-designed interface, developers can refine their skills in both design and functionality, ensuring the portal is as appealing as it is efficient.

---

## Purpose for Publishing on GitHub

### Learning Resource
- Demonstrates how to combine **Laravel** and **Vue.js** effectively for a real-world application.
- Provides beginners and intermediate developers with a resource for learning responsive design, API integration, and dynamic content management.

### Attractiveness and Usability
- Serves as a showcase of how a visually engaging and functional news portal can be created.
- Useful for freelancers, developers, or small businesses looking to deploy a similar solution.

### Collaboration and Improvement
- Encourages contributions from the community to refine the project further.
- Opens the door for feedback, ideas, and potential enhancements from others.

### Portfolio Addition
- Demonstrates the ability to analyze, adapt, and create designs inspired by existing works.
- Adds credibility to your profile by showcasing a completed, functional project.

---

## Features

### For Users
- **Main Carousel for Top Stories**:  
  A visually engaging carousel for featured news articles.
  
- **Categorized News Sections**:  
  Displays articles grouped by categories for easy exploration.

- **Trending News Widget**:  
  Highlights the most popular news articles.

- **Tags for Filtering**:  
  Allows users to filter news based on tags of interest.

- **Responsive Design**:  
  Fully responsive, ensuring compatibility across devices.

### For Admins
- **News Management**:  
  - Add, edit, or delete news articles.
  - Upload article images, assign categories, and manage tags.

- **Author Management**:  
  - Create and manage author profiles, including their names and profile pictures.

- **Tag Management**:  
  - Add, edit, or delete tags dynamically.

- **Security Features**:  
  - Role-based authentication for admin and user access.
  - Protection of sensitive data with secure API endpoints.
  - CSRF protection for form submissions.

### Code Features
- **Clean Code and Modular Approach**:  
  The project emphasizes clean, readable, and maintainable code. Components are reusable, and the structure follows a modular approach for scalability.

- **HTML to Vue Conversion**:  
  Designed as an excellent learning project for developers familiar with HTML, demonstrating how to convert static templates into dynamic Vue.js components.

---

## Table of Contents
1. [Installation](#installation)
2. [Usage](#usage)
3. [Technologies Used](#technologies-used)
4. [Folder Structure](#folder-structure)
5. [License](#license)
6. [Acknowledgments](#acknowledgments)

---

## Installation

### Clone the Repository
```bash
git clone https://github.com/Mr-LuaM/news-portal.git
cd news-portal
```

### Install Dependencies
1. Install backend dependencies:
   ```bash
   composer install
   ```
2. Install frontend dependencies:
   ```bash
   npm install
   ```

### Set Up Environment
1. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Generate the application key:
   ```bash
   php artisan key:generate
   ```
3. Configure your database credentials in the `.env` file.

### Run Migrations and Seeders
```bash
php artisan migrate --seed
```

### Build Frontend Assets
```bash
npm run dev
```

### Run the Application
```bash
php artisan serve
```

Access the app at: `http://localhost:8000`

---

## Usage

1. **For Users**:
   - Explore news articles via the main carousel or categorized sections.
   - Filter articles using tags or browse trending news.
   
2. **For Admins**:
   - Manage news, authors, and tags through the admin panel (to be implemented).

---

## Technologies Used

- **Backend**: Laravel 11
- **Frontend**: Vue.js 3, Bootstrap 5
- **Database**: MySQL
- **Authentication**: Laravel Breeze (for secure login and role management)
- **Other Tools**: Composer, npm, Axios

---

## Folder Structure

```
news-portal/
├── app/
│   ├── Models/         # Laravel Models
│   ├── Http/Controllers/  # API Controllers
│   ├── ...
├── database/
│   ├── migrations/     # Database migrations
│   ├── seeders/        # Database seeders
│   ├── ...
├── public/             # Public assets
├── resources/
│   ├── views/          # Blade templates (if any)
│   ├── js/             # Vue components
├── routes/
│   ├── api.php         # API routes
│   ├── web.php         # Web routes
├── ...
```

---

## License

This project is open-source and licensed under the MIT License.

---

## Acknowledgments

- Design inspired by [BizNews by ThemeWagon](https://themewagon.github.io/biznews/).
- Built as a learning project to improve skills in Laravel, Vue.js, and responsive design.
