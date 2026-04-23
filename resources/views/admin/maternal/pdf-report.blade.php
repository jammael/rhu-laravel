<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Maternal Health Report - {{ $record->full_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            text-align: center;
            border-bottom: 3px solid #10b981;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: #10b981;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
            margin: 3px 0;
        }

        .report-title {
            font-size: 18px;
            color: #059669;
            margin-top: 15px;
            font-weight: bold;
        }

        /* Content Sections */
        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            background-color: #10b981;
            padding: 8px 12px;
            margin-bottom: 12px;
            border-radius: 4px;
        }

        /* Two-column layout for patient info */
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .info-row {
            display: table-row;
        }

        .info-col {
            display: table-cell;
            width: 50%;
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .info-label {
            font-weight: bold;
            color: #10b981;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .info-value {
            font-size: 13px;
            color: #333;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
            margin-top: 5px;
        }

        .status-low-risk {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .status-medium-risk {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde047;
        }

        .status-high-risk {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* Health Details Table */
        .health-table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
        }

        .health-table th {
            background-color: #f3f4f6;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            color: #374151;
            border-bottom: 2px solid #10b981;
        }

        .health-table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        .health-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        /* Assessment Box */
        .assessment-box {
            background-color: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: 12px;
            margin: 15px 0;
            border-radius: 4px;
        }

        .assessment-title {
            font-weight: bold;
            color: #10b981;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .assessment-content {
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }

        /* Recommendations */
        .recommendations {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px;
            margin: 15px 0;
            border-radius: 4px;
        }

        .recommendations-title {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .recommendations-list {
            font-size: 12px;
            color: #333;
            line-height: 1.6;
            padding-left: 15px;
        }

        .recommendations-list li {
            margin-bottom: 5px;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 11px;
            color: #999;
        }

        .signature-line {
            margin-top: 30px;
            display: inline-block;
            width: 200px;
            border-top: 1px solid #333;
            text-align: center;
        }

        .signature-title {
            margin-top: 5px;
            font-size: 11px;
            font-weight: bold;
        }

        .trimester-info {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
            font-size: 11px;
        }

        .trimester-info strong {
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>{{ $rhuName }}</h1>
            <p>Maternal Care & Health Assessment Report</p>
            <div class="report-title">Health Record for {{ $record->full_name }}</div>
            <p style="font-size: 11px; margin-top: 10px;">Report Generated: {{ $reportDate }}</p>
        </div>

        <!-- Patient Information Section -->
        <div class="section">
            <div class="section-title">📋 PATIENT INFORMATION</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-col">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $record->full_name }}</div>
                    </div>
                    <div class="info-col">
                        <div class="info-label">Age</div>
                        <div class="info-value">{{ $record->age }} years</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-col">
                        <div class="info-label">Contact Number</div>
                        <div class="info-value">{{ $record->contact_number }}</div>
                    </div>
                    <div class="info-col">
                        <div class="info-label">Address</div>
                        <div class="info-value">{{ $record->address }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pregnancy Information Section -->
        <div class="section">
            <div class="section-title">🤰 PREGNANCY INFORMATION</div>
            <table class="health-table">
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pregnancy Stage</td>
                        <td>
                            @if($record->pregnancy_stage === 'first_trimester')
                                <strong>First Trimester (0-3 months)</strong> - Early pregnancy period
                            @elseif($record->pregnancy_stage === 'second_trimester')
                                <strong>Second Trimester (4-6 months)</strong> - Mid-pregnancy period
                            @else
                                <strong>Third Trimester (7-9 months)</strong> - Late pregnancy period (approaching delivery)
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Last Checkup Date</td>
                        <td>{{ $record->last_checkup_date->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <td>Expected Delivery Date</td>
                        <td>{{ $record->expected_delivery_date->format('F d, Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Risk Assessment Section -->
        <div class="section">
            <div class="section-title">⚕️ RISK ASSESSMENT</div>

            <div style="padding: 12px; background-color: #f9fafb; border-radius: 4px;">
                <div class="info-label" style="color: #333; margin-bottom: 8px;">Current Risk Level:</div>
                <div>
                    @if($record->risk_level === 'low')
                        <span class="status-badge status-low-risk">🟢 LOW RISK - Normal Pregnancy</span>
                        <div class="assessment-box" style="margin-top: 10px;">
                            <div class="assessment-title">Assessment:</div>
                            <div class="assessment-content">
                                The mother is within normal health parameters with no identified risk factors. Regular prenatal care and routine checkups are recommended to ensure healthy pregnancy progression.
                            </div>
                        </div>
                    @elseif($record->risk_level === 'medium')
                        <span class="status-badge status-medium-risk">🟡 MEDIUM RISK - Requires Monitoring</span>
                        <div class="assessment-box" style="margin-top: 10px;">
                            <div class="assessment-title">Assessment:</div>
                            <div class="assessment-content">
                                The mother has certain health factors that require closer monitoring and more frequent prenatal visits. Lifestyle modifications and nutritional counseling are recommended.
                            </div>
                        </div>
                    @else
                        <span class="status-badge status-high-risk">🔴 HIGH RISK - Urgent Care Needed</span>
                        <div class="assessment-box" style="margin-top: 10px;">
                            <div class="assessment-title">Assessment:</div>
                            <div class="assessment-content">
                                The mother has significant health concerns requiring immediate medical attention and comprehensive prenatal management. Specialist consultation may be necessary.
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="trimester-info">
                <strong>Pregnancy Trimester Guide:</strong>
                <strong>First Trimester (0-3 months):</strong> Critical organ development |
                <strong>Second Trimester (4-6 months):</strong> Rapid fetal growth |
                <strong>Third Trimester (7-9 months):</strong> Final development and preparation for delivery
            </div>
        </div>

        <!-- Clinical Recommendations Section -->
        <div class="section">
            <div class="section-title">💡 CLINICAL RECOMMENDATIONS</div>
            <div class="recommendations">
                <div class="recommendations-title">For Mother's Health:</div>
                <ul class="recommendations-list">
                    @if($record->risk_level === 'low')
                        <li>Continue regular prenatal checkups every 4 weeks</li>
                        <li>Maintain balanced diet with adequate folic acid and iron intake</li>
                        <li>Engage in light physical activities (walking, swimming)</li>
                        <li>Get adequate rest (7-9 hours sleep daily)</li>
                        <li>Avoid smoking, alcohol, and harmful substances</li>
                        <li>Take prescribed prenatal vitamins regularly</li>
                    @elseif($record->risk_level === 'medium')
                        <li>Schedule prenatal checkups every 2-3 weeks</li>
                        <li>Increase folic acid and iron supplementation as recommended</li>
                        <li>Monitor blood pressure regularly at home</li>
                        <li>Follow strict dietary guidelines for healthy weight gain</li>
                        <li>Avoid strenuous activities and prolonged standing</li>
                        <li>Report any unusual symptoms immediately</li>
                        <li>Attend nutrition and prenatal education classes</li>
                    @else
                        <li>URGENT: Schedule immediate medical consultation</li>
                        <li>Frequent prenatal checkups (weekly or as recommended)</li>
                        <li>Specialized ultrasound and laboratory monitoring</li>
                        <li>Consider referral to high-risk pregnancy specialist</li>
                        <li>Strict bed rest if recommended by healthcare provider</li>
                        <li>Hospitalization may be necessary for close observation</li>
                        <li>Emergency contact protocol for warning signs</li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Health Provider Notes Section -->
        <div class="section">
            <div class="section-title">👨‍⚕️ HEALTH PROVIDER NOTES</div>
            <div style="padding: 12px; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px; min-height: 60px;">
                <p style="font-size: 12px; color: #666;">
                    This report is based on the mother's current medical status and pregnancy parameters. Regular monitoring and adherence to clinical recommendations are essential for optimal maternal and fetal health outcomes.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>{{ $rhuName }} | Maternal Care Management System</p>
            <p style="margin-top: 5px; font-size: 10px;">This report is confidential and for medical use only. Record ID: {{ $record->id }}</p>

            <div style="margin-top: 30px; text-align: center;">
                <div class="signature-line"></div>
                <div class="signature-title">Authorized Health Provider</div>
            </div>
        </div>
    </div>
</body>
</html>
