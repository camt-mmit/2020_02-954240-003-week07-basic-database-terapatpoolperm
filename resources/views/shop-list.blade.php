@extends('layouts.main')

@section('title', $title)

@section('content')
    <main>
        <div class="center">
            <form action="{{ route('shop-list') }}" method="get" class="search centerized" style="width: 300px;">
                <label> 
                <b>search</b>
                <input type="text" name="term" value="{{ $term }}" />
                </label>
            </form>
        </div> <br />

        <nav class="actions-panel" align="center">
            <a href="{{ route('shop-create-form') }}">Create shop</a>
        </nav> <br />

        {{ $shops->withQueryString()->links() }}

        <table align="center", border="1px" solid black; class="shop-details">
            <thead>
                <th>Code</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Number of Products</th>
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
                        <td class="value" align="end">
                            <em>{{ $shop->products_count }}</em>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection