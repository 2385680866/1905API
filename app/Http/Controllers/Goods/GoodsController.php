<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;

class GoodsController extends Controller
{
    public function index()
    {
        $goodsInfo=GoodsModel::all()->toarray();
        return view('goods.index',["goodsInfo"=>$goodsInfo]);
    }
    public function create()
    {

    }
}
