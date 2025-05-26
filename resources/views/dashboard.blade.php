<x-app-layout>
    <div id="default-styled-tab-content" class="bg-white dark:bg-black w-full">

        {{-- popup modals --}}
        @include('partials.app-popup-modal')
        {{-- end of popup modals --}}
        @include('partials.dashboard-flashcards')
        @include('partials.dashboard-practice-papers')
    </div>
</x-app-layout>
