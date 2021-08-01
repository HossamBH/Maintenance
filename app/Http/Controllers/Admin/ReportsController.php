<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function safe()
    {
        $safes = Report::where('type', '!=', 'purchase_order')->orderBy('created_at', 'DESC')->get();
        $cashIncome = 0;
        $cashOutcome = 0;
        $visaIncome = 0;
        $visaOutcome = 0;
        foreach ($safes as $safe) {
            if ($safe->status == 'in') {

                if ($safe->payment_type == 'cash') {
                    $cashIncome += $safe->amount;
                } else {
                    $visaIncome += $safe->amount;
                }
            } else {

                if ($safe->payment_type == 'cash') {
                    $cashOutcome += $safe->amount;
                } else {
                    $visaOutcome += $safe->amount;
                }
            }
        }
        $cashSafe = $cashIncome - $cashOutcome;
        $visaSafe = $visaIncome - $visaOutcome;
        $currentSafe = $cashIncome + $visaIncome - $cashOutcome - $visaOutcome;
        return view('Admin.Reports.safe', compact('safes', 'currentSafe', 'cashSafe', 'visaSafe'));
    }
    public function profits()
    {
        $total_in = 0;
        $total_out = 0;
        $reports = Report::where('type', '!=', 'purchase_order')->get();
        foreach ($reports as  $value) {
            if ($value->status == 'in') {
                $total_in += $value->amount;
            }
            if ($value->status == 'out') {
                $total_out += $value->amount;
            }
            $total = $total_in - $total_out;
        }
        return view('Admin.Reports.profit', compact('reports', 'total'));
    }
}
