<aside class="w-64 h-screen bg-white shadow-lg fixed dark:bg-gray-800">
    <div class="p-6 text-xl font-bold border-b border-gray-200 dark:border-gray-700">
        ADMIN
    </div>

    <nav class="mt-4 px-4">
        <ul class="space-y-2">
            <li>
                <a href=""
                   class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('dashboard*') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href=""
                   class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('Propertys*') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
                    Propertys
                </a>
            </li>
            <li>
                <a href=""
                   class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('Owner*') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
                    Owner
                </a>
            </li>
            <li>
                <a href=""
                   class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('Admin*') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
                    Admin
                </a>
            </li>
        </ul>
    </nav>
</aside>
