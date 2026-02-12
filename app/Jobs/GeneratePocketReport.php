<?php

namespace App\Jobs;

use App\Exports\PocketReportExport;
use App\Models\UserPocket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class GeneratePocketReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected UserPocket $pocket,
        protected string $type,
        protected string $date,
        protected string $reportFileName)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->type === 'INCOME') {
            $query = $this->pocket->incomes();
        } elseif ($this->type === 'EXPENSE') {
            $query = $this->pocket->expenses();
        } else {
            return;
        }

        $results = $query->whereDate('created_at', $this->date)->latest()->get();

        $fullPath = "reports/{$this->reportFileName}.xlsx";

        $export = new PocketReportExport($results);

        Excel::store($export, $fullPath, 'public');
    }
}
