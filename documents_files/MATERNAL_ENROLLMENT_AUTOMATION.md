# Maternal Enrollment Automation Implementation

## Overview
Successfully implemented automatic maternal enrollment synchronized with the Child Nutrition module pattern. When users fill out the "New Maternal Enrollment" form, the system now automatically creates both a Patient record and a MaternalRecord simultaneously with an automatically calculated Risk Level.

## Features Implemented

### 1. ✅ Form Updates (patients/create.blade.php)
Added three new fields to the maternal enrollment form:

- **Pregnancy Stage** (Dropdown)
  - Options: 1st Trimester (0-12 weeks), 2nd Trimester (13-26 weeks), 3rd Trimester (27+ weeks)
  - Required field

- **Last Checkup Date** (Date picker)
  - Used to determine if checkup schedule is current
  - Required field
  - Important for risk level calculation

- **Expected Delivery Date (EDD)** (Date picker)
  - Tracks the expected delivery timeline
  - Required field
  - Must be after Last Checkup Date (validation rule added)

- **UI Feedback Note**
  - Informs users: "Maternal Risk Level will be automatically determined based on the clinical dates provided and the patient's age. Pregnant mothers aged 35 and above are automatically categorized as medium risk or higher."

### 2. ✅ Controller Integration (PatientController)
Updated `PatientController@store` method to handle maternal type enrollment:

```php
// Validates maternal-specific fields
if ($type === 'maternal') {
    $maternalValidated = $request->validate([
        'pregnancy_stage'       => 'required|in:first_trimester,second_trimester,third_trimester',
        'last_checkup_date'     => 'required|date',
        'expected_delivery_date' => 'required|date|after:last_checkup_date',
    ]);
}

// Creates MaternalRecord with patient_id link
if ($type === 'maternal' && $maternalValidated) {
    $age = \Carbon\Carbon::parse($validated['birthdate'])->age;
    
    MaternalRecord::create([
        'patient_id'              => $patient->id,
        'full_name'               => $validated['name'],
        'age'                     => $age,
        'address'                 => $validated['barangay'],
        'contact_number'          => $validated['contact_number'],
        'pregnancy_stage'         => $maternalValidated['pregnancy_stage'],
        'last_checkup_date'       => $maternalValidated['last_checkup_date'],
        'expected_delivery_date'  => $maternalValidated['expected_delivery_date'],
        // risk_level is auto-calculated by observer
    ]);
}
```

**Key Features:**
- Creates Patient record first with category 'pregnant'
- Automatically calculates age from birthdate using Carbon
- Creates MaternalRecord linked via patient_id
- Uses foreign key constraint for data integrity

### 3. ✅ Logic Verification (MaternalRecordObserver)
The MaternalRecordObserver automatically calculates risk_level using:

**Risk Level Calculation Rules:**
1. **Age-based Risk (Primary Factor)**
   - Age ≥ 35 years → At least "medium" risk
   - Age < 35 years → "low" base risk

2. **Pregnancy Stage & Checkup Timeliness (Secondary Factor)**
   - If in 3rd Trimester AND last checkup > 30 days ago → "high" risk
   - Otherwise → keep base risk level

**Risk Levels:**
- `low` - Young mother (< 35 years), on-schedule checkups
- `medium` - Older mother (≥ 35 years) or moderate delay in checkups
- `high` - 3rd trimester with missed monthly checkup (> 30 days)

### 4. ✅ Database Schema Updates
Migration created: `2026_04_28_add_patient_id_to_maternal_records.php`

**Changes:**
- Added `patient_id` column to maternal_records table
- Added foreign key constraint linking to patients table
- Cascade delete on patient deletion ensures referential integrity

### 5. ✅ Model Relationships
**Patient Model:**
```php
public function maternalRecords()
{
    return $this->hasMany(MaternalRecord::class);
}
```

**MaternalRecord Model:**
```php
public function patient()
{
    return $this->belongsTo(Patient::class);
}
```

## Testing & Verification

