<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nom' => 'ARATO',
                'username' => 'aratomg',
                'password' => bcrypt('arato'),
                'is_admin' => 1,
                'is_depot' => 0
            ],
            [
                'nom' => 'Francki',
                'username' => 'francki',
                'password' => bcrypt('arato'),
                'is_admin' => 0,
                'is_depot' => 0
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
