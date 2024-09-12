<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Year;
use App\Notifications\FirebaseNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendPaymentReminderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:payment-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send payment reminder notification to parents';

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
     * @return int
     */
    public function handle()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $dueDate = Carbon::now()->addDays(2)->format('Y-m-d');
        $parents = Payment::where('year_id',$year_id)->where('next_batch',$dueDate)->with('parent')->get();
        $fcm_tokens = [];
        $users_ids = [];
        foreach ($parents as $parent) {
            $fcm_tokens[] = $parent->parent->fcm_token;
            $users_ids[] = $parent->parent->id;
        }

        $message = [
            'title' => 'Reminder',
            'body' => 'Hi, we just want to remind you that you have to pay the school fees after two days',
            'type' => 'payment',
            'url' => url('/parent//get-payments'),

        ];
        \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));
        $this->info('Fee reminder notifications sent successfully.');
        return 0;
    }
}
