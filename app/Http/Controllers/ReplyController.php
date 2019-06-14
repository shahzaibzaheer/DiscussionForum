<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

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

}
