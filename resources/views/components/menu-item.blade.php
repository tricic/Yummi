<!-- An unexamined life is not worth living. - Socrates -->
<div class="menu-item row">
    <div class="col-3 border-right d-none d-sm-block">
        <img class="menu-item-image w-100" src="{{ $itemParent->image }}" alt="Item image">
    </div>

    <div class="col">
        <h3 class="menu-item-name mb-0">{{ $itemParent->name }}</h3>
        <p class="menu-item-description mb-2">{{ $itemParent->description }}</p>

        <hr class="my-1">

        <div class="menu-item-sizes d-flex justify-content-end">
            @foreach ($items as $item)
                <div class="ml-lg-3">
                    <span class="menu-item-size">{{ $item->size }}</span>
                    <button onclick='cart.addItem(@JSON($item))' class="menu-item-btn btn btn-sm btn-outline-primary py-0">
                        <b class="menu-item-price">{{ $item->price }}</b>
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>
