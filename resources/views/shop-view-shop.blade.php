@extends('layouts.main')
 
@section('title', $title)
 
@section('content')
    <div class="center">
        <form action="{{ route('shop-view-shop', [
            'shop' => $shop->code,
            ]) }}" method="get" class="search centerized" style="width: 300px;">
            <label>
                <b>search</b>
                <input type="text" name="term" value="{{ $term }}" />
            </label>
        </form>
    </div> <br />
    
    {{ $shops->withQueryString()->links() }}

    <nav align="center">
        <a href="{{ route('shop-add-product-form', [
            'shop' => $shop->code,
        ]) }}">Add Product</a>
    </nav> <br />
    
    <main>
        <table class="centerized top-header" style="width: 600px;">
            <colgroup>
                    <col style="width: 6ch;" />
                <col />
                    <col style="width: 20ch;" />
            </colgroup>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shops as $shop)
                    <tr>
                        <th>
                            <a href="{{ route('shop-view', [
                                'shop' => $shop->code,
                                ]) }}">
                                {{ $shop->code }}
                            </a>
                        </th>
                        <td>{{ $shop->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection