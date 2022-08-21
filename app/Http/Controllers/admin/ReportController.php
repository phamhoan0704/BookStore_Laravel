<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportFile;

use App\Http\Services\Admin\CategoryService;
use App\Http\Services\Admin\SupplierService;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\Admin\ReportService;

class ReportController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService, ReportService $reportService)
    {
        $this->reportService=$reportService;
        $this->productService=$productService;
    }

    public function index(Request $request){
        $currentDate = Carbon::now()->format('Y-m-d');
        // $previousDate = Carbon::now()->subDays(360)->format('Y-m-d');
        $previousDate = "2022-01-01";
        if(!empty($request->currentDate)) $currentDate=$request->currentDate;
        if(!empty($request->previousDate)) $previousDate=$request->previousDate;
        $lineChart=$this->reportService->getDataForLineChart();
        // dd(Carbon::now()->format('Y-m-d H:i:s'));
        $reportList=$this->reportService->getData($currentDate, $previousDate);
        $total = 0;
        foreach($reportList as $item)
            $total += $item->total;
        // dd($currentDate, $previousDate, $reportList);
        return view('admin.report.index',compact(['reportList','currentDate','previousDate','lineChart','total']));
    }

    public function homepage(){

        $listProductBestSeller=$this->reportService->getListProductBestSeller();
        $listCategoryBestSeller=$this->reportService->getCategoryBestSeller();
        $orderStatus0=$this->reportService->ordersStatus(0);
        $orderStatus1=$this->reportService->ordersStatus(1);
        $orderStatus2=$this->reportService->ordersStatus(2);
        $productSoldOut=$this->reportService->productSoldOut();
        return view('admin.homepage.index',compact(['listProductBestSeller','listCategoryBestSeller','orderStatus0','orderStatus1','orderStatus2','productSoldOut']));
    }
    public function export(Request $request) 
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $previousDate = Carbon::now()->subDays(30)->format('Y-m-d');
        if(!empty($request->currentDate)) $currentDate=$request->currentDate;
        if(!empty($request->previousDate)) $previousDate=$request->previousDate;
        $reportList=$this->reportService->getData($currentDate, $previousDate);
        ob_end_clean();

        ob_start(); //At the very top of your program (first line)
        return Excel::download(new ExportFile($currentDate,$previousDate),"TKDT Tu $previousDate Den $currentDate.xlsx");
        // return Excel::download(new ExportFile($currentDay,$currentMonth,$currentYear,$previousDay,$previousMonth,$previousYear),'report.xlsx');

        // return Excel::download(new ExportFile([$reportList]), 'report.xlsx');
        ob_flush();

    }
}
