@extends('layouts.app')

@section('content')
@foreach ($itemParents as $itemParent)
    <div class="row mb-3 p-2 border">
        <div class="col-3">
            <img width="140" src="{{ $itemParent->image }}" alt="Pizza">
        </div>
        <div class="col">
            <h3 class="mb-0">{{ $itemParent->name }}</h3>
            <p class="mb-2">{{ $itemParent->description }}</p>

            <div class="text-right">
                @foreach ($itemParent->items as $item)
                    <button class="btn btn-sm btn-primary ml-2">{{ $item->size }} <b>{{ $item->price }}</b></button>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
@endsection
