<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $controller = [
            'name' => 'category',
            'name_ja' => 'カテゴリ',
        ];
        view()->share(compact('controller'));
    }

    public function index()
    {
        $action = ['name_ja' => '一覧', 'name' => 'list'];
        //全ての情報を取得
        //$categories = Category::all();
        //$category = Category::get();
        $categories = Category::withDepth()->defaultOrder()->get()->toFlatTree();

        //ツリー構造の$categoriesを再帰的に配列に格納
        $categoriesArray = [];
        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            $used_categories = [];
            foreach ($categories as $category) {
                //used_categoryに格納されているcategory_idを持つcategoryは出力しない
                if (in_array($category->id, $used_categories)) {
                    continue;
                }

                //1度出力されたcategory_idを$used_categoryに格納
                //使ってない
                $category->id;
                $used_categories[] = $category->id;

                $children = [];
                if (!$category->children->isEmpty()) {
                    $result = $traverse($category->children, $prefix . '-');
                    $children = $result['categoriesArray'];
                    $used_categories = array_merge($used_categories, $result['used_categories']);
                }

                $categoriesArray[] = [
                    'id' => $category->id,
                    'name' => $prefix . ' ' . $category->name,
                    'depth' => $category->depth,
                    'children' => $children,
                ];
            }
            return ['categoriesArray' => $categoriesArray, 'used_categories' => $used_categories];
        };
        $categoriesArray = $traverse($categories);

        return view('admin.categories.index', compact('action', 'categories', 'traverse'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = ['name_ja' => '作成', 'name' => 'create'];
        //投稿画面表示
        return view('admin.categories.create', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //投稿内容保存処理
        $category = new Category();
        $category->fill($request->all())->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $action = ['name_ja' => '詳細', 'name' => 'show'];
        //詳細画面
        return view('admin.categories.show', compact('action', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $action = ['name_ja' => '編集', 'name' => 'edit'];
        //編集画面
        $categories = Category::withDepth()->defaultOrder()->get()->toFlatTree();
        return view('admin.categories.edit', compact('action', 'category', 'categories'));
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');
        Category::rebuildTree($order);

        return redirect()->route('categories.index')->with('success', 'カテゴリの並び順を更新しました。');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //更新処理
        if ($category->fill($request->all())->save()) {
            session()->flash('message.success', '更新しました');
        } else {
            session()->flash('message.danger', '更新に失敗しました');
        }

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //削除処理
        if ($category->delete()) {
            session()->flash('message.success', '削除しました');
        } else {
            session()->flash('message.danger', '削除に失敗しました');
        }
        return redirect()->route('examples.index');
    }
}
