{{-- breezeで自動的に作られるblade、コメントアウトしてAdminLTEのテンプレートに変更 --}}
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<p></p>
@stop

@section('css')
{{-- ページごとCSSの指定
<link rel="stylesheet" href="/css/xxx.css">
--}}
@stop

@section('js')
<script>
    console.log('ページごとJSの記述');
</script>
@stop