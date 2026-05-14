# PMBOOK CUSTOMIZED PREDEFINED SECTIONS
## Health Monitoring System for RHU Sierra Bullones (NutriCare)

---

# PREDEFINED SYSTEM MODULES

The NutriCare system already contains these finalized, fully-implemented modules:

## ADMIN MODULES (Role: Admin - Protected Route)
1. **User Management Module** - Complete user lifecycle management with approval/denial workflow, role assignment (Doctor, Nurse, Midwife, Encoder), and access control
2. **Activity Logging Module** - System-wide activity audit trail with user action tracking, IP address logging, and comprehensive search/filtering
3. **Admin Dashboard Module** - Real-time statistics dashboard with maternal care and child nutrition metrics, interactive data cards with drill-down filtering

## STAFF MODULES (Role: Staff/Health Workers - Protected Route)
4. **Maternal Record Management Module** - Pregnant women registration, pregnancy stage tracking (1st/2nd/3rd trimester), risk level classification, archive/restore functionality, and PDF report generation
5. **Child Nutrition Monitoring Module** - Child health tracking (0-59 months), automatic WHO/DOH-compliant nutritional status calculation, BMI/Z-score computation, and health certificate PDF generation
6. **Patient Management Module** - Patient registry with full CRUD operations, patient selector/dropdown for record associations

## CORE SYSTEM MODULES (Available to All Authenticated Users)
7. **Authentication & Authorization Module** - User registration with email verification, login/logout, session management, role-based access control (RBAC)
8. **User Profile Management Module** - User profile view/edit, password management, account settings

**Total Implemented Modules: 8**
- Admin Modules: 3
- Staff Modules: 3
- Core System Modules: 2

**DO NOT invent additional core modules unless needed for enhancement recommendations in Phase 5.**

---

# PREDEFINED USER ROLES

The NutriCare system contains these finalized user roles:

| Role | Level | Access | Responsibilities |
|------|-------|--------|------------------|
| **Super Admin / Admin** | System Level | Full system access including user management, activity logs, admin dashboard | Manage system users, approve/deny registrations, assign roles, monitor system activities, access all statistics |
| **Staff (Doctor, Nurse, Midwife, Encoder)** | Operational Level | Maternal care, child nutrition, patient management modules | Register patients, create/edit health records, generate PDF reports, monitor patient health status |
| **Unauthenticated User** | Public Level | Landing page, registration, login | Register new account, access public information |

**DO NOT invent additional user roles unless required for system enhancement.**

---

# PREDEFINED UI/UX DIRECTION

The NutriCare system follows these finalized UI/UX principles:

* **Primary Color Theme**: Blue and health-care focused palette with status indicators
* **Secondary Colors**: 
  - Green (Normal/Healthy status)
  - Yellow (Underweight/Medium risk)
  - Red (Severely Underweight/High risk)
* **Layout Pattern**: Admin sidebar navigation with collapsible menu, responsive design
* **Data Display**:
  - Table-based record management with pagination (15 records per page for nutrition, 20 items per page for logs)
  - Search-first experience for finding maternal/child records by name
  - Advanced filtering by risk level, nutritional status, and date ranges
  - Color-coded status badges for quick visual identification
* **Component Design**:
  - Sticky form panels (add new records on left, data table on right)
  - Interactive statistics cards with hover effects and drill-down capability
  - Professional PDF report generation with RHU branding
  - Modal-based confirm dialogs for destructive actions
* **Responsive Design**: Mobile-first approach with breakpoint support for tablets and desktops
* **Professional Appearance**: Enterprise health management system aesthetics with clean spacing and consistent card layouts
* **Analytics-Focused**: Dashboard-driven decision making with real-time metrics and status summaries

---

# PREDEFINED DATABASE ENTITIES

The NutriCare database already contains these major entities:

| Entity | Purpose | Key Fields | Relationships |
|--------|---------|------------|---------------|
| **users** | System users and staff members | id, name, email, password, role, status, created_at, updated_at | One-to-Many with ActivityLog, One-to-Many with MaternalRecords, One-to-Many with ChildNutritionRecords |
| **maternal_records** | Pregnant women health tracking | id, patient_id, full_name, age, address, contact_number, pregnancy_stage, last_checkup_date, expected_delivery_date, risk_level, deleted_at, created_at, updated_at | Many-to-One with Patient, Many-to-One with User (creator), Soft Delete enabled |
| **child_nutrition_records** | Child nutritional health tracking | id, patient_id, full_name, age_months, barangay, weight_kg, height_cm, last_weigh_in_date, nutritional_status (auto-calculated), created_at, updated_at | Many-to-One with Patient, Many-to-One with User (creator), Auto-calculated via Observer |
| **patients** | Patient registry | id, full_name, age, address, contact_number, barangay, created_at, updated_at | One-to-Many with MaternalRecords, One-to-Many with ChildNutritionRecords |
| **activity_logs** | System audit trail | id, user_id, action, description, ip_address, user_agent, created_at, updated_at | Many-to-One with User |
| **roles** | User role definitions | id, name, created_at, updated_at | One-to-Many with Users |

