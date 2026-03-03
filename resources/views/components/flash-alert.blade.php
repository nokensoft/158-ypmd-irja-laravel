@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 text-base">
        <div class="flex items-center justify-between">
            <p><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</p>
            <button @click="show = false" class="text-green-500 hover:text-green-700"><i class="fas fa-times"></i></button>
        </div>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 text-base">
        <div class="flex items-center justify-between">
            <p><i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}</p>
            <button @click="show = false" class="text-red-500 hover:text-red-700"><i class="fas fa-times"></i></button>
        </div>
    </div>
@endif
