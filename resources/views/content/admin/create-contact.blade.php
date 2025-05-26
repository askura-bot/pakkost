@extends('layouts.app', ['title' => 'Create Contact'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-6">Create New Contact</h2>
        
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">WhatsApp Number</label>
                    <input type="text" name="no_wa" required
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" required
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Instagram</label>
                    <input type="text" name="instagram"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Facebook</label>
                    <input type="text" name="facebook"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <a href="{{ route('contacts.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection