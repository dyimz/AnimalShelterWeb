<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\Animal;
use App\Models\Rescuer;
use App\Models\Adopter;
use App\Models\ShelterPersonnel;
use App\Charts\AdoptedChart;
use App\Charts\ClinicChart;
use App\Charts\RescuedChart;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'role']);
        // $this->middleware(['auth', 'verified', 'role']);
    }

    public function index()
    {
        $user = Auth::user()->role;
        if($user == 'employee')
        {
            $profile = ShelterPersonnel::where('user_id',Auth::id())->first();
            $query = Animal::where('personnel_id','=',Auth::id())->get();
        }
        elseif($user == 'rescuer')
        {
            $profile = Rescuer::where('user_id',Auth::id())->first();
            $query = Animal::where('rescuer_id','=',Auth::id())->get();

        }
        elseif($user == 'adopter')
        {
            $profile = Adopter::where('user_id',Auth::id())->first();
            $query = Animal::where('status','=','adoptable')->get();
            //dd($query);
        }

        $adate = DB::table('adopters')
        ->join('animals','adopters.id','=','adopter_id')
        ->select(DB::raw('count(adopters.date_adopted) AS total'), DB::raw('MONTHNAME(adopters.date_adopted) as month'))
        ->groupBy('month')
        ->pluck(DB::raw('count(month) AS total'), 'month')
        ->all();
        $adoptedChart = new AdoptedChart;
        $dataset = $adoptedChart->labels(array_keys($adate));
        $dataset= $adoptedChart->dataset('Adopted Per Month', 'horizontalBar', array_values($adate));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $adoptedChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> true],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => true],
                            'gridLines' => ['display' => true],
                            'display' => true
                          ]],
            ],
        ]);
        $rdate = DB::table('animals')
        ->join('rescuers','rescuers.id','=','rescuer_id')
        ->select(DB::raw('count(animals.date_rescued) AS total'), DB::raw('MONTHNAME(animals.date_rescued) as month'))
        ->groupBy('month')
        ->pluck(DB::raw('count(month) AS total'), 'month')
        ->all();
        $rescuedChart = new RescuedChart;
        $dataset = $rescuedChart->labels(array_keys($rdate));
        $dataset= $rescuedChart->dataset('Rescued Per Month', 'bar', array_values($rdate));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $rescuedChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> true],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => true],
                            'gridLines' => ['display' => true],
                            'display' => true
                          ]],
            ],
        ]);
        $clinic = DB::table('animals')->leftJoin('animal_condition', 'animals.id', 'animal_condition.animal_id')
        ->leftJoin('disease_injuries', 'disease_injuries.id','animal_condition.disease_injury_id')
        ->whereNotNull('disease_injuries.id')
        ->groupBy('dis_inj')
        ->pluck(DB::raw('count(name)'),'dis_inj')
        ->all();
        $clinicChart = new ClinicChart;
        $dataset = $clinicChart->labels(array_keys($clinic));
        $dataset= $clinicChart->dataset('Common Diseases/disease_injuries', 'pie', array_values($clinic));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $clinicChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> false],
                            'gridLines'=> ['display'=> false],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => false
                          ]],
            ],
        ]);
        $admin = User::find(Auth::id());

        $animal_condition = DB::table('animals')->leftJoin('animal_condition', 'animals.id', 'animal_condition.animal_id')
        ->leftJoin('disease_injuries', 'disease_injuries.id', 'animal_condition.disease_injury_id')
        ->select('animal_condition.animal_id', 'animal_condition.disease_injury_id', 'dis_inj')->get();
        if(Auth::user()->role == "admin")
        {
            return view('user.multiuser', compact('admin', 'adoptedChart', 'rescuedChart', 'clinicChart'));
        }
        else
        {
            return view('user.multiuser', compact('query', 'animal_condition', 'profile'));
        }
    }
}
