<dialog {{ $attributes->merge(['class' => 'modal']) }}>
    <form
        class="modal-box"
        method="dialog"
    >
        <h3 class="text-lg font-bold">{{ $title }}</h3>

        {{ $slot }}

        <div class="flex justify-end space-x-2 align-middle">
            {{ $footer }}
        </div>
    </form>
    <form
        class="modal-backdrop"
        method="dialog"
    >
        <button>close</button>
    </form>
</dialog>
