# Admin Panel Implementation Guide

## Overview
The Admin Panel provides comprehensive user management and activity logging capabilities for the NutriCare system. It features strict RBAC (Role-Based Access Control) with built-in security measures.

---

## 📋 Features Implemented

### 1. User Management System
**Location**: `/admin/users`

#### Features:
- **User List Display**: View all users with their profile information
- **Status Tracking**: Visual indicators for user status (Pending/Approved/Denied)
- **Role Assignment**: Assign roles (Doctor, Nurse, Midwife, Encoder) during approval
- **User Actions**:
  - ✓ **Approve**: Approve pending users and assign a role
  - ✕ **Deny**: Reject pending user applications
  - 🔄 **Update Role**: Change an approved user's role
  - 🗑 **Delete**: Remove users from the system

#### Security Features:
- Admin-only access via `IsAdmin` middleware
- Self-deletion prevention (admin cannot delete their own account)
- CSRF protection on all forms
- Confirmation dialogs for destructive actions

---

### 2. Activity Logging System
**Location**: `/admin/logs`

#### Captured Information:
- **User Name**: Who performed the action
- **Action**: Type of action (Approved User, Denied User, Updated Role, Deleted User)
- **Description**: Detailed information about the action
- **IP Address**: Source IP address of the requester
- **Timestamp**: When the action occurred (with human-readable format)

#### Features:
- Real-time logging of all admin actions
- Advanced search functionality (by user, action, or description)
- Pagination (20 logs per page)
- Color-coded action badges for quick identification
- User email display for verification

---

### 3. Sidebar Integration
**Location**: `resources/views/admin/body/sidebar.blade.php`

#### New Section:
- **System Administration** (Admin only)
  - User Management link
  - Activity Logs link

#### Visibility:
- Only visible to users with `admin` role
- Clean, intuitive navigation with icons

---

## 🔐 Security & RBAC

### Middleware Protection
```php
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin-only routes
});
```

### Unauthorized Access Handling
When a non-admin user attempts to access `/admin/users` or `/admin/logs`:
1. User is logged out automatically
2. Session is invalidated
3. User is redirected to login page
4. Error message displayed: "Access Denied: You do not have permission to access the Admin Panel."

### CSRF Protection
All forms use `@csrf` directive to prevent Cross-Site Request Forgery attacks.

---

## 📊 Database Schema

### Activity Logs Table
```sql
CREATE TABLE activity_logs (
    id BIGINT PRIMARY KEY,
    user_id BIGINT (Foreign Key → users.id),
    action VARCHAR(255),
    description VARCHAR(255) NULLABLE,
    ip_address VARCHAR(45) NULLABLE,
    user_agent TEXT NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Users Table Updates
```sql
ALTER TABLE users ADD COLUMN status ENUM('pending', 'approved', 'denied') DEFAULT 'pending';
```

---

## 🎨 User Interface

### Styling
- Built entirely with **Tailwind CSS**
- Responsive design for mobile and desktop
- Consistent color scheme:
  - Green: Approve/Success actions
  - Red: Deny/Danger actions
  - Blue: Info/Read actions
  - Purple: Admin actions
  - Gray: Delete actions

### Interactive Components
- **Dropdown Menus**: For selecting roles and actions
- **Status Badges**: Visual status indicators
- **Action Buttons**: Contextual buttons based on user status
- **Search Bar**: For filtering activity logs
- **Pagination**: For browsing large datasets

---

## 📁 File Structure

```
app/
├── Http/
│   ├── Controllers/Admin/
│   │   ├── UserManagementController.php
│   │   └── ActivityLogsController.php
│   └── Middleware/
│       └── IsAdmin.php
├── Models/
│   ├── User.php (updated)
│   └── ActivityLog.php
│
database/
└── migrations/
    └── 2026_04_24_000001_create_activity_logs_table.php

resources/views/admin/
├── users/
│   └── index.blade.php
├── logs/
│   └── index.blade.php
├── body/
│   └── sidebar.blade.php (updated)
└── admin_master.blade.php

routes/
└── web.php (updated with admin routes)

bootstrap/
└── app.php (middleware registration)
```

---

## 🔄 User Status Workflow

```
Registration
    ↓
Pending Status
    ├─→ Approved (with role assignment) → Can access system
    └─→ Denied → Cannot access system
```

---

## 📝 API Routes

### User Management Routes
```
GET    /admin/users                    # List all users
POST   /admin/users/{user}/approve     # Approve user with role
POST   /admin/users/{user}/deny        # Deny user
PUT    /admin/users/{user}/role        # Update user role
DELETE /admin/users/{user}             # Delete user
```

### Activity Logs Routes
```
GET    /admin/logs                     # View all activity logs (with optional search)
```

---

## 🛠️ Usage Examples

### Approving a User
1. Navigate to `/admin/users`
2. Find the pending user
3. Click "Approve" button
4. Select role from dropdown
5. Click "Confirm Approval"
6. System logs the action and updates user status

### Viewing Activity Logs
1. Navigate to `/admin/logs`
2. (Optional) Use search bar to filter by user, action, or description
3. Click "Search" to apply filter
4. View paginated results
5. Color-coded badges show action type

---

## ⚠️ Important Notes

1. **Admin Account**: Protect your admin account carefully. There is no role higher than admin.
2. **Deletion**: Deleted users cannot be recovered. Always confirm before deletion.
3. **Activity Logs**: All admin actions are permanently logged for security audits.
4. **IP Logging**: IP addresses are automatically captured for security tracking.
5. **CSRF Tokens**: Never disable CSRF protection on admin forms.

---

## 🔍 Troubleshooting

### Issue: "Access Denied" message for admin user
- Verify user's role is set to `admin` in the database
- Clear session cache: `php artisan cache:clear`
- Ensure middleware is properly registered in `bootstrap/app.php`

### Issue: Activity logs not appearing
- Verify migration was run: `php artisan migrate --step`
- Check database for `activity_logs` table
- Verify `ActivityLog::log()` is being called in controllers

### Issue: Dropdown menus not working
- Clear browser cache
- Ensure JavaScript is enabled
- Check browser console for errors
- Verify `resources/js/app.js` is loaded

---

## 📈 Future Enhancements

Potential improvements for future versions:
- Bulk user actions
- User import/export functionality
- Advanced filtering and sorting
- Log export (CSV/PDF)
- Email notifications for approvals/denials
- Two-factor authentication for admin actions
- Audit trail for detailed action history
- Role-based permissions matrix

---

## Support

For issues or questions, please contact the development team or check the application logs:
```bash
tail -f storage/logs/laravel.log
```

---

**Last Updated**: 2026-04-24
**Version**: 1.0.0
**Status**: Production Ready
