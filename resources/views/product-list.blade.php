@extends('layouts.main')

@section('title', $title)

@section('content')
    <main>
    @if(session()->has('ststus'))
    <div>{{ session()->get('status') }}</div>
        <div class="center">
            <form action="{{ route('product-list') }}" method="get" class="search centerized" style="width: 300px;">
                <label>
                <b>search</b>
                <input type="text" name="term" value="{{ $term }}" />
                </label>
            </form> <br />

            <nav class="actions-panel" align="center">
                <a href="{{ route('product-create-form') }}">Create Product</a>
            </nav> <br />
        </div>

        {{ $products->withQueryString()->links() }}

        <table align="center", border="1px" solid black; class="product-list">
            <thead>
                <th>Code</th>
                <th>Name</th>
                <th>Number of Shops</th>
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
                        <td class="value" align="end">
                            <em>{{ $product->shops_count }}</em>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection