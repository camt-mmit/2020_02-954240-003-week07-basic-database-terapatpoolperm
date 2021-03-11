@extends('layouts.main')

@section('title', $title)

@section('content')
    <nav align="center">
        <a href="{{ route('shop-view-product', [
            'shop' => $shop->code
        ]) }}">&lt; Back</a>
    </nav> <br />

    <div class="center">
        <form action="{{ route('shop-add-product', [
            'shop' => $shop->code,
            ]) }}" method="get" class="search centerized" style="width: 300px;">
            <label>
                <b>search</b>
                <input type="text" name="term" value="{{ $term }}" />
            </label>
        </form>
    </div> <br />
    
    {{ $products->withQueryString()->links() }}
    
    <main>
        <form action="{{ route('shop-add-product', [
                'shop' => $shop->code,
            ]) }}" method="post">
            @csrf
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
                            <td class="pre" align="center"><b>{{ $product->code }}</b></td>
                            <td><em>{{ $product->name }}</em></td>
                            <td>
                                <button type="submit" name="product" value="{{ $product->id }}">
                                    Add
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </main>
@endsection