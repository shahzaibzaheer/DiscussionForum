<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{

    public function index(Request $request)
    {
        $discussions = Discussion::paginate(4); // get all discussion
        return view('discussion.index')->with('discussions',$discussions);
    }

    public function userDiscussions(){
        // get specific user's discussion
        $discussions = Auth()->user()->discussions()->get();
        return view('discussion.user.index')->with('discussions',$discussions);
    }


    public function create()
    {
        return view('discussion.user.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content'=>'required',
            'channel_id'=>'required',
        ]);

        Auth()->user()->discussions()->create([
            'title' => $request->input('title'),
            'slug'=> Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'channel_id' => $request->input('channel_id'),
        ]);
        session()->flash('success','New Discussion Successfully Created');


//        dd($discussions);
        return redirect()->route('discussion.userDiscussions');
//        dd($request->all());
    }

    public function show(Discussion $discussion)
    {
        $replies = $discussion->replies()->orderBy('created_at','DESC')->paginate(3);
        $bestReply = $discussion->replies()->where('isBestReply',true)->limit(1)->get()->first();
//        dd($bestReply->user->name);
        return view('discussion.show')
            ->with('discussion',$discussion)
            ->with('replies',$replies)
            ->with('bestReply',$bestReply);
    }


    public function edit(Discussion $discussion)
    {
        //
    }


    public function update(Request $request, Discussion $discussion)
    {
        //
    }


    public function destroy(Discussion $discussion)
    {
        //
    }
}
