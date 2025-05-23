<aside class="w-64 h-screen bg-white shadow-lg fixed">
    <div class="p-6 text-xl font-bold border-b border-gray-200">
        OWNER
    </div>

    <nav class="mt-4 px-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard.' . auth()->user()->role) }}"
                   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->is('dashboard*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->is('properti*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Data Properti
                </a>
            </li>
            <li>
                <a href="{{ route('ulasan.index') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->is('ulasan*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Ulasan
                </a>
            </li>
        </ul>
    </nav>
</aside>