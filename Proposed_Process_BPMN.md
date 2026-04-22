# RHU-Laravel Capstone Project - Proposed (Automated) Process

## Project Overview

**Project Name:** RHU-Laravel (Rural Health Unit Management System)  
**Document Focus:** Proposed Automated Processes with BPMN Diagrams  
**Date:** April 22, 2026

---

## Chapter 4: Proposed (Automated) Process

### 4.1 Introduction

This chapter presents the proposed automated processes for the RHU-Laravel system, utilizing Business Process Model and Notation (BPMN) diagrams to illustrate workflow automation, system integration, and improved operational efficiency.

---

### 4.2 Process Automation Architecture

#### 4.2.1 Overview

The proposed automation framework includes:

1. **Request/Response Workflows** - Automated HTTP request handling
2. **Data Processing Pipelines** - Asynchronous job queuing and execution
3. **Notification Systems** - Automated alerts and communications
4. **Report Generation** - Scheduled and on-demand report creation
5. **Email Workflows** - Transactional and notification emails

---

### 4.3 Proposed BPMN Diagrams

#### 4.3.1 Maternal Record Creation - Automated Workflow

**Process Name:** Maternal Record Registration with Validation & Notification

```
[Start] 
   ↓
[Submit Maternal Record Form]
   ↓
[Validate Input Data]
   ├─ Valid? → [Store in Database]
   │            ↓
   │           [Queue Email Job]
   │            ↓
   │           [Send Confirmation Email]
   │            ↓
   │           [Trigger Alert (if High Risk)]
   │            ├─ High Risk? → [Queue Slack Notification]
   │            │               ↓
   │            │              [Send Admin Alert]
   │            └─ Low/Medium Risk? → [Complete]
   │                                     ↓
   └─ Invalid? → [Return Error Message]
                   ↓
                 [Display Validation Errors]
                   ↓
                 [End - Retry]
```

**Automated Components:**
- Input validation at controller level
- Database transaction for atomic save
- Async email job queue
- Conditional Slack notifications based on risk level
- Error handling with user feedback

**Technology Stack for Automation:**
```php
// Queue Configuration
QUEUE_CONNECTION=database
// or REDIS_HOST for production

// Mail Configuration  
MAIL_FROM_ADDRESS
MAIL_FROM_NAME
POSTMARK_API_KEY (or RESEND_API_KEY)
```

---

#### 4.3.2 Maternal Health Monitoring - Data Analysis Workflow

**Process Name:** Automated Risk Assessment and Monitoring

```
[Scheduled Job - Daily at 8 AM]
   ↓
[Fetch All Maternal Records]
   ↓
[Analyze Each Record]
   ├─ Days Since Checkup > 30?
   │  └─ Yes → [Mark for Attention]
   │            ↓
   │           [Generate Alert]
   │            ↓
   │           [Notify Admin via Slack]
   │            ↓
   │           [Log Event]
   └─ No → Continue
   ↓
[Check Pregnancy Stage Transitions]
   ├─ Moving to 3rd Trimester? → [Generate Report]
   │                              ↓
   │                             [Store Report]
   │                              ↓
   │                             [Email to Healthcare Provider]
   └─ Other Stage? → Continue
   ↓
[Update Dashboard Statistics]
   ├─ Total Active Records
   ├─ High-Risk Count
   ├─ Overdue Checkups
   └─ By Risk Level Distribution
   ↓
[Store Metrics in Cache]
   ↓
[End - Task Complete]
```

**Automated Components:**
- Laravel Scheduled Jobs (Kernel.php)
- Background data analysis
- Conditional branching based on thresholds
- Multi-channel notifications (Email, Slack)
- Dashboard metric caching for performance

**Implementation:**
```php
// app/Console/Kernel.php
$schedule->job(new AnalyzeMaternalRecords::class)
    ->dailyAt('08:00');

$schedule->call(function () {
    // Update cache metrics
    Cache::remember('maternal_stats', 3600, function () {
        return MaternalRecord::statistics();
    });
})->hourly();
```

---

#### 4.3.3 Child Nutrition Monitoring - Automated Analysis

