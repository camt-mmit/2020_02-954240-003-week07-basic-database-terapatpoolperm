@extends('layouts.main')

@section('title', $title)

@section('content')
    <br />
    <nav class="actions-panel" align="center">
        <a href="{{ route('product-view-shop', [
                    'product' => $product->code,
                ]) }}">Show Shops</a>
        <a href="{{ route('product-update-form', [
                    'product' => $product->code,
                ]) }}">Update</a>
        <a href="{{ route('product-delete', [
                    'product' => $product->code,
                ]) }}">Delete</a>
    </nav> <br />

    <div>
        <table border-collapse="collapse"; margin="auto";>
            <tbody>
            <tr>
                <td class="b" align="end">Code</td><td></td><td class="c">::</td><td></td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td class="b" align="end">Name</td><td></td><td class="c">::</td><td></td>
                <td><i>{{ $product->name }}</i></td>
            </tr>
            <tr>
                <td class="b" align="end">Price</td><td></td><td class="c">::</td><td></td>
                <td class="pre">{{ number_format($product->price, 2) }}</td>
            </tr>
            </tbody>
        </table>
        <pre>{{ $product->description }}</pre>
    </div>
@endsection