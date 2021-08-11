<?php
namespace Database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_messages')->delete();

        DB::table('type_messages')->insert(array (
            0 =>
            array (
                'type_message' => 'General Message',
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'name' => 'Report',
                'created_at' => '2021-04-01 00:00:00',
                'updated_at' => NULL,
            ),
            2 =>
                array (
                    'name' => 'Feedback',
                    'created_at' => '2021-04-01 00:00:00',
                    'updated_at' => NULL,
                ),
        ));
    }
}
