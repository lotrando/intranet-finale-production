<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $personalNumber = $this->faker->unique()->numberBetween(61000, 65000);

        return [
            'personal_number' => $personalNumber,
            'image'           => $personalNumber . '.jpg',
            'title_preffix'   => $this->faker->title(),
            'last_name'       => $this->faker->lastName(),
            'first_name'      => $this->faker->firstName(),
            'title_suffix'    => $this->faker->title(),
            'department_id'   => Department::all()->random()->id,
            'job_id'          => Job::all()->random()->id,
            'email'           => $this->faker->unique()->safeEmail(),
            'start_date'      => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'end_date'        => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'comment'         => $this->faker->text(),
            'phone'           => $this->faker->numberBetween(341, 556),
            'mobile'          => $this->faker->e164PhoneNumber(),
            'id_card'         => $this->faker->randomElement(['Nový nástup', 'Vytvořit kartu', 'Předat nálepku', 'Aktualizovat nálepku', 'Ok', 'Vrácena']),
            'coffee'          => $this->faker->randomElement(['N', 'A']),
            'employment'      => $this->faker->randomElement(['HPP', 'DPP', 'DPČ', 'EVP', 'ČSO']),
            'status'          => $this->faker->randomElement(['Aktivní', 'Neaktivní', 'Mateřská']),
        ];
    }
}
