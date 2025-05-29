<div wire:click='click' class="text-gray-100 flex items-center justify-between p-3 rounded-lg hover:bg-gray-300 hover:text-gray-600 transition-colors cursor-pointer">
    <div class="font-medium">{{ $boardTitle }}</div>
    <div class="flex items-center space-x-4 ">
        <div class="flex items-center space-x-1">
            <flux:icon.users class="w-4 h-4" />
            <span class="text-sm">{{ $boardMembersCount }}</span>
        </div>
        
        <div class="flex items-center space-x-1">
            <flux:icon.rectangle-stack class="w-4 h-4" />
            <span class="text-sm">{{ $boardTasksCount }}</span>
        </div>
    </div>
</div>  