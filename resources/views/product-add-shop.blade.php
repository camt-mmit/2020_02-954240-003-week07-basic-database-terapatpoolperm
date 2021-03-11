@extends('layouts.main')

@section('title', $title)

@section('content')
    <nav align="center">
        <a href="{{ route('product-view-shop', [
            'product' => $product->code
        ]) }}">&lt; Back</a>
    </nav> <br />

    <div class="center">
        <form action="{{ route('product-add-shop', [
            'product' => $product->code,
            ]) }}" method="get" class="search centerized" style="width: 300px;">
            <label>
                <b>search</b>
                <input type="text" name="term" value="{{ $term }}" />
            </label>
        </form>
    </div> <br />
    
    {{ $shops->withQueryString()->links() }}
    
    <main>
        <form action="{{ route('product-add-shop', [
                'product' => $product->code,
            ]) }}" method="post">
            @csrf
            <table align="center", border="1px" solid black; class="product-list">
                <colgroup>
                    <col style="width: 6ch;" />
                    <col style="width: 20ch;" />
                    <col style="width: 20ch;" />
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
                            <td class="pre" align="center"><b>{{ $shop->code }}</b></td>
                            <td><em>{{ $shop->name }}</em></td>
                            <td>{{ $shop->owner }}</td>
                            <td>
                                <button type="submit" name="shop" value="{{ $shop->id }}">
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