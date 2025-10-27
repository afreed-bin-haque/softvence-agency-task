<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ABHDevRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abh:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will run both php artisan server and npm run dev';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Laravel and Vite servers');
        $php = new Process(['php', 'artisan', 'serve']);
        $php->setTimeout(null);
        $php->start();
        $npm = new Process(['npm', 'run', 'dev']);
        $npm->setTimeout(null);
        $npm->start();
        foreach ([$php, $npm] as $process) {
            $process->wait(function ($type, $buffer) {
                echo $buffer;
            });
        }

        return Command::SUCCESS;
    }
}
