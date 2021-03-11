<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Shop;

class ProductController extends Controller
{
    private $title = 'Product';

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Product::orderBy('code')->withCount('shops');
        $term = (key_exists('term', $data))? $data['term'] : '';
        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                ->where('code', 'LIKE', "%{$word}%")
                ->orWhere('name', 'LIKE', "%{$word}%");
            });
        }
        return view('product-list', [
            'title' => "{$this->title} : List",
            'term' => $term,
            'products' => $query->paginate(5),]);
    }

    function createForm() {
        return view('product-create', [
            'title' => "{$this->title} : Create",
        ]);
    }
    
    function create(Request $request) {
        $product = Product::create($request->getParsedBody());
    
        return redirect()->route('product-list')
            ->with('status', "Product {$product->code} was created.");
    }

    function show($productCode) {
        $product = Product
            ::where('code', $productCode)
            ->firstOrFail();
    
        return view('product-view', [
            'title' => "{$this->title} : View",
            'product' => $product,
        ]);
    }
    
    function updateForm($productCode) {
        $product = Product::where('code', $productCode)->firstOrFail();
        return view('product-update', [
            'title' => "{$this->title} : Update",
            'product' => $product,
        ]);
    }
 
    function update(Request $request, $productCode) {
        $data = $request->getParsedBody();
        $product = Product::where('code', $productCode)->firstOrFail();
        $product->fill($data);
        $product->save();
 
        return redirect()->route('product-view', ['product' => $product->code]);
    }

    function delete($productCode) {
        $product = Product::where('code', $productCode)->firstOrFail();
        $product->delete();
 
        return redirect()->route('product-list');
 
    }

    function showShop(Request $request, $productCode) {
        $product = Product::where('code', $productCode)->firstOrFail();
        $data = $request->getQueryParams();
        $query = $product->shops()->orderBy('code');
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
        return $innerQuery
            ->where('code', 'LIKE', "%{$word}%")
            ->orWhere('name', 'LIKE', "%{$word}%");
        });
    }
 
        return view('product-view-shop', [
            'title' => "{$this->title} {$product->code} : Shop",
            'term' => $term,
            'product' => $product,
            'shops' => $query->paginate(5),
        ]);
    }

    function addShopForm(Request $request, $productCode) {
        $product = Product::where('code', $productCode)->firstOrFail();
        $query = Shop::orderBy('code')->whereDoesntHave('products', function($innerQuery) use($product) {
            $innerQuery->where('id', $product->id);
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
 
        return view('product-add-shop', [
            'title' => "{$this->title} {$product->code} : Add Shop",
            'term' => $term,
            'product' => $product,
            'shops' => $query->paginate(5),
        ]);
    }

    function addShop(Request $request, $productCode) {
        $product = Product::where('code', $productCode)->firstOrFail();
        $data = $request->getParsedBody();
        $product->shops()->attach($data['shop']);

        return back();
    }

    function removeShop($productCode, $shopCode) {
        $product = Product::where('code', $productCode)->firstOrFail();
        $shop = $product->shops()->where('code', $shopCode)->firstOrFail();
        $product->shops()->detach($shop);

        return back();
    }
}
