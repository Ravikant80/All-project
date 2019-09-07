<?php
namespace App\Http\Controllers;
use File;
use Image;
use App\Photo;
use Redirect;
use Illuminate\Http\Request;
class PhotoController extends Controller
{
    protected $photo;
 
    /**
     * [__construct description]
     * @param Photo $photo [description]
     */
 	public function __construct(  Photo $photo )
      
    {
        $this->photo = $photo;
    }
 
    /**
     * Display photo input and recent images
     * @return view [description]
     */
    public function index(){


        $photos = Photo::all();
        
        return view('photo', compact('photos'));
   	 }



    public function deleteImg($id){
    $photos = Photo::findOrFail($id);
    $photos->delete();
    return back()->with('success','Item delete successfully!');
     }
 


    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        //you can store only jpeg,png,jpg,gif,svg in database

        //svg -> scale vector graphics
 
                 //check if image exist

            if ($request->hasFile('image')) {
                $images = $request->file('image');
     
                //setting flag for condition

                $org_img = $thm_img = true;
     
                //if file does'nt exist in public folder then make the directory in public folder images->originals

                if( ! File::exists('images/originals/')) {
                    $org_img = File::makeDirectory('images/originals/', 0777, true);
                }
                //if file does'nt exist in public folder then make the directory in public folder images->thumbnails

                if ( ! File::exists('images/thumbnails/')) {
                    $thm_img = File::makeDirectory('images/thumbnails', 0777, true);
                }
 
            
                //loop through each image to save and upload

                foreach($images as $key => $image) {
                //create new instance of Photo class

                $newPhoto = new $this->photo;
                //get file name of image  and concatenate with 4 random integer for unique

                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

            
                //path image to upload inside the public folder images->originals->imagesave with       extension,with name


                $org_path = 'images/originals/' . $filename;
                $thm_path = 'images/thumbnails/' . $filename;
                $newPhoto->image     = 'images/originals/'.$filename;
                $newPhoto->thumbnail = 'images/thumbnails/'.$filename;                                                                                           

                //don't upload file when unable to save name to save in database if thumbnail and original thumbnail not matched unable to save if originals/images not matched


                if ( ! $newPhoto->save()) {
                        return false;
                }
 
                //Upload Image to Server

                if (($org_img && $thm_img) == true) {
                   Image::make($image)->fit(900, 500, function ($constraint) {
                           $constraint->upsize();
                       })->save($org_path);
                   Image::make($image)->fit(270, 160, function ($constraint) {
                       $constraint->upsize();
                   })->save($thm_path);
                }
            }
        }
 
                return redirect()->action('PhotoController@index');

                // return redirect()->back();
 
    }

           
            //get the full infromation this code on the gagan skype

    
}