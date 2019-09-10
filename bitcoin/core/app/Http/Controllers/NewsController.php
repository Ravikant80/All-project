<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function getKnowledge(Request $request){
        $data['page_title'] = "News Section";
        $data['news']= News::orderBy('updated_at','DESC')
                 ->paginate(5);
        return view('home.news', $data);
        
    }
    public function getNewsDetails($slug ,$id){

        $headlines = str_replace('-', ' ', $slug);
        $data['news'] = News::where('headlines','=',$headlines)
                    ->orWhere('news_id',$id)->get();
        $data['page_title'] =$headlines ;
        return view('home.news-details', $data);
       
    }
    public function adminNews(){
        
        $data['page_title'] = 'News Section';
        
        $data['newsdata']=News::orderBy('updated_at','DESC')->get();
        return view('dashboard.news-section',$data);
    }
    
    public function adminAddNews(Request $request){
         
        $this->validate($request,[
            'headlines' => 'required',
            'story' => 'required',
            'image'=>'sometimes|required',
            'video'=>'sometimes|required',
            'otherlinks'=>'sometimes|required',
        ]);
        /*
         if ($this->fails()) {
            return Response::json(['success' => false, 'message' => 'Error while added news!!']);
        }
        */
        // $new = new News;
        // $news =$new->createNews($request->all());
        
        $news = new News;
        $news->headlines=$request->headlines;
        $news->story=$request->story;
      
         if ($request->hasFile('image')) {      
            $image = $request->file('image');
            $filename ="img_" .$image->getClientOriginalName();
            Image::make($image)->save('assets/images/news/' . $filename);
            $news->image = $filename;
            $news->save();
        }
        if ($request->hasFile('video')) {      
            $video = $request->file('video');
            $fileVideo ="video_". $video->getClientOriginalName();
            $location ="assets/images/news/".$fileVideo;
            $video->move($location);
          //  Image::make($video)->save('assets/images/news/' . $fileVideo);
            $news->video = $fileVideo;
            $news->save();
        }
        $news->otherlinks=$request->otherlinks;
        $news->save();
        
        return response()->json($news);
      
    }
    public function editNews($news_id)
    {
        $news = News::find($news_id);
        return response()->json($news);
    }
    public function updateNews(Request $request,$news_id)
    {
        
        $this->validate($request,[
            'headlines' => 'required',
            'story' => 'required',
            'image'=>'sometimes|required',
            'video'=>'sometimes|required',
            'otherlinks'=>'sometimes|required',
        ]);
        
//        if($this->fails()){
//          return Response::json(["success"=>false,"error"=>$this->errors()]);
//        }
  
       //print_r($request->all());
      
        
        $news = News::find($news_id);
        $news->headlines=$request->headlines;

        $news->story=$request->story;
      
         if ($request->hasFile('image')) {      
            $image = $request->file('image');
            $filename ="img_" .$image->getClientOriginalName();
            Image::make($image)->save('assets/images/news/' . $filename);
            $news->image = $filename;
            $news->save();
        }
        if ($request->hasFile('video')) {      
            $video = $request->file('video');
            $fileVideo ="video_". $video->getClientOriginalName();
            $location ="assets/images/news/".$fileVideo;
            $video->move($location);
         
            $news->video = $fileVideo;
            $news->save();
        }
    
        $news->otherlinks=$request->otherlinks;
        $news->save();
        return response()->json($news);
    }
    public function admindeleteNews($id){
        
        $news =  News::find($id);
        $news->delete();
        return redirect('admin/news-section');
        
        
    }
    public function adminViewNews($id){
        $news =  News::find($id);
        
        
    }




}