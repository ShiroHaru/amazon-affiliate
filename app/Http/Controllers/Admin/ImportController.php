<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Origin;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    public function __construct()
    {
        $controller = [
            'name' => 'import', 'name_ja' => 'アップロード',
        ];
        view()->share(compact('controller'));
    }


    //feature
    public function feature()
    {
        $action = ['name_ja' => 'json feature', 'name' => 'feature'];

        //originモデルとそれに紐づいたcategoryモデルのname一覧を取得してviewに渡す
        $origins_with_categories = Origin::with('categories')->get();
        dump($origins_with_categories);


        return view(
            'admin.import.feature',
            compact('action')
        )->with([
            'origins_with_categories' => $origins_with_categories,
        ]);
    }

    public function store(Request $request)
    {
        //$request->file('json')->store('');
        //dd($request->file('json'));

        //アップロードされたjsonファイルをddでダンプ
        // $json = $request->file('json')->store('');
        // dd($json);

        //アップロードされたjsonファイルをjson_decodeでデコード
        // $json = $request->file('json')->store('');
        // dd($json);
        // $data = json_decode($json, true);
        // dd($data);

        // storageフォルダに保存されたjsonファイルをddでダンプ
        $file_path = $request->file('json')->store('');
        $json = file_get_contents(storage_path('app/' . $file_path));
        //dump($json);
        //jsonデコード
        $products = json_decode($json, true);
        $product = $products[1];

        dump($product);

        //$productからcategory_nameを全て取得
        $category_name = array_column($product['specs'], 'category_name');
        dd($category_name);


        //Storage::delete($file_path);







        // $json = file_get_contents('php://input');

        // // Converts json data into a PHP object 
        // $data = json_decode($json, true);
        // dd($data);
    }
}
