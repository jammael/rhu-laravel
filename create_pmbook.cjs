const { Document, Packer, Paragraph, Table, TableRow, TableCell, AlignmentType, TextRun, ShadingType, HeadingLevel } = require('docx');
const fs = require('fs');

const doc = new Document({
  sections: [{
    children: [
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
      new Paragraph({
        text: 'TABLE OF CONTENTS',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),
      new Paragraph({ text: 'PHASE 1 — INITIATION', spacing: { after: 50 } }),
      new Paragraph({ text: 'PHASE 2 — PLANNING', spacing: { after: 50 } }),
      new Paragraph({ text: 'PHASE 3 — EXECUTION', spacing: { after: 50 } }),
      new Paragraph({ text: 'PHASE 4 — MONITORING & CONTROLLING', spacing: { after: 50 } }),
      new Paragraph({ text: 'PHASE 5 — CLOSING', spacing: { after: 200 } }),
      new Paragraph({ text: '', pageBreakBefore: true }),
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
        text: 'Current State: RHU Sierra Bullones operates on manual, paper-based record keeping with multiple critical inefficiencies: 5-15 minute patient lookups, data inconsistency issues, 20-30 minute patient registration, 30-45 minute report generation, and no analytical capabilities.',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.2 Business Needs Analysis',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'Eight core business needs: (1) Centralized Information Access, (2) Real-Time Data Availability, (3) Automated Health Assessments, (4) Maternal Health Risk Tracking, (5) Professional Reporting, (6) Analytics & Insights, (7) Audit & Compliance, (8) Staff Workload Reduction.',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.3 Project Vision & Mission',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'VISION: A comprehensive, technologically-enabled health monitoring platform that empowers RHU Sierra Bullones to deliver evidence-based maternal and child health services through real-time data management, automated health assessments, and actionable clinical insights.',
        italics: true,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'MISSION: To develop and deploy an integrated web-based health monitoring system that streamlines patient registration, automates nutritional status assessment using WHO/DOH standards, tracks maternal health risks, generates professional health reports, and provides clinic management with real-time analytics for improved healthcare delivery.',
        italics: true,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.4 Project Goals & Objectives',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'General Objectives: Establish centralized platform | Improve monitoring efficiency | Enable data-driven decisions | Enhance patient care quality | Support clinic staff with intuitive tools',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Specific Objectives: Maternal Health (registration, tracking, reporting) | Child Nutrition (0-59 months tracking with auto-calculations) | Patient Registry (CRUD operations) | User Management (RBAC with approval) | System Monitoring (activity logging) | Real-Time Analytics (dashboard) | Data Security (auth/authz) | Reporting (PDF generation)',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.5 Project Charter',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'PURPOSE: Formalize project initiation and authorize development of NutriCare Health Monitoring System',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'SCOPE: Web-based system with 8 modules: maternal records, child nutrition, patient management, user management, activity logging, admin dashboard, authentication, user profile management',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'DELIVERABLES: Functional web application | Authentication system | Database | Dashboard | PDF generation | Technical documentation | User manuals | Deployment guide',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'CONSTRAINTS: 5-6 month timeline | Limited budget ($100-150) | 5-person team | XAMPP/shared hosting | Academic capstone standards',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'SUCCESS CRITERIA: System deployment by May 2026 | 100% core modules | 90%+ staff approval | Zero critical vulnerabilities | 95%+ UAT pass rate | Complete documentation | <2% data inconsistency | 99.5% uptime',
        spacing: { after: 100 },
      }),
      new Paragraph({ text: '', pageBreakBefore: true }),
      new Paragraph({
        text: '1.6 Stakeholder Identification & Analysis',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      createStakeholderTable(),
      new Paragraph({ spacing: { after: 100 } }),
      new Paragraph({
        text: '1.7 Initial Scope Definition',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'INCLUDED (8 Core Modules): User Management | Maternal Record Management | Child Nutrition Monitoring | Patient Management | Authentication & Authorization | Activity Logging | Admin Dashboard | User Profile Management',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'KEY FEATURES: Responsive design | RBAC (5 roles) | Auto WHO/DOH calculations | PDF reports with branding | Real-time dashboard | Advanced search/filtering | Soft delete with restore | Audit trail | Email/SMS notifications | Color-coded status badges',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'EXCLUDED: Mobile native apps | AI/ML analytics | Telemedicine | E-prescriptions | Insurance/billing | Hospital integration | Scheduling | Pharmacy/inventory | Financial system',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '1.8 Communication Planning',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      createCommTable(),
      new Paragraph({ spacing: { after: 100 } }),
      new Paragraph({
        text: '1.9 Risk Identification',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 100 },
      }),
      createRiskTable(),
      new Paragraph({ spacing: { after: 100 } }),
      new Paragraph({
        text: '1.10 Feasibility Study',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Technical: HIGHLY FEASIBLE - Laravel 12 mature, team experienced, Bootstrap proven, calculations straightforward, PDF established',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Operational: FEASIBLE WITH CAVEATS - Committed sponsor, staff literate, intuitive UI, realistic training | Challenges: Staff resistance, limited IT support, network reliability | Mitigation: Training, documentation, offline investigation',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Economic: HIGHLY FEASIBLE - Total Cost $100-150 | Breakdown: Hosting $50, Domain $12, Contingency $50 | Annual: $42-62 | ROI: Breakeven 2 months (saves 15-20 hrs/week + paper costs)',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Schedule: HIGHLY FEASIBLE - 5-6 months (academic aligned) | Core modules implemented | Remaining: documentation | Team proven | No blockers | Adequate buffer',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'CONCLUSION: System is technically feasible, operationally viable, economically justified, and schedulable within timeline.',
        run: new TextRun({ bold: true, italic: true }),
        spacing: { after: 200 },
      }),
      new Paragraph({
        text: '— END OF PHASE 1 —',
        alignment: AlignmentType.CENTER,
        run: new TextRun({ bold: true }),
        spacing: { after: 200 },
      }),
      new Paragraph({ text: '', pageBreakBefore: true }),
      new Paragraph({
        text: 'PHASE 2 — PLANNING',
        heading: HeadingLevel.HEADING_1,
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '2.1 Detailed Scope Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Comprehensive web-based health monitoring system managing maternal records, child nutrition, patient registry, user access, activity logging, real-time analytics, professional reporting, and intuitive interface for RHU Sierra Bullones clinic operations.',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: 'Work Breakdown Structure:',
        run: new TextRun({ bold: true }),
        spacing: { after: 50 },
      }),
      new Paragraph({ text: '1. NUTRICARE SYSTEM DEVELOPMENT', spacing: { after: 25 } }),
      new Paragraph({ text: '   1.1 Core Infrastructure (Database, Laravel, Auth)', spacing: { after: 25 } }),
      new Paragraph({ text: '   1.2 Admin Modules (User Mgmt, Activity Logging, Dashboard)', spacing: { after: 25 } }),
      new Paragraph({ text: '   1.3 Staff Modules (Maternal, Nutrition, Patient)', spacing: { after: 25 } }),
      new Paragraph({ text: '   1.4 Core Features (PDF, Notifications)', spacing: { after: 25 } }),
      new Paragraph({ text: '   1.5 Frontend (Bootstrap, Responsive, Components)', spacing: { after: 25 } }),
      new Paragraph({ text: '   1.6 QA (Unit, Integration, UAT)', spacing: { after: 25 } }),
      new Paragraph({ text: '   1.7 Deployment & Documentation', spacing: { after: 100 } }),
      new Paragraph({
        text: '2.2 Project Schedule Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Phase 1: Weeks 1-2 | Phase 2: Weeks 3-5 | Phase 3: Weeks 6-15 | Phase 4: Weeks 6-21 (concurrent) | Phase 5: Weeks 23-24',
        spacing: { after: 100 },
      }),
      createSprintTable(),
      new Paragraph({ spacing: { after: 100 } }),
      new Paragraph({
        text: '2.3 Project Cost Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Hosting (6 months): $30-50 | Domain: $12 | SSL: $0 (Let\'s Encrypt) | Tools: $0 (open source) | Contingency: $50 | TOTAL: $92-112',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '2.4 Quality Management Plan',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Code Quality: PSR-12 compliance, 80%+ test coverage, zero critical vulnerabilities',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Functional: 100% modules, 95%+ UAT pass, 99%+ calculation accuracy',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Performance: <2s page load, <3s dashboard refresh, 10+ concurrent users',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Security: HTTPS/SSL, RBAC, 30min timeout, audit trail',
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Testing: Unit (80%+) | Integration (100%) | Manual UI (all browsers) | UAT (95%+)',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '2.5 Risk Management Plan',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'R-001 (Delays): Prioritize core modules | R-002 (Resistance): Training + feedback | R-003 (Inconsistency): Validation + tests | R-007 (Security): Code review + OWASP',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '2.6 Human Resource Management',
        heading: HeadingLevel.HEADING_2,
        spacing: { after: 50 },
      }),
      new Paragraph({
        text: 'Michael Ayento (80%): PM, coordination, stakeholder management',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'Jammael Magallanes (100%): Architecture, backend, frontend, optimization',
        spacing: { after: 25 },
      }),
      new Paragraph({
        text: 'QA Team (80% each): Testing, documentation, UAT coordination',
        spacing: { after: 100 },
      }),
      new Paragraph({
        text: '— END OF PHASE 2 —',
        alignment: AlignmentType.CENTER,
        run: new TextRun({ bold: true }),
        spacing: { after: 200 },
      }),
      new Paragraph({
        text: 'DOCUMENT COMPLETION NOTE: This PM Book provides comprehensive PMBOK-based project documentation for Phases 1-2 of the NutriCare project. Phases 3-5 follow similar structures with implementation details, testing protocols, monitoring dashboards, status reports, and enhancement recommendations. Key artifacts include project charter, feasibility analysis, stakeholder matrices, WBS, sprint schedule, budget analysis, quality standards, risk register, and team assignments.',
        italics: true,
        spacing: { after: 100 },
      }),
    ]
  }]
});

function createStakeholderTable() {
  const rows = [
    new TableRow({
      children: [
        new TableCell({ children: [new Paragraph({ text: 'Stakeholder', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Role', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Power', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Interest', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } })
      ]
    }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Dr. Airiene V. Sumaljag-Dormido' })] }), new TableCell({ children: [new Paragraph({ text: 'RHU Director' })] }), new TableCell({ children: [new Paragraph({ text: 'High' })] }), new TableCell({ children: [new Paragraph({ text: 'High' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Jammael Magallanes' })] }), new TableCell({ children: [new Paragraph({ text: 'Developer' })] }), new TableCell({ children: [new Paragraph({ text: 'High' })] }), new TableCell({ children: [new Paragraph({ text: 'High' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Michael Ayento' })] }), new TableCell({ children: [new Paragraph({ text: 'Project Manager' })] }), new TableCell({ children: [new Paragraph({ text: 'High' })] }), new TableCell({ children: [new Paragraph({ text: 'High' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Clinical Staff' })] }), new TableCell({ children: [new Paragraph({ text: 'System Users' })] }), new TableCell({ children: [new Paragraph({ text: 'Medium' })] }), new TableCell({ children: [new Paragraph({ text: 'High' })] })] }),
  ];
  return new Table({ width: { size: 100, type: 'pct' }, rows });
}

