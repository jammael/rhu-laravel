# NutriCare System - Functional & Non-Functional Requirements

## Project Overview
**Project Name:** Web-Based Health Monitoring System with SMS Notification Reminders  
**Organization:** Rural Health Unit (RHU) of Sierra Bullones  
**Date Generated:** April 27, 2026  
**Status:** Development Phase

---

## FUNCTIONAL REQUIREMENTS

The software is divided into the following six main functionalities: **Manage Maternal Records**, **Manage Child Nutrition Records**, **Manage Users & Access Control**, **Generate Reports & Analytics**, **Send SMS Notifications**, and **Manage Patient Enrollment**.

---

### 1. **Manage Maternal Records**

Manage Maternal Records involves the management and monitoring of pregnant women in the RHU. This includes registering pregnant women, tracking their health status, monitoring pregnancy stages, assessing risk levels, and maintaining comprehensive health records for proper prenatal care.

#### Key Features:
- **Register Pregnant Women**: Create new maternal records with complete patient information including name, age, address, contact number for SMS notifications, pregnancy stage, last checkup date, expected delivery date, and risk level classification (low, medium, high).
- **Search & Filter Records**: Search maternal records by full name and filter by risk level or active/archived status with pagination support (15 records per page).
- **Monitor Pregnancy Progress**: Track pregnancy stage progression (first, second, third trimester) and monitor changes in risk level assessment.
- **Update Records**: Edit and modify existing maternal records to reflect current health status and checkup information.
- **Archive/Restore Records**: Soft delete functionality to archive completed or inactive records while maintaining data integrity. Ability to restore archived records when needed.
- **View Record Details**: Display comprehensive maternal record information including registration date, last checkup date, expected delivery date, and risk assessment details.
- **Generate PDF Reports**: Create professional PDF reports for individual maternal records with RHU branding and complete patient information.

#### Validation Rules:
```
Full Name: Required, string, maximum 255 characters
Age: Required, integer, minimum 15, maximum 50 years
Address: Required, string, maximum 500 characters
Contact Number: Required, format validation (7+ digits with optional + or -)
Pregnancy Stage: Required, must be (first_trimester, second_trimester, third_trimester)
Last Checkup Date: Required, must be today or earlier
Expected Delivery Date: Required, must be after last checkup date
Risk Level: Required, must be (low, medium, high)
```

---

### 2. **Manage Child Nutrition Records**

Manage Child Nutrition Records involves comprehensive nutrition tracking for children aged 0-59 months. This includes registering children, recording physical measurements, automatically calculating nutritional status based on WHO/DOH standards, monitoring nutrition progress, and identifying at-risk cases for intervention.

#### Key Features:
- **Register Child Patients**: Create new child nutrition records with patient information including full name, age (in months), weight (kg), height (cm), last weigh-in date, barangay location, and contact number for SMS notifications.
- **Automatic Nutritional Status Calculation**: System automatically calculates BMI and Z-score based on WHO/DOH standards without manual entry. Classifications include:
  - **Normal**: Z-Score ≥ -2
  - **Underweight**: -3 ≤ Z-Score < -2
  - **Severely Underweight**: Z-Score < -3
- **Search & Filter Records**: Search by full name and filter by nutritional status or active/archived status with pagination (15 records per page).
- **Track Measurements**: Record and update physical measurements (weight, height) and calculate BMI automatically for each weigh-in.
- **Monitor Nutritional Progress**: View nutritional status history, identify trends, and flag cases requiring intervention.
- **Archive/Restore Records**: Archive completed or inactive child records while maintaining historical data. Restore archived records as needed.
- **View Record Details**: Display comprehensive child nutrition information including age-specific reference data, calculated BMI, Z-score, and nutritional assessment.
- **Generate PDF Reports**: Create professional child health reports with anthropometric measurements and nutritional status assessment.

