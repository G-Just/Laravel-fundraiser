<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\Hashtag;
use App\Http\Requests\StoreCauseRequest;
use App\Http\Requests\UpdateCauseRequest;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CauseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $causes = Cause::withSum('donations as collected', 'donation')->paginate(5);
        return view('home', compact(['causes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cause.create');
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
            'thumbnail' => 'image'
        ]);

        $validated['owner'] = Auth::user()->id;

        if ($request->has('thumbnail')) {
            $imagePath = request('thumbnail')->store('cause', 'public');
            $validated['thumbnail'] = $imagePath;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCauseRequest $request, Cause $cause)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cause $cause)
    {
        //
    }

    /**
     * Store a newly donation resource in storage.
     */
    public function donate(Request $request, Cause $cause)
    {
        $validated = $request->validate([
            'donation' => 'numeric'
        ]);
        $validated['cause_id'] = $cause->id;
        $validated['user_id'] = Auth::user()->id;
        Donation::create($validated);
        return redirect()->route('cause.show', $cause)->with('message', 'Donation successful');
    }
}
