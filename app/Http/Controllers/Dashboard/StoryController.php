<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Story;
use App\Mail\StoryCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::latest()->paginate(20);

        return view('dashboard.stories.index', compact('stories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:5',
        ]);

        // Create story
        $story = auth()->user()->stories()->create($data);

        // send an email to admin
        Mail::to(config('mail.from.address'))->send(new StoryCreated($story));

        // redirect with message
        return to_route('story.index')->with('success', 'Story created successfully.');
    }

    public function show(Request $request, Story $story)
    {
        return view('dashboard.story.show', compact('story'));
    }

    public function approve(Request $request, Story $story)
    {
        $story->update(['approved' => true]);

        return to_route('story.index')->with('success', 'Story approved for public view.');
    }
}
