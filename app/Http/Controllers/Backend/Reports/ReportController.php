<?php

namespace App\Http\Controllers\Backend\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Models\Dashboard\Payment\Customer;
use App\Models\Dashboard\Total;
use App\Models\Dashboard\Event;
use App\Models\Access\Team\Team;
use Yajra\Datatables\Facades\Datatables;
use Charts;
use Excel;
use DB;

class ReportController extends Controller
{
    public function index()
    {
         $donars = Customer::all();
         //$teams = Team::with('totals')->get();
         $teams = DB::table('teams')
         ->join('totals', 'teams.id', '=', 'totals.team_id')->get();
         $donations_per_team = DB::table('teams')
         ->join('customers', 'teams.id', '=', 'customers.team_id')->get();



         $event = DB::table('teams')
         ->join('events', 'teams.id', '=', 'events.team_id')
         ->join('totals', 'events.id', '=', 'totals.event_id')
         ->get();

//        return $event->pluck('title');




         $chart = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("Event Activity")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
             ->colors(['#FFC107', '#F44336', '#2196F3'  ])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Total Donations', $event->pluck('total_donations'))
           ->dataset('Goal', $event->pluck('goal_amount'))
//            ->dataset('Element 3', [25,10,40])

            // Setup what the values mean
            ->labels($event->pluck('title'));

        $users_chart = Charts::database(User::all(), 'bar', 'highcharts')
                ->title("Users Signed Up Per Month")
                ->elementLabel("Total")
                ->dimensions(1000, 500)
                ->responsive(true)
                ->groupByMonth();

        $donors_chart = Charts::create('pie', 'highcharts')
                      ->title('Donations')
                      ->labels($donars->pluck('name'))
                      ->values($donars->pluck('amount'))
                      ->dimensions(1000, 500)
                      ->responsive(true);


        $team_chart = Charts::multi('areaspline', 'highcharts')
                    ->title('Team Progress')
                    ->colors(['#e07164', '#178c1b'])
                    ->labels($teams->pluck('name'))

                    ->dataset('Teams', $teams->pluck('total_donations'));
//                    ->dataset('Users',  $teams->pluck('amount'));
//


         $progress_chart = Charts::create('progressbar', 'progressbarjs')
                            ->values([65,0,100])
                            ->responsive(false)
                            ->height(50)
                            ->width(0);

        return view('backend.reports.index', [
            'users_chart' => $users_chart,
            'chart' => $chart,
            'donors_chart' => $donors_chart,
            'team_chart' => $team_chart,
            'progress_chart' => $progress_chart,
            'donation_total' => $donations_per_team->sum('amount'),
        ]);
    }

    public function userReports()
    {
        return view('backend.reports.user');
    }

    public function userReportsTable()
    {

        $users = User::whereStatus(1)->whereConfirmed(1)->where('id', '!=', 1)->where('id', '!=', \Auth::user()->id)->select(['name','email']);
//        $users = \DB::table('users')
//                    ->join('customers','users.id', '=', 'customers.user_id')
//                    ->select('users.name','users.email');


        return Datatables::of($users)->make();
    }

    public function teamReports()
    {
        return view('backend.reports.team');
    }

    public function teamReportsTable()
    {
        //
    }

    public function eventReports()
    {
        return view('backend.reports.event');
    }

    public function eventReportsTable()
    {
        //
    }

    public function donationReports(Request $request)
    {
        $timeline = $request->timeline;
        $default = 15;
        /* Get filter to filter different views*/
        $number = $request->has('timeline') ? $timeline : $default;

        $customers = Charts::database(Customer::all(), 'bar', 'highcharts')
                        ->elementLabel("Total")
                        ->dimensions(1000, 500)
                        ->responsive(true)
                        ->lastByDay($number, true);
        return view('backend.reports.donation', compact('customers', 'timeline', 'number'));
    }

    public function donationReportsTable()
    {
        $customers = Customer::orderBy('id', 'desc')
            ->select([
                'name',
                'email',
                'address',
                'city',
                'postal',
                'payment_type',
                'amount',
                'created_at',
            ]);

            return Datatables::of($customers)->make();
    }
}
