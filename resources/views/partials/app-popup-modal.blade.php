<div id="popup-modal" tabindex="-1"
    class="hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    {{-- create form for flashcards --}}
    <div class="relative p-4 w-full max-w-2xl h-[80%] bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-y-auto">
        <form action="{{ route('flashcards.store') }}" class="flex flex-col gap-4" method="POST" enctype="multipart/form-data">
            {{-- close button --}}
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
                <select name="module_id" id="module_id" class="border border-gray-300 rounded p-2 w-full">
                    <option value="">Select Module</option>
                    @foreach ($modules as $module)
                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="topic_id">Topic:</label>
                <select name="topic_id" id="topic_id" class="border border-gray-300 rounded p-2 w-full">
                    <option value="">Select Topic</option>
                    @foreach ($topics->sortBy('name') as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                    file</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    name="image" id="image" type="file">
            </div>
            <div class="flex justify-end mt-2 gap-2">
                <button type="submit" class=" block mb-2 text-sm font-medium text-white dark:text-white bg-gray-900 hover:bg-gray-700 rounded-md px-5 py-3 ml-auto hover:shadow-md">Submit</button>
                <button type="submit" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white border hover:bg-gray-500 hover:text-white border-gray-900 hover:border-gray-500 rounded-md px-5 py-3 hover:shadow-md">Cancel</button>
            </div>
        </form>
    </div>
</div>
