<nav class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <a href="#" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">MyWebsite</a><!-- Desktop menu -->
        <div class="hidden md:flex space-x-8">
          <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Home</a>
          <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">About</a>
          <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Services</a>
          <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Contact</a>
        </div>
        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button @click="open = !open" aria-label="Toggle Menu" type="button"
                  class="text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-600">
            <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg" >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg" >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
    <!-- Mobile Menu -->
    <div x-show="open" @click.away="open = false"
         class="md:hidden bg-white dark:bg-gray-800 shadow-md"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         style="display: none;">
      <a href="#" class="block px-4 py-2 border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700 transition">Home</a>
      <a href="#" class="block px-4 py-2 border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700 transition">About</a>
      <a href="#" class="block px-4 py-2 border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700 transition">Services</a>
      <a href="#" class="block px-4 py-2 hover:bg-indigo-50 dark:hover:bg-gray-700 transition">Contact</a>
    </div>
  </nav>