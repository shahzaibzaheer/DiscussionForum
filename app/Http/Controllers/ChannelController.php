<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelController extends Controller
{

    public function __construct()
    {
        $this->middleware('onlyAdmin');
    }


    public function showDiscussions(Channel $channel){
        $discussions = $channel->discussions()->paginate(4);
//        $discussions = Discussion::paginate(4); // get all discussion
        return view('discussion.index')->with('discussions',$discussions);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('channel.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('channel.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* by this way of handling validation,
          if data is not valid then request will be automatically
          redirected to submitted form with old data and validation error
        */
        $this->validate($request,[
            'title' => 'required',
        ]);


        Auth()->user()->channels()->create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
        ]);


        session()->flash('success','New Channel Successfully Created');
        return redirect()->route('channel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        return view('channel.create')
            ->with('channel',$channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        /* by this way of handling validation,
          if data is not valid then request will be automatically
          redirected to submitted form with old data and validation error
        */
        $this->validate($request,[
            'title' => 'required',
            'slug' => 'unique:channels',
        ]);

        $channel->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
        ]);

        session()->flash('success', 'Channel Updated Successfully');
        return redirect()->route('channel.index');
    }

    /**
     * Show the delete form
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function delete(Channel $channel)
    {
        return view('channel.delete')->with('slug',$channel->slug);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        $channel->delete();
        session()->flash('success',"Channel Deleted Successfully");
        return redirect()->route('channel.index');
    }
}
