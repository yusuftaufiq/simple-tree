<div
    class="toast toast-end toast-top"
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
>
    <div {{ $attributes->merge(['class' => 'alert alert-success']) }}>
        {{ $slot }}
    </div>
</div>
