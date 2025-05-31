<div
     class="group flex flex-col p-3 bg-neutral-800 rounded-lg shadow-sm hover:bg-neutral-700 transition-colors duration-200 cursor-pointer">
    <div class="flex flex-row justify-between">
        <div>
            {{-- Task Title --}}
            <h4 class="{{$task->status ? 'line-through' : ''}} text-sm font-medium text-gray-100">
                {{ $task->title }}
            </h4>
            @if ($task->description)
                <p class="text-xs text-gray-200 line-clamp-2 mb-3">
                    {{ $task->description }}
                </p>
            @endif
            <flux:avatar class="cursor-pointer"
                         size="xs"
                         color="auto"
                         color:seed="{{ $user->id }}"
                         :initials="$user-> initials()" />
        </div>
        <div class="flex-shrink-0 ">
            {{-- Checkbox Status --}}
            <div
                 class="appearance-none flex items-center justify-center text-2xl p-[0.1rem] border-2 border-neutral-500 hover:border-neutral-300 rounded-lg w-7 h-7"
                 wire:click="changeTaskStatus"
                 >
                 @if ($task->status)
                 <flux:icon.check class=" text-neutral-00"/> 
                 @endif
            </div>
        </div>
    </div>
    {{-- Task Description Preview --}}
    {{-- Task Meta Info --}}
    <div class="flex items-center justify-end mt-auto">
        {{-- Task Info --}}
        <div class="flex items-center gap-2 text-gray-400">
            {{-- Archive Status --}}
            @if ($task->archive)
                <span class="flex items-center">
                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </span>
            @endif
            {{-- Created Date --}}
            <span class="text-xs">
                {{ $task->created_at->format('M d') }}
            </span>
        </div>
    </div>
</div>
