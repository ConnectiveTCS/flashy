<div id="popup-modal" tabindex="-1"
    class="hiddden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    {{-- create form for flashcards --}}
    <div class="relative p-4 w-full max-w-2xl max-h-full bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <form action="" class="flex flex-col gap-4" method="POST">
            @csrf
            <h2 class="text-xl text-center mb-4">Add Flashcard</h2>
            <div>
                <label for="question">Question:</label>
                <input type="text" id="question" name="question" class="border border-gray-300 rounded p-2 w-full"
                    required>
            </div>
            <div class="mt-4 flex flex-col">
                <label for="answer">Answer:</label>
                <textarea name="answer" id="answer" cols="30" rows="10" class="border border-gray-300 rounded p-2 w-full"></textarea>
            </div>
            <div>
                <label for="module_id">Module:</label>
                <select name="module_id" id="module_id"
                    class="border border-gray-300 rounded p-2 w-full">
                    <option value="">Select Module</option>
                    @foreach ($modules as $module)
                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>
