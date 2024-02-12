<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\Hashtag;
use App\Http\Requests\StoreCauseRequest;
use App\Http\Requests\UpdateCauseRequest;
use App\Models\Donation;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CauseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $causes = Cause::withSum('donations as collected', 'donation')->where('approved', '=', 1)->paginate(5);
        $private = null;
        if (Auth::check()) {
            $private = Cause::withSum('donations as collected', 'donation')->where('user_id', '=', Auth::user()->id)->where('approved', '=', 0)->first();
        }

        return view('home', compact(['causes', 'private']));
    }

    /**
     * Display a listing of the queued resources.
     */
    public function queue()
    {
        $causes = Cause::withSum('donations as collected', 'donation')->where('approved', '=', 0)->paginate(5);
        return view('cause.queue', compact(['causes']));
    }

    /**
     * Show the form for creating a new resource.
     * @disregard [cause() method exists, but not detected by intelephense]
     */
    public function create()
    {
        if (Auth::user()->cause()->count() === 1) {
            return redirect()->route('home')->with('error', 'Users can only create one cause');
        };
        $hashtags = Hashtag::all();
        return view('cause.create', compact(['hashtags']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCauseRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:30',
            'description' => 'nullable|string',
            'goal' => 'numeric',
            'thumbnail' => 'image',
            'image' => 'image',
        ]);

        $validated['user_id'] = Auth::user()->id;

        if ($request->has('thumbnail')) {
            $imagePath = request('thumbnail')->store('cause', 'public');
            $validated['thumbnail'] = url('storage/' . $imagePath);
        }

        $cause = Cause::create($validated);

        if (isset($request->hashtags)) {
            foreach ($request->hashtags as $hashtag) {
                if (strlen($hashtag) > 0) {
                    $hashtag = Hashtag::updateOrCreate(['hashtag' => $hashtag]);
                    $cause->hashtags()->syncWithoutDetaching($hashtag);
                }
            }
        }
        if (isset($request->images)) {
            foreach ($request->images as $image) {
                $imagePath = $image->store('cause', 'public');
                Image::updateOrCreate(['image' => $imagePath, 'cause_id' => $cause->id]);
            }
        }

        return redirect()->route('home')->with('message', 'Cause created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cause = Cause::where('id', '=', $id)->withSum('donations as collected', 'donation')->first();
        return view('cause.show', compact(['cause']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cause $cause)
    {
        if ($cause->approved) {
            return redirect()->route('cause.show', compact(['cause']))->with('error', 'Cannot edit the post after it has been approved');
        };
        $hashtags = Hashtag::all();
        return view('cause.edit', compact(['cause', 'hashtags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCauseRequest $request, Cause $cause)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:30',
            'description' => 'nullable|string',
            'goal' => 'numeric',
        ]);

        DB::table('cause_hashtag')->whereIn('cause_id', [$cause->id])->delete();

        if (isset($request->hashtags)) {
            foreach ($request->hashtags as $hashtag) {
                if (strlen($hashtag) > 0) {
                    $hashtag = Hashtag::updateOrCreate(['hashtag' => $hashtag]);
                    $cause->hashtags()->syncWithoutDetaching($hashtag);
                }
            }
        }

        if ($request->approved) {
            $validated['approved'] = true;
        };

        $cause->update($validated);

        return redirect()->route('cause.edit', $cause)->with('message', 'Cause updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cause $cause)
    {
        $cause->delete();
        return redirect()->route('home')->with('message', 'Cause deleted successfully');
    }

    /**
     * Store a new donation resource in storage.
     */
    public function donate(Request $request, Cause $cause)
    {
        $cause = Cause::where('id', '=', $cause->id)->withSum('donations as collected', 'donation')->first();
        $validated = $request->validate([
            'donation' => 'numeric|min:0.01'
        ]);
        $validated['cause_id'] = $cause->id;
        $validated['user_id'] = Auth::user()->id;
        Donation::create($validated);
        return redirect()->route('cause.show', $cause)->with('message', 'Donation successful');
    }

    /**
     * Store a like resource in storage.
     * @disregard [likes() method exists, but not detected by intelephense]
     */
    public function like(Cause $cause, Request $request)
    {
        auth()->user()->likes()->attach($cause);
        return redirect()->route('home', ['page' => $request->page]);
    }

    /**
     * Destroy a like resource in storage.
     * @disregard [likes() method exists, but not detected by intelephense]
     */
    public function dislike(Cause $cause, Request $request)
    {
        auth()->user()->likes()->detach($cause);
        return redirect()->route('home', ['page' => $request->page]);
    }
}
