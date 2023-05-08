<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Animal;
use App\Models\Rescuer;
use App\Models\Adopter;
use App\Models\ShelterPersonnel;
use DB;
use App\Charts\AdoptedChart; 
use App\Charts\ClinicChart; 
use App\Charts\RescuedChart;

class UserController extends Controller
{
    // public function getSignin()
    // {
    //     return view('user.signin');
    // }

    // public function postSignin(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'email| required',
    //         'password' => 'required| min:4'
    //     ]);

    //     if(auth()->attempt(array('email' => $request->email, 'password' => $request->password,'status'=> 0)))
    //     {
    //         if (auth()->user()->role == 'admin') 
    //         {
    //             return redirect()->route('user.dashboard');
    //         } 
    //         elseif (auth()->user()->role == 'employee') 
    //         {
    //             return redirect()->route('user.profile');
    //         } 
    //         elseif (auth()->user()->role == 'rescuer') 
    //         {
    //             return redirect()->route('user.profile');
    //         } 
    //         elseif (auth()->user()->role == 'adopter') 
    //         {
    //             return redirect()->route('user.profile');
    //         } 
    //         else 
    //         {
    //            return redirect()->back();
    //         }
    //     }
    //     else
    //     {
    //         // return redirect()->route('user.signin')->with('error', 'Email-Address Or Password Are Wrong.');
    //         return redirect()->route('user.signin');
    //     }
    // }

    // public function getProfile() 
    // {
    //     $animal_condition = DB::table('animals')->leftJoin('animal_condition', 'animals.id', 'animal_condition.animal_id')->leftJoin('disease_injuries', 'disease_injuries.id', 'animal_condition.disease_injury_id')->select('animal_condition.animal_id', 'animal_condition.disease_injury_id', 'dis_inj')->get();
    //     $user = Auth::user()->role;
    //     if($user == 'employee')
    //     {
    //         $profile = ShelterPersonnel::where('user_id',Auth::id())->first();
    //         $query = Animal::with('shelterpersonnels')->where('personnel_id', $profile->id)->get();
    //     }
    //     elseif($user == 'rescuer')
    //     {
    //         $profile = Rescuer::where('user_id',Auth::id())->first();
    //         $query = Animal::with('rescuers')->where('rescuer_id', $profile->id)->get();

    //     }
    //     elseif($user == 'adopter')
    //     {
    //         $profile = Adopter::where('user_id',Auth::id())->first();
    //         $query = Animal::with('adopters')->where('adopter_id', $profile->id)->get();
    //     }
    //     return view('user.profile', compact('query', 'animal_condition', 'profile'));
    // }

