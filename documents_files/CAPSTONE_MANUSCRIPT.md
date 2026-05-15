# RHU-Laravel Capstone Project - Methodology Documentation

## Project Overview

**Project Name:** RHU-Laravel (Rural Health Unit Management System)  
**Analysis Date:** April 22, 2026  
**Analysis Focus:** Backend Framework Architecture, Technology Stack, and Development Patterns

---

## Chapter 3: Methodology

### 3.1 Analysis Approach

This methodology documents the systematic review conducted on the RHU-Laravel backend system. The analysis encompasses:

1. **Framework & Version Identification**
2. **Technology Stack Assessment**
3. **Architecture Pattern Evaluation**
4. **Code Structure Analysis**
5. **Third-Party Integration Review**
6. **Data Flow Documentation**

---

### 3.2 Project Design

This section details the various architecture and technologies employed in developing the RHU-Laravel system. The system uses a modern, scalable backend architecture combined with contemporary frontend technologies to deliver a robust rural health management solution.

#### 3.2.1 Laravel and the MVC Architecture

The RHU-Laravel system is built on **Laravel Framework version 12.56.0**, utilizing the classic **Model-View-Controller (MVC)** architectural pattern. This architecture provides clear separation between data handling, business logic, and presentation layers.

**Architectural Components:**

- **Models** (`app/Models/`): Eloquent ORM models manage data persistence and relationships with the database. Current models include `MaternalRecord`, `Patient`, `ChildNutritionRecord`, and `User`. Each model uses:
  - `$fillable` arrays for mass assignment protection
  - `$casts` for type casting (e.g., date casting for `last_checkup_date`, `expected_delivery_date`)
  - No custom query methods or relationships currently defined

- **Controllers** (`app/Http/Controllers/Admin/`): Handle incoming HTTP requests, process form submissions, and execute queries directly through models. Controllers include:
  - `MaternalController` - Manages maternal record CRUD operations
  - `ChildNutritionController` - Manages child nutrition data
  - Direct business logic and query building at controller level
  - No abstraction layers (Services/Repositories)

- **Views** (`resources/views/`): Blade templating engine renders the user interface with:
  - Reusable Blade components (`<x-nav-link>`, `<x-dropdown-link>`)
  - Tailwind CSS utility classes for styling
  - Data binding and form handling via `@csrf`, `@error` directives
  - Alpine.js for interactive components (mobile menu toggle)

- **Routes** (`routes/web.php`): Define application endpoints with middleware protection:
  - Built-in `auth` middleware for authentication checks
  - Custom `IsAdmin` middleware restricting routes to admin users
  - Custom `IsUser` middleware restricting routes to regular users
  - Named routes for easy referencing (e.g., `route('maternal.index')`)

**Data Flow Example: Maternal Record Retrieval**

```
HTTP Request: GET /maternal-care
    ↓
Route Middleware: ['auth', IsAdmin::class]
    ↓
MaternalController::index(Request $request)
    ↓
Query Building at Controller Level:
  - $query = MaternalRecord::query()
  - Search filtering: where('full_name', 'like', '%'.$search.'%')
  - Risk level filtering: where('risk_level', $request->risk_level)
  - Pagination: ->paginate(15)
    ↓
MaternalRecord Model (Eloquent):
  - Eloquent handles database query execution
  - Type casting applied (dates)
    ↓
Database Query: SELECT * FROM maternal_records ...
    ↓
View: resources/views/admin/maternal/index.blade.php
  - compact('records') passes data to view
  - Blade loops through records and renders with Tailwind CSS
    ↓
HTML Response with Tailwind-styled UI
```

**Data Flow Example: Creating New Maternal Record**

```
HTTP Request: POST /maternal-care/store
    ↓
Route Middleware: ['auth', IsAdmin::class]
    ↓
MaternalController::store(Request $request)
    ↓
Request Validation at Controller:
  - $request->validate([
      'full_name' => 'required|string|max:255',
      'age' => 'required|integer|min:15|max:50',
      'contact_number' => 'required|regex:/^[0-9\-\+\s]{7,}$/',
      'pregnancy_stage' => 'required|in:first_trimester,second_trimester,third_trimester',
      'risk_level' => 'required|in:low,medium,high'
    ])
    ↓
MaternalRecord::create($validated)
    ↓
Database INSERT Query
    ↓
Redirect with Success Message
```