function createCommTable() {
  const rows = [
    new TableRow({
      children: [
        new TableCell({ children: [new Paragraph({ text: 'Channel', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Purpose', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } }),
        new TableCell({ children: [new Paragraph({ text: 'Frequency', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } })
      ]
    }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Google Meet' })] }), new TableCell({ children: [new Paragraph({ text: 'Formal meetings' })] }), new TableCell({ children: [new Paragraph({ text: 'Weekly' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Messenger' })] }), new TableCell({ children: [new Paragraph({ text: 'Daily coordination' })] }), new TableCell({ children: [new Paragraph({ text: 'Daily' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'GitHub' })] }), new TableCell({ children: [new Paragraph({ text: 'Code & issues' })] }), new TableCell({ children: [new Paragraph({ text: 'Ongoing' })] })] }),
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
        new TableCell({ children: [new Paragraph({ text: 'Focus', bold: true })], shading: { type: ShadingType.CLEAR, color: '4472C4' } })
      ]
    }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Sprint 1 (May 16-29)' })] }), new TableCell({ children: [new Paragraph({ text: 'Planning, architecture, training' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Sprint 2 (June 1-15)' })] }), new TableCell({ children: [new Paragraph({ text: 'Dashboard & API' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Sprint 3 (June 16-29)' })] }), new TableCell({ children: [new Paragraph({ text: 'User mgmt & logging' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Sprint 4 (June 30-July 13)' })] }), new TableCell({ children: [new Paragraph({ text: 'Maternal & nutrition' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Sprint 5 (July 14-27)' })] }), new TableCell({ children: [new Paragraph({ text: 'Reports & notifications' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Sprint 6 (July 28-Aug 10)' })] }), new TableCell({ children: [new Paragraph({ text: 'Testing & optimization' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Sprint 7 (Aug 11-24)' })] }), new TableCell({ children: [new Paragraph({ text: 'UAT & adjustments' })] })] }),
    new TableRow({ children: [new TableCell({ children: [new Paragraph({ text: 'Sprint 8 (Aug 25-Sept 5)' })] }), new TableCell({ children: [new Paragraph({ text: 'Deployment & docs' })] })] }),
  ];
  return new Table({ width: { size: 100, type: 'pct' }, rows });
}

Packer.toBuffer(doc).then(buffer => {
  fs.writeFileSync('NutriCare_PM_Book.docx', buffer);
  console.log('✓ NutriCare PM Book Created Successfully!');
  console.log('✓ File: NutriCare_PM_Book.docx');
  console.log('✓ Location: c:\\xampp\\htdocs\\RHU-Laravel\\');
});
