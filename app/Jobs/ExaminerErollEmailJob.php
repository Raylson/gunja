<?php

namespace App\Jobs;

use App\Models\Examiner;
use App\Notifications\IloEncompassNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExaminerErollEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $examiner;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Examiner $examiner)
    {
        $this->examiner = $examiner;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->examiner->notify(new IloEncompassNotification($this->examiner));
    }
}
