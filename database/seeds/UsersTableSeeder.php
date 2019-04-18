<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
         public function run()
    {
//         DB::table('users')->insert([
//            
//            'name' => "Anamaria",
//            'email' => "amic_dragic@yahoo.com",
//           
//            'password' => Hash::make('anamaria'),
//           
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s'),
//        ]);
//         
//         DB::table('users')->insert([
//            
//            'name' => "Ama",
//            'email' => "amic@yahoo.com",
//           
//            'password' => Hash::make('anamaria'),
//           
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s'),
//        ]);
         
        
         DB::table('users')->insert([
            
            'name' => "Dragicka",
            'email' => "dragic@yahoo.com",
           
            'password' => Hash::make('anamaria'),
           
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
    
}
