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
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class ExportFile implements 
    FromQuery, 
    ShouldAutoSize, 
    WithHeadings,
    WithEvents
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
        // $currentDate = Carbon::now()->format('Y-m-d');
        // $previousDate = Carbon::now()->subDays(30)->format('Y-m-d');
        // dd($currentDate);
        //return User::query()->whereYear('created_at', $this->year);
        return Product::query()
        ->select('order_product.product_id','products.product_name','products.product_price', DB::raw('SUM(order_product.product_amount) AS sale_amount'),DB::raw('SUM(order_product.product_amount*products.product_price) AS total'))
        ->join('order_product', 'order_product.product_id', '=', 'products.id')
        ->join('orders', 'orders.id', '=', 'order_product.order_id')
        ->where('orders.order_date','<',$currentDate)
        ->where('orders.order_status','=', '3')
        ->where('orders.order_date','>',$previousDate)
        ->groupBy('order_product.product_id','products.product_name','products.product_price');
    }

    public function headings(): array
    {
        return [
            'Mã sản phẩm',
            'Tên sản phẩm',
            'Giá Bán',
            'Số lượng',
            'Doanh Thu',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:E1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
                
            }
        ];
    }

}
