<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractSetting;
use App\Models\Contract;
use App\Models\Branch;
use App\Models\User;
use App\MOdels\UserDetail;
use Google\Service\CloudDomains\ContactSettings;
use Google\Service\ServiceConsumerManagement\Control;
use Illuminate\Support\Facades\Auth;


class ContractController extends Controller
{
    //

    public function index(){
        if (Auth::user()->can('show contract') || Auth::user()->can('manage contract')) {
            $user = Auth::user();
            
            $contracts = Contract::with('client','clientDetail','branch')->where('branch_id',$user->branch_id)->orderBy('id', 'DESC')->get();
            
            return view('contract.index',compact('contracts'));
        }
        else {
            return redirect()->back()->with('error', __('Permission Denied.'));

        }
    }

    public function add(){
        if (Auth::user()->can('create contract') || Auth::user()->can('manage contract')) {
        $branches = Branch::all();
        $clients = User::select('id','name')->where('type','client')->get();
        $points  = json_decode(ContractSetting::find(1)->points);
      
        return view('contract.add',compact('branches','clients','points'));
        }
        else {
            return redirect()->back()->with('error', __('Permission Denied.'));

        } 
    }

    public function store(Request $request){
        if (Auth::user()->can('edit contract') || Auth::user()->can('manage contract')) {

        $points  = json_decode(ContractSetting::find(1)->points);
        $contract = Contract::orderBy('id','Desc')->first();
        $count_id = (!empty($contract)) ? ++$contract->count_id: 1;
        
        foreach ($points as $key=> $point) {
            $input = 'input-'.$key;
            $input2 = 'input-2-'.$key;
            $input3 = 'input-3-'.$key;
        
            $point = str_replace("{{input}}", $request->$input , $point);
            $point = str_replace("{{input-2}}", $request->$input2 , $point);
            $point = str_replace("{{input-3}}", $request->$input3 , $point);
            $points_array[] = $point; 
        }
        
        $contact = new Contract();
        $contact->branch_id = $request->branch;
        $contact->client_id = $request->client;
        $contact->count_id = $count_id;
        $contact->contract_no =sprintf('%05d', $count_id);
        $contact->points = json_encode($points_array);
        $contact->save();

        return redirect()->route('contract')->with('success', __('Contract successfully created.'));
        }
        else {
            return redirect()->back()->with('error', __('Permission Denied.'));

        }

    }

    public function  print($id){
        $user_id = Auth::user();
        $contract = Contract::find($id);
        $branches = Branch::all();
        $client = User::select('id','name')->where('type','client')->where('id',$contract->client_id)->first();
        $clientDetail = Contract::getUserDetail($client->id);
        $points  = json_decode($contract->points);
        $branch_detail = UserDetail::find($user_id->id);

        return view('contract.print',compact('contract','branches','client','points','clientDetail','branch_detail')); 
    }

    public function edit($id){

        if (Auth::user()->can('edit contract') || Auth::user()->can('manage contract')) {

            $contract = Contract::find($id);
            $branches = Branch::all();
            $clients = User::select('id','name')->where('type','client')->get();
            $points  = json_decode($contract->points);
       
        return view('contract.edit',compact('contract','branches','clients','points')); 
        }
        else {
            return redirect()->back()->with('error', __('Permission Denied.'));

        }

    }

    public function update(Request $request){

        if (Auth::user()->can('edit contract') || Auth::user()->can('manage contract')) {

            $points  = json_decode(ContractSetting::find(1)->points);
            $contract = Contract::orderBy('id','Desc')->first();
            $count_id = (!empty($contract)) ? $contract->count_id: 1;
        
            foreach ($points as $key=> $point) {
                $input = 'input-'.$key;
                $input2 = 'input-2-'.$key;
                $input3 = 'input-3-'.$key;
            
                $point = str_replace("{{input}}", $request->$input , $point);
                $point = str_replace("{{input-2}}", $request->$input2 , $point);
                $point = str_replace("{{input-3}}", $request->$input3 , $point);
                $points_array[] = $point;
            
            
            }
            
            $contact = Contract::find($request->id);
            $contact->branch_id = $request->branch;
            $contact->client_id = $request->client;
            $contact->count_id = $count_id;
            $contact->contract_no =sprintf('%04d', $count_id);
            $contact->points = json_encode($points_array);
            $contact->save();

            return redirect()->route('contract')->with('success', __('Contract successfully created.'));
        }
        else {
            return redirect()->back()->with('error', __('Permission Denied.'));

        }

    }

    public function setting(){
        if (Auth::user()->can('manage contract')) {
            $points = json_decode(ContractSetting::find(1)->points);
            $count = (!empty($points)) ?  count($points) : 0;
            return view('contract.setting',compact('points','count'));
        }
        else {
            return redirect()->back()->with('error', __('Permission Denied.'));

        }

    }

    public function settingSave(Request $request){
        if (Auth::user()->can('manage contract')) {
            $setting = ContractSetting::find(1);
            $setting->points = json_encode($request->points);
            $setting->save();
            return redirect()->route('contract.setting')->with('success', __('Member successfully created.'));
        }
        else {
            return redirect()->back()->with('error', __('Permission Denied.'));

        }
    }
}
