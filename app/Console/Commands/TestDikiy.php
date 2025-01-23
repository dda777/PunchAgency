<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Revolution\Google\Client\Facades\Google;
use Revolution\Google\Sheets\Facades\Sheets;
use Google\Client;
use Revolution\Google\Sheets\SheetsClient;
class TestDikiy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-dikiy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

    }
}
