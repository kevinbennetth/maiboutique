<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - MaiBoutique</title>
    <link rel="icon" type="image/x-icon" href="https://twemoji.maxcdn.com/2/svg/1f3ec.svg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class='w-full flex flex-col min-h-screen h-auto'>
    <nav
        class='bg-slate-200 px-5 py-2 md:px-10 md:py-3 flex flex-col md:flex-row justify-center md:justify-between items-center gap-2 md:gap-0'>
        <div class='flex flex-col md:flex-row items-center gap-1 md:gap-4'>
            <h1 class='font-semibold text-xl'>MAI BOUTIQUE</h1>
            @auth
                <ul class='font-light md:text-md flex list-none gap-3'>
                    <li><a href="{{ route('products.index') }}" class='hover:text-cyan-600'>Home</a></li>
                    <li><a href="{{ route('products.search') }}" class='hover:text-cyan-600'>Search</a></li>
                    @if (Auth::user()->role->name == 'Member')
                        <li>
                            <a href="{{ route('orders.index', ['user_id' => Auth::id()]) }}" class='hover:text-cyan-600'>
                                Cart
                            </a>
                        </li>
                        <li><a href="{{ route('transactions.index', ['user_id' => Auth::id()]) }}"
                                class='hover:text-cyan-600'>History</a></li>
                    @endif
                    <li>
                        <a href="{{ route('users.show', ['user_id' => Auth::id()]) }}" class='hover:text-cyan-600'>Profile</a>
                    </li>
                </ul>
            @endauth
        </div>
        <div class='flex gap-2 md:gap-4'>
            @auth
                @includeWhen(Auth::user()->role->name == 'Admin', 'components.button', [
                    'link' => route('products.create'),
                    'text' => 'Add Item',
                    'color' => 'outline',
                    'size' => 'sm',
                ])
                @include('components.button', [
                    'link' => route('users.logout'),
                    'text' => 'Sign Out',
                    'color' => 'outline',
                    'size' => 'sm',
                ])
            @else
                @include('components.button', [
                    'link' => route('users.login'),
                    'text' => 'Sign In',
                    'color' => 'outline',
                    'size' => 'sm',
                ])
            @endauth
        </div>
    </nav>
    <main style='@auth background-image:none; @else background-image:url("{{ asset('header.jpeg') }}"); @endauth'
        class="min-h-screen h-auto mb-auto bg-cover bg-no-repeat">
        @yield('body')
    </main>
    <footer class='bg-slate-200 py-5 flex flex-col justify-center items-center'>
        <h3 class='text-sm md:text-base font-light'>Copyright &copy; MaiBoutique 2022</h3>
    </footer>
</body>

</html>
