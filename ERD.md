# RHU-Laravel Entity Relationship Diagram (ERD)

## Document Information

**Project Name:** RHU-Laravel (Rural Health Unit Management System)  
**Database System:** MySQL 8.0+  
**Document Date:** April 22, 2026  
**Version:** 2.0 (Updated from MySQL Workbench)

---

## Table of Contents

1. [ERD Overview](#erd-overview)
2. [Entity-Relationship Diagram](#entity-relationship-diagram)
3. [Entity Descriptions](#entity-descriptions)
4. [Table Relationships](#table-relationships)
5. [Database Schema Details](#database-schema-details)
6. [Cardinality & Constraints](#cardinality--constraints)
7. [Foreign Key Relationships](#foreign-key-relationships)

---

## ERD Overview

The RHU-Laravel system manages rural health unit operations with a focus on maternal health and child nutrition monitoring. The database architecture consists of **12 main tables** organized into multiple functional domains:

1. **Authentication & User Management** - Users, Sessions, Password Reset, Migrations
2. **Patient Management** - Patients (core entity)
3. **Health Records** - Maternal Records, Child Nutrition Records
4. **System Infrastructure** - Cache, Cache Locks, Jobs, Job Batches, Failed Jobs (Laravel framework tables)

---

## Entity-Relationship Diagram

```
┌──────────────────────────────────────────────────────────────────────────────────┐
│                        RHU-LARAVEL DATABASE SCHEMA v2.0                          │
└──────────────────────────────────────────────────────────────────────────────────┘

                                 ┌─────────────────┐
                                 │    USERS        │
                                 ├─────────────────┤
                                 │ id (PK)         │
                                 │ name            │
                                 │ email (UQ)      │
                                 │ password        │
                                 │ role (enum)     │
                                 │ photo           │◄──────────┐
                                 │ phone           │           │ (1:1)
                                 │ address         │           │
                                 │ plan_id         │      ┌────┴──────────┐
                                 │ token_used      │      │               │
                                 │ status          │      │               │
                                 │ remember_token  │      │               │
                                 │ maternal_rec_id │─────►│       ┌───────┴────────────┐
                                 │ sessions_id     │      │       │                    │
                                 │ child_nut_id    │      │       │                    │
                                 │ timestamps      │      │       ▼                    ▼
                                 └─────────────────┘      │   ┌────────────┐    ┌─────────────┐
                                       │                  │   │ MATERNAL  │    │   CHILD     │
                                       │ (N:1)            │   │ RECORDS   │    │  NUTRITION  │
                                       │                  │   ├────────────┤    │   RECORDS   │
                                       ▼                  │   │ id (PK)    │    ├─────────────┤
                    ┌──────────────────────────┐          │   │ full_name  │    │ id (PK)     │
                    │      SESSIONS            │          │   │ age        │    │ full_name   │
                    ├──────────────────────────┤          │   │ address    │    │ age_months  │
                    │ id (PK, VARCHAR)         │          │   │ contact_#  │    │ barangay    │
                    │ user_id (FK) ◄───────────┼──────────┘   │ preg_stage │    │ weight_kg   │
                    │ ip_address               │              │ last_check │    │ height_cm   │
                    │ user_agent               │              │ exp_deliv  │    │ nutr_status │
                    │ payload                  │              │ risk_level │    │ last_weigh  │
                    │ last_activity            │              │ timestamps │    │ timestamps  │
                    └──────────────────────────┘              └────────────┘    └─────────────┘
                                                                  ▲                    ▲
                    ┌──────────────────────────┐                  │                    │
                    │ PASSWORD_RESET_TOKENS    │                  │ (N:1)              │ (N:1)
                    ├──────────────────────────┤                  │                    │
                    │ email (PK, VARCHAR)      │              ┌───┴────────────────────┴────┐
                    │ token (VARCHAR)          │              │      PATIENTS               │
                    │ created_at               │              ├─────────────────────────────┤
                    └──────────────────────────┘              │ id (PK)                     │
                                                              │ name                        │
                    ┌──────────────────────────┐              │ category (enum)             │
                    │      CACHE               │              │ birthdate                   │
                    ├──────────────────────────┤              │ barangay                    │
                    │ key (PK, VARCHAR)        │              │ contact_number              │
                    │ value (MEDIUMTEXT)       │              │ health_remarks              │
                    │ expiration (INT)         │              │ maternal_records_id (FK)    │
                    └──────────────────────────┘              │ child_nutrition_records_id  │
                                                              │ timestamps                  │
                    ┌──────────────────────────┐              └─────────────────────────────┘
                    │    CACHE_LOCKS           │
                    ├──────────────────────────┤
                    │ key (PK, VARCHAR)        │
                    │ owner (VARCHAR)          │
                    │ expiration (INT)         │
                    └──────────────────────────┘

                    ┌──────────────────────────┐
                    │      JOBS                │
                    ├──────────────────────────┤
                    │ id (PK, BIGINT)          │
                    │ queue (VARCHAR)          │
                    │ payload (LONGTEXT)       │
                    │ attempts (TINYINT)       │
                    │ reserved_at              │
                    │ available_at             │
                    │ created_at               │
                    └──────────────────────────┘

                    ┌──────────────────────────┐
                    │    JOB_BATCHES           │
                    ├──────────────────────────┤
                    │ id (PK, VARCHAR)         │
                    │ name (VARCHAR)           │
                    │ total_jobs (INT)         │
                    │ pending_jobs (INT)       │
                    │ failed_jobs (INT)        │
                    │ cancelled_at             │
                    │ created_at               │
                    │ finished_at              │
                    └──────────────────────────┘

                    ┌──────────────────────────┐
                    │    FAILED_JOBS           │
                    ├──────────────────────────┤
                    │ id (PK, BIGINT)          │
                    │ uuid (VARCHAR)           │
                    │ connection (TEXT)        │
                    │ queue (TEXT)             │
                    │ payload (LONGTEXT)       │
                    │ exception (LONGTEXT)     │
                    │ failed_at                │
                    └──────────────────────────┘

                    ┌──────────────────────────┐
                    │    MIGRATIONS            │
                    ├──────────────────────────┤
                    │ id (PK, INT)             │
                    │ migration (VARCHAR)      │
                    │ batch (INT)              │
                    └──────────────────────────┘

Legend:
  PK = Primary Key
  FK = Foreign Key
  UQ = Unique Key
  (1:1) = One-to-One Relationship
  (1:N) = One-to-Many Relationship
  (N:1) = Many-to-One Relationship
  enum = Enumerated Type (Fixed Values)
```

---

## Entity Descriptions

### 1. **USERS** - User Accounts & Authentication

**Purpose:** Stores user account information and authentication credentials for the RHU system.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT(20) | PK, AUTO_INCREMENT | Unique user identifier |
| name | VARCHAR(255) | NOT NULL | User's full name |
| email | VARCHAR(255) | NOT NULL, UNIQUE | User's email address (login credential) |
| email_verified_at | TIMESTAMP | NULLABLE | Timestamp when email was verified |
| password | VARCHAR(255) | NOT NULL | Hashed password (bcrypt) |
| photo | VARCHAR(255) | NULLABLE | User's profile photo path |
| phone | VARCHAR(255) | NULLABLE | User's phone number |
| address | TEXT | NULLABLE | User's residential address |
| role | ENUM('admin', 'user') | DEFAULT 'user' | User's role in the system |
| plan_id | BIGINT(20) | DEFAULT 1 | Subscription/plan identifier |
| token_used | INT(11) | DEFAULT 0 | API token usage counter |
| status | VARCHAR(255) | DEFAULT 'active' | Account status (active/inactive) |
| remember_token | VARCHAR(100) | NULLABLE | "Remember me" token |
| maternal_records_id | BIGINT(20) | FK, NULLABLE | Reference to MATERNAL_RECORDS |
| child_nutrition_records_id | BIGINT(20) | FK, NULLABLE | Reference to CHILD_NUTRITION_RECORDS |
| patients_id | BIGINT(20) | FK, NULLABLE | Reference to PATIENTS |
| created_at | TIMESTAMP | DEFAULT CURRENT | Account creation timestamp |
| updated_at | TIMESTAMP | DEFAULT CURRENT | Last update timestamp |

**Key Relationships:**
- One User can have One Patient (1:1)
- One User can have One Session (1:1) via sessions.user_id
- One User can have One Maternal Record (1:1)
- One User can have One Child Nutrition Record (1:1)

**Indexes:**
- PRIMARY KEY: id
- UNIQUE KEY: email
- INDEX: role, status

---

### 2. **PATIENTS** - Patient Demographics & Categories

**Purpose:** Stores demographic information for patients who are either pregnant women or children being monitored.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT(20) | PK, AUTO_INCREMENT | Unique patient identifier |
| name | VARCHAR(255) | NOT NULL | Patient's full name |
| category | ENUM('pregnant', 'child') | NOT NULL | Type of patient (pregnant woman or child) |
| birthdate | DATE | NOT NULL | Patient's date of birth (used to calculate age) |
| barangay | VARCHAR(255) | NOT NULL | Barangay/district name (Sierra Bullones location tracking) |
| contact_number | VARCHAR(255) | NOT NULL | Contact number for SMS notifications |
| health_remarks | TEXT | NULLABLE | General health notes/observations |
| maternal_records_id | BIGINT(20) | FK, NULLABLE | Reference to MATERNAL_RECORDS (when category = 'pregnant') |
| child_nutrition_records_id | BIGINT(20) | FK, NULLABLE | Reference to CHILD_NUTRITION_RECORDS (when category = 'child') |
| created_at | TIMESTAMP | DEFAULT CURRENT | Record creation timestamp |
| updated_at | TIMESTAMP | DEFAULT CURRENT | Last update timestamp |

**Key Relationships:**
- One Patient (pregnant) can link to One Maternal Record (1:1)
- One Patient (child) can link to One Child Nutrition Record (1:1)

**Indexes:**
- PRIMARY KEY: id
- INDEX: category, barangay
- FOREIGN KEY: maternal_records_id, child_nutrition_records_id

---

### 3. **MATERNAL_RECORDS** - Maternal Health Monitoring

**Purpose:** Tracks pregnancy status, health checkups, and risk assessment for pregnant mothers.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT(20) | PK, AUTO_INCREMENT | Unique maternal record identifier |
| full_name | VARCHAR(255) | NOT NULL | Mother's full name |
| age | INT(11) | NOT NULL | Mother's age (15-50 range validated) |
| address | TEXT | NOT NULL | Residential address |
| contact_number | VARCHAR(255) | NOT NULL | Phone number for contact/SMS |
| pregnancy_stage | VARCHAR(255) | NOT NULL | Trimester: 'first_trimester', 'second_trimester', 'third_trimester' |
| last_checkup_date | DATE | NOT NULL | Date of last medical checkup |
| expected_delivery_date | DATE | NOT NULL | Estimated due date |
| risk_level | ENUM('low', 'medium', 'high') | DEFAULT 'low' | Health risk classification |
| created_at | TIMESTAMP | DEFAULT CURRENT | Record creation timestamp |
| updated_at | TIMESTAMP | DEFAULT CURRENT | Last update timestamp |

**Validation Rules:**
- Age: 15-50 years
- Contact Number: Regex validation for phone format
- Dates: last_checkup_date ≤ today, expected_delivery_date > last_checkup_date

**Risk Level Classification:**
- **LOW**: Normal pregnancy with no complications
- **MEDIUM**: Requires close monitoring, minor risk factors present
- **HIGH**: High-risk pregnancy, requires immediate intervention

**Key Relationships:**
- One Maternal Record can be linked from Multiple Users (N:1 to USERS)
- One Maternal Record can be linked from One Patient (1:1 to PATIENTS)

**Indexes:**
- PRIMARY KEY: id
- INDEX: risk_level, created_at

---

### 4. **CHILD_NUTRITION_RECORDS** - Child Nutrition Monitoring

**Purpose:** Tracks nutritional status and growth metrics for children under monitoring.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT(20) | PK, AUTO_INCREMENT | Unique nutrition record identifier |
| full_name | VARCHAR(255) | NOT NULL | Child's full name |
| age_months | INT(11) | NOT NULL | Child's age in months |
| barangay | VARCHAR(255) | NOT NULL | Location identifier (Sierra Bullones tracking) |
| weight_kg | DECIMAL(5,2) | NOT NULL | Child's weight in kilograms |
| height_cm | DECIMAL(5,2) | NOT NULL | Child's height in centimeters |
| nutritional_status | ENUM('normal', 'underweight', 'severely_underweight') | DEFAULT 'normal' | Nutritional classification |
| last_weigh_in_date | DATE | NOT NULL | Date of last measurement |
| created_at | TIMESTAMP | DEFAULT CURRENT | Record creation timestamp |
| updated_at | TIMESTAMP | DEFAULT CURRENT | Last update timestamp |

**Nutritional Status Classification:**
- **NORMAL**: Weight and height within normal range for age
- **UNDERWEIGHT**: Below normal weight for age (malnutrition risk)
- **SEVERELY_UNDERWEIGHT**: Critical malnutrition, requires intervention

**Key Relationships:**
- One Child Nutrition Record can be linked from Multiple Users (N:1 to USERS)
- One Child Nutrition Record can be linked from One Patient (1:1 to PATIENTS)

**Indexes:**
- PRIMARY KEY: id
- INDEX: nutritional_status, barangay

---

### 5. **SESSIONS** - User Session Management

**Purpose:** Stores active user session information for authentication management.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | VARCHAR(255) | PK | Unique session identifier |
| user_id | BIGINT(20) | FK, NOT NULL | Reference to USERS table |
| ip_address | VARCHAR(45) | NULLABLE | User's IP address (IPv6 compatible) |
| user_agent | TEXT | NULLABLE | Browser/device information |
| payload | LONGTEXT | NOT NULL | Serialized session data |
| last_activity | INT(11) | NOT NULL, INDEX | Unix timestamp of last activity |

**Key Relationships:**
- Many Sessions belong to One User (N:1)
- Foreign Key: user_id → USERS.id

**Indexes:**
- PRIMARY KEY: id
- FOREIGN KEY: user_id
- INDEX: user_id, last_activity

---

### 6. **PASSWORD_RESET_TOKENS** - Password Reset Management

**Purpose:** Stores temporary tokens for password reset functionality.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| email | VARCHAR(255) | PK | Email address for password reset |
| token | VARCHAR(255) | NOT NULL | Hashed reset token |
| created_at | TIMESTAMP | NULLABLE | Token creation timestamp (expires after 60 min) |

---

### 7. **CACHE** - Laravel Cache Storage

**Purpose:** Framework table for caching query results and application data.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| key | VARCHAR(255) | PK | Cache key identifier |
| value | MEDIUMTEXT | NOT NULL | Serialized cache value |
| expiration | INT(11) | NOT NULL | Unix timestamp of expiration |

---

### 8. **CACHE_LOCKS** - Cache Locking Mechanism

**Purpose:** Manages distributed cache locking to prevent race conditions.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| key | VARCHAR(255) | PK | Lock key identifier |
| owner | VARCHAR(255) | NOT NULL | Lock owner identifier |
| expiration | INT(11) | NOT NULL | Lock expiration timestamp |

---

### 9. **JOBS** - Laravel Job Queue

**Purpose:** Framework table for managing background jobs and scheduled tasks.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT(20) UNSIGNED | PK, AUTO_INCREMENT | Unique job identifier |
| queue | VARCHAR(255) | NOT NULL | Queue name |
| payload | LONGTEXT | NOT NULL | Serialized job data |
| attempts | TINYINT(3) UNSIGNED | NOT NULL | Number of attempts |
| reserved_at | INT(10) UNSIGNED | NULLABLE | Reservation timestamp |
| available_at | INT(10) UNSIGNED | NOT NULL | When job becomes available |
| created_at | INT(10) UNSIGNED | NOT NULL | Job creation timestamp |

**Indexes:**
- PRIMARY KEY: id
- INDEX: queue

---

### 10. **JOB_BATCHES** - Batch Job Management

**Purpose:** Tracks batches of jobs executed together.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | VARCHAR(255) | PK | Unique batch identifier |
| name | VARCHAR(255) | NOT NULL | Batch name |
| total_jobs | INT(11) | NOT NULL | Total jobs in batch |
| pending_jobs | INT(11) | NOT NULL | Pending jobs count |
| failed_jobs | INT(11) | NOT NULL | Failed jobs count |
| cancelled_at | TIMESTAMP | NULLABLE | Batch cancellation timestamp |
| created_at | TIMESTAMP | NOT NULL | Batch creation timestamp |
| finished_at | TIMESTAMP | NULLABLE | Batch completion timestamp |

---

### 11. **FAILED_JOBS** - Failed Job Tracking

**Purpose:** Records jobs that failed during execution for debugging and retry.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | BIGINT(20) UNSIGNED | PK, AUTO_INCREMENT | Unique failed job identifier |
| uuid | VARCHAR(255) | NOT NULL | Unique job UUID |
| connection | TEXT | NOT NULL | Queue connection name |
| queue | TEXT | NOT NULL | Queue name |
| payload | LONGTEXT | NOT NULL | Serialized job data |
| exception | LONGTEXT | NOT NULL | Exception/error message |
| failed_at | TIMESTAMP | DEFAULT CURRENT | Failure timestamp |

---

### 12. **MIGRATIONS** - Migration History Tracking

**Purpose:** Records database migrations applied to track schema version.

**Attributes:**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | INT(11) UNSIGNED | PK, AUTO_INCREMENT | Unique migration identifier |
| migration | VARCHAR(255) | NOT NULL | Migration filename |
| batch | INT(11) | NOT NULL | Batch number |

---

## Table Relationships

### Primary Relationships Summary

| Relationship | Type | Cardinality | Foreign Key | Status |
|--------------|------|-------------|------------|--------|
| USERS → PATIENTS | 1:1 | One User to One Patient | users.patients_id | ✅ Active |
| USERS → SESSIONS | 1:N | One User has Many Sessions | sessions.user_id | ✅ Active |
| USERS → MATERNAL_RECORDS | 1:1 | One User to One Maternal Record | users.maternal_records_id | ✅ Active |
| USERS → CHILD_NUTRITION_RECORDS | 1:1 | One User to One Child Nutrition Record | users.child_nutrition_records_id | ✅ Active |
| PATIENTS → MATERNAL_RECORDS | 1:1 | One Patient to One Maternal Record | patients.maternal_records_id | ✅ Active |
| PATIENTS → CHILD_NUTRITION_RECORDS | 1:1 | One Patient to One Child Nutrition Record | patients.child_nutrition_records_id | ✅ Active |

---

## Foreign Key Relationships

### Complete Foreign Key Definitions for MySQL Workbench Reverse Engineer:

```sql
-- SESSIONS Table
ALTER TABLE sessions
ADD CONSTRAINT fk_sessions_user_id
FOREIGN KEY (user_id) REFERENCES users(id)
ON DELETE CASCADE ON UPDATE CASCADE;

-- USERS Table (Maternal Records)
ALTER TABLE users
ADD CONSTRAINT fk_users_maternal_records_id
FOREIGN KEY (maternal_records_id) REFERENCES maternal_records(id)
ON DELETE SET NULL ON UPDATE CASCADE;

-- USERS Table (Child Nutrition Records)
ALTER TABLE users
ADD CONSTRAINT fk_users_child_nutrition_records_id
FOREIGN KEY (child_nutrition_records_id) REFERENCES child_nutrition_records(id)
ON DELETE SET NULL ON UPDATE CASCADE;

-- PATIENTS Table (Maternal Records)
ALTER TABLE patients
ADD CONSTRAINT fk_patients_maternal_records_id
FOREIGN KEY (maternal_records_id) REFERENCES maternal_records(id)
ON DELETE SET NULL ON UPDATE CASCADE;

-- PATIENTS Table (Child Nutrition Records)
ALTER TABLE patients
ADD CONSTRAINT fk_patients_child_nutrition_records_id
FOREIGN KEY (child_nutrition_records_id) REFERENCES child_nutrition_records(id)
ON DELETE SET NULL ON UPDATE CASCADE;
```

---

## Database Schema Details

### Core Health Tables Summary

| Table | Purpose | Key Field | Indexes |
|-------|---------|-----------|---------|
| users | Authentication & Authorization | id, email | email (UQ), role, status |
| patients | Patient Registry | id, category | category, barangay |
| maternal_records | Pregnancy Tracking | id, risk_level | risk_level, created_at |
| child_nutrition_records | Nutrition Monitoring | id, nutritional_status | nutritional_status, barangay |
| sessions | Session Management | id, user_id | user_id, last_activity |
| password_reset_tokens | Password Reset | email | created_at |
| cache | Query Caching | key | expiration |
| cache_locks | Cache Locking | key | - |
| jobs | Background Tasks | id, queue | queue |
| job_batches | Batch Management | id | created_at |
| failed_jobs | Failed Jobs | id, uuid | - |
| migrations | Migration Tracking | id, batch | - |

### Data Types Used

| Type | Usage | Examples |
|------|-------|----------|
| BIGINT(20) | Primary keys, Large IDs | id in users, patients, maternal_records |
| BIGINT(20) UNSIGNED | Unsigned primary keys | id in jobs, failed_jobs |
| VARCHAR(n) | Text fields | name, email, address |
| TEXT | Long text | health_remarks, connection (failed_jobs) |
| LONGTEXT | Very long text | cache.value, jobs.payload, failed_jobs.payload |
| DATE | Date values | birthdate, last_checkup_date |
| DECIMAL(5,2) | Measurements | weight_kg, height_cm |
| INT(11) | Numbers | age, age_months, attempts |
| INT(10) UNSIGNED | Unsigned numbers | reserved_at, available_at |
| ENUM | Fixed options | role, category, risk_level, nutritional_status, pregnancy_stage |
| TIMESTAMP | Auto timestamps | created_at, updated_at, failed_at |

---

## Cardinality & Constraints

### Cardinality Notation

| Symbol | Meaning |
|--------|---------|
| 1 | Exactly one |
| N | Zero or more |
| 1:1 | One-to-one |
| 1:N | One-to-many |
| N:1 | Many-to-one |

### Key Constraints

**Primary Keys (PK):**
- All tables have primary keys for unique identification
- Most use auto-incrementing BIGINT for scalability
- SESSIONS, PASSWORD_RESET_TOKENS, CACHE, CACHE_LOCKS, JOB_BATCHES use VARCHAR PKs for security/tracking

**Unique Keys (UQ):**
- users.email - Ensures no duplicate email registrations

**Foreign Keys (FK):**
- sessions.user_id → users.id (ON DELETE CASCADE)
- users.maternal_records_id → maternal_records.id (ON DELETE SET NULL)
- users.child_nutrition_records_id → child_nutrition_records.id (ON DELETE SET NULL)
- patients.maternal_records_id → maternal_records.id (ON DELETE SET NULL)
- patients.child_nutrition_records_id → child_nutrition_records.id (ON DELETE SET NULL)

**Indexes:**
- users.email (UNIQUE) - Fast login lookups
- users.role, users.status - Authorization filtering
- sessions.user_id, sessions.last_activity - Session management
- jobs.queue - Job queue lookups
- maternal_records.risk_level, maternal_records.created_at - Health record filtering
- child_nutrition_records.nutritional_status, child_nutrition_records.barangay - Nutrition filtering

---

## Complete SQL Schema for MySQL Workbench Import

```sql
-- ============================================================
-- Users Table
-- ============================================================
CREATE TABLE IF NOT EXISTS users (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  email_verified_at TIMESTAMP NULL,
  password VARCHAR(255) NOT NULL,
  photo VARCHAR(255) NULL,
  phone VARCHAR(255) NULL,
  address TEXT NULL,
  role ENUM('admin', 'user') DEFAULT 'user',
  plan_id BIGINT(20) DEFAULT 1,
  token_used INT(11) DEFAULT 0,
  status VARCHAR(255) DEFAULT 'active',
  remember_token VARCHAR(100) NULL,
  maternal_records_id BIGINT(20) NULL,
  sessions_id BIGINT(20) NULL,
  child_nutrition_records_id BIGINT(20) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_email (email),
  INDEX idx_role (role),
  INDEX idx_status (status)
);

-- ============================================================
-- Patients Table
-- ============================================================
CREATE TABLE IF NOT EXISTS patients (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  category ENUM('pregnant', 'child') NOT NULL,
  birthdate DATE NOT NULL,
  barangay VARCHAR(255) NOT NULL,
  contact_number VARCHAR(255) NOT NULL,
  health_remarks TEXT NULL,
  maternal_records_id BIGINT(20) NULL,
  child_nutrition_records_id BIGINT(20) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_category (category),
  INDEX idx_barangay (barangay)
);

-- ============================================================
-- Maternal Records Table
-- ============================================================
CREATE TABLE IF NOT EXISTS maternal_records (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(255) NOT NULL,
  age INT(11) NOT NULL,
  address TEXT NOT NULL,
  contact_number VARCHAR(255) NOT NULL,
  pregnancy_stage VARCHAR(255) NOT NULL,
  last_checkup_date DATE NOT NULL,
  expected_delivery_date DATE NOT NULL,
  risk_level ENUM('low', 'medium', 'high') DEFAULT 'low',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_risk_level (risk_level),
  INDEX idx_created_at (created_at)
);

-- ============================================================
-- Child Nutrition Records Table
-- ============================================================
CREATE TABLE IF NOT EXISTS child_nutrition_records (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(255) NOT NULL,
  age_months INT(11) NOT NULL,
  barangay VARCHAR(255) NOT NULL,
  weight_kg DECIMAL(5, 2) NOT NULL,
  height_cm DECIMAL(5, 2) NOT NULL,
  nutritional_status ENUM('normal', 'underweight', 'severely_underweight') DEFAULT 'normal',
  last_weigh_in_date DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_nutritional_status (nutritional_status),
  INDEX idx_barangay (barangay)
);

-- ============================================================
-- Sessions Table
-- ============================================================
CREATE TABLE IF NOT EXISTS sessions (
  id VARCHAR(255) PRIMARY KEY,
  user_id BIGINT(20) UNSIGNED NULL,
  ip_address VARCHAR(45) NULL,
  user_agent TEXT NULL,
  payload LONGTEXT NOT NULL,
  last_activity INT(11) NOT NULL,
  INDEX idx_user_id (user_id),
  INDEX idx_last_activity (last_activity),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================================
-- Password Reset Tokens Table
-- ============================================================
CREATE TABLE IF NOT EXISTS password_reset_tokens (
  email VARCHAR(255) PRIMARY KEY,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL
);

-- ============================================================
-- Cache Table
-- ============================================================
CREATE TABLE IF NOT EXISTS cache (
  key VARCHAR(255) PRIMARY KEY,
  value MEDIUMTEXT NOT NULL,
  expiration INT(11) NOT NULL
);

-- ============================================================
-- Cache Locks Table
-- ============================================================
CREATE TABLE IF NOT EXISTS cache_locks (
  key VARCHAR(255) PRIMARY KEY,
  owner VARCHAR(255) NOT NULL,
  expiration INT(11) NOT NULL
);

-- ============================================================
-- Jobs Table
-- ============================================================
CREATE TABLE IF NOT EXISTS jobs (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  queue VARCHAR(255) NOT NULL,
  payload LONGTEXT NOT NULL,
  attempts TINYINT(3) UNSIGNED NOT NULL,
  reserved_at INT(10) UNSIGNED NULL,
  available_at INT(10) UNSIGNED NOT NULL,
  created_at INT(10) UNSIGNED NOT NULL,
  INDEX idx_queue (queue)
);

-- ============================================================
-- Job Batches Table
-- ============================================================
CREATE TABLE IF NOT EXISTS job_batches (
  id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  total_jobs INT(11) NOT NULL,
  pending_jobs INT(11) NOT NULL,
  failed_jobs INT(11) NOT NULL,
  cancelled_at TIMESTAMP NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  finished_at TIMESTAMP NULL
);

-- ============================================================
-- Failed Jobs Table
-- ============================================================
CREATE TABLE IF NOT EXISTS failed_jobs (
  id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  uuid VARCHAR(255) NOT NULL,
  connection TEXT NOT NULL,
  queue TEXT NOT NULL,
  payload LONGTEXT NOT NULL,
  exception LONGTEXT NOT NULL,
  failed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- Migrations Table
-- ============================================================
CREATE TABLE IF NOT EXISTS migrations (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  migration VARCHAR(255) NOT NULL,
  batch INT(11) NOT NULL
);

-- ============================================================
-- Foreign Keys
-- ============================================================

ALTER TABLE users
ADD CONSTRAINT fk_users_maternal_records_id
FOREIGN KEY (maternal_records_id) REFERENCES maternal_records(id)
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE users
ADD CONSTRAINT fk_users_child_nutrition_records_id
FOREIGN KEY (child_nutrition_records_id) REFERENCES child_nutrition_records(id)
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE patients
ADD CONSTRAINT fk_patients_maternal_records_id
FOREIGN KEY (maternal_records_id) REFERENCES maternal_records(id)
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE patients
ADD CONSTRAINT fk_patients_child_nutrition_records_id
FOREIGN KEY (child_nutrition_records_id) REFERENCES child_nutrition_records(id)
ON DELETE SET NULL ON UPDATE CASCADE;
```

---

## Document Version History

| Version | Date | Changes | Notes |
|---------|------|---------|-------|
| 1.0 | 2026-04-22 | Initial ERD documentation | Based on migrations only |
| 2.0 | 2026-04-22 | Updated from MySQL Workbench | Added foreign key relationships, additional tables (cache_locks, job_batches, failed_jobs, migrations), corrected field types |

---

**End of ERD Documentation - Version 2.0**
