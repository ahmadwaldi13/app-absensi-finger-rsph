<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

class ApiReportData extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    function reportStokObat(Request $request) 
    {
        if ($request->start) {
            $start = $request->start;
            $end = $request->end;
            $data = $this->reportService->getReportStokObat($start,$end);
            $rowTotal = count($data);
            $realTotal = 0;
            $hilangTotal = 0;
            $lebihTotal = 0;
            // foreach ($data as $report ) {
            //     $realTotal = $realTotal + $report->totalreal;
            //     $hilangTotal = $hilangTotal + $report->nomihilang;
            //     $lebihTotal = $lebihTotal + $report->nomilebih;
            // }
            
            return $this->sendSuccess($this->reportService->getReportStokObat($start, $end,
                [
                    "data" => $data,
                    "rowTotal" => $rowTotal,
                    "realTotal" => $realTotal,
                    "hilangTotal" => $hilangTotal,
                    "lebihTotal" => $lebihTotal,
                    "nonMedis" => false,
                    "title" => "TRANSAKSI STOK OPNAME"
                ]
                ), "Success");
        }
        return "error";
    }

    function reportNonMedis(Request $request) 
    {
        if ($request->start) {
            $start = $request->start;
            $end = $request->end;
            $data = $this->reportService->getReportNonMedis($start,$end);
            $rowTotal = count($data);
            $realTotal = 0;
            $hilangTotal = 0;
            $lebihTotal = 0;
            // foreach ($data as $report ) {
            //     $realTotal = $realTotal + $report->totalreal;
            //     $hilangTotal = $hilangTotal + $report->nomihilang;
            //     $lebihTotal = $lebihTotal + $report->nomilebih;
            // }
            // return $this->sendSuccess(str_replace('"',"'",view('excel/excel_stok_opname',[
            return $this->sendSuccess($this->reportService->getReportNonMedis($start, $end, [
                "data" => $data,
                "rowTotal" => $rowTotal,
                "realTotal" => $realTotal,
                "hilangTotal" => $hilangTotal,
                "lebihTotal" => $lebihTotal,
                "nonMedis" => true,
                "title" => "TRANSAKSI STOK OPNAME NON MEDIS, PENUNJANG LAB & RADIOLOGI"
            ]), "Success");
        }
        return "error";
    }
}
