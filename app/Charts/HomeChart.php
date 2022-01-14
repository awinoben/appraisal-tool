<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Escalate;
use App\Models\User;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class HomeChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $users = new User();

        return Chartisan::build()
            ->labels(['Appraised', 'Self Appraised', 'Pending', 'Escalations'])
            ->dataset('Appraisal Statistics', [
                count($users->where('is_evaluated', true)->where('is_self_evaluated', true)->get()),
                count($users->where('is_evaluated', false)->where('is_self_evaluated', true)->get()),
                count($users->where('is_evaluated', false)->where('is_self_evaluated', false)->get()),
                count(Escalate::query()->where('is_closed', false)->get()),
            ]);
    }
}
