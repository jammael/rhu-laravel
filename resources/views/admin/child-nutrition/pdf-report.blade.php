<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Child Health Report - {{ $record->display_name }}</title>
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
            border-bottom: 3px solid #0891b2;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: #0891b2;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
            margin: 3px 0;
        }

        .report-title {
            font-size: 18px;
            color: #1e40af;
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
            background-color: #0891b2;
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
            color: #0891b2;
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

        .status-normal {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .status-underweight {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde047;
        }

        .status-severely-underweight {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* Measurements Table */
        .measurements-table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
        }

        .measurements-table th {
            background-color: #f3f4f6;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            color: #374151;
            border-bottom: 2px solid #0891b2;
        }

        .measurements-table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        .measurements-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .measurement-value {
            font-weight: bold;
            color: #0891b2;
        }

        /* Assessment Box */
        .assessment-box {
            background-color: #f0f9ff;
            border-left: 4px solid #0891b2;
            padding: 12px;
            margin: 15px 0;
            border-radius: 4px;
        }

        .assessment-title {
            font-weight: bold;
            color: #0891b2;
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

        /* Z-Score Interpretation Helper */
        .zscore-info {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
            font-size: 11px;
        }

        .zscore-info strong {
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>{{ $rhuName }}</h1>
            <p>Child Nutrition & Health Assessment Report</p>
            <div class="report-title">Health Record for {{ $record->display_name }}</div>
            <p style="font-size: 11px; margin-top: 10px;">Report Generated: {{ $reportDate }}</p>
        </div>

        <!-- Patient Information Section -->
        <div class="section">
            <div class="section-title">📋 PATIENT INFORMATION</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-col">
                        <div class="info-label">Child's Full Name</div>
                        <div class="info-value">{{ $record->display_name }}</div>
                    </div>
                    <div class="info-col">
                        <div class="info-label">Age</div>
                        <div class="info-value">{{ $record->age_months }} months ({{ number_format($record->age_months / 12, 1) }} years)</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-col">
                        <div class="info-label">Barangay</div>
                        <div class="info-value">{{ $record->display_barangay }}</div>
                    </div>
                    <div class="info-col">
                        <div class="info-label">Last Weigh-in Date</div>
                        <div class="info-value">{{ $record->last_weigh_in_date->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Physical Measurements Section -->
        <div class="section">
            <div class="section-title">📏 PHYSICAL MEASUREMENTS</div>
            <table class="measurements-table">
                <thead>
                    <tr>
                        <th>Measurement</th>
                        <th>Value</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Weight</td>
                        <td><span class="measurement-value">{{ $record->weight_kg }} kg</span></td>
                        <td>Measured on {{ $record->last_weigh_in_date->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <td>Height</td>
                        <td><span class="measurement-value">{{ $record->height_cm }} cm</span></td>
                        <td>Measured on {{ $record->last_weigh_in_date->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <td>Body Mass Index (BMI)</td>
                        <td><span class="measurement-value">{{ $bmi }}</span></td>
                        <td>Calculated from weight and height</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Nutritional Status Section -->
        <div class="section">
            <div class="section-title">🏥 NUTRITIONAL STATUS ASSESSMENT</div>

            <div style="padding: 12px; background-color: #f9fafb; border-radius: 4px;">
                <div class="info-label" style="color: #333; margin-bottom: 8px;">Current Status:</div>
                <div>
                    @if($record->nutritional_status === 'normal')
                        <span class="status-badge status-normal">✓ NORMAL - Healthy Growth</span>
                        <div class="assessment-box" style="margin-top: 10px;">
                            <div class="assessment-title">Assessment:</div>
                            <div class="assessment-content">
                                The child is within the normal range for BMI and age. The nutritional intake and physical development are appropriate for age. Continue current dietary practices and regular check-ups.
                            </div>
                        </div>
                    @elseif($record->nutritional_status === 'underweight')
                        <span class="status-badge status-underweight">⚠ UNDERWEIGHT - Requires Attention</span>
                        <div class="assessment-box" style="margin-top: 10px;">
                            <div class="assessment-title">Assessment:</div>
                            <div class="assessment-content">
                                The child is below WHO/DOH standards for BMI (between -2 to -3 standard deviations). This suggests malnutrition or growth concerns. Nutritional intervention and dietary counseling are recommended.
                            </div>
                        </div>
                    @else
                        <span class="status-badge status-severely-underweight">🔴 SEVERELY UNDERWEIGHT - Urgent Action Required</span>
                        <div class="assessment-box" style="margin-top: 10px;">
                            <div class="assessment-title">Assessment:</div>
                            <div class="assessment-content">
                                The child is significantly below WHO/DOH standards for BMI (below -3 standard deviations). This indicates severe malnutrition. Immediate medical consultation and comprehensive nutritional support are essential.
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="zscore-info">
                <strong>Z-Score Explanation:</strong> The nutritional status is determined using WHO/DOH Child Growth Standards.
                <strong>Normal (Z ≥ -2):</strong> Healthy weight for age |
                <strong>Underweight (-3 ≤ Z < -2):</strong> Below normal |
                <strong>Severely Underweight (Z < -3):</strong> Significantly malnourished
            </div>
        </div>

        <!-- Recommendations Section -->
        <div class="section">
            <div class="section-title">💡 RECOMMENDATIONS</div>
            <div class="recommendations">
                <div class="recommendations-title">For Parents/Guardians:</div>
                <ul class="recommendations-list">
                    @if($record->nutritional_status === 'normal')
                        <li>Maintain current dietary practices with balanced nutrition</li>
                        <li>Ensure 3 main meals and 2 healthy snacks daily</li>
                        <li>Encourage physical activity and outdoor play</li>
                        <li>Schedule regular check-ups every 3 months</li>
                        <li>Monitor height and weight growth patterns</li>
                    @elseif($record->nutritional_status === 'underweight')
                        <li>Increase caloric intake with nutrient-dense foods</li>
                        <li>Include protein-rich foods (eggs, fish, legumes) in daily diet</li>
                        <li>Incorporate iron-rich foods (red meat, leafy greens) to prevent anemia</li>
                        <li>Ensure adequate calcium and vitamin D intake</li>
                        <li>Schedule follow-up check-up in 2 months</li>
                        <li>Consider micronutrient supplementation if recommended by health provider</li>
                    @else
                        <li>URGENT: Consult with a pediatrician immediately</li>
                        <li>Increase caloric and protein intake significantly</li>
                        <li>Include high-energy foods: peanut butter, coconut oil, eggs, fish</li>
                        <li>Provide therapeutic foods for malnutrition management</li>
                        <li>Ensure clean drinking water and sanitation practices</li>
                        <li>Schedule follow-up within 2 weeks</li>
                        <li>Consider referral to nutrition specialist</li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Health Provider Section -->
        <div class="section">
            <div class="section-title">👨‍⚕️ HEALTH PROVIDER NOTES</div>
            <div style="padding: 12px; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px; min-height: 60px;">
                <p style="font-size: 12px; color: #666;">
                    This report is based on standardized WHO/DOH child growth standards.
                    The nutritional status assessment helps guide interventions and monitor child development.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>{{ $rhuName }} | Child Nutrition Management System</p>
            <p style="margin-top: 5px; font-size: 10px;">This report is confidential and for medical use only. Record ID: {{ $record->id }}</p>

            <div style="margin-top: 30px; text-align: center;">
                <div class="signature-line"></div>
                <div class="signature-title">Authorized Health Provider</div>
            </div>
        </div>
    </div>
</body>
</html>
