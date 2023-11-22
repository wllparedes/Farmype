<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Services\CompanyInventoryService;
use App\Services\ProductService;
use Auth;
use Exception;
use Illuminate\Http\Request;

class CompanyInventoryController extends Controller
{
    private $companyInventoryService;

    public function __construct(CompanyInventoryService $service)
    {
        $this->companyInventoryService = $service;
    }

    public function index(Request $request)
    {

        $inventories = $this->companyInventoryService->getInventories();

        if ($request->ajax()) {

            $inventories = view('company.products.render.query-inventories', compact('inventories'))->render();

            return [
                'html' => $inventories
            ];

        }
        return view('company.products.index', compact('inventories'));
    }


    public function create()
    {

        $products = Product::all();
        return view('company.products.create-inventory', compact('products'));

    }

    public function store(Request $request)
    {

        return $this->companyInventoryService->createInventory($request);

    }

    public function edit(Inventory $inventory)
    {

        return $this->companyInventoryService->editInventory($inventory);

    }

    public function update(Request $request, Inventory $inventory)
    {

        return $this->companyInventoryService->updateInventory($request, $inventory);

    }

    public function destroy(Inventory $inventory)
    {

        try {
            $inventory->delete();
            $message = "Producto eliminado correctamente";
            $success = true;
        } catch (Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'message' => $message,
            'success' => $success
        ]);

    }
}
