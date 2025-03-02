@extends('layouts.app')

@section('content')
    <livewire:shop-show :productId="$productId" />
    <livewire:footer />
@endsection