**Architecture Notes:**
- **NO Service/Repository Pattern**: All business logic resides directly in controllers
- **Direct Model Access**: Controllers query models directly without abstraction layers
- **Controller-Level Validation**: Form validation handled at controller level
- **Suitable for Current Scale**: MVC pattern is adequate for application requirements but would benefit from service layers as the application grows

#### 3.2.2 Frameworks and APIs

**Backend Framework & Language:**
- **PHP 8.2+** - Server-side language
- **Laravel 12.56.0** - Modern PHP web application framework with:
  - Built-in authentication scaffolding via Laravel Breeze
  - Eloquent ORM for intuitive database access
  - Migration system for database schema versioning
  - Middleware pipeline for request/response handling
  - Database seeding for test data generation
  - CSRF token protection out-of-the-box
  - Role-based middleware implementation

**Frontend Frameworks & Tools:**

1. **CSS Framework: Tailwind CSS 3.4.19** ✅
   - Utility-first CSS framework for rapid UI development
   - Dependencies: `@tailwindcss/forms` (v0.5.2), `@tailwindcss/vite` (v4.0.0)
   - Responsive breakpoints: `sm:`, `lg:`, `2xl:` for mobile-first design
   - Used throughout layout files: `bg-gray-100`, `border-gray-100`, `max-w-7xl`, `px-4`
   - **NOT Bootstrap** - Confirmed by package.json analysis

2. **JavaScript Framework: Alpine.js 3.4.2**
   - Lightweight JavaScript framework for component interactivity
   - Used for interactive elements (e.g., mobile navigation menu toggle with `@click="open = !open"`)
   - Minimal overhead compared to heavier frameworks

3. **Starter Kit: Laravel Breeze 2.4** ✅
   - Authentication scaffolding package with pre-built authentication views and controllers
   - Includes:
     - User registration and login pages
     - Password reset functionality
     - Email verification
     - Profile management
     - Pre-built Blade components for navigation and dropdowns
   - Foundation of the authentication system

4. **Build Tool: Vite 7.0.7**
   - Modern asset bundler for CSS and JavaScript
   - Hot module replacement during development
   - Configured in `tailwind.config.js` for Tailwind integration
   - Asset compilation scripts: `npm run dev` (development), `npm run build` (production)

**Database:**
- **MySQL 8.0+** - Relational database with migrations for schema versioning
- Connection configured in `.env.example`: `DB_CONNECTION=mysql`, `DB_DATABASE=rhu_laravel`

**Third-Party APIs & Services** (Configured in `config/services.php`):

1. **Email Services** (Configured):
   - **Postmark** - API-based email delivery service
     - Configuration key: `POSTMARK_API_KEY`
   - **Resend** - Modern email service provider
     - Configuration key: `RESEND_API_KEY`
   - **AWS SES** - Amazon Simple Email Service for transactional emails
     - Configuration keys: `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`

2. **Communication Services** (Configured):
   - **Slack Notifications** - Integration for system alerts and notifications
     - Configuration keys: `SLACK_BOT_USER_OAUTH_TOKEN`, `SLACK_BOT_USER_DEFAULT_CHANNEL`

3. **NOT Configured/Missing**:
   - ❌ **SMS Services**: Twilio, Vonage/Nexmo, iSMS (NOT found in composer.json or config)
   - ❌ **PDF Generation**: DomPDF, mPDF (NOT in composer.json)
   - ❌ **Charting Libraries**: Chart.js (NOT in package.json)

**Development & Testing Tools** (in `require-dev`):
- **Pest 3.8** - Modern PHP testing framework
- **Laravel Pint 1.24** - Code style fixer for PSR-12 compliance
- **Laravel Sail 1.41** - Docker containerization for consistent development environments
- **FakerPHP 1.23** - Fake data generation for testing and seeding
- **Laravel Tinker** - Interactive PHP shell for quick database manipulation

**Package Management:**
- **Composer** - PHP dependency manager (backend packages)
- **npm** - Node Package Manager (frontend packages and build tools)

---

### 3.3 Data Collection Methods

#### 3.2.1 File-Based Analysis

**Examined Files:**
- `composer.json` - Backend dependencies and framework version
- `package.json` - Frontend/build dependencies
- `.env.example` - Environment configuration template
- `tailwind.config.js` - CSS framework configuration
- `routes/web.php` - Application routing structure
- `app/Http/Controllers/` - Controller implementations
- `app/Models/` - Data models and Eloquent configurations
- `resources/views/layouts/` - View layer components
- `config/services.php` - Third-party service configurations

#### 3.3.2 Directory Structure Analysis

