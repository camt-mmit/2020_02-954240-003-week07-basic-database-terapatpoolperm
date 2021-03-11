@extends('layouts.main')
 
@section('title', $title)
 
@section('content')
    <main>
        <form action="{{ route('product-create') }}" method="post">
            @csrf
            <table class="centered">
                <tr>
                <td class="b" align="end"><label for="code">Code</label></td><td class="c">::</td>
                    <td><input id="code" type="text" name="code" /></td>
                </tr>
                <tr>
                <td class="b" align="end"><label for="code">Name</label></td><td class="c">::</td>
                    <td><input id="name" type="text" name="name" /></td>
                </tr>
                <tr>
                <td class="b" align="end"><label for="code">Price</label></td><td class="c">::</td>
                    <td><input id="number" type="number" step="0.25" name="price" /></td>
                </tr>
                <tr>
                <td class="b" align="end"><label for="code">Description</label></td><td class="c">::</td>
                    <td><textarea id="description" name="description" cols="40" rows="5"></textarea></td>
                </tr>
            </table>
            <div align="center">
                <button type="submit">Create</button>
            </div>
        </form>
    </main>
@endsection