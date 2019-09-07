<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Category;
use App\Product;
use Image;
use App\User;
use App\Order;
class AdminController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function getDashboard(){

        $data['page_title'] =  "Dashboard";
        $data['total_user'] =  User::all()->count();
        $data['total_order'] = Order::all()->count();
        return view('admin_dashboard.index', $data);
    }

    public function getCategory(){

        $data['page_title'] = "Category";
        $data['category'] = Category::all();

        return view('admin.category.index', $data);
    }
    public function createCategory(){

        $data['page_title'] = "Create Category";
        $data['category'] = Category::all();

        return view('admin.category.create', $data);
    }

    public function storeCategory(Request $request){

       // print_r($request->all());
       // die;
        $this->validate($request,[
            'name' => 'required',
        ]);

        $parentdata = Category::where('name', $request->parent_id)->first();
        if($parentdata != NULL){
            $id=$parentdata->id;
        }
        else{
            $id =0;
        }
        $category = new Category;
        $category->name=$request->name;
        $category->slug=$request->slug;

        $category->parent_id=$id;
        $category->meta_title=$request->meta_title;
        $category->meta_description=$request->meta_description;
        $category->save();
        session()->flash('message', 'Category Added Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect('admin/category');
       // return redirect()->back();

    }
    public function editCategory($id){

        $data['page_title'] = "Edit Category";
        $data['category'] = Category::findOrFail($id);
        return view('admin.category.edit', $data);
    }
    public function updateCategory(Request $request,$id){

        $this->validate($request,[
            'name' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->parent_id=$request->parent_id;
        $category->meta_title=$request->meta_title;
        $category->meta_description=$request->meta_description;
        $category->save();
        session()->flash('message', 'Category Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect('admin/category');

    }
    public function viewCategory($id){

        $data['page_title'] = "View Category";
        $data['category']= Category::findOrFail($id);

        return view('admin.category.show',$data);
    }
    public function destroyCategory($id){

        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('message', 'Category Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect('admin/category');
    }
    public function getProduct(){

        $data['page_title'] = "Product";
        $data['product'] = Product::all();

        return view('admin.product.index', $data);
    }
    public function createProduct(){

        $data['page_title'] = "Create Product";
        $data['category'] = Category::all();

        return view('admin.product.create', $data);
    }

    public function storeProduct(Request $request){
       // print_r($request->all());
       // die;
        $this->validate($request,[
            'name' => 'required',
        ]);

        $product = new Product;
        $product->name=$request->name;
        $product->product_category=$request->product_category;
        $product->save();

       // $data['product'] = Product::findOrFail($product->id);

        // session()->flash('message', 'Category Added Successfully.');
        // Session::flash('type', 'success');
        // Session::flash('title', 'Success');
        return redirect('admin/product/edit/'.$product->id);

    }

    public function editProduct($id){

        $data['page_title'] = "Edit Product";
        $data['product'] = Product::findOrFail($id);
        return view('admin.product.edit', $data);
    }
    public function updateProduct(Request $request,$id){

        $request->validate([
               'pincode'=>'required|min:6|max:6',    
        ]);
        
       if ($request->hasFile('image')) {
      $image = $request->image;
      $filename = $image->getClientOriginalName();
      $storagePath='ecommerce/assets/admin/upload/catalog/images/'.$filename;
      Image::make($image)->save($storagePath);
      
      $product = Product::where('id',$id)
                        ->update(['image'=>$filename ]);
       }
        $product = Product::where('id',$id)
                        ->update([
                          'name'=>$request->name,
                          'product_category'=>$request->product_category,
                          'short_description'=>$request->short_description,
                          'description'=>$request->description,
                          'price'=>$request->price,
                          'cost_price'=>$request->cost_price,
                          'discount'=>$request->discount,
                          'size'=>$request->size,
                          'qty'=>$request->qty,
                          'color'=>$request->color,
                          'width'=>$request->width,
                          'height'=>$request->height,
                          'length'=>$request->length,
                          'status'=>$request->status,
                          'in_stock'=>$request->in_stock,
                          'featured'=>$request->featured,
                          'special'=>$request->special,
                          'onsale'=>$request->onsale,
                          'pincode'=>$request->pincode

                        ]);
        Session()->flash('message', 'Product Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect('admin/product');
    }

    public function uploadImage(Request $request){
      $image = $request->image;
      print_r($image);
      $tmpPath = str_split(strtolower(str_random(3)));
      $checkDirectory = 'ecommerce/assets/uploads/catalog/images/' . implode('/', $tmpPath);

      $dbPath = $checkDirectory . '/' . $image->getClientOriginalName();
      $image = Image::upload($request->file('image'), $checkDirectory)->makeSizes()->get();

      $tmp = $this->_getTmpString();

      return view('admin.product.upload-images')
          ->with('image', $image)
          ->with('tmp', $tmp);
  }
  public function showProduct($id){
        $data['page_title'] = "Product Details";
        $data['product'] = Product::findOrFail($id);
        return view('admin.product.show', $data);
  }
  
  public function deleteProduct($id){
        $data['page_title'] = "Product Details";
        $product = Product::findOrFail($id);
        $product->delete();
        Session()->flash('message', 'Product Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect('admin/product');
  }

  public function deleteImage(Request $request){
        $path = $request->get('path');

        $fileName = pathinfo($path, PATHINFO_BASENAME);
        $relativeDir = pathinfo($path, PATHINFO_DIRNAME);

        $sizes = config('avored-framework.image.sizes');
        foreach ($sizes as $sizeName => $widthHeight) {
            $imagePath = $relativeDir . DIRECTORY_SEPARATOR . $sizeName . '-' . $fileName;

            if (File::exists(storage_path('ecommerce/assets/uploads/catalog/images/' . $imagePath))) {
                File::delete(storage_path('ecommerce/assets/uploads/catalog/images/' . $imagePath));
            }
        }

        if (File::exists(storage_path('ecommerce/assets/uploads/catalog/images/' . $path))) {
            File::delete(storage_path('ecommerce/assets/uploads/catalog/images/' . $path));
        }

        return JsonResponse::create(['success' => true]);
    }
    public function getCustomers(){
        
       $data['page_title'] = "Customer Data";
       $data['customers'] = User::all();
       
       return view('admin.customer.index', $data);
        
    }

}
