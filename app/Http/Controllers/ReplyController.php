<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{


    /**
     * ReplyController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $discussion_id){
        $this->validate($request,['content'=>'required']);

        $discussion = Discussion::findOrFail($discussion_id);
        $discussion->replies()->create([
            'content' => $request->input('content'),
            'user_id' => Auth()->user()->id,
        ]);
        session()->flash('success','Reply Successfully created');
        return redirect()->route('discussion.show',['discussion'=>$discussion->slug]);
    }

    public function like(Reply $reply){
        // like the reply
        $reply->likes()->create([
            'user_id'=> Auth()->user()->id,
        ]);
        session()->flash('success','You like the reply');
        return redirect()->back();
    }

    public function unlike(Reply $reply){
        //delete the user's like on this reply

        $reply->likes()->where('user_id',Auth()->user()->id)->delete();
        session()->flash('success','You Unlike the reply');
        return redirect()->back();
    }

    public function markAsBest($discussion_id, Reply $reply){
        $discussion = Discussion::findOrFail($discussion_id);
//        dd('marked reply as best');
        //delete previous maked and set new as best reply
        $discussion->replies()->where('isBestReply',true)->update([
           'isBestReply'=>false,
        ]);

        // mark new reply as best reply
        $reply->update(['isBestReply'=>true]);
        session()->flash('success','Reply Successfully marked as best');
        return redirect()->back();
    }
    public function removeFromBest($discussion_id){
        $discussion = Discussion::findOrFail($discussion_id);
//        dd('marked reply as best');
        //delete previous maked and set new as best reply
        $discussion->replies()->where('isBestReply',true)->update([
           'isBestReply'=>false,
        ]);

        session()->flash('success','Successfully Removed from best reply');
        return redirect()->back();
    }

}
