<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
@unless ($isEmpty())
    <div class="{{ $class }}">
        @if (!empty($danger))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($danger as $alert)
                    <p class="m-0">&bullet; {{ $alert }}</p>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (!empty($warning))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                @foreach ($warning as $alert)
                    <p class="m-0">&bullet; {{ $alert }}</p>
                @endforeach

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (!empty($success))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                @foreach ($success as $alert)
                    <p class="m-0">&bullet; {{ $alert }}</p>
                @endforeach

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (!empty($info))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                @foreach ($info as $alert)
                    <p class="m-0">&bullet; {{ $alert }}</p>
                @endforeach

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
@endunless
