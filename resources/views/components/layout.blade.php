<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/app.css" />
    <title>Laravel From Scratch Blog</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
    
<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    Blog Post
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @guest
                <a href="/register" class="text-xs font-bold uppercase">Register</a>
                <a href="/login" class="ml-6 text-xs text-blue-500 font-bold uppercase">Login</a>
                @else

                <x-dropdown>
                    <x-slot name='trigger'>
                        <button class="text-xs font-bold">Welcome, {{ auth()->user()->name }} !</button>
                    </x-slot>

                    @if (auth()->user()->username == 'ghassan')   
                    <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')">All Posts</x-dropdown-item>
                    <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">New Post</x-dropdown-item>
                    @endif
                    <x-dropdown-item href="#" x-data="{}" 
                        @click.prevent="document.querySelector('#logout-form').submit()" 
                    >
                        Logout
                    </x-dropdown-item>

                    <form id='logout-form' action="/logout" method="post" class="hidden">
                    @csrf
                    </form>
                </x-dropdown>

                @endguest

                <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>
            </div>
        </nav>

    {{ $slot }}

       <footer 
       id="newsletter"
        class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
            <h5 class="text-3xl">Stay in touch with the latest posts</h5>
            <p class="text-sm">Promise to keep the inbox clean. No bugs.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">
                    <form method="POST" action="/newsletter" class="lg:flex text-sm">
                        @csrf
                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <div class="flex flex-col">
                                <input name="email" id="email" type="email" placeholder="Your email address"
                                    class="lg:bg-transparent pl-4 focus-within:outline-none">
                                @error('email')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer>
    </section>
    @if (session()->has('success'))
        <div 
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => { show = false }, 3000)"

        class="fixed bg-blue-500 text-white text-sm py-2 px-4 rounded-xl bottom-3 right-3 ">
            <p>
                {{ session()->get('success') }}
            </p>
        </div>
    @endif
</body>
</html>