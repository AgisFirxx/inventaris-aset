<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Loan;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.navigation', function ($view) {
            if (auth()->check()) {
                $lateCount = Loan::where('status', 'dipinjam')
                    ->where('tanggal_kembali_rencana', '<', now())
                    ->count();
                $view->with('lateLoanCount', $lateCount);
            }
        });
    }
}