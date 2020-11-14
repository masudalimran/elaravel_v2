<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index_product(){
        $index_product=DB::table('products')
                ->leftJoin('categories','products.category_id','=','categories.id')
                ->leftJoin('brands','products.brand_id','=','brands.id')
                ->leftJoin('sub_categories','products.subcategory_id','=','sub_categories.id')
                ->select('products.*','categories.category_name','brands.brand_name','sub_categories.sub_category_name')
                ->get();
        return view('admin/product/index_product',compact('index_product'));
    }

    public function create_product(){
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        return view('admin.product.create_product',compact('category','brand'));
    }

    public function store_product(Request $request){
        $data=array();

        $data['category_id']=$request->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['brand_id']=$request->brand_id;

        $data['product_name']=$request->product_name;
        $data['product_code']=$request->product_code;
        $data['product_quantity']=$request->product_quantity;
        $data['product_details']=$request->product_details;
        $data['product_color']=$request->product_color;
        $data['product_size']=$request->product_size;
        $data['selling_price']=$request->selling_price;
        $data['discount_price']=$request->discount_price;
        $data['video_link']=$request->video_link;
        $data['main_slider']=$request->main_slider;
        $data['mid_slider']=$request->mid_slider;
        $data['hot_deal']=$request->hot_deal;
        $data['hot_new']=$request->hot_new;
        $data['best_rated']=$request->best_rated;
        $data['trend']=$request->trend;
        $data['buy_1_get_1']=$request->buy_1_get_1;
        $data['publication_status']=1;

        $image_1=$request->image_1;
        $image_2=$request->image_2;
        $image_3=$request->image_3;

        if($image_1 && $image_2 && $image_3){
            $image_one_name = hexdec(uniqid()).'.'.$image_1->getClientOriginalExtension();
                Image::make($image_1)->resize(300,300)->save('public/media/product/'.$image_one_name);
                $data['image_1']='public/media/product/'.$image_one_name;

            $image_two_name = hexdec(uniqid()).'.'.$image_2->getClientOriginalExtension();
                Image::make($image_2)->resize(300,300)->save('public/media/product/'.$image_two_name);
                $data['image_2']='public/media/product/'.$image_two_name;

            $image_three_name = hexdec(uniqid()).'.'.$image_3->getClientOriginalExtension();
                Image::make($image_3)->resize(300,300)->save('public/media/product/'.$image_three_name);
                $data['image_3']='public/media/product/'.$image_three_name;

            $product=DB::table('products')->insert($data);
            $notification=array(
                'messege'=>'Product Created successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }elseif($image_1 && $image_2){
            $image_one_name = hexdec(uniqid()).'.'.$image_1->getClientOriginalExtension();
                Image::make($image_1)->resize(300,300)->save('public/media/product/'.$image_one_name);
                $data['image_1']='public/media/product/'.$image_one_name;

            $image_two_name = hexdec(uniqid()).'.'.$image_2->getClientOriginalExtension();
                Image::make($image_2)->resize(300,300)->save('public/media/product/'.$image_two_name);
                $data['image_2']='public/media/product/'.$image_two_name;

            $product=DB::table('products')->insert($data);
            $notification=array(
                'messege'=>'Product Created successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else {
            $image_one_name = hexdec(uniqid()).'.'.$image_1->getClientOriginalExtension();
                Image::make($image_1)->resize(300,300)->save('public/media/product/'.$image_one_name);
                $data['image_1']='public/media/product/'.$image_one_name;

            $product=DB::table('products')->insert($data);
            $notification=array(
                'messege'=>'Product Created successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }

    // Inactivate product
      public function inactive_product($id){
        DB::table('products')->where('id',$id)->update(['publication_status'=> 0]);
        $notification=array(
            'messege'=>'Product Deactivated successfully',
            'alert-type'=>'warning'
        );
        return Redirect()->back()->with($notification);
    }

    // Activate product
    public function active_product($id){
        DB::table('products')->where('id',$id)->update(['publication_status'=>1]);
        $notification=array(
            'messege'=>'Product activated successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    //Delete Product
    public function delete_product($id){
        $product=DB::table('products')->where('id',$id)->first();
        $image_1=$product->image_1;
        $image_2=$product->image_2;
        $image_3=$product->image_3;

        if($image_1){
            unlink($image_1);
            if($image_2){
                unlink($image_2);
            }if($image_3){
                unlink($image_3);
            }
        }else{

        }
        DB::table('products')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Product Deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    //View Product
    public function view_product($id){
        $product=DB::table('products')
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->leftJoin('brands','products.brand_id','=','brands.id')
                    ->leftJoin('sub_categories','products.subcategory_id','=','sub_categories.id')
                    ->select('products.*','categories.category_name','brands.brand_name', 'sub_categories.sub_category_name')
                    ->where('products.id',$id)
                    ->first();
        return view('admin.product.show_product',compact('product'));
    }

    //Edit Product
    public function edit_product($id){
        $product=DB::table('products')->where('id',$id)->first();

        return view('admin.product.edit_product',compact('product'));
    }

    //Update product without photo
    public function update_product_without_photo(Request $request,$id){
        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['brand_id']=$request->brand_id;

        $data['product_name']=$request->product_name;
        $data['product_code']=$request->product_code;
        $data['product_quantity']=$request->product_quantity;
        $data['product_details']=$request->product_details;
        $data['product_color']=$request->product_color;
        $data['product_size']=$request->product_size;
        $data['selling_price']=$request->selling_price;
        $data['discount_price']=$request->discount_price;
        $data['video_link']=$request->video_link;
        $data['main_slider']=$request->main_slider;
        $data['mid_slider']=$request->mid_slider;
        $data['hot_deal']=$request->hot_deal;
        $data['hot_new']=$request->hot_new;
        $data['best_rated']=$request->best_rated;
        $data['trend']=$request->trend;
        $data['buy_1_get_1']=$request->buy_1_get_1;

        $update=DB::table('products')->where('id',$id)->update($data);
        if($update){
             $notification=array(
                     'messege'=>'Successfully Product Updated ',
                     'alert-type'=>'success'
                     );
             return Redirect()->route('all.product')->with($notification);

        }else{
            $notification=array(
                     'messege'=>'Nothing To Updated ',
                     'alert-type'=>'warning'
                     );
              return Redirect()->route('all.product')->with($notification);
        }



        // return response()->json($update);
    }

    // Update product Image
    public function update_product_photo(Request $request, $id){
        $old_1=$request->old_1;
        $old_2=$request->old_2;
        $old_3=$request->old_3;

        $image_1=$request->image_1;
        $image_2=$request->image_2;
        $image_3=$request->image_3;
        $data=array();

        if($image_1 && $image_2 && $image_3){
            unlink($old_1);
            $image_one_name = hexdec(uniqid()).'.'.$image_1->getClientOriginalExtension();
            Image::make($image_1)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $data['image_1']='public/media/product/'.$image_one_name;
            unlink($old_2);
            $image_two_name = hexdec(uniqid()).'.'.$image_2->getClientOriginalExtension();
            Image::make($image_2)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $data['image_2']='public/media/product/'.$image_two_name;
            unlink($old_3);
            $image_three_name = hexdec(uniqid()).'.'.$image_3->getClientOriginalExtension();
            Image::make($image_3)->resize(300,300)->save('public/media/product/'.$image_three_name);
            $data['image_3']='public/media/product/'.$image_three_name;
            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image 1, 2 & 3 Updated ',
                'alert-type'=>'success'
                );
            return Redirect()->route('all.product')->with($notification);
        }

        if($image_1 && $image_2){
            unlink($old_1);
            unlink($old_2);

            $image_one_name = hexdec(uniqid()).'.'.$image_1->getClientOriginalExtension();
            Image::make($image_1)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $data['image_1']='public/media/product/'.$image_one_name;

            $image_two_name = hexdec(uniqid()).'.'.$image_2->getClientOriginalExtension();
            Image::make($image_2)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $data['image_2']='public/media/product/'.$image_two_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image 1 & 2 Updated ',
                'alert-type'=>'success'
                );
            return Redirect()->route('all.product')->with($notification);
        }
        if($image_1 && $image_3){
            unlink($old_1);
            unlink($old_3);

            $image_one_name = hexdec(uniqid()).'.'.$image_1->getClientOriginalExtension();
            Image::make($image_1)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $data['image_1']='public/media/product/'.$image_one_name;

            $image_three_name = hexdec(uniqid()).'.'.$image_3->getClientOriginalExtension();
            Image::make($image_3)->resize(300,300)->save('public/media/product/'.$image_three_name);
            $data['image_3']='public/media/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image 1 & 3 Updated ',
                'alert-type'=>'success'
                );
            return Redirect()->route('all.product')->with($notification);
        }
        if($image_2 && $image_3){
            unlink($old_2);
            unlink($old_3);

            $image_two_name = hexdec(uniqid()).'.'.$image_2->getClientOriginalExtension();
            Image::make($image_2)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $data['image_2']='public/media/product/'.$image_two_name;

            $image_three_name = hexdec(uniqid()).'.'.$image_3->getClientOriginalExtension();
            Image::make($image_3)->resize(300,300)->save('public/media/product/'.$image_three_name);
            $data['image_3']='public/media/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image 2 & 3 Updated ',
                'alert-type'=>'success'
                );
            return Redirect()->route('all.product')->with($notification);
        }

        if($image_1){
            unlink($old_1);
            $image_one_name = hexdec(uniqid()).'.'.$image_1->getClientOriginalExtension();
            Image::make($image_1)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $data['image_1']='public/media/product/'.$image_one_name;
            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image 1 Updated ',
                'alert-type'=>'success'
                );
            return Redirect()->route('all.product')->with($notification);
        }
        if($image_2){
            unlink($old_2);
            $image_two_name = hexdec(uniqid()).'.'.$image_2->getClientOriginalExtension();
            Image::make($image_2)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $data['image_2']='public/media/product/'.$image_two_name;
            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image 2 Updated ',
                'alert-type'=>'success'
                );
            return Redirect()->route('all.product')->with($notification);
        }
        if($image_3){
            unlink($old_3);
            $image_three_name = hexdec(uniqid()).'.'.$image_3->getClientOriginalExtension();
            Image::make($image_3)->resize(300,300)->save('public/media/product/'.$image_three_name);
            $data['image_3']='public/media/product/'.$image_three_name;
            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image 3 Updated ',
                'alert-type'=>'success'
                );
            return Redirect()->route('all.product')->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Nothing To Update ',
                'alert-type'=>'warning'
                );
            return Redirect()->route('all.product')->with($notification);
        }
    }

        //Get Sub category by ajax
    public function get_subcategory($category_id){
        $get_subcategory = DB::table('sub_categories')->where("category_id",$category_id)->get();
        return json_decode($get_subcategory);
    }
}