#### Age-Specific Reference Data (WHO Standards):
```
0-6 months: BMI mean 17.5, SD 1.2
6-12 months: BMI mean 18.0, SD 1.3
12-24 months: BMI mean 17.5, SD 1.4
24-36 months: BMI mean 16.9, SD 1.3
36-48 months: BMI mean 16.2, SD 1.2
48-60 months: BMI mean 15.8, SD 1.1
60-72 months: BMI mean 15.5, SD 1.2
72-180 months (6-15 years): BMI mean 15.8, SD 1.3
```

---

### 3. **Manage Users & Access Control**

Manage Users & Access Control involves comprehensive user account management and role-based access control (RBAC). This includes user registration, approval workflow, role assignment, role updates, and access management to ensure data security and proper authorization.

#### Key Features:
- **User Registration**: Users can register new accounts with email verification and role selection (Doctor, Nurse, Midwife, Encoder).
- **Approval Workflow**: Admin users can review pending user applications, approve with role assignment, or deny applications.
- **Role Assignment**: Assign specific roles to approved users (Admin, Doctor, Nurse, Midwife, Encoder) determining their system access and permissions.
- **Update User Roles**: Admin can modify an approved user's role to reflect changes in job responsibilities or organizational needs.
- **User Status Tracking**: Visual indicators show user status (Pending/Approved/Denied) for quick identification.
- **Delete User Accounts**: Remove users from the system with confirmation dialogs and self-deletion prevention for security.
- **Access Control**: Implement strict role-based middleware protection (`IsAdmin`, `IsUser`) controlling route access based on user roles.
- **Session Management**: Automatic logout on unauthorized access attempts with error messaging.
- **View User List**: Display all users with profile information, status, role, and email verification status.

#### Roles & Permissions:
```
Admin: 
  - Full system access
  - User management
  - Activity logging
  - System configuration
  
Doctor/Nurse/Midwife/Encoder:
  - View maternal records
  - View child nutrition records
  - Create/update records
  - Generate PDF reports
  - View patient data
```

---

### 4. **Generate Reports & Analytics**

Generate Reports & Analytics provides comprehensive reporting and data visualization capabilities for health monitoring and organizational analysis. This includes dashboard analytics, detailed records reporting, and health status summaries.

#### Key Features:
- **Dashboard Analytics**: Display key statistics and metrics including:
  - Total registered maternal patients
  - Total child nutrition patients
  - Count of high-risk maternal cases
  - Count of normal, underweight, and severely underweight children
  - Upcoming delivery dates (within 30 days)
  - Recent health alerts
- **Individual Record Reports**: Generate detailed PDF reports for specific maternal or child nutrition records with patient information, measurements, and health assessments.
- **Health Status Summary**: Provide overview statistics on patient populations by category, nutritional status, and risk level.
- **Urgent Health Alerts**: Display 5 most recent critical and warning cases requiring immediate attention.
- **Data Export**: Export patient records and reports in PDF format with professional RHU branding and timestamped filenames.
- **Report Filtering**: Filter and view specific subsets of data (by status, date range, location).
- **Barangay-Based Tracking**: Track patient distribution and health metrics by barangay location for local health planning.

---

### 5. **Send SMS Notifications**

Send SMS Notifications involves automated and manual SMS messaging to patients for appointment reminders, follow-up notifications, and health alerts. This ensures consistent patient engagement and improves health outcomes through proactive communication.

#### Key Features:
- **Manual SMS Trigger**: Admin/Healthcare staff can manually send SMS messages to individual patients with custom message composition.
- **Appointment Reminders**: Automated SMS reminders for scheduled prenatal check-ups with patient name, appointment date, and RHU contact information.
- **Follow-up Notifications**: Automated SMS notifications for nutrition follow-ups, weight checks, and required interventions.
- **High-Risk Alerts**: Automated SMS alerts for patients with high-risk maternal status or severe malnutrition requiring urgent intervention.
- **Contact Number Validation**: Verify and validate patient contact numbers during enrollment with opt-in/opt-out management.
- **Delivery Tracking**: Track SMS delivery status (sent, delivered, failed) for each notification.
- **Retry Mechanism**: Automatic retry for failed SMS with exponential backoff strategy.
- **SMS Templates**: Predefined message templates for reminders, follow-ups, and alerts for consistency and efficiency.
- **Scheduled Dispatch**: Queue-based scheduling for SMS delivery at optimal times (morning, evening, specific dates).
- **Compliance Logging**: Log all SMS activity with timestamps, recipient details, and delivery status for audit trail.