    // public function getDashboard() 
    // {
    //     // $admin = User::find(Auth::id());
    //     // return view('user.dashboard', compact('admin'));
    //     $adate = DB::table('adopters')
    //     ->join('animals','adopters.id','=','adopter_id')
    //     ->select(DB::raw('count(adopters.date_adopted) AS total'), DB::raw('MONTHNAME(adopters.date_adopted) as month'))
    //     ->groupBy('month')
    //     ->pluck(DB::raw('count(month) AS total'), 'month')
    //     ->all();
    //     $adoptedChart = new AdoptedChart;
    //     $dataset = $adoptedChart->labels(array_keys($adate));
    //     $dataset= $adoptedChart->dataset('Adopted Per Month', 'horizontalBar', array_values($adate));
    //     $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
    //     $adoptedChart->options([
    //         'responsive' => true,
    //         'legend' => ['display' => true],
    //         'tooltips' => ['enabled'=>true],
    //         'aspectRatio' => 1,
    //         'scales' => [
    //             'yAxes'=> [[
    //                         'display'=>true,
    //                         'ticks'=> ['beginAtZero'=> true],
    //                         'gridLines'=> ['display'=> true],
    //                       ]],
    //             'xAxes'=> [[
    //                         'categoryPercentage'=> 0.8,
    //                         'barPercentage' => 1,
    //                         'ticks' => ['beginAtZero' => true],
    //                         'gridLines' => ['display' => true],
    //                         'display' => true
    //                       ]],
    //         ],
    //     ]);
    //     $rdate = DB::table('animals')
    //     ->join('rescuers','rescuers.id','=','rescuer_id')
    //     ->select(DB::raw('count(animals.date_rescued) AS total'), DB::raw('MONTHNAME(animals.date_rescued) as month'))
    //     ->groupBy('month')
    //     ->pluck(DB::raw('count(month) AS total'), 'month')
    //     ->all();
    //     $rescuedChart = new RescuedChart;
    //     $dataset = $rescuedChart->labels(array_keys($rdate));
    //     $dataset= $rescuedChart->dataset('Rescued Per Month', 'bar', array_values($rdate));
    //     $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
    //     $rescuedChart->options([
    //         'responsive' => true,
    //         'legend' => ['display' => true],
    //         'tooltips' => ['enabled'=>true],
    //         'aspectRatio' => 1,
    //         'scales' => [
    //             'yAxes'=> [[
    //                         'display'=>true,
    //                         'ticks'=> ['beginAtZero'=> true],
    //                         'gridLines'=> ['display'=> true],
    //                       ]],
    //             'xAxes'=> [[
    //                         'categoryPercentage'=> 0.8,
    //                         'barPercentage' => 1,
    //                         'ticks' => ['beginAtZero' => true],
    //                         'gridLines' => ['display' => true],
    //                         'display' => true
    //                       ]],
    //         ],
    //     ]);
    //     $clinic = DB::table('animals')->leftJoin('animal_condition', 'animals.id', 'animal_condition.animal_id')
    //     ->leftJoin('disease_injuries', 'disease_injuries.id','animal_condition.disease_injury_id')
    //     ->whereNotNull('disease_injuries.id')
    //     ->groupBy('dis_inj')
    //     ->pluck(DB::raw('count(name)'),'dis_inj')
    //     ->all();
    //     $clinicChart = new ClinicChart;
    //     $dataset = $clinicChart->labels(array_keys($clinic));
    //     $dataset= $clinicChart->dataset('Common Diseases/disease_injuries', 'pie', array_values($clinic));
    //     $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
    //     $clinicChart->options([
    //         'responsive' => true,
    //         'legend' => ['display' => true],
    //         'tooltips' => ['enabled'=>true],
    //         'aspectRatio' => 1,
    //         'scales' => [
    //             'yAxes'=> [[
    //                         'display'=>false,
    //                         'ticks'=> ['beginAtZero'=> false],
    //                         'gridLines'=> ['display'=> false],
    //                       ]],
    //             'xAxes'=> [[
    //                         'categoryPercentage'=> 0.8,
    //                         'barPercentage' => 1,
    //                         'ticks' => ['beginAtZero' => false],
    //                         'gridLines' => ['display' => false],
    //                         'display' => false
    //                       ]],
    //         ],
    //     ]);
    //     $admin = User::find(Auth::id());
    //     return view('user.multiuser', compact('admin', 'adoptedChart', 'rescuedChart', 'clinicChart'));
    // }

    public function adminEdit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('user.multiuser')->with('success', 'SAVED');
    }

    // public function getSignup()
    // {
    //     return view('user.signup');
    // }

    // public function postSignup(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'email|required|unique:users',
    //         'password' => 'required|min:4'
    //     ]);

    //     $user = new User([
    //     	'name' => $request->input('fname').' '.$request->lname,
    //         'role' => $request->input('type'),
    //         'email' => $request->input('email'),
    //         'password' => bcrypt($request->input('password'))
    //     ]);
         
    //     $user->save();

    //     if($request->input('type') == 'employee')
    //     {
    //         $employee = new ShelterPersonnel;
    //         $employee->user_id = $user->id;
    //         $employee->p_fname = $request->fname;
    //         $employee->p_lname = $request->lname;
    //         $employee->job_description = 'Employee';
    //         $employee->address = $request->address;
    //         $employee->phone = $request->phone;
    //         $employee->save();
    //     }
    //     elseif($request->input('type') == 'rescuer')
    //     {
    //         $rescuer = new Rescuer;
    //         $rescuer->user_id = $user->id;
    //         $rescuer->r_fname = $request->fname;
    //         $rescuer->r_lname = $request->lname;
    //         $rescuer->address = $request->address;
    //         $rescuer->phone = $request->phone;
    //         $rescuer->save();
    //     }
    //     elseif($request->input('type') == 'adopter')
    //     {
    //         $adopter = new Adopter;
    //         $adopter->user_id = $user->id;
    //         $adopter->a_fname = $request->fname;
    //         $adopter->a_lname = $request->lname;
    //         $adopter->address = $request->address;
    //         $adopter->phone = $request->phone;
    //         $adopter->save();
    //     }

    //     Auth::login($user);
    //     return redirect()->route('user.profile');
    // }

    // public function getLogout()
    // {
    //     Auth::logout();
    //     return redirect()->route('home');
    // }

    public function getUser() 
    {
        $user = DB::table('users')->where('role','<>','admin')->get();
        return view('user.disable', compact('user'));
    }

    public function userBan($id)
    {
        $user = User::find($id);
        if($user->status == 0)
        {
            $user->status = 1;
            $user->save();
        }
        else
        {
            $user->status = 0;
            $user->save();
        }
        return redirect()->back();
    }
}
