<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class LadyController extends Controller
{
    public function index($pageNum = 1) {
        
        $totalCount = DB::table('tbd_goods')->count();
        //echo $totalCount;
        $pageSize = 5;
        $totalPage = ceil($totalCount/$pageSize);
        //echo $totalPage;
        $startIndex = ($pageNum - 1) * $pageSize;
        
        $showPage = 5;
        $pageOffset = ($showPage - 1)/2;
        
        $start = 1;
        $end = $totalPage;
        
        if($totalPage > $showPage) {
            
            if($pageNum > $pageOffset) {
                $start = $pageNum - $pageOffset;
                $end = ($totalPage > $pageNum + $pageOffset) ? ($pageNum + $pageOffset) : $totalPage;
            } else {
                $start = 1;
                $end = $totalPage > $showPage ? $showPage : $totalPage;
            }
            if($pageNum + $pageOffset > $totalPage) {
                $start = $start - ($pageNum + $pageOffset - $end);
            }
            
        }
        
        $goods = DB::select(" SELECT * FROM tbd_goods LIMIT $startIndex, $pageSize ");
        return view('lady', ['goods' => $goods, 'pageNum' => $pageNum, 'totalPage' => $totalPage, 
            'showPage' => $showPage, 'pageOffset' => $pageOffset, 'start'=> $start, 'end' => $end]);
    }
    
    public function search(Request $request) {
        
        $kw = $request->input('keywords');
        $goods = DB::select(" SELECT * FROM tbd_goods WHERE goods_name LIKE '%$kw%' ");
        return view('lady', ['goods' => $goods, 'kw' => $kw]);
        
    }
    
    public function store(Request $request) {
        
        $goodsId = $request->input('goods_id');
        $goodsName = $request->input('goods_name');
        $goodsPrice = $request->input('goods_price');
        
        if($goodsId) {
            DB::update(' UPDATE tbd_goods SET goods_name = ?, goods_price = ? WHERE id = ? ', [$goodsName, $goodsPrice, $goodsId]);
        } else {
            DB::insert(" INSERT INTO tbd_goods(goods_name, goods_price) VALUES(?, ?) ", [$goodsName, $goodsPrice]);
        }
    }
    
    public function delete($id) {
        $goods = DB::delete(" DELETE FROM tbd_goods WHERE id = ? ", [$id]);
        return redirect('lady');
    }
       
}