Reviewed the following directory hierarchies:
- Application structure (`app/` folder)
- Database configurations (`database/` folder)
- View templates (`resources/views/` folder)
- Configuration files (`config/` folder)
- HTTP layer organization (`app/Http/Controllers/` folder)

#### 3.3.3 Source Code Inspection

Analyzed:
- Model definitions (MaternalRecord.php, Patient.php)
- Controller methods (MaternalController.php, ChildNutritionController.php)
- Blade template syntax and component usage
- Route middleware implementation

---

### 3.4 Analysis Categories

#### 3.4.1 Framework Version Identification

**Method:** 
- Extracted version constraints from `composer.json` `require` section
- Cross-referenced with terminal output: `php artisan --version`

**Findings:**
- **Identified Version:** Laravel 12.56.0
- **Constraint in composer.json:** `"laravel/framework": "^12.0"`
- **Status:** Production-ready, latest stable version

---

#### 3.4.2 Frontend Technology Stack Assessment

**Method:**
- Examined `package.json` devDependencies
- Analyzed `tailwind.config.js` configuration
- Reviewed blade template files for styling classes
- Checked view components for framework indicators

**Analysis Points:**
- CSS framework identification (utility classes: `rounded-lg`, `border-gray-300`, `focus:border-emerald-500`)
- Tailwind plugin usage (`@tailwindcss/forms`, `@tailwindcss/vite`)
- Font configurations (Figtree, Outfit custom fonts)
- Responsive breakpoints (custom TailAdmin breakpoints: `2xsm`, `xsm`, `3xl`)

**Findings:**
- **Primary CSS Framework:** Tailwind CSS 3.4.19
- **Starter Kit:** Laravel Breeze 2.4
- **Build Tool:** Vite 7.0.7
- **JavaScript Framework:** Alpine.js 3.4.2
- **Status:** Modern, maintained, production-ready

---

#### 3.4.3 Architecture Pattern Evaluation

**Method:**
- Traced data flow from routes → controllers → models → views
- Examined controller method implementations
- Analyzed model structures and database relationships
- Reviewed middleware implementation (`IsAdmin`, `IsUser`)
- Assessed code organization for design patterns

**Analysis Points:**
1. **Route Layer** (`routes/web.php`):
   - Middleware authentication checks
   - Named routes for easy referencing
   - Resource routing structure

2. **Controller Layer** (`app/Http/Controllers/Admin/MaternalController.php`):
   - Direct business logic in controller methods
   - Query building at controller level
   - Form validation in action methods
   - No abstraction layers (Services/Repositories)

3. **Model Layer** (`app/Models/`):
   - Basic Eloquent models
   - `$fillable` arrays for mass assignment
   - Type casting with `$casts`
   - No custom query methods or relationships defined

4. **View Layer** (`resources/views/`):
   - Blade templating syntax
   - Alpine.js for component reactivity
   - Blade components usage (`<x-nav-link>`, `<x-dropdown-link>`)
   - Form binding with `@csrf`, `@error` directives

**Findings:**
- **Architecture Pattern:** Standard MVC (Model-View-Controller)
- **Design Pattern Status:** Basic implementation, NO Services/Repositories layer
- **Data Flow:** Route → Controller → Model → View (Direct)
- **Limitation:** No separation of concerns between HTTP handling and business logic

---

#### 3.3.4 Code Structure Analysis

**Method:**
- Examined file organization
- Analyzed naming conventions
- Reviewed middleware implementation
- Assessed controller method organization

**Findings:**

| Component | Status | Details |
|-----------|--------|---------|
| **Naming Convention** | ✅ PSR-4 | `App\Models\`, `App\Http\Controllers\Admin\` |
| **Middleware** | ✅ Custom | `IsAdmin::class`, `IsUser::class` |
| **Route Protection** | ✅ Implemented | Auth guards + role-based middleware |
| **Validation** | ✅ Present | Laravel validation rules in controllers |
| **Error Handling** | ✅ Basic | View error display with `@error()` |

---

#### 3.3.5 Third-Party Integration Review

**Method:**
- Examined `config/services.php` for configured services
- Reviewed `.env.example` for available configuration keys
- Searched codebase for library imports/usage
- Analyzed `composer.json` for dependencies

**Analyzed Services:**

1. **Email Services (Configured):**
   - Postmark (API-based email)
   - Resend (Modern email API)
   - AWS SES (Amazon Simple Email Service)

2. **Communication Services (Configured):**
   - Slack Notifications (Bot token, channels)

3. **SMS Services (Not Configured):**
   - Twilio (NOT found)
   - Vonage/Nexmo (NOT found)
   - iSMS (NOT found)

4. **PDF Generation (Not Installed):**
   - DomPDF (NOT in composer.json)
   - mPDF (NOT in composer.json)

5. **Charting Libraries (Not Installed):**
   - Chart.js (NOT in package.json)
   - Other charting libraries (NOT found)

---

### 3.4 Data Flow Documentation

#### 3.4.1 Request Flow Example: Maternal Record Management

```
HTTP Request (POST /maternal-care/store)
    ↓
