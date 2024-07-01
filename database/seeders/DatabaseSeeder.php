<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Artisan;
use App\Models\AccountType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $accountTypes = [["name"=>"Savings Account"],["name"=>"Checking Account"], ["name"=>"Time Deposit"]];
        AccountType::insert($accountTypes);
        
        User::create(["username"=>"user01", "password"=>"user01", "email"=>"user01@email.com", "contact_number"=>"123457"]);
        User::create(["username"=>"test", "password"=>"test", "email"=>"test@email.com", "contact_number"=>"8378"]);
        User::create(["username"=>"test1", "password"=>"test1", "email"=>"test1@email.com", "contact_number"=>"889999273273"]);
        
        
        Artisan::call('passport:client --personal --no-interaction');
    }
}
