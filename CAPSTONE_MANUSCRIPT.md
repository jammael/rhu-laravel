# RHU-Laravel Capstone Project: Manuscript

## Project Design

The RHU-Laravel project is designed as a comprehensive health management system for Sierra Bullones Rural Health Unit (RHU). The system architecture follows modern web development principles with clear separation of concerns, supporting two primary user roles: Administrators and Regular Users.

### System Architecture Overview

The application is built on **Laravel 10**, a robust PHP framework that emphasizes clean code and developer productivity. The project implements a three-tier architecture consisting of:

- **Presentation Layer**: User interfaces built with Blade templating engine
- **Application Layer**: Business logic encapsulated in controllers
- **Data Layer**: Database interactions managed through Eloquent ORM

### Key Features

The system manages two critical health domains:

1. **Maternal Care Management**: Tracks pregnant women, their pregnancy stages, risk assessments, and medical checkup schedules
2. **Child Nutrition Monitoring**: Records and monitors children's nutritional status and development
3. **Patient Management**: Comprehensive patient record management system

---

## Laravel and the MVC Architecture

### Overview of MVC Implementation

The RHU-Laravel system strictly adheres to the **Model-View-Controller (MVC)** architectural pattern without additional abstraction layers such as Services or Repositories. This straightforward approach ensures clarity and maintainability for the capstone project.

### Components Breakdown

#### **Model Layer**

The Model layer utilizes **Eloquent ORM**, Laravel's built-in object-relational mapper. Each data entity is represented as a Model class:

**Example: MaternalRecord Model** ([app/Models/MaternalRecord.php](app/Models/MaternalRecord.php))

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaternalRecord extends Model
{
    protected $fillable = [
        'full_name',
        'age',
        'address',
        'contact_number',
        'pregnancy_stage',
        'last_checkup_date',
        'expected_delivery_date',
        'risk_level',
    ];

    protected $casts = [
        'last_checkup_date' => 'date',
        'expected_delivery_date' => 'date',
    ];
}
```

**Model Features:**
- `$fillable`: Defines which attributes can be mass-assigned
- `$casts`: Automatically converts attributes to native types (dates are cast to Carbon instances)
- Automatic timestamps: `created_at` and `updated_at` fields for tracking records
- Eloquent methods provide query building capabilities

#### **Controller Layer**

Controllers contain the business logic and request handling. They act as intermediaries between routes and models.

**Example: MaternalController** ([app/Http/Controllers/Admin/MaternalController.php](app/Http/Controllers/Admin/MaternalController.php))

The `index()` method demonstrates search and filtering logic:

```php
public function index(Request $request)
{
    $query = MaternalRecord::query();

    // Search by full name
    if ($request->filled('search')) {
        $query->where('full_name', 'like', '%' . $request->search . '%');
    }

    // Filter by risk level
    if ($request->filled('risk_level')) {
        $query->where('risk_level', $request->risk_level);
    }

    // Dashboard filter
    if ($request->filled('filter')) {
        match ($request->filter) {
            'high_risk' => $query->where('risk_level', 'high'),
            'medium_risk' => $query->where('risk_level', 'medium'),
            'low_risk' => $query->where('risk_level', 'low'),
            default => $query,
        };
    }

    $records = $query->orderBy('created_at', 'desc')->paginate(15);
    return view('admin.maternal.index', compact('records'));
}
```

**Key Responsibilities:**
- Validates incoming request data
- Executes database queries through Eloquent models
- Applies business rules and filtering logic
- Returns appropriate responses or views

The `store()` method validates input and creates records:

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'age' => 'required|integer|min:15|max:50',
        'address' => 'required|string|max:500',
        'contact_number' => 'required|string|regex:/^[0-9\-\+\s]{7,}$/',
        'pregnancy_stage' => 'required|in:first_trimester,second_trimester,third_trimester',
        'last_checkup_date' => 'required|date|before_or_equal:today',
        'expected_delivery_date' => 'required|date|after:last_checkup_date',
        'risk_level' => 'required|in:low,medium,high',
    ]);

    MaternalRecord::create($validated);
    return redirect()->route('maternal.index')
                    ->with('success', 'Maternal record added successfully!');
}
```

#### **View Layer**

