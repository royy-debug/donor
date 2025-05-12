<header class="fixed top-0 left-0 w-full z-30 bg-white/70 shadow-md" x-data="{ open: false }">
    <div class="container mx-auto flex justify-between items-center py-3 px-4">
      <a href="/" class="flex items-center">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-10 object-contain" />
      </a>
  
      <!-- desktop nav -->
      <nav class="hidden md:flex space-x-4 items-center font-semibold">
        <a href="{{ url('/') }}" class="nav-link">Homepage</a>
        <a href="{{ url('/') }}#blood_stock" class="nav-link">Stock</a>
        <a href="{{ url('/') }}#education" class="nav-link">Education</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="nav-link">Logout</button>
        </form>
      </nav>
  
      <!-- mobile toggle -->
      <button class="md:hidden" @click="open = !open">
        <i class="fas fa-bars text-gray-700"></i>
      </button>
    </div>
  
    <!-- mobile menu -->
    <div x-show="open" x-transition class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40" @click.away="open=false">
      <div class="absolute right-0 top-0 w-64 h-full bg-white p-6 space-y-4">
        <button @click="open=false" class="text-gray-600"><i class="fas fa-times"></i></button>
        <a href="{{ url('/') }}" @click="open=false" class="flex items-center gap-2"><i class="fas fa-home"></i> Homepage</a>
        <a href="{{ url('/') }}#blood_stock" @click="open=false" class="flex items-center gap-2"><i class="fas fa-tint"></i> Stock</a>
        <a href="{{ url('/') }}#education" @click="open=false" class="flex items-center gap-2"><i class="fas fa-book"></i> Education</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="flex items-center gap-2"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
      </div>
    </div>
  </header>
  