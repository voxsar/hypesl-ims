<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\Contact;

use App\Models\Invoice;
use App\Models\Payment;

use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\AppointmentColor;
use App\Models\AppointmentConstraint;

use App\Models\Message;
use App\Models\MessageTopic;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        User::factory()->create(['email' => 'voxsar@gmail.com', 'fname' => 'Miyuru', 'lname' => 'Dharmage']);
        Team::factory()->create([
            'user_id' => '1',
            'personal_team' => '1',
        ]);
        //User::factory()->count(10)->create();
        //Contact::factory()->count(2)->create();
        //Invoice::factory()->count(5)->create();
        
        AppointmentType::create([
            'name' => 'Monthly Meetin'
        ]);
        AppointmentColor::create([
            'name' => 'blue',
            'hex' => '#0000ff'
        ]);
        AppointmentConstraint::create([
            'name' => 'Public Holiday'
        ]);

        //Appointment::factory()->count(20)->create();

        //Payment::factory()->count(5)->create();
        //factory(App\ContactRelationshipType::class, 5)->create();
        DB::table('contact_relationship_types')->insert([
            ['name' => 'Mentor'],
            ['name' => 'Inductor'],
            ['name' => 'Sibling'],
        ]);

        DB::table('team_user')->insert([
            [
                'team_id' => '1',
                'user_id' => '1',
                'role' => '1',
            ],
        ]);

        //MessageTopic::factory()->count(20)->create();
        //Message::factory()->count(200)->create();
    }
}
