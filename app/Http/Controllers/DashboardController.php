<?php

namespace App\Http\Controllers;

use App\Models\Advocate;
use App\Models\Cases;
use App\Models\Document;
use App\Models\Hearing;
use App\Models\Order;

use App\Models\ToDo;
use App\Models\User;
use App\Models\Utility;
Use App\Models\Branch;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        
        if (Auth::check()) {
            if (Auth::user()->can('show dashboard') ) {
                Artisan::call('optimize:clear');
                $hearings = Hearing::with('case')
                            ->where('created_by', Auth::user()->creatorId())
                            ->orderBy('date', 'ASC')
                            ->get();          
                $advocate = Advocate::where('created_by', Auth::user()->creatorId())->get();
                // $members = User::where('created_by', Auth::user()->creatorId())->get();
                $members = User::where('type','!=','client')
                    ->where(function($query) {$query->where('created_by',Auth::user()->creatorId())->orWhere('id',Auth::user()->creatorId());
                    })->get();
                $todos = ToDo::where('created_by', Auth::user()->creatorId())->orderBy('start_date','ASC')->get();
                $docs = Document::where('created_by', Auth::user()->creatorId())->get();
                $cases = Cases::where('created_by',Auth::user()->creatorId())->count();

                $upcoming_case = [];
                
                foreach ($hearings as $key => $value) {
                    if (strtotime($value->date) > strtotime(date('Y-m-d'))) {
                        $upcoming_case[$key]['title'] = $value->case->title;
                        $upcoming_case[$key]['upcoming_case'] = $value->date;
                    }
                }

                $curr_time = strtotime(date("Y-m-d h:i:s"));

                // UPCOMING
                $upcoming_todo = [];
                $todayTodos = [];
                
                foreach ($todos as $key => $utd) {
                    $start_date = strtotime($utd->start_date);
                    if ($start_date > $curr_time && $utd->status == 1) {

                        $upcoming_todo[$key]['description'] = $utd->description;
                        $upcoming_todo[$key]['start_date'] = $utd->start_date;

                    }

                    $due = explode(' ', $utd->start_date);

                    if ($due[0] == date('Y-m-d')) {

                        $todayTodos[$key]['description'] = $utd['description'];
                        $todayTodos[$key]['start_date'] = $utd['start_date'];
                        $todayTodos[$key]['assign_to'] = $utd['assign_to'];
                        $todayTodos[$key]['assign_by'] = $utd['assign_by'];
                        $todayTodos[$key]['relate_to'] = $utd['relate_to'];
                    }

                }

                $todayHear = Hearing::where('created_by', Auth::user()->creatorId())->where('date',date('Y-m-d'))->get();
                $hearings = Hearing::where('created_by', Auth::user()->creatorId())->where('date',date('Y-m-d'))->pluck('case_id')->toArray();
                $todatCases = Cases::where('created_by',Auth::user()->creatorId())->whereIn('id',$hearings)->get();

                $users = User::find(\Auth::user()->creatorId());

                return view('dashboard', compact('upcoming_case', 'cases', 'upcoming_todo', 'advocate', 'members', 'todos',  'docs', 'todatCases', 'todayTodos','users','todayHear'));

            } elseif (Auth::user()->can('manage super admin dashboard') || Auth::user()->super_admin_employee==1) {

                $user = Auth::user();
                $branchs = Branch::get();
                
                $branch_id = request('branch_id');
                // $advocate = Advocate::join('users','advocates.user_id','=','users.id')->select('advocates.*','users.branch_id');
                // if(request()->has('branch_id')){
                //      $advocate->where('users.branch_id',$branch_id);
                // }
                // $advocate = $advocate->get();

               $advocate =Advocate::select('*');
               $cases = Cases::select('*');

               $members = User::where('type','!=','client');
                    // ->where(function($query) {$query->where('created_by',Auth::user()->creatorId())->orWhere('id',Auth::user()->creatorId());
                    // });
                
               if(request()->has('branch_id') &&  !empty($branch_id)){
                     $advocate->where('branch_id',$branch_id);
                     $cases->where('branch_id', $branch_id);
                     $members->where('users.branch_id', $branch_id);
                }
             
                $advocate = $advocate->get();
                $cases = $cases->count();
                $members = $members->get();
                // $members = User::where('created_by', Auth::user()->creatorId())->get();

                
                $todos = ToDo::orderBy('start_date','ASC')->get();
                $docs = Document::get();
                
              
                return view('admin_dash', compact('user','branchs','advocate','members','todos','docs','cases','branch_id'));
            } else {

                return redirect()->back()->with('error', __('Permission Denied.'));
            }
        } else {
                $settings = Utility::settings();
                return redirect('login');
        }
    }

    public function getOrderChart($arrParam)
    {
        $arrDuration = [];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'week') {
                $previous_week = strtotime("-2 week +1 day");
                for ($i = 0; $i < 14; $i++) {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }

        $arrTask = [];
        $arrTask['label'] = [];
        $arrTask['data'] = [];
        foreach ($arrDuration as $date => $label) {

            $data = Order::select(DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][] = $data->total;
        }

        return $arrTask;
    }
}
