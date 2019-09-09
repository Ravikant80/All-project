<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Html;
class ImageController extends Controller
{
    public function ajaxImage(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_uploading');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);

                if ($validator->fails())
                    return array(
                        'fail' => true,
                        'errors' => $validator->errors()
                    );

                $extension = $request->file('file')->getClientOriginalExtension();
                $dir = 'uploads/';
                $filename = uniqid() . '_' . time() . '.' . $extension;
                $request->file('file')->move($dir, $filename);
                return $filename;
                    }
                }


                public function deleteImage($filename)
                {
                    File::delete('uploads/' . $filename);
                }
                

                public function hello()
                {
                    return 'hi Raushan';
                }


}