**Process Name:** Child Nutrition Status Tracking and Alert System

```
[Monthly Scheduled Check]
   ↓
[Fetch All Child Nutrition Records]
   ↓
[For Each Child Record]
   ├─ Calculate BMI
   │  ├─ Malnourished (<-2 SD)?
   │  │  └─ Yes → [Flag as Malnourished]
   │  │           ↓
   │  │          [Generate Alert]
   │  │           ↓
   │  │          [Queue Notification Email]
   │  │           ↓
   │  │          [Create Dashboard Alert Card]
   │  │           ↓
   │  │          [Log Alert Event]
   │  ├─ At Risk (-1 to -2 SD)?
   │  │  └─ Yes → [Flag as At Risk]
   │  │           ↓
   │  │          [Store For Monitoring]
   │  └─ Normal (>-1 SD)?
   │     └─ [No Action Required]
   ├─ Check Weight Gain Trend
   │  ├─ Declining?
   │  │  └─ Yes → [Alert Healthcare Provider]
   │  └─ Improving?
   │     └─ [Log Progress]
   └─ Generate Performance Report
      ↓
[Aggregate Statistics]
   ├─ Total Malnourished
   ├─ Total At Risk
   ├─ Improvement Rate
   └─ By Barangay Distribution
   ↓
[Cache Dashboard Metrics]
   ↓
[Send Summary Report to Admin]
   ↓
[End - Monitoring Complete]
```

**Automated Components:**
- BMI calculation automation
- Status classification logic
- Multi-tier alerting system
- Historical trend analysis
- Geographic aggregation

**Event Flow:**
```
Child Record Updated
    ↓
ChildNutritionUpdated Event Dispatched
    ↓
Listeners:
├─ RecalculateNutritionStatus
├─ CheckMalnourishmentThreshold
├─ NotifyHealthcareProvider
└─ UpdateDashboardMetrics
```

---

#### 4.3.4 Report Generation - On-Demand Automation

**Process Name:** Automated PDF Report Generation Workflow

```
[User Requests Report]
   ↓
[Select Report Type & Parameters]
   ├─ Maternal Health Report
   ├─ Child Nutrition Report
   ├─ Risk Assessment Summary
   └─ Barangay Statistics
   ↓
[Validate Parameters]
   ├─ Valid? → [Queue PDF Generation Job]
   │            ↓
   │           [Fetch Required Data]
   │            ↓
   │           [Apply Filters & Sorting]
   │            ↓
   │           [Format Data for PDF]
   │            ↓
   │           [Generate PDF File]
   │            ↓
   │           [Store in Storage]
   │            ↓
   │           [Send Download Link via Email]
   │            ↓
   │           [Display Success Message]
   │            ↓
   │           [End - Download Ready]
   └─ Invalid? → [Return Error]
                  ↓
                 [End - Request Failed]
```

**Automated Components:**
- Asynchronous job processing
- Data aggregation and formatting
- PDF generation (DomPDF library)
- File storage management
- Email delivery with attachment/link

**Queue Job Implementation:**
```php
// app/Jobs/GeneratePdfReport.php
public function handle()
{
    $data = $this->gatherReportData();
    $pdf = PDF::loadView('reports.' . $this->reportType, $data);
    $path = $pdf->save(storage_path('reports/' . $filename));
    
    Mail::send(new ReportGenerated($path));
}
```

---

#### 4.3.5 User Authentication & Role Management - Automated Flow

**Process Name:** User Login, Role Assignment, and Dashboard Routing

