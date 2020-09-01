@extends('layouts.app')

@section('title', 'Search')

@section('content')
<div class="row">
    <div class="col-lg-8 mb-3">
        <form action="{{ route('menu.search') }}" method="GET" class="mb-3">
            <input type="text" name="q" class="form-control" placeholder="Search menu items..." value="{{ $q }}">
        </form>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Search results for "{{ $q }}"</h4>
            </div>
            <div class="card-body">
                @forelse ($itemParents as $itemParent)
                    <x-menu-item :item-parent="$itemParent" />

                    @unless ($loop->last)
                        <hr>
                    @endunless
                @empty
                    <div class="h6 text-center">Sorry, we didn't find anything :(</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div style="position: -webkit-sticky; position: sticky; top: 10px;">
            <x-cart />
        </div>
    </div>
</div>
@endsection
