<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\InvoiceSetting;

class InvoiceSettingController extends Controller
{
    //

    public function index(){

        return view('invoice/index');
    }

    public function create(){
        $branches = Branch::get();
        return view('invoice/create',compact('branches')); 
    }

    public function store(Request $request){

        $invoice = new InvoiceSetting();
        $invoice->name = $request->name;
        $invoice->branch_id = $request->branch;
        $invoice->content = $request->content;
        $invoice->status = 1;
        $invoice->save();
        return redirect()->back()->with('success', __('Invoice Has been Successful..'));

    }
}
