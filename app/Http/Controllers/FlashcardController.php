<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlashcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $flashcards = Flashcard::all();
        $modules = \App\Models\Module::all();
        $topics = \App\Models\Topic::all();
        return view('flashcards.index', compact('flashcards', 'modules', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('flashcards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'module_id' => 'required|exists:modules,id',
            'topic_id' => 'required|exists:topics,id',
            'image' => 'nullable|image|max:2048',
        ]);
        $flashcard = new Flashcard();
        $flashcard->user_id = Auth::user()->id;
        $flashcard->question = $request->question;
        $flashcard->answer = $request->answer;
        $flashcard->module_id = $request->module_id;
        $flashcard->topic_id = $request->topic_id;
        if ($request->hasFile('image')) {
            $flashcard->image = $request->file('image')->store('images', 'public');
        }
        $flashcard->is_bookmarked = $request->has('is_bookmarked');
        $flashcard->is_correct = $request->has('is_correct');
        $flashcard->is_incorrect = $request->has('is_incorrect');
        $flashcard->save();
        return redirect()->route('flashcards.index')->with('success', 'Flashcard created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flashcard $flashcard)
    {
        //  
        return view('flashcards.show', compact('flashcard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flashcard $flashcard)
    {
        //
        return view('flashcards.edit', compact('flashcard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flashcard $flashcard)
    {
        //
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'module_id' => 'required|exists:modules,id',
            'topic_id' => 'required|exists:topics,id',
            'image' => 'nullable|image|max:2048',
        ]);
        $flashcard->question = $request->question;
        $flashcard->answer = $request->answer;
        $flashcard->module_id = $request->module_id;
        $flashcard->topic_id = $request->topic_id;
        if ($request->hasFile('image')) {
            $flashcard->image = $request->file('image')->store('images', 'public');
        }
        $flashcard->is_bookmarked = $request->has('is_bookmarked');
        $flashcard->is_correct = $request->has('is_correct');
        $flashcard->is_incorrect = $request->has('is_incorrect');
        $flashcard->save();
        return redirect()->route('flashcards.index')->with('success', 'Flashcard updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flashcard $flashcard)
    {
        //
        $flashcard->delete();
        return redirect()->route('flashcards.index')->with('success', 'Flashcard deleted successfully.');
    }

    /**
     * Add Multiple Flashcards
     */
    public function addMultiple(Request $request)
    {
        $request->validate([
            'flashcards' => 'required|array',
            'flashcards.*.question' => 'required|string|max:255',
            'flashcards.*.answer' => 'required|string',
            'flashcards.*.module_id' => 'required|exists:modules,id',
            'flashcards.*.topic_id' => 'required|exists:topics,id',
            'flashcards.*.image' => 'nullable|image|max:2048',
        ]);

        foreach ($request->flashcards as $data) {
            $flashcard = new Flashcard();
            $flashcard->user_id = Auth::user()->id;
            $flashcard->question = $data['question'];
            $flashcard->answer = $data['answer'];
            $flashcard->module_id = $data['module_id'];
            $flashcard->topic_id = $data['topic_id'];
            if (isset($data['image'])) {
                $flashcard->image = $data['image']->store('images', 'public');
            }
            $flashcard->is_bookmarked = isset($data['is_bookmarked']) ? true : false;
            $flashcard->is_correct = isset($data['is_correct']) ? true : false;
            $flashcard->is_incorrect = isset($data['is_incorrect']) ? true : false;
            $flashcard->save();
        }

        return redirect()->route('flashcards.index')->with('success', 'Flashcards added successfully.');
    }
    /**
     * Bookmark a flashcard
     */
    public function bookmark(Flashcard $flashcard)
    {
        $flashcard->is_bookmarked = !$flashcard->is_bookmarked;
        $flashcard->save();
        return redirect()->back()->with('success', 'Flashcard bookmark status updated successfully.');
    }
    /**
     * Mark a flashcard as correct
     */
    public function markAsCorrect(Flashcard $flashcard)
    {
        $flashcard->is_correct = true;
        $flashcard->is_incorrect = false;
        $flashcard->save();
        return redirect()->back()->with('success', 'Flashcard marked as correct successfully.');
    }
    /**
     * Mark a flashcard as incorrect
     */
    public function markAsIncorrect(Flashcard $flashcard)
    {
        $flashcard->is_incorrect = true;
        $flashcard->is_correct = false;
        $flashcard->save();
        return redirect()->back()->with('success', 'Flashcard marked as incorrect successfully.');
    }
    /**
     * Remove a flashcard from bookmarks
     */
    public function removeBookmark(Flashcard $flashcard)
    {
        $flashcard->is_bookmarked = false;
        $flashcard->save();
        return redirect()->back()->with('success', 'Flashcard removed from bookmarks successfully.');
    }
    /**
     * Search flashcards
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);
        $query = $request->input('query');
        $flashcards = Flashcard::where('question', 'like', "%{$query}%")
            ->orWhere('answer', 'like', "%{$query}%")
            ->get();
        return view('flashcards.index', compact('flashcards'));
    }
    /**
     * Filter flashcards by module
     */
    public function filterByModule(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
        ]);
        $moduleId = $request->input('module_id');
        $flashcards = Flashcard::where('module_id', $moduleId)->get();
        return view('flashcards.index', compact('flashcards'));
    }
    /**
     * Filter flashcards by topic
     */
    public function filterByTopic(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
        ]);
        $topicId = $request->input('topic_id');
        $flashcards = Flashcard::where('topic_id', $topicId)->get();
        return view('flashcards.index', compact('flashcards'));
    }
}