```
[User Visits Login Page]
   ↓
[Enter Credentials]
   ↓
[Submit Login Form]
   ↓
[Verify Credentials Against Database]
   ├─ Credentials Valid?
   │  ├─ Yes → [Create Session/Token]
   │  │        ↓
   │  │       [Log Login Event]
   │  │        ↓
   │  │       [Check User Role]
   │  │        ├─ Admin?
   │  │        │  └─ [Redirect to Admin Dashboard]
   │  │        │     ↓
   │  │        │    [Load Admin Widgets]
   │  │        │     └─ Maternal Records, Child Nutrition, Stats
   │  │        └─ User/Staff?
   │  │           └─ [Redirect to User Dashboard]
   │  │              ↓
   │  │             [Load User-Specific Data]
   │  │              └─ My Patients, My Records
   │  │        ↓
   │  │       [Cache User Permissions]
   │  │        ↓
   │  │       [Display Success Message]
   │  │        ↓
   │  │       [End - Session Active]
   └─ No → [Log Failed Attempt]
           ↓
          [Increment Failed Count]
           ├─ Attempts > 5?
           │  └─ Lock Account Temporarily
           │     ↓
           │    [Notify User]
           └─ Attempts ≤ 5?
              └─ [Display Error]
                 ↓
                [End - Return to Login]
```

**Automated Components:**
- Credential verification
- Session/token generation
- Role-based routing
- Failed attempt tracking
- Account security measures

**Laravel Implementation:**
```php
// Middleware Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('IsAdmin')->group(function () {
        // Admin routes
    });
    Route::middleware('IsUser')->group(function () {
        // User routes
    });
});
```

---

#### 4.3.6 Email Notification System - Automated Queue

**Process Name:** Transactional Email Delivery Pipeline

```
[System Triggers Email Event]
   ├─ Maternal Record Created
   ├─ High-Risk Alert
   ├─ Report Ready
   ├─ Password Reset
   └─ Verification Email
   ↓
[Email Event Listener Triggered]
   ↓
[Queue Email Job]
   ├─ Using Driver: Database/Redis
   ├─ Set Priority: High/Normal/Low
   └─ Set Retry Count: 3 times
   ↓
[Queue Worker Processes Job]
   ├─ Failed Retry < 3?
   │  └─ Retry with exponential backoff
   └─ Failed Retry = 3?
      └─ Move to Failed Queue
   ↓
[Format Email Template]
   ├─ Blade Template Rendering
   ├─ Dynamic Content Insertion
   └─ Attachment Processing
   ↓
[Select Mail Provider]
   ├─ Postmark API
   ├─ Resend API
   └─ AWS SES
   ↓
[Send Email]
   ├─ Success? → [Log Delivery]
   │             ↓
   │            [Update Email Status]
   │             ↓
   │            [Complete]
   └─ Failed? → [Retry Logic]
                 ↓
                [Log Failure]
```

**Automated Components:**
- Event-driven email triggering
- Queue-based delivery
- Retry mechanisms
- Multi-provider support
- Delivery tracking

**Configuration:**
```php
// config/mail.php
'driver' => env('MAIL_DRIVER', 'postmark'),
'queue' => [
    'driver' => 'database',
    'retry_after' => 300,
],
'postmark' => [
    'secret' => env('POSTMARK_API_KEY'),
],
```

---

### 4.4 Integration Points with Existing System

#### 4.4.1 Controller Integration

```php
// Controllers automatically trigger automation
MaternalController::store()
├─ Validate Input
├─ Create Record
├─ Event::dispatch(MaternalRecordCreated::class)
│  └─ Triggers: Email, Slack Notification, Dashboard Update
└─ Return Response

// Listeners handle automation
listeners/
├─ SendMaternalRecordEmail::class
├─ NotifySlackChannel::class
└─ UpdateDashboardStats::class
```

---

#### 4.4.2 Database Integration

```php
// Migrations for automation support
├─ jobs (Queue table for async jobs)
├─ failed_jobs (Failed job tracking)
├─ event_logs (System event logging)
└─ notifications (Notification history)
```

---

#### 4.4.3 Middleware Integration

```php
// Automated middleware handling
routes/web.php
├─ auth (Automatic authentication)
├─ verified (Email verification automation)
├─ IsAdmin (Automatic role checking)
└─ IsUser (Automatic permission checking)
```

---

### 4.5 Technology Requirements for Automation

#### 4.5.1 Required Packages

```json
{
  "require": {
    "laravel/framework": "^12.0",
    "doctrine/dbal": "^4.0",
    "dompdf/dompdf": "^3.0",
    "symfony/process": "^7.0"
  },
  "require-dev": {
    "laravel/pint": "^1.0",
    "pestphp/pest": "^3.0"
  }
}
```

