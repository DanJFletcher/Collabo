<?php

namespace App\Http\Controllers\Backend\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Models\Dashboard\Payment\Customer;
use App\Models\Dashboard\Total;
use App\Models\Dashboard\Event;
use Charts;

class ReportController extends Controller
{
    public function index()
    {

         $chart = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("User Chart")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Element 1', [5,20,100])
            ->dataset('Element 2', [15,30,80])
            ->dataset('Element 3', [25,10,40])
            // Setup what the values mean
            ->labels(['One', 'Two', 'Three']);

        $users_chart = Charts::database(User::all(), 'bar', 'highcharts')
                ->title("Users Signed Up Per Month")
                ->elementLabel("Total")
                ->dimensions(1000, 500)
                ->responsive(true)

                ->groupByMonth();
        $donors_chart = Charts::create('pie', 'highcharts')
                      ->title('Montly Donations')
                      ->labels(['First', 'Second', 'Third'])
                      ->values([5,10,20])
                      ->dimensions(1000,500)
                      ->responsive(true);

        $team_chart = Charts::multi('areaspline', 'highcharts')
                    ->title('Team Progress')
                    ->colors(['#ff0000', '#ffffff'])
                    ->labels(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday', 'Sunday'])
                    ->dataset('John', [3, 4, 3, 5, 4, 10, 12])
                    ->dataset('Jane',  [1, 3, 4, 3, 3, 5, 4]);;

         $progress_chart = Charts::create('progressbar', 'progressbarjs')
                            ->values([65,0,100])
                            ->responsive(false)
                            ->height(50)
                            ->width(0);





        return view('backend.reports.index',['users_chart' => $users_chart, 'chart' => $chart,'donors_chart' => $donors_chart,'team_chart' => $team_chart,'progress_chart' => $progress_chart]);
    }
}
