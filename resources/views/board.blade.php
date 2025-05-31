<x-layouts.app :title="__('Board')">
    {{-- header --}}
        <div class="text-2xl font-semibold text-gray-200 dark:text-white flex justify-between w-full ">
            <h1>
                {{$board->title}}
            </h1>
            <h1>
                members
            </h1>
        </div>
        <div class="flex flex-row space-x-3 mt-4 overflow-x-scroll h-full max-h-11/12">
        
        @foreach ($board->sections()->get() as $section)
            @livewire('board.section-card', ['section' => $section], key($section->id))
        @endforeach
        </div>
</x-layouts.app>
