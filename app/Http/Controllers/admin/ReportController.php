<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $previousDate = Carbon::now()->subDays(30)->format('Y-m-d');
        if(!empty($request->currentDate)) $currentDate=$request->currentDate;
        if(!empty($request->previousDate)) $previousDate=$request->previousDate;
        $homepageList=$this->reportService->getDataForHomepage();
        
        $reportList=$this->reportService->getData($currentDate, $previousDate);
        $total = 0;
        foreach($reportList as $item)
            $total += $item->product_price;
        // dd($currentDate, $previousDate, $reportList);
        return view('admin.report.index',compact(['reportList','currentDate','previousDate','homepageList','total']));
    }

    public function homepage(){

        $homepageList=$this->reportService->getDataForHomepage();
        $listProductBestSeller=$this->reportService->getListProductBestSeller();
        $orderStatus0=$this->reportService->ordersStatus(0);
        $orderStatus1=$this->reportService->ordersStatus(1);
        $orderStatus2=$this->reportService->ordersStatus(2);
        $productSoldOut=$this->reportService->productSoldOut();
        return view('admin.homepage.index',compact(['homepageList','listProductBestSeller','orderStatus0','orderStatus1','orderStatus2','productSoldOut']));
    }
}
