<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $stories = Story::latest()
            ->approved()
            ->cursorPaginate(30);

        return view('notice.index', compact('stories'));
    }

    /**
     * Display a listing of the resource for API
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiIndex(Request $request)
    {
        $request->validate([
            'post_id' => 'integer|min:0',
        ]);

        $stories = Story::latest()
            ->approved()
            ->where('id', '>', $request->input('post_id'))
            ->cursorPaginate(30);

        return response()->json($stories);
    }
}