#### 4.5.2 Queue Configuration

**Options:**
- `database` - Suitable for development/small scale
- `redis` - Recommended for production
- `sqs` - AWS-based queuing
- `sync` - Synchronous (for testing)

#### 4.5.3 Email Configuration

**Providers:**
- Postmark (configured)
- Resend (configured)
- AWS SES (configured)

---

### 4.6 Automation Benefits

#### 4.6.1 Operational Efficiency

✅ Reduced manual data entry  
✅ Automated risk assessment  
✅ Scheduled health monitoring  
✅ Instant notifications  
✅ Background processing for heavy operations

#### 4.6.2 Data Integrity

✅ Transaction-based operations  
✅ Validation automation  
✅ Event-driven consistency  
✅ Audit logging  

#### 4.6.3 User Experience

✅ Real-time alerts  
✅ Asynchronous operations  
✅ Non-blocking UI interactions  
✅ Automated report generation  

#### 4.6.4 Healthcare Outcomes

✅ Timely high-risk alerts  
✅ Continuous health monitoring  
✅ Data-driven insights  
✅ Improved follow-up tracking  

---

### 4.7 Implementation Roadmap

#### Phase 1: Foundation (Weeks 1-2)
- [ ] Set up job queue (Database driver)
- [ ] Configure mail services
- [ ] Create event listeners
- [ ] Implement basic notifications

#### Phase 2: Core Automation (Weeks 3-4)
- [ ] Maternal record workflows
- [ ] Child nutrition analysis
- [ ] Risk assessment automation
- [ ] Dashboard metric caching

#### Phase 3: Advanced Features (Weeks 5-6)
- [ ] PDF report generation
- [ ] Scheduled health monitoring jobs
- [ ] Slack integration
- [ ] Email notification system

#### Phase 4: Optimization (Week 7+)
- [ ] Redis queue migration
- [ ] Performance tuning
- [ ] Load testing
- [ ] Production deployment

---

### 4.8 Monitoring & Logging

#### 4.8.1 Job Monitoring

```php
// Monitor failed jobs
php artisan queue:failed

// Monitor queue status
php artisan queue:monitor

// View job logs
Log::channel('queue')->info($message);
```

#### 4.8.2 Event Logging

```php
// Create event logs table
php artisan make:migration create_event_logs_table

// Log all events
EventLog::create([
    'event_type' => class_basename($event),
    'data' => $event->getData(),
    'status' => 'processed',
    'timestamp' => now(),
]);
```

---

### 4.9 Error Handling & Retry Strategy

#### 4.9.1 Job Failure Handling

```php
// Exponential backoff retry strategy
QUEUE_FAILED_RETRY_AFTER=60  // Start with 60 seconds
// Increases exponentially: 60s → 120s → 240s → etc.
```

#### 4.9.2 Error Notifications

```php
// Alert on repeated failures
if ($failedAttempts > 3) {
    Mail::send(new JobFailedAlert($job));
    Slack::notify('Critical Job Failure');
}
```

---

### 4.10 Conclusion

The proposed automated processes provide a comprehensive framework for efficient health data management, risk assessment, and real-time alerts. By implementing event-driven architecture, asynchronous job processing, and integrated notification systems, the RHU-Laravel system will deliver enhanced operational efficiency and improved healthcare outcomes for rural health units.

The BPMN diagrams presented provide clear visual representation of complex workflows, enabling developers and stakeholders to understand system automation at both high-level and detailed operational levels.

---

## Appendix B: BPMN Symbols Reference

| Symbol | Name | Purpose |
|--------|------|---------|
| ⭕ | Start/End Event | Begin or end of process |
| ◇ | Decision/Gateway | Conditional branching |
| ▭ | Activity/Task | Action or operation |
| ◆ | Message Event | Communication trigger |
| ↓ | Sequence Flow | Process flow direction |
| ⟲ | Loop | Repeated operations |

---

**Document Version:** 1.0  
**Date Created:** April 22, 2026  
**Status:** Proposed Implementation  
**Prepared For:** Capstone Project - Chapter 4 Proposed Process
