<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function show()
    {
//        viewShare();
        return response()->view("admin.financial-report.show");
    }

    public function generateReport()
    {
        $transactions = (new TransactionRepository())
            ->whereMonth("created_at", "=", request()->get("month"))
            ->whereYear("created_at", "=", request()->get("year"))
            ->getAllData();

        if(!$transactions || $transactions->count()===0){
            return redirect()->back()->withErrors(["errors" => "Data transaksi pada bulan tersebut tidak ditemukan"])->withInput();
        }

        $totalDebit = 0;
        $totalCredit = 0;
        foreach ($transactions as $key=>$transaction){
            if($transaction->type === "credit"){
                $totalCredit+=$transaction->amount;
            }
            if($transaction->type === "debit"){
                $totalDebit+=$transaction->amount;
            }
        }

        $pdf = Pdf::loadView('admin.financial-report.report', [
            'total_debit' => $totalDebit,
            'total_credit' => $totalCredit,
            'transactions' => $transactions
        ]);

        return $pdf->stream();
    }
}
