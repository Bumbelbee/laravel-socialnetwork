<?php

namespace App\Http\Controllers;

use App\Community;
use Illuminate\Http\Request;
Use DB;
use Illuminate\Support\Facades\Auth;
use Session;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();
        $community = DB::table('communities')->select('id','title','description')->get();
        $allow = DB::table('comm_follow')->where('userId', $user->id)->get();
        return view('comm.index',compact('user','community','allow'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('comm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $community = new Community;

        $community->title = $request->title;
        $community->description = $request->desc;
        $community->creator = $request->creator;
        $community->save();
        
        return redirect()->route('community.show',$community->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {   $user = Auth::user();
        $wall = [
            'new_post_group_id' => 3
        ];
        $community = DB::table('communities')->where('title',$title)->get();

        return view('comm.show',compact('user','community','wall'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Community $community)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        //
    }

    public function follow(Request $request){
        $title = $request->title;
        $commId = $request->commId;
        $userId = $request->userId;

        DB::table('comm_follow')->insert(['userId'=>$userId,'commId'=>$commId]);
        DB::table('comm_follow')->where(['userId'=>$userId,'commId'=>$commId])->update(['allow' => 1 ]);
       
        $follow = DB::table('communities')->where('title',$title)->update(['follow' => 1]);
        $follow = DB::table('communities')->where('title',$title)->increment('followers');
        
        Session::flash('success',"now you follow this community");  
        return redirect()->route('community.show',$title);
    }

    public function unfollow(Request $request){
        $title = $request->title;
        $commId = $request->commId;
        $userId = $request->userId;

        $unfollow = DB::table('communities')->where('title',$title)->update(['follow' => 0]); 
        $unfollow = DB::table('communities')->where('title',$title)->decrement('followers');
        Session::flash('success',"now you unfollow this community");  
        return redirect()->route('community.show',$title);
    }

}
