<div class="flex flex-col min-w-40 h-fit">
    <form wire:submit.prevent="create" class="space-y-4 p-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                Task Title
            </label>
            <input type="text" id="title" wire:model="title" class="w-full px-3 py-2 bg-neutral-700 border border-neutral-600 rounded-lg 
                    text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 
                    focus:ring-neutral-500 focus:border-transparent" placeholder="Enter task title" required autofocus>
            @error('title')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                Task Description
            </label>
            <textarea id="description" wire:model="description" class="w-full px-3 py-2 bg-neutral-700 border border-neutral-600 rounded-lg 
                    text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 
                    focus:ring-neutral-500 focus:border-transparent" placeholder="Enter task description" rows="4"
                required></textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <flux:button type="submit">
                Create Task
            </flux:button>
        </div>
    </form>
</div>