<dialog {{ $attributes->merge(['class' => 'modal']) }}>
    <div class="modal-box">
        <h3 class="text-lg font-bold">{{ $title }}</h3>

        {{ $slot }}

        <div class="flex justify-end space-x-2 align-middle">
            {{ $footer }}
        </div>
    </div>
    <form
        class="modal-backdrop"
        method="dialog"
    >
        <button>close</button>
    </form>
</dialog>
