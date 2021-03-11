@extends('layouts.main')
 
@section('title', $title)
 
@section('content')
    <main>
        <form action="{{ route('shop-update', [
            'shop' => $shop->code,
            ]) }}" method="post">
            @csrf
            <table class="centered">
                <tr>
                    <td class="field-label" align="end"><label for="code">Code :: </label></td>
                    <td><input id="code" type="text" name="code" value="{{ $shop->code }}" /></td>
                </tr>
                <tr>
                    <td class="field-label" align="end"><label for="name">Name :: </label></td>
                    <td><input id="name" type="text" name="name" value="{{ $shop->name }}" /></td>
                </tr>
                <tr>
                    <td class="field-label" align="end"><label for="owner">Owner :: </label></td>
                    <td><input id="owner" type="owner" name="owner" value="{{ $shop->owner }}" /></td>
                </tr>
                <tr>
                    <td class="field-label" align="end"><label for="latitude">Latitude :: </label></td>
                    <td><input id="latitude" type="latitude" name="latitude" value="{{ $shop->latitude }}" /></td>
                </tr>
                <tr>
                    <td class="field-label" align="end"><label for="longitude">Longitude :: </label></td>
                    <td><input id="longitude" type="longitude" name="longitude" value="{{ $shop->longitude }}" /></td>
                </tr>
                <tr>
                    <td class="field-label" align="end"><label for="address">Address :: </label>
                    <td>
                        <textarea id="address" name="address" cols="40" rows="5">{{ $shop->address }}</textarea>
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