<?php

namespace App\Services;

use Yajra\DataTables\DataTables;
use Auth;

class CompanySaleService
{

    public function getDatatable()
    {

        $user = Auth::user();

        $sales = $user->sales()->with(['client:id,names_surnames'])->get();

        return DataTables::of($sales)
            ->addColumn('id', function ($sale) {
                return $sale->id;
            })
            ->addColumn('operation_number_sale', function ($sale) {
                return $sale->operation_number_sale;
            })
            ->addColumn('client', function ($sale) {
                return $sale->client->names_surnames;
            })
            ->addColumn('discount', function ($sale) {
                return $sale->discount ? '<span class="badge badge-lg badge-danger"> -% ' . $sale->discount . '</span>' : 'S.CD';
            })
            ->addColumn('total', function ($sale) {
                return '<span class="badge badge-lg badge-success"> S/. ' . $sale->total . '</span>';
            })
            ->addColumn('time', function ($sale) {
                return timeFormal($sale->created_at);
            })
            ->addColumn('date', function ($sale) {
                return dateFormal($sale->created_at);
            })
            ->addColumn('action', function ($sale) {
                return '<a href="' . route('company.sales.view', $sale) . '" class="btn btn-sm btn-warning"> <i class="fas fa-eye"</i> </a>';
            })
            ->rawColumns(['action', 'discount', 'total'])
            ->make(true);
    }



}