### Test Case: Maria Santos
**Input Data:**
- Full Name: Maria Santos
- DOB: 1998-03-15 (Age: 28)
- Barangay: Poblacion
- Contact: 09175551234
- Pregnancy Stage: 2nd Trimester
- Last Checkup: 2026-04-15
- Expected Delivery: 2026-07-20

**Expected Output:**
✅ Patient Record Created:
- ID: 4
- Name: Maria Santos
- Category: pregnant
- Birthdate: 1998-03-15

✅ Maternal Record Created:
- ID: 1
- patient_id: 4 (linked)
- Age: 28 (auto-calculated)
- Pregnancy Stage: second_trimester
- Risk Level: **low** (Age < 35, on-schedule checkups)
- Last Checkup: 2026-04-15
- Expected Delivery: 2026-07-20

✅ Form UI Shows:
- All three new maternal health fields visible
- Informational note about automatic risk level calculation
- Proper validation on all required fields

## Files Modified

1. **[app/Http/Controllers/PatientController.php](app/Http/Controllers/PatientController.php)**
   - Added MaternalRecord import
   - Added maternal validation logic
   - Added MaternalRecord creation in store() method

2. **[app/Models/MaternalRecord.php](app/Models/MaternalRecord.php)**
   - Added patient_id to fillable array
   - Added patient() relationship method
   - Observer already in place

3. **[app/Models/Patient.php](app/Models/Patient.php)**
   - Added maternalRecords() relationship method

4. **[app/Observers/MaternalRecordObserver.php](app/Observers/MaternalRecordObserver.php)**
   - Updated Carbon import for proper DateTime handling
   - Risk calculation logic verified and working

5. **[resources/views/patients/create.blade.php](resources/views/patients/create.blade.php)**
   - Added maternal health information section
   - Added pregnancy stage dropdown with trimester options
   - Added last checkup date picker
   - Added expected delivery date (EDD) picker
   - Added informational note about automatic risk level

6. **[database/migrations/2026_04_28_add_patient_id_to_maternal_records.php](database/migrations/2026_04_28_add_patient_id_to_maternal_records.php)**
   - New migration file
   - Adds patient_id foreign key

## Workflow Comparison: Child Nutrition vs Maternal Care

| Feature | Child Nutrition | Maternal Care |
|---------|-----------------|---------------|
| Form Fields | Age (months), Weight, Height, Last Weigh-in Date | Pregnancy Stage, Last Checkup Date, Expected Delivery Date |
| Auto-calculation | Nutritional Status (WHO Z-score) | Risk Level (Age + Checkup Schedule) |
| Observer | ChildNutritionRecordObserver | MaternalRecordObserver |
| Patient Link | Via ChildNutritionRecord.patient_id | Via MaternalRecord.patient_id |
| Display Page | /child-nutrition | /maternal-care |
| Status Badge | Low/Normal, Underweight, Severely Underweight | Low, Medium, High Risk |

## Future Enhancements

1. **SMS Reminders** - Send automated SMS reminders for overdue checkups
2. **Reporting** - Generate maternal health reports and trend analysis
3. **Risk Interventions** - Automated alerts for high-risk pregnancies
4. **Comorbidity Tracking** - Add conditions like gestational diabetes, preeclampsia
5. **Integration** - Link to immunization and prenatal care records

## Deployment Notes

- Migration has been run on development database
- No breaking changes to existing data
- Backward compatible with existing patient records
- All existing maternal records remain intact

## Verification Checklist

- [x] Migration successfully applied
- [x] Patient record created with correct category
- [x] Maternal record created automatically
- [x] Foreign key relationships established
- [x] Risk level calculated correctly
- [x] Form displays all required fields
- [x] UI feedback note visible
- [x] Validation rules working
- [x] Age auto-calculated from birthdate
- [x] Maternal records display in maternal-care page

---

**Implementation Date:** April 28, 2026  
**Status:** ✅ Complete and Tested  
**Version:** 1.0
