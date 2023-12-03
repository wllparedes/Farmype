<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Services\CompanySaleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanySaleController extends Controller
{

    protected $companyService;

    public function __construct(CompanySaleService $service)
    {
        $this->companyService = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            return $this->companyService->getDatatable();

        }else{

            return view('company.sales.index');

        }

    }

    public function view(Sale $sale){
        //
    }


}
