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
        ->select('order_product.product_id','products.product_name','products.product_price', DB::raw('SUM(order_product.product_amount) AS sale_amount'),DB::raw('SUM(order_product.product_amount*products.product_price) AS total'))
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->join('orders', 'orders.id', '=', 'order_product.order_id')
        ->where('orders.order_date','<',$currentDate)
        ->where('orders.order_date','>', $previousDate)
        ->groupBy('order_product.product_id','products.product_name','products.product_price');
        
        if( str_contains(url()->full(),'sale-amount-asc') ) {
            $reportList=$reportList->orderBy('sale_amount')->get();
        } else

        if( str_contains(url()->full(),'sale-amount-desc') ){
            $reportList=$reportList->orderByDesc('sale_amount')->get();
        } else
        

        if( str_contains(url()->full(),'revenue-asc') ) {
            $reportList=$reportList->orderBy('total')->get();
        } else

        if( str_contains(url()->full(),'revenue-desc') ) {
            $reportList=$reportList->orderByDesc('total')->get();
        }
        else {
            $reportList=$reportList->get();
        }

        return $reportList;
   }
//    select order_product.product_id, products.product_name, products.product_price, SUM(order_product.product_amount) AS sale_amount from order_product inner join products on order_product.product_id = products.id inner join orders on orders.id = order_product.order_id where orders.order_date < 2022-08-19 and orders.ordxer_date > 2022-07-20 group by order_product.product_id, products.product_name, products.product_price

    public function getDataForLineChart($filters=[]){
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
        ->select('order_product.product_id','products.product_name','products.product_price', 'categories.category_name', DB::raw('SUM(order_product.product_amount) AS sale_amount'))
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->groupBy('order_product.product_id','products.product_name','products.product_price', 'categories.category_name')
        ->orderBy('sale_amount','desc') 
        ->get();
        return $reportList;
    }

    public function getCategoryBestSeller($filters=[]){
        $reportList=DB::table('order_product')
        ->select('categories.id','categories.category_name', DB::raw('SUM(order_product.product_amount) AS sale_amount'))
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->groupBy('categories.id','categories.category_name')
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


