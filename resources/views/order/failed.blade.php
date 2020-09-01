@extends('layouts.app')

@section('title', 'Order failed!')

@section('content')
<div class="text-center">
    <div class="lead">
        An error occured during the ordering process!
    </div>

    <a href="{{ route('menu') }}" class="btn btn-primary">Back to menu</a>
</div>
<script>
    localStorage.clear('cart');
</script>
@endsection
