<?php

namespace Modules\WhatsAppMessenger\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WhatsAppMessengerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(PermissionTableSeeder::class);
        $this->call(MarketPlaceSeederTableSeeder::class);

        // $this->call("OthersTableSeeder");
    }
}
