<?php

namespace App\Http\Controllers;

use App\Discussion;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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


        $slug = Str::slug($request->input('title'));
        if(DB::table('discussions')->where('slug',$slug)->count() > 0 ){
            return redirect()->back()->withInput()->withErrors(['slug'=>'slug should be unique']);
        }


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


//    Show the edit discussion forum
    public function edit(Discussion $discussion)
    {
        return view('discussion.user.update')->with('discussion',$discussion);
    }


    public function update(Request $request, Discussion $discussion)
    {
        // this will solve the problem, when user change select option in dropdown,
        // and if validation error occur, the dropdown change will be discarded to default automatically
        // following line will solve that
        $discussion->update(['channel_id' => $request->input('channel_id')]);


        $this->validate($request,[
            'title' => 'required',
            'content'=>'required',
            'channel_id'=>'required',
        ]);


        $slug = Str::slug($request->input('title'));
        if(DB::table('discussions')->where('slug',$slug)->count() > 0 ){
            return redirect()->back()->withInput()->withErrors(['slug'=>'slug should be unique']);
        }



            $discussion->update([
                'title' => $request->input('title'),
                'slug'=> Str::slug($request->input('title')),
                'content' => $request->input('content'),
                'channel_id' => $request->input('channel_id'),
            ]);

        session()->flash('success','Discussion Successfully Updated');

//        dd($discussions);
        return redirect()->route('discussion.userDiscussions');
//        dd($request->all());

    }


    /* Show the delete form */
    public function delete(Discussion $discussion){
        return view('discussion.user.delete')->with('slug',$discussion->slug);
    }

    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        session()->flash('success','Discussion Successfully Deleted');
        return redirect()->route('discussion.userDiscussions');
    }
}