#### SMS Message Types:
```
1. Maternal Checkup Reminder: 
   "Hi [Name], reminder of your prenatal checkup on [Date] at RHU Sierra Bullones. 
   Call [Contact] for rescheduling."

2. Child Nutrition Follow-up:
   "Hi [Name], time for [Child Name]'s weight check on [Date]. 
   Please visit RHU Sierra Bullones."

3. High-Risk Alert:
   "Urgent: [Name], your health assessment requires immediate attention. 
   Please contact RHU Sierra Bullones: [Contact]"
```

---

### 6. **Manage Patient Enrollment**

Manage Patient Enrollment involves registering and managing patient information for both maternal and child nutrition services. This includes patient data collection, categorization, location tracking, and contact management for service coordination.

#### Key Features:
- **Patient Registration**: Create patient records with complete information including name, birthdate, category (pregnant, child), barangay location, contact number, and health remarks.
- **Category-Based Enrollment**: Differentiate patient enrollment based on category:
  - **Maternal Patients**: Pregnant women requiring prenatal care
  - **Child Patients**: Children aged 0-59 months requiring nutrition monitoring
- **Location Tracking**: Record patient barangay location for geographic tracking and local health planning.
- **Contact Information Management**: Store and maintain patient contact numbers for SMS notifications and communication.
- **Health Remarks**: Add notes and observations about patient health status, allergies, or special conditions.
- **Patient Search**: Find patients by name, category, or barangay location.
- **Update Patient Information**: Edit and modify patient records when information changes.
- **View Patient Details**: Display comprehensive patient profile with enrollment status and linked health records.
- **Soft Delete**: Archive inactive patient records while maintaining historical data.
- **Automatic Record Linking**: When child patients are enrolled, automatically create linked child nutrition records with calculated nutritional status.

#### Validation Rules:
```
Name: Required, string, maximum 255 characters
Birthdate: Required, valid date
Category: Required, must be (pregnant, child)
Barangay: Required, string, maximum 255 characters
Contact Number: Required, valid phone format (7+ digits)
Health Remarks: Optional, text field
```

---

## NON-FUNCTIONAL REQUIREMENTS

Non-functional requirements describe system qualities, performance characteristics, security features, and operational constraints that the software must satisfy.

---

### 1. **Performance Requirements**

- **Response Time**: All page loads and database queries must complete within 2 seconds for optimal user experience.
- **Dashboard Loading**: Dashboard analytics and summary statistics must load within 3 seconds even with 1000+ patient records.
- **PDF Generation**: Report PDF generation must complete within 5 seconds for individual records.
- **Search Performance**: Patient search and filter operations must return results within 1.5 seconds.
- **Pagination**: Display 15 records per page to balance data presentation with performance.
- **Batch Processing**: Support bulk SMS dispatch and report generation without blocking user interface.
- **Database Query Optimization**: Use indexed searches for full_name, risk_level, nutritional_status fields.
- **Concurrent Users**: System must support minimum 50 concurrent users without performance degradation.

---

### 2. **Security Requirements**

- **Authentication**: Implement secure user authentication using Laravel Breeze with email verification.
- **Authorization**: Enforce role-based access control (RBAC) using middleware (`IsAdmin`, `IsUser`).
- **CSRF Protection**: Enable CSRF token validation on all forms using @csrf directive.
- **Password Security**: Enforce strong password requirements with hashing using bcrypt algorithm.
- **Data Encryption**: Encrypt sensitive data including contact numbers and health information in transit (HTTPS/TLS 1.2+).
- **Session Management**: Implement secure session handling with automatic logout on unauthorized access.
- **Self-Deletion Prevention**: Prevent admin users from deleting their own accounts.
- **Audit Logging**: Log all administrative actions (user approvals, denials, role changes, deletions) with timestamp and IP address.
- **Input Validation**: Validate all user inputs on both client and server side to prevent SQL injection and XSS attacks.
- **Contact Number Masking**: Mask partially displayed phone numbers in logs and reports for privacy.
- **GDPR Compliance**: Provide ability to archive/soft delete patient data upon request.

