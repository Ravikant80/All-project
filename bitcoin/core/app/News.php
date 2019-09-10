<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Input;
class News extends Model
{
    protected $table = 'news';
    protected $primaryKey ="news_id";
    protected $fillable = ['headlines','story','image','video','other_links'];
    
    public function createNews(Request $request){
        
         $news = new News;
         $news->headlines=$request->headlines;
         $news->story=$request->story;
      
         if ($request->hasFile('image')) {      
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            Image::make($image)->save('assets/images/news/' . $filename);
            $news->image = $filename;
            $news->save();
        }
        if ($request->hasFile('video')) {      
            $video = $request->file('video');
            $fileVideo = $video->getClientOriginalName();
            $location ="assets/images/news/".$fileVideo;
            $video->move($location);
          //  Image::make($video)->save('assets/images/news/' . $fileVideo);
            $news->video = $fileVideo;
            $news->save();
        }
        $news->otherlinks=$request->otherlinks;
        $news->save();
        return $news;
        
    }
}
