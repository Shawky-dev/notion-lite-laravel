<x-layouts.app :title="__('Board')">
    {{-- header --}}
    <div class="text-2xl font-semibold text-gray-200 dark:text-white flex justify-between w-full ">
        <h1>
            {{$board->title}}
        </h1>
        <div>

            <flux:modal.trigger name="add-user">
                @livewire('board.members-list', ['board' => $board])
            </flux:modal.trigger>
            <flux:modal name='add-user' class=" md:w-96 h-full">
                @livewire('board.add-user', ['board' => $board])
            </flux:modal>
        </div>
    </div>
    <div class="flex flex-row space-x-3 mt-4 overflow-x-scroll h-full max-h-11/12">

        @livewire('board.section-list', ['board' => $board])
        <flux:modal.trigger name="add-section">
            <flux:button>+ Add Section</flux:button>
        </flux:modal.trigger>
        <flux:modal name="add-section" class="md:w-96">
            @livewire('board.add-section',['board'=>$board],key($board->id))
        </flux:modal>

    </div>
</x-layouts.app>