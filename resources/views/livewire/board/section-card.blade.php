<div class="flex flex-col min-w-65 h-fit bg-neutral-600 rounded-lg shadow-sm">
    {{-- Section Header --}}
    <flux:modal name="add-task-{{$section->id}}" class="md:w-96">
        @livewire('board.add-task', ['section' => $section])
    </flux:modal>
    <div class="p-3 flex items-center justify-between">
        <h3 class="font-medium text-gray-300">{{ $section->title ?? 'New Section' }}</h3>
        <flux:dropdown position='bottom' align='center'>
            <flux:button variant='subtle' icon:trailing='ellipsis-vertical'></flux:button>

            <flux:menu>
                <flux:menu.item wire:click='delete' variant="danger" icon="trash">Delete</flux:menu.item>
            </flux:menu>

        </flux:dropdown>
    </div>

    {{-- Tasks Container --}}
    <div class="p-2 flex flex-col gap-2 min-h-[200px]">
        @foreach ($tasks as $task)
        <flux:modal.trigger name="task-modal-{{$task->id}}">
            @livewire('board.task-card', ['task' => $task], key('card-' . $task->id))
        </flux:modal.trigger>

        <flux:modal name="task-modal-{{$task->id}}" class="md:w-full h-full">
            @livewire('board.task-component', ['task' => $task], key('comp-' . $task->id))
        </flux:modal>
        @endforeach

        {{-- Add Task Button --}}
        <flux:modal.trigger name="add-task-{{$section->id}}">
            <button class="w-full p-2 text-left text-gray-300 hover:bg-neutral-800 rounded">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add a card
                </span>
            </button>
        </flux:modal.trigger>
    </div>

</div>