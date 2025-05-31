<div class="flex flex-col min-w-65 h-fit bg-neutral-600 rounded-lg shadow-sm">
    {{-- Section Header --}}
    <div class="p-3 flex items-center justify-between">
        <h3 class="font-medium text-gray-300">{{ $section->title ?? 'New Section' }}</h3>
        <button class="text-gray-300 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
            </svg>
        </button>
    </div>

    {{-- Tasks Container --}}
    <div class="p-2 flex flex-col gap-2 min-h-[200px]">
        @foreach ($section->tasks()->get() as $task)
            @livewire('board.task-card', ['task' => $task], key($task->id))
        @endforeach
        {{-- Add Task Button --}}
        <button class="w-full p-2 text-left text-gray-300 hover:bg-neutral-800 rounded">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add a card
            </span>
        </button>
    </div>
</div>