<div class="flex flex-row space-x-1 items-center cursor-pointer hover:opacity-50">
    @foreach ($user_bubbles as $user)
    <flux:avatar class="cursor-pointer" size="sm" color="auto" color:seed="{{ $user->id }}"
        :initials="$user-> initials()" />
    @endforeach
    <flux:icon.plus />
</div>