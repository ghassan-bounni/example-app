 @props(['heading'])
 <section class="max-w-4xl mx-auto py-8">
            <h1 class="mb-8 pb-2 border-b font-bold text-lg">{{ $heading }}</h1>
        <div class="flex">
            <aside class="w-48">
                <h4 class="font-semibold mb-4">Links</h4>
                <ul>
                    <li><a href="/dashboard">Dashboard</a></li>
                    <li><a href="/admin/posts/create" class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : "" }}">New Post</a></li>
                </ul>
            </aside>
    
            <main class="max-w-lg mx-auto  bg-gray-100  border border-gray-200  p-6 rounded-xl flex-1">
             {{ $slot }}
            </main>
        </div>
        </section>