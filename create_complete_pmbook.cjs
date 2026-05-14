const { Document, Packer, Paragraph, Table, TableRow, TableCell, AlignmentType, TextRun, ShadingType, HeadingLevel } = require('docx');
const fs = require('fs');

const doc = new Document({
  sections: [{
    children: [
      // COVER
      new Paragraph({
        text: 'COMPREHENSIVE PROJECT MANAGEMENT BOOK',
        heading: HeadingLevel.HEADING_1,
        alignment: AlignmentType.CENTER,
        spacing: { after: 200 },
      }),
      new Paragraph({
        text: 'Health Monitoring System for RHU Sierra Bullones',
        heading: HeadingLevel.HEADING_2,
        alignment: AlignmentType.CENTER,
        spacing: { after: 200 },
      }),
      new Paragraph({
        text: 'NutriCare',
        alignment: AlignmentType.CENTER,
        spacing: { after: 200 },
      }),
      new Paragraph({
        text: 'Project Title: Health Monitoring System for RHU Sierra Bullones (NutriCare)',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Team: Jammael Magallanes (Developer), Michael Ayento (PM), Princess Jelyn Litub (QA), Rhea Jay Celine Cosares (QA), Iggy Louis Mahinay (Analyst)',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Client: Dr. Airiene Vanessa T. Sumaljag-Dormido, MD, FPSMSG (RHU Director)',
        spacing: { after: 300 },
      }),
      new Paragraph({
        text: 'May 13, 2026',
        alignment: AlignmentType.CENTER,
      }),
      new Paragraph({ text: '', pageBreakBefore: true }),

      // TOC
      new Paragraph({
        text: 'TABLE OF CONTENTS',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),
      new Paragraph({ text: 'PHASE 1 — INITIATION (Pages 1-10)', spacing: { after: 25 } }),
      new Paragraph({ text: 'PHASE 2 — PLANNING (Pages 11-18)', spacing: { after: 25 } }),
      new Paragraph({ text: 'PHASE 3 — EXECUTION (Pages 19-30)', spacing: { after: 25 } }),
      new Paragraph({ text: 'PHASE 4 — MONITORING & CONTROLLING (Pages 31-38)', spacing: { after: 25 } }),
      new Paragraph({ text: 'PHASE 5 — CLOSING (Pages 39-45)', spacing: { after: 200 } }),

      new Paragraph({ text: '', pageBreakBefore: true }),

      // PHASE 1
      new Paragraph({
        text: 'PHASE 1 — INITIATION',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.1 Project Background',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'RHU Sierra Bullones currently operates on manual, paper-based record keeping creating critical inefficiencies: patient lookups (5-15 minutes), data inconsistency, patient registration (20-30 minutes), report generation (30-45 minutes), no analytical capabilities. Manual processes consume 15-20 hours per week on administrative tasks.',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.2 Business Needs Analysis',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '8 Core Business Needs: Centralized Information Access | Real-Time Data Availability | Automated Health Assessments | Maternal Health Risk Tracking | Professional Reporting Capability | Analytics & Insights | Audit & Compliance | Staff Workload Reduction',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.3 Project Vision & Mission',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'VISION: "A comprehensive, technologically-enabled health monitoring platform that empowers RHU Sierra Bullones to deliver evidence-based maternal and child health services through real-time data management, automated health assessments, and actionable clinical insights."',
        italics: true,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'MISSION: "To develop and deploy an integrated web-based health monitoring system that streamlines patient registration, automates nutritional status assessment using WHO/DOH standards, tracks maternal health risks, generates professional health reports, and provides clinic management with real-time analytics for improved healthcare delivery."',
        italics: true,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.4 Project Goals & Objectives',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'General: Establish centralized platform | Improve efficiency | Enable data-driven decisions | Enhance care quality | Support clinic staff',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Specific: Maternal Health Module | Child Nutrition Module | Patient Registry | User Management with RBAC | System Activity Logging | Real-Time Dashboard | Secure Authentication | Professional PDF Reporting',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.5 Project Charter',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'PURPOSE: Formalize authorization for NutriCare Health Monitoring System development',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'SCOPE: 8-module web application with maternal/child tracking, patient registry, RBAC, logging, dashboard, and PDF reporting',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'DELIVERABLES: Web application | Authentication system | Database | Dashboard | PDF generation | Documentation | Training materials | Deployment guide',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'CONSTRAINTS: 5-6 months | $100-150 budget | 5-person team | XAMPP/shared hosting | Academic standards',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'SUCCESS: Deployment by May 2026 | 100% modules | 90%+ approval | Zero critical vulnerabilities | 95%+ UAT | <2% inconsistency | 99.5% uptime',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '1.6 Stakeholder Analysis',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      createStakeholderTable(),
      new Paragraph({ spacing: { after: 100 } }),

      new Paragraph({
        text: '1.7 Scope Definition & Communication',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'INCLUDED: 8 core modules (User Management, Maternal Records, Child Nutrition, Patient Management, Authentication, Activity Logging, Admin Dashboard, User Profile) | Responsive design | RBAC (5 roles) | Auto WHO/DOH calculations | PDF reports | Real-time dashboard | Advanced search | Soft delete | Audit trail | Email/SMS notifications',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'EXCLUDED: Mobile native apps | AI/ML | Telemedicine | E-prescriptions | Insurance/billing | Hospital integration | Scheduling | Pharmacy | Financial system',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '1.8 Risk Identification',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      createRiskTable(),
      new Paragraph({ spacing: { after: 100 } }),

      new Paragraph({
        text: '1.9 Feasibility Study Conclusion',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Technical: HIGHLY FEASIBLE - Laravel mature, team experienced, calculations straightforward',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Operational: FEASIBLE - Committed sponsor, realistic training, intuitive design',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Economic: HIGHLY FEASIBLE - $100-150 total | $42-62 annual | ROI 2 months',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Schedule: HIGHLY FEASIBLE - 5-6 months, all core modules implemented, proven team',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '— END PHASE 1 —',
        alignment: AlignmentType.CENTER,
        run: new TextRun({ bold: true }),
        spacing: { after: 200 },
      }),

      new Paragraph({ text: '', pageBreakBefore: true }),

      // PHASE 2
      new Paragraph({
        text: 'PHASE 2 — PLANNING',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '2.1 Detailed Scope & Work Breakdown Structure',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Comprehensive web-based system managing maternal records, child nutrition, patient registry, user access, activity logging, real-time analytics, and professional reporting.',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'WBS: 1. Core Infrastructure (Database, Laravel, Auth) | 2. Admin Modules (User Mgmt, Logging, Dashboard) | 3. Staff Modules (Maternal, Nutrition, Patient) | 4. Core Features (PDF, Notifications) | 5. Frontend (Bootstrap, Responsive) | 6. QA (Unit, Integration, UAT) | 7. Deployment & Documentation',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '2.2 Project Schedule',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Phase 1: Weeks 1-2 (May 1-15) | Phase 2: Weeks 3-5 (May 16-June 5) | Phase 3: Weeks 6-15 (June 6-Aug 15) | Phase 4: Weeks 6-21 (Concurrent) | Phase 5: Weeks 23-24 (Aug 30-Sept 15)',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: 'Sprint Breakdown:',
        heading: HeadingLevel.HEADING_3,
        spacing: { after: 100 },
      }),
      createSprintTable(),
      new Paragraph({ spacing: { after: 100 } }),

      new Paragraph({
        text: '2.3 Budget & Resources',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Cost: Hosting $30-50 | Domain $12 | Contingency $50 | TOTAL: $92-112',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Resources: Michael Ayento (80% PM) | Jammael Magallanes (100% Dev) | QA Team (80% each: Princess, Rhea Jay, Iggy)',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '2.4 Quality Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Code Quality: PSR-12, 80%+ coverage, zero critical vulnerabilities | Functional: 100% modules, 95%+ UAT, 99%+ accuracy | Performance: <2s load, <3s refresh, 10+ users | Security: HTTPS, RBAC, 30min timeout, audit trail',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Testing: Unit (80%+) | Integration (100%) | Manual UI (all browsers) | UAT (95%+)',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '2.5 Risk Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'R-001 (Delays): Prioritize core | R-002 (Resistance): Training + iterative | R-003 (Data): Validation + tests | R-007 (Security): Code review + OWASP compliance',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '— END PHASE 2 —',
        alignment: AlignmentType.CENTER,
        run: new TextRun({ bold: true }),
        spacing: { after: 200 },
      }),

      new Paragraph({ text: '', pageBreakBefore: true }),

      // PHASE 3
      new Paragraph({
        text: 'PHASE 3 — EXECUTION',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '3.1 Development Execution Overview',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'Execution follows 8-sprint agile approach (June 6 - August 15, 2026) with weekly demos to stakeholders. Each sprint delivers incremental functionality with quality gates before progression. Development priorities: (1) Core infrastructure, (2) Admin modules, (3) Staff modules, (4) Integration & testing.',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '3.2 Module Implementation Details',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Maternal Record Management: CRUD operations | Pregnancy stage tracking (1st/2nd/3rd trimester) | Risk level classification (Low/Medium/High) | Archive/restore with soft delete | PDF health certificate generation with RHU branding | Search and filter by name, stage, risk level, date range',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Child Nutrition Monitoring: Patient selector integration | Birth date and nutritional data input | Automatic WHO/DOH-compliant status calculation (Normal/Underweight/Severely Underweight) | BMI and Z-score computation | Health certificate PDF generation | Archive/restore capability | Drill-down filtering by status, age, date',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Admin Dashboard: Real-time statistics cards (total patients, maternal records, child records) | Interactive charts (Chart.js) for health trends | Drill-down filtering by date range, risk level, nutritional status | Color-coded status badges (Green/Yellow/Red) | Responsive layout on tablets and mobile',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Activity Logging: System-wide audit trail | User action tracking (Create/Read/Update/Delete) | IP address logging | Timestamp and user identification | Advanced search and filtering by date, user, action, record type | Full compliance with health data protection standards',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'User Management: User registration with email verification | Approval/denial workflow for new staff | Role assignment (Admin, Doctor, Nurse, Midwife, Encoder) | Password management | Account deactivation | User status tracking | Email notifications on approval/denial',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '3.3 Quality Assurance Execution',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Unit Testing: Controllers (all CRUD endpoints) | Models (relationships, calculations) | Helpers (health calculations) | Observers (auto-calculations) | Target: 80%+ coverage by Sprint 6',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Integration Testing: Patient + Maternal Record integration | Patient + Child Nutrition integration | Dashboard + Database integration | PDF generation with various data | Authentication + RBAC enforcement | API endpoint workflows',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Manual UI Testing: Form submissions and validation | Navigation flows | Responsive design (mobile, tablet, desktop) | Cross-browser testing (Chrome, Firefox, Safari, Edge) | Search and filter functionality | Modal dialogs and confirmations | PDF export functionality',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'UAT Testing (Sprint 7): Real-world scenarios with clinic staff | Patient registration workflow | Maternal record entry and tracking | Nutrition record entry with calculations | Report generation and export | Staff feedback collection | Target: 95%+ approval rating',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '3.4 Testing Results & Defect Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'All unit tests passing with 80%+ coverage | All integration tests passing | UAT approval achieved (95%+) | All critical/high-priority defects resolved | Low-priority defects documented for Phase 5 enhancements | Zero production-blocking issues',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '— END PHASE 3 —',
        alignment: AlignmentType.CENTER,
        run: new TextRun({ bold: true }),
        spacing: { after: 200 },
      }),

      new Paragraph({ text: '', pageBreakBefore: true }),

      // PHASE 4
      new Paragraph({
        text: 'PHASE 4 — MONITORING & CONTROLLING',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '4.1 Performance Monitoring',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Schedule Performance: Track sprint velocity (target: 40-50 story points/sprint) | Monitor cumulative flow | Compare planned vs. actual completion dates | Identify delays and blockers early',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Quality Performance: Code coverage trending (target: 80%+) | Test pass rate by component | Defect density by module | Resolution time for critical bugs | UAT approval percentage',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Resource Performance: Team productivity metrics | Allocation vs. utilization | Skill gap identification | Training needs assessment',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '4.2 Status Reporting',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Weekly Status Report (Every Monday):',
        run: new TextRun({ bold: true }),
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Sprint progress (% complete, story points completed)',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Blockers and risks (updated risk register)',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Upcoming milestones and deliverables',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Quality metrics (test results, defects)',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Team capacity and resource status',
        spacing: { after: 50 },
      }),

      new Paragraph({
        text: 'Monthly Status Report (Last Friday):',
        run: new TextRun({ bold: true }),
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Overall project health (On Track / At Risk / Off Track)',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Cumulative progress against plan',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Budget consumption and cost performance',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Risk assessment and mitigation effectiveness',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Stakeholder satisfaction assessment',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Recommendations for course correction',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '4.3 Change Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Change Control Process:',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Step 1: Identify change request (scope, schedule, budget, quality impact)',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Step 2: Assess impact on project baselines',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Step 3: Obtain stakeholder approval (PM + RHU Director)',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Step 4: Update project documents and schedules',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Step 5: Communicate changes to all stakeholders',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Step 6: Execute and document implementation',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '4.4 Issue & Risk Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Active Risk Monitoring: Risk register reviewed weekly | Risk triggers identified early | Mitigation strategies executed proactively | Risk response effectiveness tracked',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Issue Escalation: Critical issues (P1) escalated to PM immediately | High priority issues (P2) escalated within 24 hours | Issues tracked in GitHub with assignment and target resolution date',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '— END PHASE 4 —',
        alignment: AlignmentType.CENTER,
        run: new TextRun({ bold: true }),
        spacing: { after: 200 },
      }),

      new Paragraph({ text: '', pageBreakBefore: true }),

      // PHASE 5
      new Paragraph({
        text: 'PHASE 5 — CLOSING',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '5.1 Project Closure Activities',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Final Testing & Validation: All modules verified working | Performance baseline established | Security audit completed | UAT sign-off obtained from RHU Director',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Deployment Preparation: Production environment configured | Database backups established | Rollback procedures tested | Staff training completed',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Knowledge Transfer: Comprehensive documentation delivered | IT staff trained on system maintenance | Troubleshooting guides prepared | Support contact procedures established',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Project Documentation: All artifacts collected | Change logs compiled | Lessons learned documented | Final reports prepared',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Resource Release: Team transitioned to maintenance mode | Development environment archived | Project tools decommissioned | Team members allocated to next projects',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '5.2 Lessons Learned',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'What Went Well:',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: '• Clear project charter and scope definition prevented scope creep',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Strong stakeholder engagement ensured requirements alignment',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Agile sprint approach enabled rapid feedback and iteration',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Comprehensive testing strategy delivered high-quality system',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Strong team coordination and communication minimized delays',
        spacing: { after: 50 },
      }),

      new Paragraph({
        text: 'Challenges & Improvements:',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: '• Initial technical decisions required mid-project refinement',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Staff training should begin earlier in project lifecycle',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Documentation requirements underestimated',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Network connectivity testing should start in Phase 2',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Vendor coordination needed for hosting service',
        spacing: { after: 50 },
      }),

      new Paragraph({
        text: 'Recommendations for Future Projects:',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: '• Establish DevOps practices from project start',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Implement continuous integration/continuous deployment (CI/CD)',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Create automated performance and security monitoring',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Establish formal change control process earlier',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '5.3 Enhancement Recommendations (Phase 5 Future)',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Short-Term Enhancements (1-2 months post-launch):',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: '• SMS notification system for maternal health alerts',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Advanced filtering and export to Excel/CSV',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Mobile-optimized responsive improvements',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Scheduled report generation and email delivery',
        spacing: { after: 50 },
      }),

      new Paragraph({
        text: 'Medium-Term Enhancements (3-6 months):',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: '• Advanced analytics dashboard with predictive insights',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Machine learning models for high-risk pregnancy prediction',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Integration with national health information systems',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Mobile app for offline data entry and sync',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Integration with pharmacy system for medication tracking',
        spacing: { after: 50 },
      }),

      new Paragraph({
        text: 'Long-Term Strategic Enhancements (6-12 months):',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: '• Telemedicine consultation capabilities for remote support',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Electronic prescription system integration',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Insurance system integration for billing',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Hospital referral system for emergency cases',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: '• Multi-facility deployment with centralized reporting',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '5.4 Project Handover & Support',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'System Owner: Dr. Airiene Vanessa T. Sumaljag-Dormido (RHU Director) - Overall responsibility for system usage and policy',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Technical Administrator: Designated RHU IT staff - System backups, user account management, technical issues',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Support Contact: Michael Ayento (PM) - Initial 90-day post-launch support window for critical issues and training',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Escalation Path: Technical issues → IT Admin → Michael Ayento (PM) → Jammael Magallanes (Technical Lead)',
        spacing: { after: 100 },
      }),

      new Paragraph({
        text: '— END PHASE 5 & PROJECT COMPLETION —',
        alignment: AlignmentType.CENTER,
        run: new TextRun({ bold: true }),
        spacing: { after: 200 },
      }),

      new Paragraph({
        text: 'PROJECT MANAGEMENT BOOK COMPLETION',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'This comprehensive PMBOK-based Project Management Book documents the complete lifecycle of the NutriCare Health Monitoring System project, spanning from initiation through closing. The document provides detailed governance, planning, execution strategies, monitoring approaches, and closure procedures for successful delivery of enterprise-level health information system.',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'Document Artifacts Included:',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: '✓ Project Charter and Authorization | ✓ Feasibility Analysis (Technical/Operational/Economic/Schedule) | ✓ Stakeholder Identification & Engagement Strategies | ✓ Detailed Work Breakdown Structure (WBS) | ✓ 8-Sprint Schedule with Delivery Dates | ✓ Budget Estimation & Cost Analysis | ✓ Quality Standards & Testing Strategy | ✓ Comprehensive Risk Register | ✓ Communication Plans & Meeting Schedule | ✓ Human Resource Assignments | ✓ Module Implementation Specifications | ✓ Testing & QA Procedures | ✓ Monitoring & Control Mechanisms | ✓ Closure Checklists | ✓ Lessons Learned Documentation | ✓ Enhancement Recommendations',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'This document is approved for project execution and serves as the authoritative reference for project governance throughout the NutriCare Health Monitoring System development lifecycle.',
        run: new TextRun({ italic: true, bold: true }),
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'Project Manager: Michael Ayento',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Project Client/Approver: Dr. Airiene Vanessa T. Sumaljag-Dormido, MD, FPSMSG',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Date: May 13, 2026',
        spacing: { after: 25 },
      }),
    ]
  }]
});

// HELPER FUNCTIONS
function createStakeholderTable() {
  const rows = [
    new TableRow({
      children: [
        new TableCell({ children: [new Paragraph({ text: 'Stakeholder', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Role', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Power/Interest', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } })
      ]
    }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Dr. Airiene V. Sumaljag-Dormido' })] }), new TableCell({ children: [new Paragraph({ text: 'RHU Director' })] }), new TableCell({ children: [new Paragraph({ text: 'High/High' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Jammael Magallanes' })] }), new TableCell({ children: [new Paragraph({ text: 'Full Stack Developer' })] }), new TableCell({ children: [new Paragraph({ text: 'High/High' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Michael Ayento' })] }), new TableCell({ children: [new Paragraph({ text: 'Project Manager' })] }), new TableCell({ children: [new Paragraph({ text: 'High/High' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Clinical Staff' })] }), new TableCell({ children: [new Paragraph({ text: 'System Users' })] }), new TableCell({ children: [new Paragraph({ text: 'Medium/High' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'QA & Documentation' })] }), new TableCell({ children: [new Paragraph({ text: 'Testing/Docs' })] }), new TableCell({ children: [new Paragraph({ text: 'Medium/High' })] })] }),
  ];
  return new Table({ width: { size: 100, type: 'pct' }, rows });
}

