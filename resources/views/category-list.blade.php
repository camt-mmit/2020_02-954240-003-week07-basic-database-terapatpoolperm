@extends('layouts.main')

@section('title', $title)

@section('content')
    <main>
        <div class="center">
            <form action="{{ route('category-list') }}" method="get" class="search centerized" style="width: 300px;">
                <label>
                <b>search</b>
                <input type="text" name="term" value="{{ $term }}" />
                </label>
            </form> <br />

            <nav class="actions-panel" align="center">
                <a href="{{ route('category-create-form') }}">Create Category</a>
            </nav> <br />
        </div>

        {{ $categories->withQueryString()->links() }}

        <table align="center", border="1px" solid black; class="product-list">
            <thead>
                <th>Code</th>
                <th>Name</th>
                <th>Number of Products</th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="pre" align="center"><b>
                            <a href="{{ route('category-view', [
                                'category' => $category->code,
                            ]) }}">
                                {{ $category->code }}
                            </b></a>
                        </td>
                        <td><i>{{ $category->name }}</i></td>
                        <td class="value" align="end">
                            <em>{{ $category->products_count }}</em>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection