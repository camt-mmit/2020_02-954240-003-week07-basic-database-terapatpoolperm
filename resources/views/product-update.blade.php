@extends('layouts.main')
 
@section('title', $title)
 
@section('content')
<main>
    <form action="{{ route('product-update', [
        'product' => $product->code,
        ]) }}" method="post">
        @csrf
        <table class="centered">
            <tr>
                <td class="b" align="end"><label for="code">Code</label></td><td>::</td>
                <td><input id="code" type="text" name="code" value="{{ $product->code }}" /></td>
            </tr>
            <tr>
                <td class="b" align="end"><label for="name">Name</label></td><td>::</td>
                <td><input id="name" type="text" name="name" value="{{ $product->name }}" /></td>
            </tr>
            <tr>
                <td class="b" align="end"><label for="number">Price</label></td><td>::</td>
                <td><input id="number" type="number" step="0.25" name="price" value="{{ $product->price }}" /></td>
            </tr>
            <tr>
                <td class="b" align="end"><label for="description">Description</label></td><td>::</td>
                <td>
                    <textarea id="description" name="description" cols="40" rows="5">{{ $product->description }}</textarea>
                </td>
            </tr>
        </table>
        <br />
        <div align="center">
            <button type="submit">Update</button>
        </div>
    </form>
</main>
@endsection