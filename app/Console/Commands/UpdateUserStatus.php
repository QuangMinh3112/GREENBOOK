<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User Status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $user = User::where('point', '<' , 0)->get();
    }
}
