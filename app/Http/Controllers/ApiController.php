<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{

    public function _sales(Request $request)
    {

        $limit = $request->limit ?? 5;

        $paginator = Sale::whereHas('user', function ($query) {
            $query->where('role', 'company');
        })
            ->with([
                'user:id,names_surnames',
                'inventories:id,price,product_id',
                'inventories.product:id,name'
            ])
            ->paginate($limit);

        $sales = $paginator->getCollection()
            ->flatMap(function ($sale) {
                return $sale->inventories->map(function ($inventory) use ($sale) {
                    return [
                        'company_id' => $sale->user->id,
                        'company' => $sale->user->names_surnames,
                        'product_id' => $inventory->product_id,
                        'product_name' => $inventory->product->name,
                        'subtotal' => $inventory->pivot->subtotal,
                    ];
                });
            });

        return response()->json([
            'page' => $paginator->currentPage(),
            'next' => $paginator->hasMorePages(),
            'sales' => $sales
        ]);
    }

    public function _products(Request $request)
    {
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 1000;
        $skip = ($page - 1) * $limit;

        $products = Product::skip($skip)
            ->take($limit)
            ->select('id', 'name', 'detail')
            ->get();

        $totalProducts = Product::count();

        return response()->json([
            'page' => $page,
            'next' => ($skip + $limit) < $totalProducts,
            'products' => $products
        ]);
    }

    public function _companies(Request $request)
    {
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 1000;
        $skip = ($page - 1) * $limit;

        $users = User::where('role', 'company')
            ->skip($skip)
            ->take($limit)
            ->select('id', 'names_surnames')
            ->get();

        $totalUsers = User::count();

        return response()->json([
            'page' => $page,
            'next' => ($skip + $limit) < $totalUsers,
            'companies' => $users
        ]);
    }
}
