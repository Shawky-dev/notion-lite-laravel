<div class="flex flex-row space-x-3">
    @foreach ($sections as $section)
    @livewire('board.section-card', ['section' => $section], key($section->id))
    @endforeach
</div>