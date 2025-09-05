<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class FamilySeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@family.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Family heads data
        $familyHeads = [
            [
                'name' => 'John',
                'surname' => 'Smith',
                'birthdate' => '1975-03-15',
                'mobile' => '9876543210',
                'address' => '123 Main Street, Downtown',
                'city' => 'mumbai',
                'state' => 'maharashtra',
                'pincode' => '400001',
                'marital_status' => 1,
                'mariage_date' => '2000-05-20',
                'photo_path' => 'noimage.png'
            ],
            [
                'name' => 'David',
                'surname' => 'Johnson',
                'birthdate' => '1980-07-22',
                'mobile' => '9876543211',
                'address' => '456 Oak Avenue, Suburb',
                'city' => 'pune',
                'state' => 'maharashtra',
                'pincode' => '411001',
                'marital_status' => 1,
                'mariage_date' => '2005-09-10',
                'photo_path' => 'noimage.png'
            ],
            [
                'name' => 'Michael',
                'surname' => 'Brown',
                'birthdate' => '1978-11-08',
                'mobile' => '9876543212',
                'address' => '789 Pine Road, Hillside',
                'city' => 'nashik',
                'state' => 'maharashtra',
                'pincode' => '422001',
                'marital_status' => 1,
                'mariage_date' => '2003-12-15',
                'photo_path' => 'noimage.png'
            ],
            [
                'name' => 'Robert',
                'surname' => 'Davis',
                'birthdate' => '1982-01-30',
                'mobile' => '9876543213',
                'address' => '321 Elm Street, Central',
                'city' => 'mumbai',
                'state' => 'maharashtra',
                'pincode' => '400002',
                'marital_status' => 0,
                'mariage_date' => null,
                'photo_path' => 'noimage.png'
            ],
            [
                'name' => 'William',
                'surname' => 'Wilson',
                'birthdate' => '1976-06-12',
                'mobile' => '9876543214',
                'address' => '654 Maple Lane, Eastside',
                'city' => 'pune',
                'state' => 'maharashtra',
                'pincode' => '411002',
                'marital_status' => 1,
                'mariage_date' => '2001-08-25',
                'photo_path' => 'noimage.png'
            ]
        ];

        // Insert family heads and get their IDs
        $headIds = [];
        foreach ($familyHeads as $head) {
            $headId = DB::table('heads')->insertGetId(array_merge($head, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
            $headIds[] = $headId;
        }

        // Hobbies for family heads
        $hobbies = [
            ['reading', 'cooking', 'gardening'],
            ['sports', 'music', 'traveling'],
            ['photography', 'fishing', 'hiking'],
            ['gaming', 'movies', 'books'],
            ['painting', 'dancing', 'swimming']
        ];

        // Insert hobbies for each head
        foreach ($headIds as $index => $headId) {
            foreach ($hobbies[$index] as $hobby) {
                DB::table('hobbies')->insert([
                    'head_id' => $headId,
                    'hobby_name' => $hobby,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Family members data
        $familyMembers = [
            // John Smith's family
            [
                ['name' => 'Sarah Smith', 'birthdate' => '1978-08-10', 'marital_status' => 1, 'mariage_date' => '2000-05-20', 'education' => 'Masters in Arts', 'head_id' => $headIds[0]],
                ['name' => 'Emma Smith', 'birthdate' => '2002-03-15', 'marital_status' => 0, 'mariage_date' => null, 'education' => 'High School', 'head_id' => $headIds[0]],
                ['name' => 'James Smith', 'birthdate' => '2005-11-22', 'marital_status' => 0, 'mariage_date' => null, 'education' => 'Middle School', 'head_id' => $headIds[0]]
            ],
            // David Johnson's family
            [
                ['name' => 'Lisa Johnson', 'birthdate' => '1983-04-18', 'marital_status' => 1, 'mariage_date' => '2005-09-10', 'education' => 'Bachelor in Science', 'head_id' => $headIds[1]],
                ['name' => 'Alex Johnson', 'birthdate' => '2008-07-05', 'marital_status' => 0, 'mariage_date' => null, 'education' => 'Elementary', 'head_id' => $headIds[1]]
            ],
            // Michael Brown's family
            [
                ['name' => 'Jennifer Brown', 'birthdate' => '1981-12-03', 'marital_status' => 1, 'mariage_date' => '2003-12-15', 'education' => 'Masters in Business', 'head_id' => $headIds[2]],
                ['name' => 'Ryan Brown', 'birthdate' => '2006-09-14', 'marital_status' => 0, 'mariage_date' => null, 'education' => 'High School', 'head_id' => $headIds[2]],
                ['name' => 'Sophia Brown', 'birthdate' => '2010-01-28', 'marital_status' => 0, 'mariage_date' => null, 'education' => 'Elementary', 'head_id' => $headIds[2]]
            ],
            // Robert Davis (single, no family members)
            [],
            // William Wilson's family
            [
                ['name' => 'Amanda Wilson', 'birthdate' => '1979-10-16', 'marital_status' => 1, 'mariage_date' => '2001-08-25', 'education' => 'Bachelor in Education', 'head_id' => $headIds[4]],
                ['name' => 'Daniel Wilson', 'birthdate' => '2003-05-12', 'marital_status' => 0, 'mariage_date' => null, 'education' => 'College', 'head_id' => $headIds[4]],
                ['name' => 'Olivia Wilson', 'birthdate' => '2007-02-08', 'marital_status' => 0, 'mariage_date' => null, 'education' => 'Middle School', 'head_id' => $headIds[4]]
            ]
        ];

        // Insert family members
        foreach ($familyMembers as $family) {
            foreach ($family as $member) {
                DB::table('members')->insert(array_merge($member, [
                    'photo_path' => 'noimage.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }
}