---

### 3. **Usability Requirements**

- **User Interface**: Implement clean, intuitive interface using Tailwind CSS with responsive design for desktop and mobile.
- **Navigation**: Provide clear navigation menu with role-specific menu items visible only to authorized users.
- **Confirmation Dialogs**: Display confirmation dialogs for destructive actions (delete, archive) to prevent accidental data loss.
- **Error Messages**: Display clear, user-friendly error messages for validation failures and system errors.
- **Status Indicators**: Use visual badges and indicators (color-coded) to quickly show user status, record status, and health alerts.
- **Search Functionality**: Provide search and filter capabilities for quick record location and access.
- **Mobile Responsiveness**: Support responsive design with proper display on tablets and mobile devices.
- **Accessibility**: Ensure WCAG 2.1 compliance for color contrast, font sizes, and keyboard navigation.
- **Help Text**: Provide informational notes and tooltips explaining automatic calculations (BMI, Z-score, nutritional status).
- **Consistent Design**: Maintain visual consistency across all pages and modules using standard components and styling.

---

### 4. **Data Integrity & Reliability**

- **Database Backup**: Implement regular automated database backups (daily) with point-in-time recovery capability.
- **Data Validation**: Validate all data against defined rules before storing in database.
- **Type Casting**: Use proper data types for numeric fields (age_months: integer, weight_kg: float, height_cm: float, dates: date).
- **Referential Integrity**: Implement foreign key constraints between patients and nutrition records with cascade delete.
- **Transaction Management**: Use database transactions for multi-step operations to ensure atomicity.
- **Soft Deletes**: Implement soft delete functionality for archiving records without permanent data loss.
- **Audit Trail**: Maintain complete audit trail of all changes with timestamp and user information.
- **Concurrency Control**: Handle simultaneous updates with optimistic/pessimistic locking as appropriate.
- **Data Consistency**: Ensure data consistency across related tables (Patient ↔ MaternalRecord ↔ ChildNutritionRecord).

---

### 5. **Availability & Reliability**

- **System Uptime**: Maintain 99.5% system availability with planned maintenance windows.
- **Error Handling**: Implement comprehensive error handling with graceful degradation of features.
- **Fallback Mechanisms**: Provide fallback options for SMS service failures (email notification alternative).
- **Recovery Time**: Recover from failures and restore service within 30 minutes of detection.
- **Health Monitoring**: Implement system health checks and alerting for critical component failures.
- **Graceful Degradation**: System continues to function with reduced capability if non-critical services fail.
- **Load Balancing**: Support load distribution across multiple servers for high-availability deployment.
- **Database Replication**: Implement database replication for high availability and disaster recovery.

---

### 6. **Scalability Requirements**

- **User Scale**: Support growth from current users to 500+ concurrent users within 2 years.
- **Data Scale**: Handle growth from current 1000+ records to 50,000+ records without performance degradation.
- **Record Volume**: Efficiently process and display reports on 10,000+ patient records.
- **SMS Volume**: Support sending 5,000+ SMS messages per day with reliable delivery.
- **Horizontal Scaling**: Architecture supports horizontal scaling by adding servers for load distribution.
- **Vertical Scaling**: Optimize code and queries to support vertical scaling (increased server resources).
- **Database Partitioning**: Implement table partitioning strategy for large patient record tables if needed.
- **Caching Strategy**: Implement caching (Redis) for frequently accessed data to reduce database load.

---

### 7. **Maintainability & Support**

