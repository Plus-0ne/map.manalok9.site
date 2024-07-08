<?php

namespace Database\Seeders;

use App\Models\Admins;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create uuid
        do {
            $uuid = Str::uuid();
        } while (Admins::where('uuid', '=', $uuid)->first()  instanceof Admins);

        $data = [
            'uuid' => $uuid,
            'first_name' => Str::random(6),
            'last_name' => Str::random(6),
            'middle_name' => Str::random(6),
            'email_address' => 'example@gmail.com',
            'password' => Hash::make('password'),
            'status' => 1,
        ];

        $create = Admins::create($data);

    }
}
