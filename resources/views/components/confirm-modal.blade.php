{{-- Global Confirmation Modal --}}
{{-- Usage: dispatch 'confirm-action' event with detail: { title, message, action, method, buttonText, buttonColor } --}}
{{-- Example: $dispatch('confirm-action', { title: 'Hapus Data', message: 'Yakin?', action: '/url', method: 'DELETE' }) --}}

<div x-data="confirmModal()" x-cloak
     @confirm-action.window="open($event.detail)"
     x-show="show"
     class="fixed inset-0 z-[70] flex items-center justify-center p-4"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/50" @click="show = false"></div>

    {{-- Modal --}}
    <div class="relative bg-white w-full max-w-md shadow-xl no-round z-10"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="scale-95 opacity-0"
         x-transition:enter-end="scale-100 opacity-100">

        <div class="p-6 text-center">
            {{-- Icon --}}
            <div class="w-14 h-14 mx-auto mb-4 flex items-center justify-center"
                 :class="btnColor === 'green' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'">
                <i class="fas text-2xl" :class="btnColor === 'green' ? 'fa-undo' : 'fa-exclamation-triangle'"></i>
            </div>

            {{-- Title --}}
            <h3 class="text-lg font-bold text-dark mb-2" x-text="title"></h3>

            {{-- Message --}}
            <p class="text-base text-gray-500 mb-6" x-text="message"></p>

            {{-- Actions --}}
            <div class="flex justify-center gap-3">
                <button @click="show = false" type="button"
                        class="bg-gray-200 text-gray-700 px-6 py-3 font-bold hover:bg-gray-300 transition uppercase text-sm no-round">
                    Batal
                </button>
                <form :action="action" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="_method" :value="method">
                    <button type="submit"
                            :class="btnColor === 'green' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'"
                            class="text-white px-6 py-3 font-bold transition uppercase text-sm no-round"
                            x-text="btnText">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmModal() {
    return {
        show: false,
        title: '',
        message: '',
        action: '',
        method: 'DELETE',
        btnText: 'Hapus',
        btnColor: 'red',

        open(detail) {
            this.title = detail.title || 'Konfirmasi';
            this.message = detail.message || 'Apakah Anda yakin?';
            this.action = detail.action || '';
            this.method = detail.method || 'DELETE';
            this.btnText = detail.buttonText || (detail.method === 'PATCH' ? 'Pulihkan' : 'Hapus');
            this.btnColor = detail.buttonColor || (detail.method === 'PATCH' ? 'green' : 'red');
            this.show = true;
        }
    }
}
</script>
