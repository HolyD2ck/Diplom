@extends('layouts.app')

@section('content')
    <livewire:shop-products :categoryId="$categoryId" />
    <livewire:footer />
@endsection