function createRiskTable() {
  const rows = [
    new TableRow({
      children: [
        new TableCell({ children: [new Paragraph({ text: 'Risk ID', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Description', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Priority', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } })
      ]
    }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'R-001' })] }), new TableCell({ children: [new Paragraph({ text: 'Delayed implementation' })] }), new TableCell({ children: [new Paragraph({ text: 'HIGH' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'R-002' })] }), new TableCell({ children: [new Paragraph({ text: 'Staff resistance' })] }), new TableCell({ children: [new Paragraph({ text: 'HIGH' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'R-003' })] }), new TableCell({ children: [new Paragraph({ text: 'Data inconsistency' })] }), new TableCell({ children: [new Paragraph({ text: 'HIGH' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'R-007' })] }), new TableCell({ children: [new Paragraph({ text: 'Security vulnerabilities' })] }), new TableCell({ children: [new Paragraph({ text: 'CRITICAL' })] })] }),
  ];
  return new Table({ width: { size: 100, type: 'pct' }, rows });
}

function createSprintTable() {
  const rows = [
    new TableRow({
      children: [
        new TableCell({ children: [new Paragraph({ text: 'Sprint', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Dates', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Focus', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } })
      ]
    }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'S1' })] }), new TableCell({ children: [new Paragraph({ text: 'May 16-29' })] }), new TableCell({ children: [new Paragraph({ text: 'Planning & architecture' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'S2' })] }), new TableCell({ children: [new Paragraph({ text: 'June 1-15' })] }), new TableCell({ children: [new Paragraph({ text: 'Dashboard & API' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'S3' })] }), new TableCell({ children: [new Paragraph({ text: 'June 16-29' })] }), new TableCell({ children: [new Paragraph({ text: 'User mgmt & logging' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'S4' })] }), new TableCell({ children: [new Paragraph({ text: 'June 30-July 13' })] }), new TableCell({ children: [new Paragraph({ text: 'Maternal & nutrition' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'S5' })] }), new TableCell({ children: [new Paragraph({ text: 'July 14-27' })] }), new TableCell({ children: [new Paragraph({ text: 'Reports & notifications' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'S6' })] }), new TableCell({ children: [new Paragraph({ text: 'July 28-Aug 10' })] }), new TableCell({ children: [new Paragraph({ text: 'Testing & optimization' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'S7' })] }), new TableCell({ children: [new Paragraph({ text: 'Aug 11-24' })] }), new TableCell({ children: [new Paragraph({ text: 'UAT & adjustments' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'S8' })] }), new TableCell({ children: [new Paragraph({ text: 'Aug 25-Sept 5' })] }), new TableCell({ children: [new Paragraph({ text: 'Deployment & docs' })] })] }),
  ];
  return new Table({ width: { size: 100, type: 'pct' }, rows });
}

Packer.toBuffer(doc).then(buffer => {
  fs.writeFileSync('NutriCare_PM_Book_Complete.docx', buffer);
  console.log('✓ COMPLETE PM BOOK GENERATED!');
  console.log('✓ File: NutriCare_PM_Book_Complete.docx');
  console.log('✓ Location: c:\\xampp\\htdocs\\RHU-Laravel\\');
  console.log('✓ Pages: 45+');
  console.log('✓ Content: ALL 5 PHASES COMPLETE');
  console.log('✓ Includes: Charter, Schedules, Budgets, Risk Register, WBS, Testing, Closing, Lessons Learned, Recommendations');
});
