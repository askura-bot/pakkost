@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 sm:p-8 transition-colors duration-300">

        <!-- Header Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Tambah Properti Baru</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Isi form berikut untuk menambahkan properti baru</p>
            
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-md relative" x-data="{ show: true }" 
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="absolute top-1/2 right-4 -translate-y-1/2">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        @endif
        
        </div>

        <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <!-- Nama Properti -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Properti</label>
                        <input type="text" name="nama_properti" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               required>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Harga</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3.5 text-gray-500 dark:text-gray-400">Rp</span>
                            <input type="number" name="harga" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   required>
                        </div>
                    </div>

                    <!-- Tipe & Sewa -->
                    <div class="grid gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe Properti</label>
                            <select name="tipe" 
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="putra">Putra</option>
                                <option value="putri">Putri</option>
                                <option value="campur">Campur</option>
                                <option value="kontrakan">Kontrakan</option>
                                <option value="kost">Kost</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Sewa</label>
                            <select name="sewa_jenis" 
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="bulanan">Bulanan</option>
                                <option value="tahunan">Tahunan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Photo Upload Section -->
                <div class="space-y-6">
                    <!-- Jumlah Kamar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah Kamar</label>
                        <input type="number" name="jumlah_kamar" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               required>
                    </div>

                    <div class="space-y-6">
                        <!-- Foto Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Upload Foto</label>
                            <div class="relative group border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-blue-500 dark:hover:border-blue-500 transition duration-200"
                                 id="file-upload-container">
                                <input type="file" name="foto[]" multiple accept="image/*" 
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                       id="file-input"
                                       onchange="updateFileList(this)">
                                <div class="pointer-events-none" id="upload-placeholder">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        <span class="font-medium text-blue-600 dark:text-blue-400">Upload foto</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG maks. 2MB per file</p>
                                </div>
                                <div id="file-list" class="mt-4 text-left hidden"></div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function updateFileList(input) {
                            const fileList = document.getElementById('file-list');
                            const placeholder = document.getElementById('upload-placeholder');
                            const container = document.getElementById('file-upload-container');
                            
                            fileList.innerHTML = '';
                            placeholder.classList.add('hidden');
                            fileList.classList.remove('hidden');
                            container.classList.remove('border-dashed');
                        
                            if (input.files.length > 0) {
                                const files = Array.from(input.files);
                                const list = document.createElement('div');
                                
                                files.forEach((file, index) => {
                                    const fileItem = document.createElement('div');
                                    fileItem.className = 'flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded-lg mb-2';
                                    fileItem.innerHTML = `
                                        <span class="text-sm text-gray-700 dark:text-gray-300 truncate">${file.name}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">${(file.size/1024/1024).toFixed(2)}MB</span>
                                    `;
                                    list.appendChild(fileItem);
                                });
                        
                                const changeButton = document.createElement('button');
                                changeButton.type = 'button';
                                changeButton.className = 'mt-4 text-sm text-blue-600 dark:text-blue-400 hover:underline';
                                changeButton.textContent = 'Ubah File';
                                changeButton.onclick = () => document.getElementById('file-input').click();
                                
                                fileList.appendChild(list);
                                fileList.appendChild(changeButton);
                            } else {
                                placeholder.classList.remove('hidden');
                                fileList.classList.add('hidden');
                                container.classList.add('border-dashed');
                            }
                        }
                        </script>

                <!-- Alamat Section -->
                <div class="md:col-span-2 space-y-6">
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Alamat Properti</h3>
                        
                        <!-- Alamat Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2" 
                                      class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                      required></textarea>
                        </div>

                        <!-- Detail Alamat Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kelurahan</label>
                                <input type="text" name="kelurahan" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jalan</label>
                                <input type="text" name="jalan" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">RT</label>
                                <input type="text" name="rt" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">RW</label>
                                <input type="text" name="rw" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Virtual Tour -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Link Virtual Tour</label>
                        <input type="url" name="link_VT" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="https://example.com/virtual-tour">
                    </div>

                    <!-- Fasilitas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fasilitas</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($fasilitas as $f)
                            <label class="flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition duration-200">
                                <input type="checkbox" name="fasilitas[]" value="{{ $f->id }}" 
                                       class="h-4 w-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $f->nama_fasilitas }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" 
                        class="w-full md:w-auto px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Simpan Properti
                </button>
            </div>
        </form>
    </div>
</div>
@endsection