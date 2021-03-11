@extends('layouts.main')

@section('title', $title)

@section('content')
    <br />
    <nav class="actions-panel" align="center">
        <a href="{{ route('shop-view-product', [
                    'shop' => $shop->code,
                ]) }}">Show Products</a>
        <a href="{{ route('shop-update-form', [
                    'shop' => $shop->code,
                ]) }}">Update</a>
        <a href="{{ route('shop-delete', [
                    'shop' => $shop->code,
                ]) }}">Delete</a>
    </nav> <br />

<div>
    <table border-collapse="collapse"; margin="auto";>
        <tr>
            <td class="b" align="end">Code</td><td></td><td class="c">::</td><td></td>
            <td>
                {{ $shop->code }}
            </td>
        </tr>
        <tr>
            <td class="b" align="end">Name</td><td></td><td class="c">::</td><td></td>
            <td><em>
                {{ $shop->name }}
            </em></td>
        </tr>
        <tr>
            <td class="b" align="end">Owner</td><td></td><td class="c">::</td><td></td>
            <td>
                {{ $shop->owner }}
            </td>
        </tr>
        <tr>
            <td class="b" align="end">Location</td><td></td><td class="c">::</td><td></td>
            <td class="pre">
                {{ $shop->latitude }} , {{ $shop->longitude }}
            </td>
        </tr>
        <tr>
            <td class="b" align="end">Address</td><td></td><td class="c">::</td><td></td>
            <td>
                {{ $shop->address }}
            </td>
        </tr>
    </table>
@endsection