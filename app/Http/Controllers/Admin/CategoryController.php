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
            'name' => 'category', 'name_ja' => 'カテゴリ',
        ];
        view()->share(compact('controller'));
    }

    public function index()
    {
        $action = ['name_ja' => '一覧', 'name' => 'list'];
        //全ての情報を取得
        $categories = Category::all();
        return view('admin.categories.index', compact('action', 'categories'));
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
        return view('admin.categories.edit', compact('action', 'category'));
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
