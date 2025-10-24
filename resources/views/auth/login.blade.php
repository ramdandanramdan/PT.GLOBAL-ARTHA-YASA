<x-guest-layout>
    <div
        class="flex flex-col md:grid md:grid-cols-2 items-center w-full max-w-5xl bg-white shadow-2xl rounded-2xl overflow-hidden">

        <div class="w-full px-8 py-14 flex justify-center bg-white">
            <form method="POST" action="{{ route('login') }}" 
                x-data="{ loading: false, showPassword: false }"
                @submit.prevent="
                    loading = true; 
                    // Set timeout sebentar untuk menampilkan loading state sebelum submit
                    setTimeout(() => $el.submit(), 100); 
                "
                class="w-full max-w-md relative">

                @csrf

                <div class="flex justify-center mb-8 md:hidden">
                    <img src="{{ asset('images/logo-2.jpg') }}" alt="Logo"
                        class="w-20 h-20 rounded-full object-cover shadow-md">
                </div>

                <div class="mb-10 text-center md:text-left">
                    <h1 class="text-slate-900 text-3xl md:text-4xl font-extrabold tracking-tight">
                        Selamat Datang 👋
                    </h1>
                    <p class="text-slate-500 mt-3 text-[15px]">
                        Silakan masuk untuk melanjutkan ke dashboard Anda.
                    </p>
                </div>

                <div class="mb-6">
                    <label for="email" class="text-slate-900 text-[13px] font-medium block mb-2">Email</label>
                    <div class="relative">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            class="w-full border border-slate-300 rounded-lg py-3 pl-3 pr-10 text-sm text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition"
                            placeholder="Masukkan email Anda" />
                        {{-- Email Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#94a3b8" class="w-5 h-5 absolute right-3 top-3.5"
                            viewBox="0 0 24 24">
                            <path
                                d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4-8 5-8-5V6l8 5 8-5v2Z" />
                        </svg>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="mb-8">
                    <label for="password" class="text-slate-900 text-[13px] font-medium block mb-2">Password</label>
                    <div class="relative">
                        <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required
                            class="w-full border border-slate-300 rounded-lg py-3 pl-3 pr-10 text-sm text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition"
                            placeholder="Masukkan password" />

                        <template x-if="!showPassword">
                            <svg @click="showPassword = true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                stroke="#94a3b8" class="w-5 h-5 absolute right-3 top-3.5 cursor-pointer"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </template>

                        <template x-if="showPassword">
                            <svg @click="showPassword = false" xmlns="http://www.w3.org/2000/svg" fill="none"
                                stroke="#94a3b8" class="w-5 h-5 absolute right-3 top-3.5 cursor-pointer"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0 1 12 19c-4.478 0-8.268-2.943-9.542-7a10.043 10.043 0 0 1 4.091-5.362M9.88 9.88A3 3 0 0 0 12 15a3 3 0 0 0 2.12-.88M3 3l18 18" />
                            </svg>
                        </template>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition flex justify-center items-center gap-2 shadow-lg"
                        x-bind:disabled="loading">

                        <span x-show="!loading">Masuk</span>

                        <span x-show="loading" class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v2a6 6 0 00-6 6H4z">
                                </path>
                            </svg>
                            Loading...
                        </span>
                    </button>
                </div>

                {{-- Menambahkan error validation summary agar tampil di atas --}}
                @if ($errors->any())
                <div class="absolute top-0 w-full p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm transition-opacity duration-300"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    Autentikasi gagal. Silakan cek kembali kredensial Anda.
                </div>
                @endif
            </form>
        </div>

        <div
            class="hidden md:flex w-full h-full bg-gradient-to-br from-[#000842] to-[#020e56] items-center justify-center p-8 rounded-r-2xl">
            <img src="https://readymadeui.com/signin-image.webp" alt="login-image"
                class="w-full max-w-md object-contain transform transition-transform duration-300 hover:scale-105">
        </div>
    </div>
</x-guest-layout>