**Total Database Entities: 6 core tables**

---

# PREDEFINED DEVELOPMENT WORKFLOW

The NutriCare development workflow follows this established process:

1. **Requirement Gathering** - Collect health monitoring requirements from RHU staff and clinic management
2. **UI/UX Planning** - Design dashboard layouts, form interfaces, and report templates
3. **Database Design** - Model maternal, child nutrition, and patient entities with proper relationships
4. **Backend API Development** - Develop Laravel controllers, models, observers, and business logic
5. **Frontend Integration** - Implement Blade templates, Bootstrap components, and JavaScript interactions
6. **PDF Report Generation** - Create professional health certificate and clinical record PDFs
7. **Testing & QA** - Unit tests, integration tests, manual UI testing, user acceptance testing
8. **Deployment** - Environment setup, database migrations, production deployment
9. **Monitoring & Maintenance** - Track system performance, fix bugs, support staff

---

# PREDEFINED TEAM STRUCTURE

Assume the NutriCare team structure includes:

| Role | Team Member | Responsibilities |
|------|------------|------------------|
| **Project Manager** | Jammael Magallanes | Overall project coordination, stakeholder management, documentation |
| **Backend Lead Developer** | Michael Ayento | Laravel API development, database design, business logic |
| **Frontend Developer** | Iggy Louis Mahinay | Blade templates, Bootstrap UI, JavaScript interactions |
| **Full-Stack Developer** | Princess Jelyn Litub | Support backend and frontend, feature integration |
| **QA Tester & Documentation** | Rhea Jay Celine Cosares | System testing, quality assurance, technical documentation |
| **Project Client/Stakeholder** | Dr. Airiene Vanessa T. Sumaljag-Dormido, MD, FPSMSG | RHU management, requirements validation, acceptance |

---

# PREDEFINED PROJECT ASSUMPTIONS

Assume the following are already approved:

* RHU Sierra Bullones administration supports full-scale system implementation
* Reliable internet connectivity available at RHU clinic facilities
* Server infrastructure available (XAMPP/Laravel Sail for development, production server for deployment)
* Staff have basic computer literacy and ability to use web-based systems
* Laravel 12 and MySQL are approved technology stack
* Role-based access control (RBAC) is mandatory for staff roles
* PDF report generation for health records is required
* SMS/Email notifications for maternal health reminders are within scope
* Mobile responsiveness is required for tablet and mobile devices
* Data security and patient privacy (HIPAA-like compliance) is mandatory
* System must handle concurrent users (clinic staff accessing simultaneously)
* Automatic health status calculations (WHO/DOH standards) are required

---

# PREDEFINED PROJECT CONSTRAINTS

Assume these constraints:

| Constraint | Details |
|-----------|---------|
| **Development Timeline** | Limited by academic calendar; project must be completed within capstone deadline (approximately 5-6 months) |
| **Budget Constraints** | Limited financial resources for cloud hosting; XAMPP/local development environment is primary deployment |
| **Team Size** | Small development team (5 members) with limited specialization |
| **Server Infrastructure** | Limited server resources; may be deployed on local RHU network or shared hosting |
| **Staff Training** | Limited time for training clinic staff on new system; must have intuitive UI |
| **Data Migration** | Limited historical data; system will start with fresh records |
| **Regulatory Compliance** | Must follow health data protection standards and RHU administrative guidelines |
| **Network Dependency** | Clinic internet availability may impact system access during peak hours |

---

# PREDEFINED PROJECT RISKS

Common risks already identified in NutriCare:

| Risk ID | Description | Category | Probability | Impact | Priority |
|---------|-------------|----------|------------|--------|----------|
| R-001 | Delayed feature implementation due to scope complexity | Schedule | Medium | High | HIGH |
| R-002 | Staff resistance to adopting new digital health system | Organizational | Medium | High | HIGH |
| R-003 | Database inconsistency in health records | Technical | Low | Critical | HIGH |
| R-004 | Automatic nutritional status calculation inaccuracy (WHO/DOH standards) | Technical | Low | High | HIGH |
| R-005 | PDF report rendering issues on different browsers | Technical | Low | Medium | MEDIUM |
| R-006 | Server infrastructure failure or downtime | Infrastructure | Low | Critical | HIGH |
| R-007 | Security vulnerabilities in patient health data | Security | Low | Critical | CRITICAL |
| R-008 | Chart/Dashboard rendering inconsistencies | Technical | Low | Medium | MEDIUM |
| R-009 | Insufficient role-based access control implementation | Security | Low | High | HIGH |
| R-010 | Limited hardware resources at RHU clinic | Infrastructure | Medium | Medium | MEDIUM |

