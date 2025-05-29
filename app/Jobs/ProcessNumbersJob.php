<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessNumbersJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected array $numbers)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->numbers as $number) {
            $isPrime = $this->isPrime($number);

            if ($isPrime) {
                $now = now();
                Log::channel('prime')->info("$number: number found at $now");
            }
        }
    }

    private function isPrime($number): bool
    {
        if ($number <= 1) {
            return false;
        }

        if ($number === 2) {
            return true;
        }

        if ($number > 2 && $number % 2 === 0) {
            return false;
        }

        for ($i = 3; $i <= sqrt($number); $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    }
}
