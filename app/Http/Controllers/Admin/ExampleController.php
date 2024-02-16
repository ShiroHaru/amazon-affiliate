<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Example;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function __construct()
    {
        $controller = [
            'name' => 'example', 'name_ja' => 'エグザンプル',
        ];
        view()->share(compact('controller'));
    }

    public function index()
    {
        $action = ['name_ja' => '一覧', 'name' => 'list'];
        //全ての情報を取得
        $examples = Example::all();
        return view('admin.examples.index', compact('action', 'examples'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = ['name_ja' => '作成', 'name' => 'create'];
        //投稿画面表示
        return view('admin.examples.create', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //投稿内容保存処理
        $example = new Example();
        $example->fill($request->all())->save();

        return redirect()->route('examples.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Example $example)
    {
        $action = ['name_ja' => '詳細', 'name' => 'show'];
        //詳細画面
        return view('admin.examples.show', compact('action', 'example'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Example $example)
    {
        $action = ['name_ja' => '編集', 'name' => 'edit'];
        //編集画面
        return view('admin.examples.edit', compact('action', 'example'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Example $example)
    {
        //更新処理
        if ($example->fill($request->all())->save()) {
            session()->flash('message.success', '更新しました');
        } else {
            session()->flash('message.danger', '更新に失敗しました');
        }

        return redirect()->route('examples.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Example $example)
    {
        //削除処理
        if ($example->delete()) {
            session()->flash('message.success', '削除しました');
        } else {
            session()->flash('message.danger', '削除に失敗しました');
        }
        return redirect()->route('examples.index');
    }
}
