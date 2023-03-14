<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Services\ReportService;
class ApiReport extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    function reportRegistToday(Request $request) {
        if ($request->start) {
            $start = $request->start;
            $dataReport = new \stdClass;
            $dataReport->date = $start;
            
            $dataReport->totalPasien = $this->reportService->getTotalPasien();
            $dataReport->today = $this->reportService->getListReportToday($start);
            $dataReport->totalToday = $dataReport->today[0]->jumlah+$dataReport->today[1]->jumlah;
            
            return $this->sendSuccess($dataReport, "Success");
        }
        return "error";
    }

    function reportRegistPoli(Request $request) {
        if ($request->start) {
            $start = $request->start;
            $end = $request->end;
            return $this->sendSuccess($this->reportService->getListReportPoli($start, $end), "Success");
        }
        return "error";
    }

    function reportRegistMonth(Request $request) {
        if ($request->start) {
            $start = $request->start;
            $end = $request->end;
            return $this->sendSuccess($this->reportService->getListReportRegistMonth($start, $end), "Success");
        }
        return "error";
        
    }
    function reportRegistYear(Request $request) {
        if ($request->start) {
            $start = $request->start;
            $end = $request->end;
            return $this->sendSuccess($this->reportService->getListReportRegistYear($start, $end), "Success");
        }
        return "error";
        
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
            foreach ($data as $report ) {
                $realTotal = $realTotal + $report->totalreal;
                $hilangTotal = $hilangTotal + $report->nomihilang;
                $lebihTotal = $lebihTotal + $report->nomilebih;
            }
            
            return $this->sendSuccess(str_replace('"',"'",view('pdf/pdf_stok_opname', [
                "data" => $data,
                "rowTotal" => $rowTotal,
                "realTotal" => $realTotal,
                "hilangTotal" => $hilangTotal,
                "lebihTotal" => $lebihTotal,
                "nonMedis" => false,
                "title" => "TRANSAKSI STOK OPNAME"
            ])->render()), "Success");

            $pdf = PDF::loadView('pdf/pdf_stok_opname', [
                "data" => $data,
                "rowTotal" => $rowTotal,
                "realTotal" => $realTotal,
                "hilangTotal" => $hilangTotal,
                "lebihTotal" => $lebihTotal,
                "nonMedis" => false,
                "title" => "TRANSAKSI STOK OPNAME"
            ])->setPaper('a4', 'landscape');
            return $pdf->download('itsolutionstuff.pdf');
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
            foreach ($data as $report ) {
                $realTotal = $realTotal + $report->totalreal;
                $hilangTotal = $hilangTotal + $report->nomihilang;
                $lebihTotal = $lebihTotal + $report->nomilebih;
            }
            return $this->sendSuccess(str_replace('"',"'",view('pdf/pdf_stok_opname',[
                "data" => $data,
                "rowTotal" => $rowTotal,
                "realTotal" => $realTotal,
                "hilangTotal" => $hilangTotal,
                "lebihTotal" => $lebihTotal,
                "nonMedis" => true,
                "title" => "TRANSAKSI STOK OPNAME NON MEDIS, PENUNJANG LAB & RADIOLOGI"
            ])->render()), "Success");
         
            $pdf = PDF::loadView('pdf/pdf_stok_opname', [
                "data" => $data,
                "rowTotal" => $rowTotal,
                "realTotal" => $realTotal,
                "hilangTotal" => $hilangTotal,
                "lebihTotal" => $lebihTotal,
                "nonMedis" => true,
                "title" => "TRANSAKSI STOK OPNAME NON MEDIS, PENUNJANG LAB & RADIOLOGI"
            ])->setPaper('a4', 'landscape');
            return $pdf->download('itsolutionstuff.pdf');
        }
        return "error";
    }
    
}
