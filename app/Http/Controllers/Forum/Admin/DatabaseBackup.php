<?php

namespace App\Http\Controllers\Forum\Admin;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take a backup of the entire DB and upload to S3.';

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
        $date = Carbon::now()->format('Y-m-d_h-i');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $command = "mysqldump --user={$user} --password={$password} {$database} > {$date}.sql";
        $process = new Process($command);
        $process->start();
        $process->wait();
        Storage::disk('public')->put($date . ".sql", file_get_contents("./{$date}.sql"));
        $headers = [
            'Content-Type' => 'application/force-download',
        ];
        unlink("./{$date}.sql");

        return Storage::disk('public')->download($date . ".sql", "{$date}.sql", $headers);
    }
}