<header>
        <nav class="w-full border-b border-gray-400 px-10 py-5 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{ asset('images/logo_PBL.jpeg') }}" alt="Logo Pulas" class="h-[75px] object-contain mix-blend-multiply">
            </div>

    <nav>
        <a href="{{ url('/landing') }}">Beranda</a>
        <a href="{{ url('/room') }}">Kamar</a>
        <a href="{{ url('/login') }}">Login</a>
    </nav>

    <button class="btn-auth">Masuk</button>
</header>