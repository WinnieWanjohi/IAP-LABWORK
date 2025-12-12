<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\Speciality;
use App\Models\SubSpeciality;
use App\Models\Institution;
use App\Models\Degree;
use App\Models\Practitioner;

class KmpdcSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Statuses
        $statuses = [
            ['name' => 'Active', 'code' => 'ACTIVE', 'description' => 'Practitioner is active and licensed'],
            ['name' => 'Inactive', 'code' => 'INACTIVE', 'description' => 'Practitioner is not active'],
            ['name' => 'Suspended', 'code' => 'SUSPENDED', 'description' => 'Practitioner license is suspended'],
            ['name' => 'Expired', 'code' => 'EXPIRED', 'description' => 'Practitioner license has expired'],
            ['name' => 'Retired', 'code' => 'RETIRED', 'description' => 'Practitioner has retired'],
        ];

        foreach ($statuses as $status) {
            Status::firstOrCreate(
                ['code' => $status['code']],
                $status
            );
        }

        // Seed Specialities (Common Medical Specialities in Kenya)
        $specialities = [
            ['name' => 'General Practice', 'code' => 'GP'],
            ['name' => 'Internal Medicine', 'code' => 'IM'],
            ['name' => 'Surgery', 'code' => 'SURG'],
            ['name' => 'Pediatrics', 'code' => 'PEDS'],
            ['name' => 'Obstetrics & Gynecology', 'code' => 'OBGYN'],
            ['name' => 'Psychiatry', 'code' => 'PSYCH'],
            ['name' => 'Radiology', 'code' => 'RAD'],
            ['name' => 'Pathology', 'code' => 'PATH'],
            ['name' => 'Anesthesiology', 'code' => 'ANES'],
            ['name' => 'Dermatology', 'code' => 'DERM'],
            ['name' => 'Ophthalmology', 'code' => 'OPHTH'],
            ['name' => 'ENT', 'code' => 'ENT'],
            ['name' => 'Orthopedics', 'code' => 'ORTHO'],
            ['name' => 'Urology', 'code' => 'URO'],
            ['name' => 'Cardiology', 'code' => 'CARD'],
        ];

        foreach ($specialities as $speciality) {
            Speciality::firstOrCreate(
                ['code' => $speciality['code']],
                $speciality
            );
        }

        // Get specialities for reference
        $cardiology = Speciality::where('code', 'CARD')->first();
        $surgery = Speciality::where('code', 'SURG')->first();
        $internalMedicine = Speciality::where('code', 'IM')->first();

        // Seed Sub-Specialities
        $subSpecialities = [
            // Cardiology sub-specialities
            ['speciality_id' => $cardiology->id, 'name' => 'Interventional Cardiology', 'code' => 'INTERV_CARD'],
            ['speciality_id' => $cardiology->id, 'name' => 'Electrophysiology', 'code' => 'EP'],
            
            // Surgery sub-specialities
            ['speciality_id' => $surgery->id, 'name' => 'Cardiothoracic Surgery', 'code' => 'CT_SURG'],
            ['speciality_id' => $surgery->id, 'name' => 'Neurosurgery', 'code' => 'NEURO_SURG'],
            ['speciality_id' => $surgery->id, 'name' => 'Plastic Surgery', 'code' => 'PLASTIC'],
            ['speciality_id' => $surgery->id, 'name' => 'Pediatric Surgery', 'code' => 'PED_SURG'],
            
            // Internal Medicine sub-specialities
            ['speciality_id' => $internalMedicine->id, 'name' => 'Gastroenterology', 'code' => 'GI'],
            ['speciality_id' => $internalMedicine->id, 'name' => 'Nephrology', 'code' => 'NEPHRO'],
            ['speciality_id' => $internalMedicine->id, 'name' => 'Endocrinology', 'code' => 'ENDO'],
            ['speciality_id' => $internalMedicine->id, 'name' => 'Rheumatology', 'code' => 'RHEUM'],
        ];

        foreach ($subSpecialities as $sub) {
            SubSpeciality::firstOrCreate(
                ['code' => $sub['code']],
                $sub
            );
        }

        // Seed Institutions (Kenyan Medical Institutions)
        $institutions = [
            ['name' => 'University of Nairobi', 'type' => 'University', 'country' => 'Kenya', 'accreditation_code' => 'UON001'],
            ['name' => 'Moi University', 'type' => 'University', 'country' => 'Kenya', 'accreditation_code' => 'MU001'],
            ['name' => 'Kenyatta University', 'type' => 'University', 'country' => 'Kenya', 'accreditation_code' => 'KU001'],
            ['name' => 'Mount Kenya University', 'type' => 'University', 'country' => 'Kenya', 'accreditation_code' => 'MKU001'],
            ['name' => 'Kenyatta National Hospital', 'type' => 'Hospital', 'country' => 'Kenya', 'accreditation_code' => 'KNH001'],
            ['name' => 'Moi Teaching and Referral Hospital', 'type' => 'Hospital', 'country' => 'Kenya', 'accreditation_code' => 'MTRH001'],
            ['name' => 'Aga Khan University Hospital', 'type' => 'Hospital', 'country' => 'Kenya', 'accreditation_code' => 'AKUH001'],
            ['name' => 'Nairobi Hospital', 'type' => 'Hospital', 'country' => 'Kenya', 'accreditation_code' => 'NH001'],
            ['name' => 'Makerere University', 'type' => 'University', 'country' => 'Uganda', 'accreditation_code' => 'MAK001'],
            ['name' => 'University of Dar es Salaam', 'type' => 'University', 'country' => 'Tanzania', 'accreditation_code' => 'UDSM001'],
        ];

        foreach ($institutions as $institution) {
            Institution::firstOrCreate(
                ['accreditation_code' => $institution['accreditation_code']],
                $institution
            );
        }

        // Seed Degrees
        $degrees = [
            ['name' => 'Bachelor of Medicine and Bachelor of Surgery', 'abbreviation' => 'MBChB', 'level' => 'Bachelors'],
            ['name' => 'Doctor of Medicine', 'abbreviation' => 'MD', 'level' => 'Masters'],
            ['name' => 'Master of Medicine', 'abbreviation' => 'MMed', 'level' => 'Masters'],
            ['name' => 'Doctor of Philosophy', 'abbreviation' => 'PhD', 'level' => 'Doctorate'],
            ['name' => 'Diploma in Clinical Medicine', 'abbreviation' => 'DCM', 'level' => 'Diploma'],
            ['name' => 'Diploma in Nursing', 'abbreviation' => 'DN', 'level' => 'Diploma'],
            ['name' => 'Bachelor of Science in Nursing', 'abbreviation' => 'BScN', 'level' => 'Bachelors'],
            ['name' => 'Master of Science in Nursing', 'abbreviation' => 'MScN', 'level' => 'Masters'],
            ['name' => 'Bachelor of Dental Surgery', 'abbreviation' => 'BDS', 'level' => 'Bachelors'],
            ['name' => 'Master of Dental Surgery', 'abbreviation' => 'MDS', 'level' => 'Masters'],
            ['name' => 'Bachelor of Pharmacy', 'abbreviation' => 'BPharm', 'level' => 'Bachelors'],
            ['name' => 'Master of Pharmacy', 'abbreviation' => 'MPharm', 'level' => 'Masters'],
        ];

        foreach ($degrees as $degree) {
            Degree::firstOrCreate(
                ['abbreviation' => $degree['abbreviation']],
                $degree
            );
        }

        // Seed Sample Practitioners
        $this->seedSamplePractitioners();
    }

    private function seedSamplePractitioners(): void
    {
        // Check if any practitioners already exist
        if (Practitioner::count() > 0) {
            $this->command->info('Practitioners already exist. Skipping sample practitioner seeding.');
            return;
        }

        $practitioners = [
            [
                'registration_number' => 'KMPDC/12345/2020',
                'fullname' => 'Dr. John Kamau',
                'status_id' => Status::where('code', 'ACTIVE')->first()->id,
                'speciality_id' => Speciality::where('code', 'GP')->first()->id,
                'sub_speciality_id' => null,
                'discipline' => 'Medical',
                'address' => 'Nairobi, Kenya',
                'registration_date' => '2020-01-15',
                'expiry_date' => '2025-01-15',
                'is_active' => true,
            ],
            [
                'registration_number' => 'KMPDC/12346/2019',
                'fullname' => 'Dr. Mary Wanjiku',
                'status_id' => Status::where('code', 'ACTIVE')->first()->id,
                'speciality_id' => Speciality::where('code', 'IM')->first()->id,
                'sub_speciality_id' => SubSpeciality::where('code', 'GI')->first()->id,
                'discipline' => 'Medical',
                'address' => 'Mombasa, Kenya',
                'registration_date' => '2019-03-20',
                'expiry_date' => '2024-03-20',
                'is_active' => true,
            ],
            [
                'registration_number' => 'KMPDC/12347/2018',
                'fullname' => 'Dr. Peter Ochieng',
                'status_id' => Status::where('code', 'ACTIVE')->first()->id,
                'speciality_id' => Speciality::where('code', 'SURG')->first()->id,
                'sub_speciality_id' => SubSpeciality::where('code', 'NEURO_SURG')->first()->id,
                'discipline' => 'Medical',
                'address' => 'Kisumu, Kenya',
                'registration_date' => '2018-06-10',
                'expiry_date' => '2023-06-10',
                'is_active' => true,
            ],
            [
                'registration_number' => 'KMPDC/12348/2021',
                'fullname' => 'Dr. Sarah Mohamed',
                'status_id' => Status::where('code', 'ACTIVE')->first()->id,
                'speciality_id' => Speciality::where('code', 'OBGYN')->first()->id,
                'sub_speciality_id' => null,
                'discipline' => 'Medical',
                'address' => 'Eldoret, Kenya',
                'registration_date' => '2021-02-28',
                'expiry_date' => '2026-02-28',
                'is_active' => true,
            ],
            [
                'registration_number' => 'KMPDC/12349/2017',
                'fullname' => 'Dr. David Kimani',
                'status_id' => Status::where('code', 'EXPIRED')->first()->id,
                'speciality_id' => Speciality::where('code', 'CARD')->first()->id,
                'sub_speciality_id' => SubSpeciality::where('code', 'INTERV_CARD')->first()->id,
                'discipline' => 'Medical',
                'address' => 'Nakuru, Kenya',
                'registration_date' => '2017-11-05',
                'expiry_date' => '2022-11-05',
                'is_active' => false,
            ],
        ];

        foreach ($practitioners as $practitionerData) {
            $practitioner = Practitioner::firstOrCreate(
                ['registration_number' => $practitionerData['registration_number']],
                $practitionerData
            );

            // Only add related data if practitioner was just created
            if ($practitioner->wasRecentlyCreated) {
                // Add sample contacts
                $practitioner->contacts()->create([
                    'type' => 'email',
                    'value' => strtolower(str_replace(' ', '.', str_replace('Dr. ', '', $practitioner->fullname))) . '@example.com',
                    'is_primary' => true,
                ]);

                $practitioner->contacts()->create([
                    'type' => 'phone',
                    'value' => '+2547' . rand(10000000, 99999999),
                    'is_primary' => false,
                ]);

                // Add sample qualifications
                $practitioner->qualifications()->create([
                    'degree_id' => Degree::where('abbreviation', 'MBChB')->first()->id,
                    'institution_id' => Institution::where('accreditation_code', 'UON001')->first()->id,
                    'year_awarded' => 2010 + rand(0, 10),
                    'certificate_number' => 'CERT' . rand(1000, 9999),
                ]);

                // Add sample license
                $practitioner->licenses()->create([
                    'license_number' => 'LIC' . rand(10000, 99999),
                    'issue_date' => $practitioner->registration_date,
                    'expiry_date' => $practitioner->expiry_date,
                    'status' => $practitioner->is_active ? 'active' : 'expired',
                    'fee_amount' => 5000.00,
                    'payment_status' => 'paid',
                ]);
            }
        }
        
        $this->command->info('Sample practitioners seeded successfully!');
    }
}