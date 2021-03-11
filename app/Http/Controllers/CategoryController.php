<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    private $title = 'Category';

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Category::orderBy('code')->withCount('products');
        $term = (key_exists('term', $data))? $data['term'] : '';
        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                ->where('code', 'LIKE', "%{$word}%")
                ->orWhere('name', 'LIKE', "%{$word}%");
            });
        }
        return view('category-list', [
            'title' => "{$this->title} : List",
            'term' => $term,
            'categories' => $query->paginate(5),]);
    }

    function createForm() {
        return view('category-create', [
            'title' => "{$this->title} : Create",
        ]);
    }
 
    function create(Request $request) {
        $category = Category::create($request->getParsedBody());
 
        return redirect()->route('category-list');
    }

    function show($categoryCode) {
        $category = Category
            ::where('code', $categoryCode)
            ->firstOrFail();
    
        return view('category-view', [
            'title' => "{$this->title} : View",
            'category' => $category,
        ]);
    }
    
    function updateForm($categoryCode) {
        $category = Category::where('code', $categoryCode)->firstOrFail();
        return view('category-update', [
            'title' => "{$this->title} : Update",
            'category' => $category,
        ]);
    }
 
    function update(Request $request, $categoryCode) {
        $data = $request->getParsedBody();
        $category = Category::where('code', $categoryCode)->firstOrFail();
        $category->fill($data);
        $category->save();
 
        return redirect()->route('category-view', ['category' => $category->code]);
    }

    function delete($categoryCode) {
        $category = Category::where('code', $categoryCode)->firstOrFail();
        $category->delete();
 
        return redirect()->route('category-list');
 
    }

    function showProduct(Request $request, $categoryCode) {
        $category = Category::where('code', $categoryCode)->firstOrFail();
        $data = $request->getQueryParams();
        $query = $category->products()->orderBy('code');
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
        return $innerQuery
            ->where('code', 'LIKE', "%{$word}%")
            ->orWhere('name', 'LIKE', "%{$word}%");
        });
    }
 
        return view('category-view-product', [
            'title' => "{$this->title} {$category->code} : Product",
            'term' => $term,
            'category' => $category,
            'products' => $query->paginate(5),
        ]);
    }

    function addProductForm(Request $request, $categoryCode) {
        $category = category::where('code', $categoryCode)->firstOrFail();
        $query = Product::orderBy('code')->whereDoesntHave('categories', function($innerQuery) use($category) {
            $innerQuery->where('id', $category->id);
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
 
        return view('category-add-product', [
            'title' => "{$this->title} {$category->code} : Add Product",
            'term' => $term,
            'category' => $category,
            'products' => $query->paginate(5),
        ]);
    }

    function addProduct(Request $request, $categoryCode) {
        $category = Category::where('code', $categoryCode)->firstOrFail();
        $data = $request->getParsedBody();
        $category->products()->attach($data['product']);

        return back();
    }

    function removeProduct($categoryCode, $productCode) {
        $category = Category::where('code', $categoryCode)->firstOrFail();
        $product = $shop->products()->where('code', $productCode)->firstOrFail();
        $category->products()->detach($product);

        return back();
    }
}
