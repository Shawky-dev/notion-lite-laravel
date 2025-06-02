<div class="p-4">
    <h2 class="text-lg font-medium text-gray-200 mb-4">Board Members</h2>

    @if($members->isEmpty())
    <p class="text-gray-400">No members yet</p>
    @else
    <ul class="space-y-2 mb-6">
        @foreach($members as $user)
        <li class="flex items-center justify-between p-2 hover:bg-neutral-700 rounded-lg">
            <div class="flex items-center space-x-3">
                <flux:avatar size="sm" color="auto" color:seed="{{ $user->id }}" :initials="$user->initials()" />
                <span class="text-gray-200">{{ $user->name }}</span>
            </div>
            <flux:button wire:click="removeUser({{ $user->id }})" size="sm" variant="ghost"
                class="text-red-500 hover:text-red-700">
                Remove
            </flux:button>
        </li>
        @endforeach
    </ul>
    @endif

    <h2 class="text-lg font-medium text-gray-200 mb-4">Add Members</h2>

    @if($users->isEmpty())
    <p class="text-gray-400">No users available to add</p>
    @else
    <ul class="space-y-2">
        @foreach($users as $user)
        <li class="flex items-center justify-between p-2 hover:bg-neutral-700 rounded-lg">
            <div class="flex items-center space-x-3">
                <flux:avatar size="sm" color="auto" color:seed="{{ $user->id }}" :initials="$user->initials()" />
                <span class="text-gray-200">{{ $user->name }}</span>
            </div>
            <flux:button wire:click="addUser({{ $user->id }})" size="sm" variant="subtle">
                Add
            </flux:button>
        </li>
        @endforeach
    </ul>
    @endif
</div>