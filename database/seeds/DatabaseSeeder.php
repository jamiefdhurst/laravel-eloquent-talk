<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // Simple patients and sessions
        factory(App\SimplePatient::class, rand(100, 200))->create()->each(function ($p) {

            // Create a random amount of sessions
            if (rand(0, 1)) {
                factory(App\SimpleSession::class, rand(1, 3))->create([
                    'patient_id' => $p->id
                ]);
            }

        });

        // Generate fields for patient
        \Illuminate\Support\Facades\DB::table('patient_fields')->insert([
            'type' => 'text',
            'slug' => 'surname',
            'name' => 'Surname',
        ]);
        \Illuminate\Support\Facades\DB::table('patient_fields')->insert([
            'type' => 'text',
            'slug' => 'forenames',
            'name' => 'Forenames',
        ]);
        \Illuminate\Support\Facades\DB::table('patient_fields')->insert([
            'type' => 'email',
            'slug' => 'email',
            'name' => 'Email',
        ]);
        \Illuminate\Support\Facades\DB::table('patient_fields')->insert([
            'type' => 'date',
            'slug' => 'dob',
            'name' => 'Date of Birth',
        ]);
        \Illuminate\Support\Facades\DB::table('patient_fields')->insert([
            'type' => 'text',
            'slug' => 'postcode',
            'name' => 'Postcode',
        ]);
        \Illuminate\Support\Facades\DB::table('patient_fields')->insert([
            'type' => 'text',
            'slug' => 'phone',
            'name' => 'Phone',
        ]);
        \Illuminate\Support\Facades\DB::table('patient_fields')->insert([
            'type' => 'number',
            'slug' => 'pain',
            'name' => 'Pain',
        ]);
        \Illuminate\Support\Facades\DB::table('patient_fields')->insert([
            'type' => 'text',
            'slug' => 'notes',
            'name' => 'Notes',
        ]);

        $faker = app(\Faker\Generator::class);

        // Generate random patients
        factory(App\Solution1\Patient::class, rand(100, 200))->create()->each(function ($p) use ($faker) {

            // Foreach field, generate an amount of historical values
            foreach (\App\Solution1\PatientField::all() as $field) {

                $fieldValues = $field->toArray();

                unset($fieldValues['deleted_at'], $fieldValues['id']);

                $fieldValues['patient_id'] = $p->id;
                $fieldValues['patient_field_id'] = $field->id;

                factory(App\Solution1\PatientValue::class, rand(1, 10))->create($fieldValues)->each(function ($f) use ($field, $faker) {

                    if ($field->slug == 'surname') {
                        $f->value = $faker->lastName;
                    } elseif ($field->slug == 'forenames') {
                        $f->value = $faker->firstName;
                    } elseif ($field->slug == 'email') {
                        $f->value = $faker->safeEmail;
                    } elseif ($field->slug == 'dob') {
                        $f->value = $faker->dateTimeBetween('-70 years', '-18 years');
                    } elseif ($field->slug == 'postcode') {
                        $f->value = $faker->postCode;
                    } elseif ($field->slug == 'pain') {
                        $f->value = $faker->numberBetween(0, 10);
                    } elseif ($field->slug == 'phone') {
                        $f->value = $faker->phoneNumber;
                    } elseif ($field->slug == 'notes') {
                        $f->value = $faker->sentence;
                    }
                    $f->save();

                });
            }

        });
    }
}
