
# NewsPortal

A dynamic and responsive news portal application inspired by [BizNews by ThemeWagon](https://themewagon.github.io/biznews/). While not a one-to-one replica, it incorporates the core visual and structural elements to provide an attractive, user-friendly interface. It features a **Laravel backend** and **Vue.js frontend**, connected via **Axios** for seamless communication.

The portal includes a carousel for main headlines, categorized news sections, trending news, and tags, all optimized for responsiveness and usability.

---

## Purpose for Publishing on GitHub

### Learning Resource
- Demonstrates the integration of **Laravel** and **Vue.js** for a real-world application.
- Provides developers with a resource to learn responsive design, API communication, and dynamic content management.

### Usability and Appeal
- Serves as a showcase for a visually engaging and functional news portal.
- Useful for freelancers, developers, or businesses looking to deploy a similar solution.

### Collaboration and Community
- Encourages contributions from the developer community.
- Open to feedback, feature suggestions, and improvements.

### Portfolio Addition
- Highlights the ability to analyze, adapt, and implement design principles from existing works.
- Adds credibility to developer profiles with a fully functional and scalable project.

---
### Code Features
- **Clean Code and Modular Approach**:  
  The project emphasizes clean, readable, and maintainable code. Components are reusable, and the structure follows a modular approach for scalability.

- **HTML to Vue Conversion**:  
  Designed as an excellent learning project for developers familiar with HTML, demonstrating how to convert static templates into dynamic Vue.js components.

---

## Features

### User Features
- **Main Carousel for Headlines**:  
  Showcases top news stories with an engaging carousel.
  
- **Categorized News Sections**:  
  Allows users to explore articles grouped by categories.

- **Trending News Widget**:  
  Highlights popular news articles.

- **Tags for Filtering**:  
  Enables filtering of news by specific tags.

- **Responsive Design**:  
  Fully optimized for different screen sizes and devices.

### Admin Features
- **News Management**:  
  - Add, edit, or delete news articles.
  - Assign categories, tags, and images to articles.

- **Author Management**:  
  - Create and manage author profiles, including images.

- **Tag Management**:  
  - Dynamically manage tags.

- **Role-Based Authentication**:  
  - Separate access for admin and user roles.

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

### Prerequisites
- **PHP 8.1 or higher**
- **Node.js 16+**
- **Composer**
- **MySQL**

### Clone the Repository
```bash
git clone https://github.com/Mr-LuaM/news-portal.git
cd news-portal
```

### Backend (Laravel) Setup
1. Navigate to the Laravel directory:
   ```bash
   cd backend
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy the `.env.example` file to `.env` and set up environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your `.env` file:
   - Set the database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=news_portal
     DB_USERNAME=root
     DB_PASSWORD=your_password
     ```

5. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Serve the Laravel backend:
   ```bash
   php artisan serve
   ```
   The backend will run at `http://127.0.0.1:8000`.

---

### Frontend (Vue.js) Setup
1. Navigate to the Vue.js directory:
   ```bash
   cd frontend
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Create an `.env` file:
   ```bash
   cp .env.example .env
   ```

4. Set up the backend URL in `.env`:
   ```bash
   VITE_APP_API_URL=http://127.0.0.1:8000
   ```

5. Start the development server:
   ```bash
   npm run dev
   ```
   The frontend will run at `http://127.0.0.1:5173`.

---

## Running the Application
- Ensure both the **backend** and **frontend** servers are running:
  - Backend: `php artisan serve`
  - Frontend: `npm run dev`
  
- Access the application via the **frontend URL** (`http://127.0.0.1:5173`).

---

## Usage

1. **For Users**:
   - Browse news articles using the carousel and categorized sections.
   - Filter articles using tags or explore trending news.

2. **For Admins**:
   - Log in to manage articles, authors, and tags.
   - Ensure role-based authentication is implemented to separate admin and user features.

---

## Technologies Used

### Backend
- **Framework**: Laravel 11
- **Database**: MySQL
- **Authentication**: Laravel Breeze (secure role-based authentication)

### Frontend
- **Framework**: Vue.js 3
- **Styling**: Bootstrap 5
- **State Management**: Vuex (optional, if needed)
- **HTTP Client**: Axios

---

## Folder Structure

```
news-portal/
├── backend/
│   ├── app/                # Laravel Models, Controllers, and Services
│   ├── database/           # Migrations and Seeders
│   ├── routes/             # API and Web routes
│   ├── ...
├── frontend/
│   ├── src/
│   │   ├── components/     # Vue.js Components
│   │   ├── views/          # Vue.js Pages
│   │   ├── ...
│   ├── public/             # Frontend assets
├── ...
```

---

## License

This project is open-source and licensed under the MIT License.

---

## Acknowledgments

- Design inspiration from [BizNews by ThemeWagon](https://themewagon.github.io/biznews/).
- Built as a hands-on project to learn and demonstrate proficiency in **Laravel**, **Vue.js**, and responsive design principles.