Views are built using **Blade templating engine**, Laravel's powerful templating language. The system uses a layout-based approach for consistent UI.

**Main Layout** ([resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php))

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'NutriCare') }}</title>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
```

**View Characteristics:**
- Component-based approach (reusable navigation, headers)
- Dynamic data binding using `{{ }}` syntax
- Conditional rendering with `@isset`, `@endisset`
- Template inheritance with `@extends` and `@section`

### Data Flow: Route to View

The complete data flow in the RHU-Laravel system follows this sequence:

```
1. User Request
   ↓
2. Route (web.php)
   GET /maternal-care → MaternalController@index
   ↓
3. Controller Method
   - Receives Request object
   - Builds Eloquent query: MaternalRecord::query()
   - Applies filters and search conditions
   - Executes database query: paginate(15)
   ↓
4. Model (Eloquent)
   - Executes SQL query
   - Returns Collection of MaternalRecord instances
   ↓
5. View Rendering
   - Controller passes data: compact('records')
   - Blade template iterates over records
   - Renders HTML with Tailwind CSS styling
   ↓
6. HTTP Response
   - Blade renders to HTML
   - Browser receives and displays page
```

### Complete Example: Maternal Records Index

**Route Definition** ([routes/web.php](routes/web.php))
```php
Route::get('/maternal-care', [MaternalController::class, 'index'])->name('maternal.index');
```

**Controller Processing**
```php
// Query building with filters
$query = MaternalRecord::query();
if ($request->filled('search')) {
    $query->where('full_name', 'like', '%' . $request->search . '%');
}
$records = $query->paginate(15);

// Pass to view
return view('admin.maternal.index', compact('records'));
```

**View Rendering**
```blade
@foreach($records as $record)
    <tr>
        <td>{{ $record->full_name }}</td>
        <td>{{ $record->age }}</td>
        <td>{{ $record->pregnancy_stage }}</td>
        <td>
            <span class="px-3 py-1 rounded-full text-sm font-semibold
                {{ $record->risk_level === 'high' ? 'bg-red-100 text-red-800' : '' }}">
                {{ ucfirst($record->risk_level) }}
            </span>
        </td>
    </tr>
@endforeach
```

### MVC Pattern Adherence

The project **does NOT use additional abstraction layers** such as:
- ❌ Service Layer (Business logic placed directly in controllers)
- ❌ Repository Pattern (Direct Eloquent usage in controllers)
- ❌ Data Transfer Objects (DTOs)

**Rationale for Standard MVC:**
- Suitable for a capstone project scope
- Easier to understand and maintain for educational purposes
- Reduces complexity while maintaining functionality
- Direct mapping between application layers

---

## Frameworks and APIs

### Frontend Framework & Styling

#### **Tailwind CSS**

The project utilizes **Tailwind CSS v3.4.19** as its primary CSS framework instead of Bootstrap.

**Configuration** ([tailwind.config.js](tailwind.config.js))
```javascript
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                outfit: ['Outfit', 'sans-serif'],
            },
            screens: {
                '2xsm': '375px',
                'xsm': '425px',
                '3xl': '2000px',
            },
        },
    },
    plugins: [forms],
};
```

**Advantages of Tailwind CSS:**
- **Utility-first approach**: Direct styling through HTML classes
- **Smaller bundle size**: Purges unused styles in production
- **Highly customizable**: Extended theme with custom breakpoints
- **Dark mode support**: Built-in support for dark themes
- **Better performance**: No CSS-in-JS runtime overhead

**Package.json Dependencies:**
```json
{
    "@tailwindcss/forms": "^0.5.2",
    "@tailwindcss/vite": "^4.0.0",
    "tailwindcss": "^3.4.19",
    "autoprefixer": "^10.5.0"
}
```

### Frontend Technologies

#### **Alpine.js** (v3.4.2)

Alpine.js is used for lightweight, reactive JavaScript without requiring full framework overhead.

**Example Usage** (Patient Records View):
```blade
<div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
    <button @click="open = !open" class="...">
        Add Patient
        <svg x-show="!open"><!-- Up arrow --></svg>
        <svg x-show="open"><!-- Down arrow --></svg>
    </button>
