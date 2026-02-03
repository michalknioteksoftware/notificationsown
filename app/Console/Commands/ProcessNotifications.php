<?php

namespace App\Console\Commands;

use App\Notification;
use App\NotificationSent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:process {--daemon : Run as daemon/worker} {--sleep=5 : Sleep time in seconds when running as daemon}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process notifications and mark them as sent in notifications_sent table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $daemon = $this->option('daemon');
        $sleep = (int) $this->option('sleep');

        if ($daemon) {
            $this->info('Starting notification processor in daemon mode...');
            $this->info('Press Ctrl+C to stop.');
            
            while (true) {
                $this->processNotifications();
                sleep($sleep);
            }
        } else {
            $this->processNotifications();
        }

        return Command::SUCCESS;
    }

    /**
     * Process notifications that haven't been marked as sent yet.
     */
    private function processNotifications(): void
    {
        // Get notifications that don't have a sent record yet
        $notifications = Notification::whereDoesntHave('sentRecords')
            ->get();

        if ($notifications->isEmpty()) {
            $this->info('No notifications to process.');
            return;
        }

        $this->info("Processing {$notifications->count()} notification(s)...");

        //TODO here could be integration with external services to send notifications
        $processed = 0;
        foreach ($notifications as $notification) {
            try {
                NotificationSent::create([
                    'notification_id' => $notification->id,
                    'sent' => true,
                    'channel' => 'sampleChannel',
                ]);

                $processed++;
                $this->line("✓ Processed notification #{$notification->id}");
            } catch (\Exception $e) {
                $this->error("✗ Failed to process notification #{$notification->id}: {$e->getMessage()}");
            }
        }

        $this->info("Successfully processed {$processed} notification(s).");
    }
}
