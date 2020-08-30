@extends('layouts.app')

@section('content')
<div id="menu" class="row">
    {{-- Menu --}}
    <div class="col-8">
        @foreach ($categories as $category)
            @unless ($category->isEmpty())
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="m-0">{{ $category->name }}</h4>
                    </div>

                    <div class="card-body">
                        @foreach ($category->item_parents as $itemParent)
                            <div class="menu-item row mb-3">
                                <div class="col-3">
                                    <img width="140" src="{{ $itemParent->image }}" alt="Pizza">
                                </div>

                                <div class="col">
                                    <h3 class="mb-0">{{ $itemParent->name }}</h3>
                                    <p class="mb-2">{{ $itemParent->description }}</p>

                                    <div class="text-right">
                                        @foreach ($itemParent->items as $item)
                                            <button onclick="cart.addItem({{$item->id}})" class="btn btn-sm btn-primary ml-2">
                                                {{ $item->size }} <b>{{ $item->price }}</b>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @unless ($loop->last)
                                <hr>
                            @endunless
                        @endforeach
                    </div>
                </div>
            @endunless
        @endforeach
    </div>

    {{-- Cart --}}
    <div class="col-4">
        <div style="position: -webkit-sticky; position: sticky; top: 10px;">
            {{-- <x-cart /> --}}
        </div>
    </div>
</div>
@endsection
