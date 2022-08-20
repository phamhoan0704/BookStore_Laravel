<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use app\Models\Cart;
use app\Models\Category;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\Http\Services\Admin\ReportService;

// class ExportFile implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Product::all();
//     }

//     public function headings(): array {
//         return [
//             'ID',
//             'Name',
//             'Price',    
//             "Amout",
//             "Revenue"
            
//         ];
//     }
 
//     public function map($item): array {
//         return [
//             $item->product_id,
//             $item->product_name,
//             $item->product_price,
//             $item->sale_amout,
//             $item->$item->product_price,
//         ];
//     }

// }

class ExportFile implements FromQuery
{
    use Exportable;
 
    public function __construct( $currentDate, $previousDate)
    {
        $this->currentDate = $currentDate;
        $this->previousDate = $previousDate;
    }
        
 
    public function query()
    {
        $currentDate = "$this->currentDate";
        $previousDate = "$this->previousDate";
        $currentDate = Carbon::now()->format('Y-m-d');
        $previousDate = Carbon::now()->subDays(30)->format('Y-m-d');
        // dd($currentDate);
        //return User::query()->whereYear('created_at', $this->year);
        return Product::query()
        ->select('order_product.product_id','products.product_name','products.product_price', DB::raw('SUM(order_product.product_amount) AS sale_amount'),DB::raw('SUM(order_product.product_amount*products.product_price) AS total'))
        ->join('order_product', 'order_product.product_id', '=', 'products.id')
        ->join('orders', 'orders.id', '=', 'order_product.order_id')
        ->where('orders.order_date','<',$currentDate)
        ->where('orders.order_date','>',$previousDate)
        ->groupBy('order_product.product_id','products.product_name','products.product_price');
    }
}

// class ExportFile implements FromArray
// {
//     // use RegistersEventListeners;
//     /**
//     * @return \Illuminate\Support\Collection
//     */

//     public $points;

//     public function __construct(array $points)
//     {
//         $this->points = $points;
//     }

//     public function array(): array
//     {
//         return $this->points[0];
//     }
    
    // use Exportable;
 
    // public function __construct( $currentDate, $previousDate)
    // {
    //     $this->currentDate = $currentDate;
    //     $this->previousDate = $previousDate;
    // }
 
    // public function query()
    // {
    //     $currentDate = $this->currentDate;
    //     $previousDate = $this->previousDate;
    //     dd($currentDate);
    //     //return User::query()->whereYear('created_at', $this->year);
    //     return Product::query()
    //     ->select('order_product.product_id','products.product_name','products.product_price', DB::raw('SUM(order_product.product_amount) AS sale_amount'),)
    //     ->join('order_prodduct', 'order_product.product_id', '=', 'products.id')
    //     ->join('orders', 'orders.id', '=', 'order_product.order_id')
    //     ->where('orders.order_date','<',$this->currentDate)
    //     ->where('orders.order_date','>',$this->previousDate)
    //     ->groupBy('order_product.product_id','products.product_name','products.product_price')
    //     ->get();
    // }
// }