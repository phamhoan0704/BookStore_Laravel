<?php
namespace App\Http\Services\Admin;
use Exception;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use app\Models\Cart;
use Illuminate\Support\Facades\DB;

class ReportService{
    protected $table='order_product';

    public function getData($currentDate, $previousDate, $filters=[]){
        $reportList=DB::table('order_product')
        ->select('order_product.product_id','products.product_name','products.product_price', DB::raw('SUM(order_product.product_amount) AS sale_amount'),)
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->join('orders', 'orders.id', '=', 'order_product.order_id')
        ->where('orders.order_date','<',$currentDate)
        ->where('orders.order_date','>', $previousDate)
        ->groupBy('order_product.product_id','products.product_name','products.product_price')
        ->get();
        return $reportList;
   }

    public function getDataForHomepage($filters=[]){
        $reportList=DB::table('order_product')
        ->select(DB::raw('month(orders.order_date) AS sale_amount'), DB::raw('SUM(order_product.product_price*order_product.product_amount) AS total'),)
        ->join('orders', 'orders.id', '=', 'order_product.order_id')
        ->whereYear('orders.order_date','=','2022')
        ->groupBy('sale_amount')
        ->orderBy('sale_amount')
        ->get();
        // dd($reportList);
        return $reportList;
    }

    public function getListProductBestSeller($filters=[]){
        $reportList=DB::table('order_product')
        ->select('order_product.product_id','products.product_name','products.product_price', DB::raw('SUM(order_product.product_amount) AS sale_amount'))
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->groupBy('order_product.product_id','products.product_name','products.product_price')
        ->orderBy('sale_amount','desc') 
        ->get();
        return $reportList;
    }

    public function ordersStatus($status, $filters=[]){
        $reportList=DB::table('orders')
        ->select('id')
        ->where('order_status',$status)
        ->get();
        return $reportList;
    }

    public function productSoldOut($filters=[]){
        $reportList=DB::table('products')
        ->select('id')
        ->where('product_quantity','0')
        ->get();
        return $reportList;
    }
   
}
?>


