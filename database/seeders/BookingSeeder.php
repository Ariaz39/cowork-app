<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\User;
use App\Models\Workspace;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $workspaces = Workspace::all();

        $statuses = ['Pending', 'Accepted', 'Rejected'];

        foreach (range(1, 5) as $index) {
            Booking::create([
                'user_id' => $users->random()->id,
                'workspace_id' => $workspaces->random()->id,
                'booking_date_time' => Carbon::now()->addDays($index),
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