- **Code Quality**: Follow Laravel best practices and PSR-12 coding standards for maintainability.
- **Documentation**: Maintain comprehensive code documentation and architecture documentation.
- **Version Control**: Use Git version control with clear commit messages and branching strategy.
- **Testing**: Implement unit tests and feature tests with minimum 70% code coverage.
- **Logging**: Comprehensive logging at DEBUG, INFO, WARNING, ERROR levels for troubleshooting.
- **Error Tracking**: Integrate error tracking service (Sentry) for real-time error monitoring.
- **API Documentation**: Document all endpoints and data structures for API integration.
- **Knowledge Base**: Maintain knowledge base and troubleshooting guide for support team.
- **Support Availability**: Provide 24/7 support contact through phone, email, and messaging.

---

### 8. **Compatibility Requirements**

- **Browser Support**: Support modern browsers:
  - Chrome/Edge (latest 2 versions)
  - Firefox (latest 2 versions)
  - Safari (latest 2 versions)
- **Operating Systems**: Support Windows, macOS, and Linux (for deployment).
- **Mobile Devices**: Responsive design for iOS (Safari) and Android (Chrome) devices.
- **Database**: Compatible with MySQL 8.0+ and PostgreSQL 13+.
- **PHP Version**: Require PHP 8.2+ for compatibility with Laravel 12.
- **Mail Services**: Compatible with Postmark, Resend, AWS SES, and SMTP providers.
- **SMS Services**: Support integration with Vonage (Nexmo), Twilio, or similar SMS providers.
- **API Standards**: Follow RESTful API standards for extensibility and integration.

---

### 9. **Compliance & Legal Requirements**

- **Data Protection**: Comply with data privacy laws:
  - Data Privacy Act (DPA) of Republic Act 10173 (Philippines)
  - Bayanihan to Heal as One Act (Healthcare Data)
- **Health Information Security**: Follow HIPAA-equivalent standards for health information handling.
- **Audit Requirements**: Maintain audit logs for healthcare compliance and legal accountability.
- **Consent Management**: Implement opt-in/opt-out mechanism for SMS communications.
- **Record Retention**: Follow healthcare record retention requirements (minimum 7-10 years).
- **Access Logs**: Maintain logs of who accessed patient information and when for compliance.
- **Incident Reporting**: Document and report security incidents to relevant authorities.
- **Training Records**: Keep records of staff training on data handling and security procedures.

---

### 10. **Operational Requirements**

- **Deployment Environment**: Support deployment on Laravel Forge, DigitalOcean, AWS, or on-premises servers.
- **Configuration Management**: Use environment variables (.env) for sensitive configuration.
- **Database Migrations**: Implement versioned database schema migrations for version management.
- **Automated Deployment**: Support CI/CD pipeline for automated testing and deployment.
- **Monitoring & Alerts**: Implement system monitoring and alerting for performance and security issues.
- **Log Management**: Centralized logging system for all application and system logs.
- **Scheduled Tasks**: Support scheduled job processing for SMS dispatch and report generation.
- **Queue Management**: Implement queue system (Redis/Beanstalk) for asynchronous processing.
- **Health Checks**: Provide health check endpoints for monitoring system status.
- **Disaster Recovery**: Implement disaster recovery plan with backup and restore procedures.

---

## Summary

This comprehensive requirements document provides clear guidelines for developing the NutriCare Health Monitoring System. The Functional Requirements define **WHAT** the system should do, while the Non-Functional Requirements define **HOW WELL** it should perform. These requirements serve as the foundation for:

- **Use Case Diagrams**: Model interactions between users (Admin, Healthcare Staff) and system functionalities
- **Activity Diagrams**: Detail workflows for processes like patient enrollment, record management, and SMS notification dispatch
- **Sequence Diagrams**: Show interactions between system components (Controllers, Models, Views, Services)
- **System Architecture**: Guide technical implementation and technology stack decisions
- **Test Planning**: Define acceptance criteria and test scenarios for QA validation

---

**Document Version:** 1.0  
**Last Updated:** April 27, 2026  
**Prepared for:** Use Case & Activity Diagram Development