---

# PREDEFINED COMMUNICATION TOOLS

Assume the NutriCare team uses:

* **Messenger** - Real-time team communication and quick updates
* **Google Meet** - Weekly sprint meetings, stakeholder demonstrations, progress reviews
* **GitHub** - Version control, code repositories, issue tracking
* **Google Drive** - Documentation sharing, meeting notes, project files
* **Email** - Formal communications with client and stakeholders
* **WhatsApp/Viber** - Emergency notifications and urgent updates

---

# PREDEFINED TESTING APPROACH

The NutriCare testing approach already includes:

1. **Unit Testing** - Test individual controllers, models, observers, and utility functions
2. **Integration Testing** - Test module interactions (maternal + patient, nutrition + patient)
3. **Manual UI Testing** - Test form submissions, button interactions, navigation, responsiveness
4. **User Acceptance Testing (UAT)** - Clinic staff testing real-world scenarios with sample data
5. **Security Testing** - Test role-based access control, authentication, data validation, SQL injection prevention
6. **Performance Testing** - Test system load with multiple concurrent users, query optimization
7. **PDF Report Testing** - Test PDF generation across different browser versions and data scenarios
8. **Mobile Responsiveness Testing** - Test on tablets and mobile devices

---

# PREDEFINED DEPLOYMENT STRATEGY

NutriCare deployment already follows:

1. **Development Environment**: XAMPP with Laravel Sail containerization
2. **Database Deployment**: MySQL database setup with migration workflow
3. **Environment Configuration**: 
   - .env file with database credentials
   - API configuration
   - Mail server setup for notifications
4. **Code Deployment**: 
   - Git-based version control
   - Dependency installation (composer, npm)
   - Asset compilation (Tailwind CSS, JavaScript bundling)
5. **Database Migration Workflow**:
   - Run migrations for schema creation
   - Seed sample data if needed
   - Backup existing data
6. **Backup Strategy**:
   - Daily database backups
   - Code repository backup via GitHub
   - Configuration file backups
7. **Rollback Procedures**:
   - Database rollback commands
   - Git rollback to previous commits
   - Backup restoration process

---

# PREDEFINED DEVELOPMENT STACK SUMMARY

| Layer | Technology | Purpose |
|-------|-----------|---------|
| **Backend Framework** | Laravel 12 | MVC architecture, ORM, business logic |
| **Backend Language** | PHP 8.x | Server-side application logic |
| **Database** | MySQL 8.0 | Relational data storage |
| **Frontend Framework** | Bootstrap 5 | Responsive UI components |
| **Templating Engine** | Blade (Laravel) | Dynamic HTML template rendering |
| **Frontend Scripting** | JavaScript/jQuery | Client-side interactions and AJAX |
| **CSS Preprocessor** | Tailwind CSS | Utility-first CSS framework |
| **PDF Generation** | DomPDF | Health report PDF creation |
| **Development Server** | XAMPP / Laravel Sail | Local development environment |
| **Version Control** | Git / GitHub | Code repository and collaboration |
| **API Architecture** | REST API | Stateless HTTP-based communication |

---

# PROJECT DELIVERABLES CHECKLIST

**Phase 1 Deliverables:**
- [ ] Project Charter Document
- [ ] Stakeholder Register
- [ ] Stakeholder Analysis Matrix
- [ ] Initial Scope Statement

**Phase 2 Deliverables:**
- [ ] Project Management Plan
- [ ] Work Breakdown Structure (WBS)
- [ ] Schedule Baseline (Gantt Chart)
- [ ] Cost Baseline
- [ ] Risk Register
- [ ] Communication Plan
- [ ] Procurement Plan

**Phase 3 Deliverables:**
- [ ] Complete Laravel Application Code
- [ ] Database Schema with Migrations
- [ ] API Endpoints Documentation
- [ ] User Interface Implementation
- [ ] PDF Report Templates
- [ ] Testing Suite

**Phase 4 Deliverables:**
- [ ] Project Performance Reports
- [ ] Quality Assurance Reports
- [ ] Change Logs
- [ ] Risk Status Updates
- [ ] Schedule/Budget Variance Analysis

**Phase 5 Deliverables:**
- [ ] Final System Package
- [ ] User Manual
- [ ] Technical Documentation
- [ ] Installation Guide
- [ ] Deployment Checklist
- [ ] Lessons Learned Document
- [ ] Project Closure Report

---

END OF PREDEFINED SECTIONS
