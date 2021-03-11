<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Shop;
use App\Models\Product;

class ShopController extends Controller
{
    private $title = 'Shop';

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Shop::orderBy('code')->withCount('products');
        $term = (key_exists('term', $data))? $data['term'] : '';
        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                ->where('code', 'LIKE', "%{$word}%")
                ->orWhere('name', 'LIKE', "%{$word}%");
            });
        }
        return view('shop-list', [
            'title' => "{$this->title} : List",
            'term' => $term,
            'shops' => $query->paginate(5),]);
    }

    function createForm() {
        return view('shop-create', [
            'title' => "{$this->title} : Create",
        ]);
    }

    function create(Request $request) {
        $shop = Shop::create($request->getParsedBody());
 
        return redirect()->route('shop-list');
    }

    function show($shopCode) {
        $shop = shop
            ::where('code', $shopCode)
            ->firstOrFail();
    
        return view('shop-view', [
            'title' => "{$this->title} : View",
            'shop' => $shop,
        ]);
    }

    function updateForm($shopCode) {
        $shop = Shop::where('code', $shopCode)->firstOrFail();
        return view('shop-update', [
            'title' => "{$this->title} : Update",
            'shop' => $shop,
        ]);
    }

    function update(Request $request, $shopCode) {
        $data = $request->getParsedBody();
        $shop = Shop::where('code', $shopCode)->firstOrFail();
        $shop->fill($data);
        $shop->save();
 
        return redirect()->route('shop-view', ['shop' => $shop->code]);
    }

    function delete($shopCode) {
        $shop = Shop::where('code', $shopCode)->firstOrFail();
        $shop->delete();
 
        return redirect()->route('shop-list');
 
    }

    function showProduct(Request $request, $shopCode) {
        $shop = Shop::where('code', $shopCode)->firstOrFail();
        $data = $request->getQueryParams();
        $query = $shop->products()->orderBy('code');
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
        return $innerQuery
            ->where('code', 'LIKE', "%{$word}%")
            ->orWhere('name', 'LIKE', "%{$word}%");
        });
    }
 
        return view('shop-view-product', [
            'title' => "{$this->title} {$shop->code} : Product",
            'term' => $term,
            'shop' => $shop,
            'products' => $query->paginate(5),
        ]);
    }

    function addProductForm(Request $request, $shopCode) {
        $shop = Shop::where('code', $shopCode)->firstOrFail();
        $query = Product::orderBy('code')->whereDoesntHave('shops', function($innerQuery) use($shop) {
            $innerQuery->where('id', $shop->id);
        });
        $data = $request->getQueryParams();
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
        return $innerQuery
            ->where('code', 'LIKE', "%{$word}%")
            ->orWhere('name', 'LIKE', "%{$word}%");
        });
    }
 
        return view('shop-add-product', [
            'title' => "{$this->title} {$shop->code} : Add Product",
            'term' => $term,
            'shop' => $shop,
            'products' => $query->paginate(5),
        ]);
    }

    function addProduct(Request $request, $shopCode) {
        $shop = Shop::where('code', $shopCode)->firstOrFail();
        $data = $request->getParsedBody();
        $shop->products()->attach($data['product']);

        return back();
    }

    function removeProduct($shopCode, $productCode) {
        $shop = Shop::where('code', $shopCode)->firstOrFail();
        $product = $shop->products()->where('code', $productCode)->firstOrFail();
        $shop->products()->detach($product);

        return back();
    }
}
