<?php

namespace App\Services;

use App\Models\Promotion;
use Yajra\DataTables\DataTables;
use Auth;


class CompanyPromotionService
{

    public function getDatatable()
    {
        $user = Auth::user();

        $promotions = $user->promotions()
            ->with(['products',
                'file' => fn($sq3) =>
                    $sq3->where('file_type', 'imagenes')
                        ->where('category', 'promotions')
            ])
            ->get();

        return DataTables::of($promotions)
            ->addColumn('id', function ($promotion) {
                return $promotion->id;
            })
            ->addColumn('number_promotion', function ($promotion) {
                return $promotion->number_promotion;
            })
            ->addColumn('price', function ($promotion) {
                return 'S/. ' . $promotion->price;
            })
            ->addColumn('stock', function ($promotion) {
                return $promotion->stock;
            })
            ->addColumn('date_start', function ($promotion) {
                return dateFormal($promotion->date_start);
            })
            ->addColumn('date_end', function ($promotion) {
                return dateFormal($promotion->date_end);
            })
            ->addColumn('products', function ($promotion) {

                $ul = '<ul>';
                foreach ($promotion->products as $product) {
                    $ul .= '<li>' . $product->name . '</li>';
                }

                $ul .= '</ul>';
                return $ul;

            })
            ->addColumn('image', function ($promotion) {

                return '<img src="' . verifyImage($promotion->file) . '" width="80px" height="80px">';

            })
            ->addColumn('action', function ($promotion) {

                $btnPublish = '<button class="btn btn-sm btn-success publish" data-id="' . $promotion->id . '"> <i class="fas fa-upload"></i></button>';
                $btnDispublish = '<button class="btn btn-sm btn-warning dispublish" data-id="' . $promotion->id . '"> <i class="fas fa-upload"></i></button>';

                $button = $promotion->status == 0 ? $btnPublish : $btnDispublish;

                return '
                    <div class="btn-group">
                        ' .  $button . '
                            &nbsp;
                        <button class="btn btn-sm btn-danger" data-id="' . $promotion->id . '"> <i class="fas fa-trash"></i></button>
                    </div>
                ';
                
            })
            ->rawColumns(['products', 'image', 'action'])
            ->make(true);

    }

}

