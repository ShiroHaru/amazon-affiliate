<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $controller = [
            'name' => 'product',
            'name_ja' => '商品',
        ];
        view()->share(compact('controller'));
    }

    public function index()
    {
        $action = ['name_ja' => '一覧', 'name' => 'list'];
        //全ての情報を取得
        $products = Product::all();

        $products = Product::with('categories')->get();

        return view('admin.products.index', compact('action', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = ['name_ja' => '作成', 'name' => 'create'];
        //投稿画面表示
        return view('admin.products.create', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //投稿内容保存処理
        $product = new Product();
        $product->fill($request->all())->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $action = ['name_ja' => '詳細', 'name' => 'show'];
        //詳細画面
        return view('admin.products.show', compact('action', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product)
    {
        $action = ['name_ja' => '編集', 'name' => 'edit'];

        $product = Product::with('categories')->find($product->id);




        //categoryとそれに紐づく中間テーブルをまとめて取得
        $categories = Category::withDepth()->defaultOrder() //categoriesを全て取得
            ->leftJoin('category_product', function ($join) use ($product) { //categoryに紐づく中間テーブルを取得、useで無名関数に引数を渡す
                $join->on('categories.id', '=', 'category_product.category_id') //joinの条件はcategory_idと紐づいている中間テーブル
                    ->where('category_product.product_id', '=', $product->id); //更に中間テーブルはproduct_idが一致しているもの
            })->get(['categories.*', 'category_product.category_id']); //取得カラムの絞り込み、joinで2つのテーブルのidやupdateがかぶるとnullになるので、categoriesは全て、中間テーブルは必要なもののカラムに絞る

        //編集画面
        return view('admin.products.edit', compact('action', 'product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {

        $category_ids = $request->category_ids;

        //フォームで中間テーブのチェックボックスが全て入っていない場合NULLが来てクエリビルダでエラーとなるので、その場合空の配列をセットする。
        !$category_ids ? $category_ids = [] : '';

        //中間テーブル削除用、productに紐づく中間テーブルを取得して、フォームでチェックが入っていない(=削除する)中間テーブルのcategory_idを取得して削除用とする
        $category_products_category_ids = DB::table('category_product') // 中間テーブルの取得
            ->where('product_id', '=', $product->id) // その中でproductに紐づく中間テーブルを全て取得
            ->whereNotIn('category_id', $category_ids) //その中からフォームでチェックが入っている中間テーブルを除外
            ->pluck('category_id')->toArray(); //pluckでcategory_idだけを取得して、toArrayで配列にする。

        //フォームからチェックがついていない中間テーブルを削除
        $product->categories()->detach($category_products_category_ids);

        //チェックがついている中間テーブルの作成、すでに作られているものは新たに作られない
        if (isset($category_ids)) {
            $product->categories()->syncWithoutDetaching($category_ids);
        }

        //更新処理
        if ($product->fill($request->all())->save()) {
            session()->flash('message.success', '更新しました');
        } else {
            session()->flash('message.danger', '更新に失敗しました');
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //削除処理
        if ($product->delete()) {
            session()->flash('message.success', '削除しました');
        } else {
            session()->flash('message.danger', '削除に失敗しました');
        }
        return redirect()->route('products.index');
    }
}