Route Middleware ['auth', IsAdmin::class]
    ↓
MaternalController::store()
    ↓
Form Validation (validate request)
    ↓
MaternalRecord::create()
    ↓
Database Insert (MySQL)
    ↓
HTTP Redirect with Success Message
    ↓
View Renders (resources/views/admin/maternal/index.blade.php)
    ↓
HTML Response to Client (Browser)
```

#### 3.4.2 Display Flow Example: List Maternal Records

```
HTTP Request (GET /maternal-care)
    ↓
Route Middleware ['auth', IsAdmin::class]
    ↓
MaternalController::index()
    ↓
Query Building:
  - Search filtering (LIKE 'full_name')
  - Risk level filtering
  - Dashboard filters (match statement)
  - Pagination (15 per page)
    ↓
MaternalRecord::query()
    ↓
Database SELECT Query
    ↓
View: admin.maternal.index (compact('records'))
    ↓
Blade Template Rendering
  - Loop through records
  - Display with Tailwind styling
  - Form for adding new records
    ↓
HTML Response to Client
```

---

### 3.5 Technology Stack Summary

#### 3.5.1 Backend Stack

| Technology | Version | Purpose | Status |
|-----------|---------|---------|--------|
| PHP | 8.2+ | Language | ✅ Configured |
| Laravel | 12.56.0 | Framework | ✅ Active |
| MySQL | 8.0+ | Database | ✅ Configured |
| Eloquent ORM | 12.0 | Data Access | ✅ Implemented |
| Middleware | Custom | Request Filtering | ✅ Implemented |

#### 3.5.2 Frontend Stack

| Technology | Version | Purpose | Status |
|-----------|---------|---------|--------|
| Tailwind CSS | 3.4.19 | Styling | ✅ Active |
| Alpine.js | 3.4.2 | Interactivity | ✅ Implemented |
| Blade | 12.0 | Templating | ✅ Implemented |
| Vite | 7.0.7 | Build Tool | ✅ Active |
| Laravel Breeze | 2.4 | Scaffolding | ✅ Installed |

#### 3.5.3 Development Tools

| Tool | Version | Purpose |
|------|---------|---------|
| Composer | Latest | PHP Dependency Manager |
| npm | Latest | Node Package Manager |
| Pest | 3.8 | Testing Framework |
| Laravel Pint | 1.24 | Code Style Fixer |
| Laravel Sail | 1.41 | Docker Containerization |

---

### 3.6 Current Implementation Status

#### 3.6.1 Implemented Features

✅ **Authentication System**
- User registration and login (Laravel Breeze)
- Password reset functionality
- Email verification
- CSRF protection

✅ **Authorization System**
- Role-based access control (Admin/User)
- Middleware-based route protection
- Custom guard middleware

✅ **Data Management**
- Maternal Record CRUD operations
- Child Nutrition Record management
- Patient information tracking
- Database migrations and seeders

✅ **UI/UX**
- Responsive Tailwind CSS design
- Custom branding components
- Form validation feedback
- Success/error messaging

---

#### 3.6.2 Not Implemented / Missing

❌ **PDF Generation**
- No DomPDF or similar library
- Cannot generate reports to PDF

❌ **Charting/Visualization**
- No Chart.js or alternative
- Data visualization unavailable

❌ **SMS Notifications**
- No Twilio, Vonage, or iSMS integration
- Cannot send SMS alerts

❌ **Advanced Patterns**
- No Repository pattern
- No Service/Business Logic layer
- No Event listeners (basic setup only)
- No Job queues (scheduled tasks)
- No API layer (REST endpoints)

---

### 3.7 Database Architecture

#### 3.7.1 Identified Tables

Based on migration files:

1. **users** - User authentication and profiles
2. **cache** - Laravel cache table
3. **jobs** - Job queue table
4. **sessions** - Session management
5. **patients** - Patient demographics
6. **maternal_records** - Maternal health tracking
7. **child_nutrition_records** - Child nutrition monitoring

#### 3.7.2 Model Structure

**MaternalRecord Model:**
```php
- full_name (string)
- age (integer)
- address (string)
- contact_number (string)
- pregnancy_stage (enum: first_trimester, second_trimester, third_trimester)
- last_checkup_date (date)
- expected_delivery_date (date)
- risk_level (enum: low, medium, high)
```

**Patient Model:**
```php
- name (string)
- birthdate (date)
- category (string)
- barangay (string)
- contact_number (string)
```

---

### 3.8 Middleware & Security

#### 3.8.1 Authentication Middleware

- `auth` - Built-in Laravel middleware for authentication checks
- `verified` - Email verification requirement (available)

#### 3.8.2 Authorization Middleware

- `IsAdmin::class` - Custom middleware restricting to admin users
- `IsUser::class` - Custom middleware restricting to regular users

#### 3.8.3 Security Measures Identified

✅ CSRF Protection (`@csrf` in forms)  
✅ Password Hashing (Laravel default)  
✅ SQL Injection Prevention (Eloquent parameterized queries)  
✅ Mass Assignment Protection (`$fillable` arrays)  
✅ Route Model Binding (Available)  

---

### 3.9 Methodology Limitations

1. **Static Analysis Only**
   - No runtime performance testing conducted
   - No load testing performed

2. **Code Coverage**
   - Only main controllers and models reviewed
   - Full comprehensive line-by-line analysis not included

3. **Feature Testing**
   - Functional testing not performed
   - User acceptance testing not included

4. **Security Audit**
   - No penetration testing conducted
   - Vulnerability scanning not performed

---

### 3.10 Findings & Recommendations

#### 3.10.1 Strengths

✅ Uses latest Laravel version (12.56.0)  
✅ Modern frontend stack (Tailwind CSS + Alpine.js)  
✅ Includes authentication out-of-the-box  
✅ Proper middleware implementation for access control  
✅ Clean file organization following PSR-4 standards  

#### 3.10.2 Areas for Enhancement

⚠️ **Suggested Improvements:**

1. **Add Service Layer**
   - Extract business logic from controllers
   - Create dedicated Service classes for Maternal Records, Patient management, etc.

2. **Implement Repository Pattern**
   - Centralize database queries
   - Improve testability

3. **Add PDF Generation**
   ```
   composer require dompdf/dompdf
   ```
   - Generate reports and certificates

4. **Add Charting Library**
   ```
   npm install chart.js
   ```
   - Visualize maternal health trends
   - Track child nutrition statistics

5. **Implement API Layer**
   - Create RESTful endpoints for mobile apps
   - Use Laravel API resources

6. **Add Event System**
   - Trigger notifications on record updates
   - Implement audit logging

7. **Implement Job Queues**
   - Async PDF generation
   - Background email sending
   - Report scheduling

---

### 3.11 Conclusion

The RHU-Laravel project is built on a solid foundation with Laravel 12, modern frontend technologies, and proper security measures. The current MVC architecture is suitable for the application scale but would benefit from introducing Service and Repository layers as the application grows.

The system currently focuses on core functionality (maternal records, child nutrition, patient management) and authentication. Integration of PDF generation, charting capabilities, and SMS notifications would enhance the application's ability to deliver comprehensive rural health management features.

---

## Appendix A: File Locations Reference

```
Project Root: c:\xampp\htdocs\RHU-Laravel

Key Files:
├── composer.json (Framework dependencies)
├── package.json (Frontend dependencies)
├── .env.example (Environment template)
├── tailwind.config.js (Tailwind CSS config)
├── app/
│   ├── Models/ (Data models)
│   │   ├── MaternalRecord.php
│   │   ├── Patient.php
│   │   └── User.php
│   └── Http/
│       ├── Controllers/
│       │   └── Admin/
│       │       ├── MaternalController.php
│       │       └── ChildNutritionController.php
├── routes/
│   └── web.php (Route definitions)
├── resources/
│   └── views/
│       ├── layouts/ (Layout templates)
│       └── admin/ (Admin views)
├── config/
│   └── services.php (Third-party config)
└── database/
    ├── migrations/ (Schema definitions)
    └── seeders/ (Seed data)
```

---

**Document Version:** 1.0  
**Analysis Date:** April 22, 2026  
**Prepared For:** Capstone Project - Chapter 3 Methodology
