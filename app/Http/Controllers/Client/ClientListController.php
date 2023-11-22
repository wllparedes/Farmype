<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Services\ClientListService;
use Illuminate\Http\Request;


class ClientListController extends Controller
{
    protected $clientListService;

    public function __construct(ClientListService $service)
    {
        $this->clientListService = $service;
    }

    public function index(Request $request)
    {
        return $this->clientListService->getInventoryOnList($request);
    }

    public function subtractCuantity(Inventory $inventory)
    {
        return $this->clientListService->subtractCuantity($inventory);
    }

    public function addCuantity(Inventory $inventory)
    {
        return $this->clientListService->addCuantity($inventory);
    }

    public function deleteInventoryOfList(Inventory $inventory)
    {
        
        return $this->clientListService->deleteInventoryOfList($inventory);

    }


}
