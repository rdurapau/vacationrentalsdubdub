<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class FakeSpots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sweet:fakespots {count?} {--T|type=all} {--P|photo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with fake spots';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = $this->argument('count') ? $this->argument('count') : 50;
        $type = $this->option('type') ? $this->option('type') : 'all';
        $states = $this->option('photo') ? ['has-photo'] : [];

        if ($type == 'all') {
            $a = floor($count/2);
            $b = floor($count/3);
            $c = $count -$a -$b;
        } else {
            $a = $b = $c = intval($count);
        }

        Mail::fake();

        if ($type == 'approved' || $type == 'a' || $type == 'all') {
            $aState = $states;
            $aState[] = 'has-requests';
            $this->info("Seeding {$a} approved spots");
            factory('App\Spot', $a)->states($aState)->create();
        }

        if ($type == 'pending' || $type == 'p' || $type == 'all') {
            $pState = $states;
            $this->info("Seeding {$b} pending spots");
            factory('App\Submission', $b)->states($pState)->create();
        }

        if ($type == 'rejected' || $type == 'r' || $type == 'all') {
            $rState = $states;
            $rState[] = 'rejected';
            $this->info("Seeding {$c} rejected spots");
            factory('App\Spot', $c)->states($rState)->create();
        }
    }
}
