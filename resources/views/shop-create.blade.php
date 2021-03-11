@extends('layouts.main')
 
@section('title', $title)
 
@section('content')
    <main>
        <form action="{{ route('shop-create') }}" method="post">
            @csrf
            <table class="centered">
                <tr>
                    <td class="field-label"><label for="code">Code :: </label></td>
                    <td><input id="code" type="text" name="code" /></td>
                </tr>
                <tr>
                    <td class="field-label"><label for="name">Name :: </label></td>
                    <td><input id="name" type="text" name="name" /></td>
                </tr>
                <tr>
                    <td class="field-label"><label for="owner">Owner :: </label></td>
                    <td><input id="owner" type="owner" name="owner" /></td>
                </tr>
                <tr>
                    <td class="field-label"><label for="latitude">Latitude :: </label>
                    <td><input id="latitude" type="latitude" name="latitude" /></td>
                </tr>
                <tr>
                    <td class="field-label"><label for="longitude">Longitude :: </label>
                    <td><input id="longitude" type="longitude" name="longitude" /></td>
                </tr>
                <tr>
                    <td class="field-label"><label for="address">Address :: </label>
                    <td><textarea id="address" name="address" cols="40" rows="5"></textarea></td>
                </tr>
            </table>
            <div class="actions-panel">
                <button type="submit">Create</button>
            </div>
        </form>
    </main>
@endsection