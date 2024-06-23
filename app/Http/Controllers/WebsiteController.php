<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('size', 50);
        $category = $request->input('category');
        if($category){
            $websites = Website::with('category')
            ->where('category_id', $category)
            ->orderByDesc('vote_count')
            ->paginate($perPage);
            return response()->json(['websites' => $websites], 200);
        }
        $websites = Website::with('category')
        ->orderByDesc('vote_count')
        ->paginate($perPage);
        return response()->json(['websites' => $websites], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url|unique:websites',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        $website = Website::create([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
        ]);

        return response()->json(['website' => $website], 201);
    }

    public function vote(Request $request, $id)
    {
        $website = Website::findOrFail($id);
        $vote = $website->votes()->where('user_id', Auth::id())->first();

        if ($vote) {
            $vote->delete();
            $website->vote_count--;
            $website->save();
            return response()->json(['message' => 'Vote removed'], 200);
        } else {
            $website->votes()->create(['user_id' => Auth::id()]);
            $website->vote_count++;
            $website->save();
            return response()->json(['message' => 'Vote added'], 200);
        }
    }

    public function destroy($id)
    {
        $website = Website::find($id);

        if (!$website) {
            return response()->json(['error' => 'Website not found'], 404);
        }

        $website->delete();

        return response()->json(['message' => 'Website deleted successfully']);
    }

}
