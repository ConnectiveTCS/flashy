<div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800 overflow-y-clip" id="styled-flashcards" role="tabpanel"
    aria-labelledby="flashcards-tab">
    <a href="{{ route('flashcards.deleteAll') }}" class=" w-fit block mb-2 text-sm font-medium text-white dark:text-white bg-red-900 hover:bg-red-700 rounded-md px-5 py-3 ml-auto hover:shadow-md">
        Delete All</a>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 rounded h-3/5">
        <thead class="bg-gray-300 dark:bg-gray-700">
            <tr >
                <th class="px-4 py-2 text-left">Module</th>
                <th class="px-4 py-2 text-left">Question</th>
                <th class="px-4 py-2 text-left">Answers</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($flashcards as $flashcard)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2">{{ $flashcard->module->name }}</td>
                    <td class="px-4 py-2">{{ $flashcard->question }}</td>
                    <td class="px-4 py-2">{{ $flashcard->answer }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('flashcards.edit', $flashcard->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('flashcards.destroy', $flashcard->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>
</div>