</div>
```

**Features:**
- Dropdown menus and toggles
- Form interactions
- DOM reactivity
- Minimal JavaScript overhead

#### **Vite** (v7.0.7)

Modern build tool and development server.

**Build Commands** ([package.json](package.json)):
```json
{
    "scripts": {
        "dev": "vite",
        "build": "vite build"
    }
}
```

**Benefits:**
- Instant server start
- Hot Module Replacement (HMR)
- Lightning-fast builds
- ES modules support

### Backend Technologies & APIs

#### **Laravel 10 Ecosystem**

**Core Components Used:**
- **Eloquent ORM**: Object-relational mapper for database interactions
- **Validation**: Built-in request validation rules
- **Blade Templating**: Server-side templating engine
- **Middleware**: Authentication and authorization (IsAdmin, IsUser)
- **Routing**: RESTful routing with named routes

#### **Authentication & Authorization**

**Middleware-Based Access Control** ([routes/web.php](routes/web.php)):
```php
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard']);
    Route::get('/maternal-care', [MaternalController::class, 'index']);
    Route::post('/maternal-care/store', [MaternalController::class, 'store']);
});

Route::middleware(['auth', IsUser::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
```

**Authentication Flow:**
1. User logs in via authentication routes
2. Session created with user credentials
3. Middleware checks authentication status
4. Role-based middleware (IsAdmin, IsUser) authorizes access
5. Protected routes only accessible to authorized users

#### **Database Interactions**

**Eloquent Query Examples:**

```php
// Create
MaternalRecord::create($validated);

// Read with filters
$records = MaternalRecord::query()
    ->where('full_name', 'like', '%search%')
    ->where('risk_level', 'high')
    ->orderBy('created_at', 'desc')
    ->paginate(15);

// Update
$record->update($data);

// Delete
$record->delete();
```

#### **Validation Rules**

Custom validation for data integrity:
```php
$request->validate([
    'full_name' => 'required|string|max:255',
    'age' => 'required|integer|min:15|max:50',
    'contact_number' => 'required|string|regex:/^[0-9\-\+\s]{7,}$/',
    'pregnancy_stage' => 'required|in:first_trimester,second_trimester,third_trimester',
    'last_checkup_date' => 'required|date|before_or_equal:today',
    'expected_delivery_date' => 'required|date|after:last_checkup_date',
    'risk_level' => 'required|in:low,medium,high',
]);
```

#### **External APIs & Libraries**

**Package Dependencies:**
- **axios** (v1.11.0): HTTP client for AJAX requests
- **laravel-vite-plugin** (v2.0.0): Vite integration for Laravel
- **postcss** (v8.5.10): CSS processing
- **concurrently** (v9.0.1): Run multiple npm scripts simultaneously

### API Integration Points

While this is primarily a traditional server-rendered application, integration points for APIs include:

1. **CSRF Protection**: All forms protected with CSRF tokens
   ```blade
   <meta name="csrf-token" content="{{ csrf_token() }}">
   ```

2. **Axios for AJAX**: Ready for asynchronous requests
   ```javascript
   import axios from 'axios';
   ```

3. **RESTful Routes**: Standard Laravel resource routing
   ```php
   Route::resource('patients', PatientController::class);
   ```

---

## System Technologies Summary

| Component | Technology | Version |
|-----------|-----------|---------|
| **Backend Framework** | Laravel | 10.x |
| **Frontend Framework** | Blade + Alpine.js | 3.4.2 |
| **CSS Framework** | Tailwind CSS | 3.4.19 |
| **Build Tool** | Vite | 7.0.7 |
| **Database ORM** | Eloquent | Laravel 10 |
| **HTTP Client** | Axios | 1.11.0 |
| **CSS Processing** | PostCSS + Autoprefixer | Latest |

---

## Conclusion

The RHU-Laravel capstone project demonstrates a solid implementation of **Laravel's MVC architecture** combined with modern frontend technologies. The system employs:

- **Standard MVC pattern** without additional abstraction layers
- **Tailwind CSS** for efficient, utility-first styling
- **Eloquent ORM** for intuitive database interactions
- **Blade templating** for server-side rendering
- **Role-based access control** for security
- **RESTful routing** for clean API endpoints

This architecture provides a scalable, maintainable foundation for the Rural Health Unit's health management system while remaining comprehensible for educational purposes.
