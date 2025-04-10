<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FormateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $formateurUsers = User::where('role_id', 2)->pluck('id')->toArray();

      
        $formateurs = [];

        foreach ($formateurUsers as $userId) {
            $formateurs[] = [
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

       
        DB::table('formateurs')->insert($formateurs);
    }
}
