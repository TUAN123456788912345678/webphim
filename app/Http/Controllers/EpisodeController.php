<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use Carbon\Carbon;
class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get();
          return view('admincp.episode.index', compact('list_episode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id')->all();
        return view('admincp.episode.form', compact('list_movie'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $ep = new Episode();
        $ep->movie_id = $data['movie_id'];
        $ep->linkphim = $data['link'];
        $ep->episode = $data['episode'];
        $ep->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id')->all();
        $episode = Episode::find($id);
        return view('admincp.episode.form', compact('episode','list_movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
{
    $data = $request->all();
    
    // Kiểm tra xem episode có tồn tại hay không
    $ep = Episode::find($id);
    if (!$ep) {
        return redirect()->back()->with('error', 'Không tìm thấy episode để cập nhật.');
    }

    $ep->movie_id = $data['movie_id'];
    $ep->linkphim = $data['link'];
    $ep->episode = $data['episode'];
    $ep->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
    $ep->save();
    return redirect()->back()->with('success', 'Cập nhật episode thành công.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function select_movie(){
        $id =$_GET['id'];
        $movie =Movie::find($id);
        $output='<option>--Chọn tập phim--</option>';
                              
        for($i=1;$i<=$movie->sotap;$i++){
            $output.='<option value="'.$i.'" >'.$i.'</option>';
        }
        echo $output;
    }
}
