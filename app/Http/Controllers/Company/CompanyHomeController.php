<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Sale;
use Auth;
use Illuminate\Http\Request;
use DB;

class CompanyHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {

        $user = Auth::user();

        $user->load('location');

        $discountCoupions = $user->discountCoupions()->select('id', 'uses')->sum('uses');

        $sales = $user->sales()->count();
        $salesMoney = $user->sales()->select('total')->sum('total');
        $countInventoriesSales = $user->sales()->withCount('inventories')->get()->sum('inventories_count');

        $topProducts = $user->sales()->with(['inventories', 'inventories.product'])
            ->get()
            ->flatMap(function ($sale) {
                return $sale->inventories;
            })
            ->groupBy('id')
            ->map(function ($inventories) {
                // Suma las cantidades de la tabla pivot para cada inventario
                return $inventories->sum('pivot.quantity');
            })
            ->sortDesc() // Ordena los productos por cantidad vendida en orden descendente
            ->take(4); // Toma los 3 productos más vendidos
        $topSellingData = $topProducts
            ->mapWithKeys(function ($quantity, $inventoryId) {
                $inventory = Inventory::find($inventoryId);
                return [$inventory->product->name => $quantity];
            });


        return view('company.home', compact('discountCoupions', 'sales', 'salesMoney', 'countInventoriesSales', 'topSellingData', 'user'));
    }


    public function getSalesCount()
    {
        $user = Auth::user();
        $ventasPorMes = $user->sales()->select(
            DB::raw('COUNT(*) as numero_ventas'),
            DB::raw('MONTH(created_at) as mes')
        )
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        $labels = [];
        $data = [];

        foreach ($ventasPorMes as $venta) {
            $labels[] = date('M', mktime(0, 0, 0, $venta->mes, 1));
            $data[] = $venta->numero_ventas;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => "Sales",
                    'data' => $data,
                ],
            ],
        ];
    }


    public function getSalesMoney()
    {
        $user = Auth::user();
        $ventasPorMes = $user->sales()->select(
            DB::raw('SUM(total) as total_ventas'),
            DB::raw('MONTH(created_at) as mes')
        )
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        $labels = [];
        $data = [];

        foreach ($ventasPorMes as $venta) {
            $labels[] = date('M', mktime(0, 0, 0, $venta->mes, 1));
            $data[] = $venta->total_ventas;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => "Sales",
                    'data' => $data,
                ],
            ],
        ];
    }
}
