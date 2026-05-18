<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Patient Report - {{ $patient->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.5; }
        .container { width: 100%; max-width: 900px; margin: 0 auto; padding: 20px; }
        .header { text-align: center; border-bottom: 3px solid #059669; padding-bottom: 18px; margin-bottom: 24px; }
        .header h1 { color: #059669; margin-bottom: 4px; }
        .section { margin-bottom: 22px; }
        .section-title { background: #059669; color: white; padding: 8px 10px; font-weight: bold; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 9px; border-bottom: 1px solid #e5e7eb; font-size: 12px; text-align: left; }
        th { background: #f3f4f6; }
        .label { font-weight: bold; color: #059669; width: 30%; }
        .footer { margin-top: 32px; text-align: center; font-size: 10px; color: #777; border-top: 1px solid #e5e7eb; padding-top: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $rhuName }}</h1>
            <p>Patient Enrollment Report</p>
            <h2>{{ $patient->name }}</h2>
            <p>Generated: {{ $reportDate }}</p>
        </div>

        <div class="section">
            <div class="section-title">PATIENT INFORMATION</div>
            <table>
                <tr><td class="label">Full Name</td><td>{{ $patient->name }}</td></tr>
                <tr><td class="label">Category</td><td>{{ ucfirst($patient->category) }}</td></tr>
                <tr><td class="label">Birthdate</td><td>{{ $patient->birthdate?->format('F d, Y') ?? 'N/A' }}</td></tr>
                <tr><td class="label">Barangay</td><td>{{ $patient->barangay }}</td></tr>
                <tr><td class="label">Contact Number</td><td>{{ $patient->contact_number }}</td></tr>
                <tr><td class="label">Enrollment Date</td><td>{{ $patient->created_at->format('F d, Y') }}</td></tr>
            </table>
        </div>

        @if($patient->maternalRecords->count())
            <div class="section">
                <div class="section-title">MATERNAL CARE RECORDS</div>
                <table>
                    <thead>
                        <tr>
                            <th>Pregnancy Stage</th>
                            <th>Risk Level</th>
                            <th>Last Checkup</th>
                            <th>Expected Delivery</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->maternalRecords as $record)
                            <tr>
                                <td>{{ ucwords(str_replace('_', ' ', $record->pregnancy_stage)) }}</td>
                                <td>{{ ucfirst($record->risk_level) }}</td>
                                <td>{{ $record->last_checkup_date->format('M d, Y') }}</td>
                                <td>{{ $record->expected_delivery_date->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($patient->childNutritionRecords->count())
            <div class="section">
                <div class="section-title">CHILD NUTRITION RECORDS</div>
                <table>
                    <thead>
                        <tr>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Last Weigh-in</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->childNutritionRecords as $record)
                            <tr>
                                <td>{{ $record->age_months }} months</td>
                                <td>{{ ucwords(str_replace('_', ' ', $record->nutritional_status)) }}</td>
                                <td>{{ $record->weight_kg }} kg</td>
                                <td>{{ $record->height_cm }} cm</td>
                                <td>{{ $record->last_weigh_in_date->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="footer">
            <p>{{ $rhuName }} | NutriCare Health Monitoring System</p>
            <p>This report is confidential and for health monitoring use only. Patient ID: {{ $patient->id }}</p>
        </div>
    </div>
</body>
</html>
