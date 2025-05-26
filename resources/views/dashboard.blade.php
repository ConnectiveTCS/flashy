<x-app-layout>
    {{-- popup modals --}}
    @include('partials.app-popup-modal')
    {{-- end of popup modals --}}
    <div id="default-styled-tab-content" class="bg-white dark:bg-black min-h-screen w-full">
        @include('partials.dashboard-flashcards')
        @include('partials.dashboard-practice-papers')
    </div>
</x-app-layout>
