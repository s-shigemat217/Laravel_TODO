<div>
    @if ($message)
    <div class="alert alert-{{ $type }} alert-dismissible fade show my-4 p-4 rounded-sm bg-white flex justify-between items-center" role="alert">
        <p>{{ $message }}</p>
        <flux:button type="button" variant="ghost" size="sm" class="ms-auto" onclick="this.parentElement.style.display='none';">✕</flux:button>
    </div>
    @endif
</div>
