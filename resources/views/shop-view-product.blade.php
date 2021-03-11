@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="center">
        <form action="{{ route('shop-view-product', [
            'shop' => $shop->code,
            ]) }}" method="get" class="search centerized" style="width: 300px;">
            <label>
                <b>search</b>
                <input type="text" name="term" value="{{ $term }}" />
            </label>
        </form>
    </div> <br />
    
    {{ $products->withQueryString()->links() }}
    
    <nav align="center">
        <a href="{{ route('shop-add-product-form', [
            'shop' => $shop->code,
        ]) }}">Add Product</a>
    </nav> <br />
    
    <main>
        <table align="center", border="1px" solid black; class="product-list">
            <colgroup>
                <col style="width: 6ch;" />
                <col style="width: 30ch;" />
                <col style="width= 5ch;" />
            </colgroup>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="pre" align="center"><b>
                            <a href="{{ route('product-view', [
                                'product' => $product->code,
                            ]) }}">
                            {{ $product->code }}
                            </b></a>
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <a href="{{ route('shop-remove-product', [
                                'shop' => $shop->code,
                                'product' => $product->code,
                            ]) }}">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection