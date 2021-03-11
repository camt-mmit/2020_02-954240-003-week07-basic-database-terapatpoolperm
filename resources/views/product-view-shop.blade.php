@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="center">
        <form action="{{ route('product-view-shop', [
            'product' => $product->code,
            ]) }}" method="get" class="search centerized" style="width: 300px;">
            <label>
                <b>search</b>
                <input type="text" name="term" value="{{ $term }}" />
            </label>
        </form>
    </div> <br />
    
    {{ $shops->withQueryString()->links() }}

    <nav align="center">
        <a href="{{ route('product-add-shop-form', [
            'product' => $product->code,
        ]) }}">Add Shop</a>
    </nav> <br />
    
    <main>
        <table align="center", border="1px" solid black; class="product-list">
            <colgroup>
                <col style="width: 6ch;" />
                <col style="width: 20ch;" />
                <col style="width: 15ch;" />
                <col style="width= 5ch;" />
            </colgroup>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shops as $shop)
                    <tr>
                        <td class="pre" align="center"><b>
                            <a href="{{ route('shop-view', [
                                'shop' => $shop->code,
                                ]) }}">
                                {{ $shop->code }}
                            </b></a>
                        </td>
                        <td>{{ $shop->name }}</td>
                        <td>{{ $shop->owner }}</td>
                        <td>
                            <a href="{{ route('product-remove-shop', [
                                'product' => $product->code,
                                'shop' => $shop->code,
                            ]) }}">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection