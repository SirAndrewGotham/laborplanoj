<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $board->name }}
        </h2>
        </div>
    </x-slot>

    <div class="w-full p-6 overflow-x-scroll">
        <div
            class="flex w-max space-x-6 h-[calc(theme('height.screen')-64px-73px-theme('padding.12'))]"
            wire:sortable="sorted"
            wire:sortable-group="moved"
        >
            @foreach($columns as $column)
                <div wire:key="{{ $column->id }}" wire:sortable.item="{{ $column->id }}">
                    <livewire:column :key="$column->id" :column="$column" />
                </div>
            @endforeach
        </div>
    </div>
</div>
