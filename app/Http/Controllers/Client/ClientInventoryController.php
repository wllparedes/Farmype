<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Services\ClientInventoryService;
use Illuminate\Http\Request;

class ClientInventoryController extends Controller
{
    protected $clientInventoryService;

    public function __construct(ClientInventoryService $service)
    {
        $this->clientInventoryService = $service;
    }

    public function index(Request $request)
    {
        return $this->clientInventoryService->getProducts($request);
    }

    public function view(Product $product, Request $request)
    {
        return $this->clientInventoryService->getView($product, $request);
    }

    public function add(Inventory $inventory)
    {

        return $this->clientInventoryService->addInventoryOnList($inventory);

    }

    public function delete(Inventory $inventory)
    {
        return $this->clientInventoryService->deleteInventoryOnList($inventory);
    }

}

