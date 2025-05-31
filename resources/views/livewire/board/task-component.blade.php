<div class="flex flex-col h-full bg-neutral-800 rounded-lg p-3">
    <div class="flex-1 flex flex-row justify-between m-3">
        <!-- Task Title -->
        <div>

            <h3 class="text-lg font-medium text-gray-100">
                {{$task->title}}
            </h3>

            <!-- Task Description - truncated with ellipsis -->
            @if($task->description)
            <p class="text-xs text-gray-400 line-clamp-2">
                {{$task->description}}
            </p>
            @endif
        </div>
        <div class="flex flex-row space-x-2">
            <flux:icon.pencil-square
                class="text-neutral-300 hover:text-neutral-600 hover:cursor-pointer transition-colors duration-100" />
            <flux:icon.trash
                class="hover:text-red-600 text-neutral-300 hover:cursor-pointer transition-colors duration-100" />
        </div>
    </div>

    <!-- Task Footer -->
    <div class="flex items-center justify-between pt-2 text-sm text-gray-400 border-t border-neutral-700">
        <!-- Created By -->
        <div class="flex items-center space-x-2">
            <flux:avatar class="cursor-pointer" :initials="auth()->user()->initials()" />
            <span>{{ $task->user->name }}</span>
        </div>

        <!-- Created At -->
        <span>{{ $task->created_at->diffForHumans() }}</span>
    </div>
</div>