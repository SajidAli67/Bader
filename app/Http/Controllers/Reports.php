<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Branch;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Reports extends Controller
{
    //

    public function income_vs_expernse(){

        $totalIncome =Bill::where('status', '!=', 'PENDING')
        ->select(DB::raw('SUM(total_amount - due_amount) as total'))
        ->first();
        $totalExpense =Expense::select(DB::raw('SUM(money) as total'))
        ->first();

        $invoices =Bill::where('status', '!=', 'PENDING')
        ->get();
        

        $branchs = Branch::get();

        
       
        return view('reports/incomeVsexpense',compact('branchs','totalIncome','totalExpense','invoices'));
    }
}
