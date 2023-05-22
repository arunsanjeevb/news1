<?php

namespace App\Http\Controllers\Maan;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogcategory;
use App\Models\Blogsubcategory;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Maanuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class MaanuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $profile = Maanuser::where('id',Auth::guard('maanuser')->user()->id)->first();
        return view('maanuser.pages.profile',compact('profile'));
    }

    /**
     * Display course .
     *
     * @return \Illuminate\Http\Response
     */
    public function maanUserReporter()
    {
        $reporters = User::where('user_type','0')->paginate(10);
        return view('maanuser.pages.reporters.reporter',compact('reporters'));
    }

    /**
     * Display post .
     *
     * @return \Illuminate\Http\Response
     */
    public function maanUserPost()
    {
        $postall = Blog::paginate(10);
        return view('maanuser.pages.blogs.post',compact('postall'));
    }



    public function maanuserIndex()
    {
//        DB::connection()->enableQueryLog();

//        $blogs = Blog::paginate(10)->where('id',Auth::guard('maanuser')->user()->id)->first();;
        $blogs = Blog::paginate(10);
//        $queryLog = DB::getQueryLog();
//        return view('admin.pages.blog.blog.index',compact('blogs'));
//        $postall = Blog::paginate(10);
        return view('maanuser.pages.blogs.index',compact('blogs'));
    }

    public function maanuserBlogCreate(Request $request)
    {
        if ($request->ajax()){
            $blogsubcategory = Blogsubcategory::where('category_id',$request->blogcategory_id)->get();
            return response()->json($blogsubcategory);
        }
        $blogcategories = Blogcategory::all();

        return view('maanuser.pages.blogs.create',compact('blogcategories'));
    }
    public function maanuserBlogStore(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'summary'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'date'=>'required',
            'tags'=>'required',

        ]);
        if ($request->hasFile('image')){
            foreach ($request->file('image') as $image) {
                $blog_imagename = $image->getClientOriginalName();
                $blog_image = 'maanblogimage' . date('dmY_His') . '_' . $blog_imagename;
                $blog_image_url[] = 'public/uploads/images/blogimages/' . $blog_image;
                $blog_destinationPath = base_path() . '/public/uploads/images/blogimages/';
                $blog_success = $image->move($blog_destinationPath, $blog_image);
            }
            if ($blog_success){
                $blog_image_urls = $blog_image_url ;

            }
        }else{
            $blog_image_urls = '' ;
        }
        $data['title']          = $request->title;
        $data['summary']        = $request->summary;
        $data['description']    = $request->description;
        $data['blogsubcategory_id'] = $request->subcategory_id;
        $data['date']           = date('Y-m-d', strtotime($request->date));
        $data['tags']           = $request->tags;

        if($request->status){
            $data['status']     = 1 ;
        }else{
            $data['status']       = 0 ;
        }

        $data['image']          = json_encode($blog_image_urls);

        $users_get = User::where('user_type','4')->where('is_active','1')->first();
        $data['user_id']        = $users_get->id;
        $data['public_userid']  = Auth::guard('maanuser')->user()->id;
        Blog::create($data);
        return redirect()->route('maanuser.blog') ;
    }
    public function maanuserBlogEdit(Request $request, Blog $blog)
    {
        $blogcategories = Blogcategory::all();
        $blogsubcategories = Blogsubcategory::all();
        $blogcategoryid = Blogsubcategory::where('id',$blog->blogsubcategory_id)->value('category_id');
        if ($request->ajax()){
            $blogsubcategory = Blogsubcategory::where('category_id',$request->blogcategory_id)->get();
            return response()->json($blogsubcategory);
        }

        return view('maanuser.pages.blogs.edit',compact('blog','blogcategories','blogsubcategories','blogcategoryid'));
    }
    public function maanuserBlogUpdate(Request $request, Blog $blog)
    {
        $request->validate([
            'title'=>'required',
            'summary'=>'required',
            'description'=>'required',
            'subcategory_id'=>'required',
            'date'=>'required',
            'tags'=>'required',
        ]);
        if ($request->hasFile('image')){
            $getimages = json_decode($blog->image);
            if ($getimages){
                foreach ($getimages as $image){
                    if (File::exists($image)){
                        unlink($image);
                    }
                }
            }

            foreach ($request->file('image') as $image) {
                $blog_imagename = $image->getClientOriginalName();
                $blog_image = 'maanblogimage' . date('dmY_His') . '_' . $blog_imagename;
                $blog_image_url[] = 'public/uploads/images/blogimages/' . $blog_image;
                $blog_destinationPath = base_path() . '/public/uploads/images/blogimages/';
                $blog_success = $image->move($blog_destinationPath, $blog_image);
            }
            if ($blog_success){
                $blog_image_urls = json_encode($blog_image_url); ;

            }
        }else{
            $blog_image_urls = $blog->image ;
        }
        $data['title']          = $request->title;
        $data['summary']        = $request->summary;
        $data['description']    = $request->description;
        $data['blogsubcategory_id'] = $request->subcategory_id;
        $data['date']           = date('Y-m-d', strtotime($request->date));
        $data['tags']           = $request->tags;
        if($request->status){
            $data['status']     = 1 ;
        }else{
            $data['status']     = 0 ;
        }

        $data['image']          = $blog_image_urls;
        $users_get = User::where('user_type','4')->where('is_active','1')->first();
        $data['user_id']        = $users_get->id;
        $data['public_userid']        = Auth::guard('maanuser')->user()->id;
        Blog::where('id',$blog->id)->update($data);
        return redirect()->route('maanuser.blog') ;
    }
    public function maanuserBlogDestroy(Blog $blog)
    {
        $images = json_decode($blog->image);

        foreach ($images as $image){
            if (File::exists($image)){
                unlink($image);
            }
        }

        $blog->delete();
        return redirect()->route('maanuser.blogs');
    }


}
