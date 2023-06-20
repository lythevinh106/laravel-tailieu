@include('client.header')

<style>
    @keyframes start_progress {
        0% {
            width: 0%;
        }

        100% {
            width: 100%;
            display: none;
        }
    }
</style>



<body class=" ">


    <div class="my-container-1  position-relative" style="height: 100vh;">

        @include('client.sidebar');

        @yield('content');

        @include('client.other');

        @if (session('success'))
            @include('client.toast', [
                'message' => session('success'),
                'bg_color' => 'bg-success text-white',
            ])
        @endif

    </div>
</body>


@include('client.footer');
@yield('js');
