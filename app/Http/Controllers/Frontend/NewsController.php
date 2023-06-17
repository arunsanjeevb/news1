<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\Newscategory;
use App\Models\Newscomment;
use App\Models\Photogallery;
use App\Models\Socialshare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function maanNewsComment(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'comment'=>'required'
        ]);
        $newscomments = new Newscomment();
        $newscomments->news_id = $id;
        $newscomments->name = $request->name;
        $newscomments->email = $request->email;
        $newscomments->comment = $request->comment;
        $newscomments->save();
        return redirect()->back();
    }

    public function maanNews($newscategory)
    {
        $newscategorysingle = Newscategory::where('name',ucfirst($newscategory))->first();
        DB::enableQueryLog(); // Enable query log
        $allnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->leftjoin('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.description','news.image','news.date','newssubcategories.name as news_subcategory','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('newscategories.id',$newscategorysingle->id)
            ->where('news.status',1)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->paginate(10);
//        return dd(\DB::getQueryLog());

        $popularallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
            ->where('newscategories.id',$newscategorysingle->id)
            ->where('news.status',1)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.viewers')
            ->limit(4)
            ->get();
        $recentallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug','news.summary')
            ->where('newscategories.id',$newscategorysingle->id)
            ->where('news.status',1)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->limit(5)
            ->get();

        //related news
        $relatedgetsnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.image','news.date','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"),
                DB::raw("users.image AS reporter_pic"))
            ->where('news.status',1)
            ->where('newscategories.id','=',$newscategorysingle->id)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->limit(4)
            ->get();


        $photogalleries = Photogallery::join('users','photogalleries.user_id','=','users.id')
            ->select('photogalleries.id','photogalleries.title','photogalleries.description','photogalleries.image','photogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('photogalleries.status',1)
            ->orderByDesc('photogalleries.id')
            ->paginate(10);
        $popularphotogalleries = Photogallery::where('status',1)
            ->orderByDesc('viewers')
            ->limit(4)
            ->get();
        $recentphotogalleries = Photogallery::where('status',1)
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $query = "SELECT `blogs`.id,`blogs`.title,`blogs`.summary FROM blogs join users on blogs.user_id=users.id WHERE blogs.status=1 order by blogs.id desc limit 10";
//        $blogs = Blog::paginate(10);
        $blogs = DB::select($query);
//        return $blogs;
//        return view('admin.pages.blog.blog.index',compact('blogs'));

        if ($newscategory!='columns' && $newscategory!='salar-360'){
            return view('frontend.pages.news',compact('allnews','popularallnews','recentallnews','newscategorysingle','relatedgetsnews'));
        }elseif ($newscategory=='salar-360'){
            return view('frontend.pages.salar_360',compact('photogalleries','popularphotogalleries','recentphotogalleries','blogs'));
        }else{
            $reporter_list="";
            return view('frontend.pages.livenews',compact('allnews','popularallnews','recentallnews','newscategorysingle','relatedgetsnews','reporter_list'));
        }
    }

    public function maanNewsDetails($id,$slug=null)
    {
//        return $slug;
        $viewers = News::where('id',$id)->value('viewers');
        $data['viewers'] = $viewers +1 ;
        //update
        News::where('id',$id)->update($data) ;
        // get comments
        $newscomments = Newscomment::where('news_id',$id)->paginate(10);

        $getnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.description','news.meta_keyword','news.meta_description','news.image','news.date','newssubcategories.name as news_subcategory','newscategories.name as news_category','newscategories.slug as news_categoryslug' ,'news.hide_commends',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"),
                DB::raw("users.image AS reporter_pic"),'users.id as reporter_id','users.email','news.caption','news.video_link')
            ->where('news.id',$id)
            ->where('news.status',1)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->first();
        //related news
        $relatedgetsnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.image','news.date','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"),
                DB::raw("users.image AS reporter_pic"))
            ->where('news.id','!=',$id)
            ->where('news.status',1)
            ->where('newscategories.name',$getnews->news_category)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->limit(4)
            ->get();
        $socials = Socialshare::all();

        return view('frontend.pages.news_details',compact('getnews','relatedgetsnews','newscomments','socials'));
    }

    public function maanReporterNews($reporter)
    {
        $reporter_list = User::where('id',$reporter)->get();
//        return $reporter_list;
        DB::enableQueryLog(); // Enable query log
        $allnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.description','news.image','news.video_link','news.date','newssubcategories.name as news_subcategory','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.status',1)
            ->where('users.id',$reporter)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->paginate(10);
//        return dd(\DB::getQueryLog());

        $popularallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
            ->where('news.status',1)
            ->where('users.id',$reporter)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.viewers')
            ->limit(4)
            ->get();
        $recentallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug','news.summary')
            ->where('news.status',1)
            ->where('users.id',$reporter)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->limit(5)
            ->get();

        //related news
        $relatedgetsnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.image','news.date','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"),
                DB::raw("users.image AS reporter_pic"))
            ->where('news.status',1)
            ->where('users.id',$reporter)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->limit(4)
            ->get();

//        if ($newscategory!='columns'){
//            return view('frontend.pages.news',compact('allnews','popularallnews','recentallnews','newscategorysingle','relatedgetsnews'));
//        }else{
            return view('frontend.pages.livenews',compact('allnews','popularallnews','recentallnews','relatedgetsnews','reporter_list'));
//        }
    }

    public function maanLiveNews()
    {
//        $newscategorysingle = Newscategory::get()->take(1);
//        return $newscategorysingle;
        DB::enableQueryLog(); // Enable query log
        $allnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->leftjoin('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.description','news.image','news.date','newssubcategories.name as news_subcategory','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.live_news',1)
            ->where('news.status',1)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->paginate(10);
//        return dd(\DB::getQueryLog());

        $popularallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
            ->where('news.live_news',1)
            ->where('news.status',1)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.viewers')
            ->limit(4)
            ->get();
        $recentallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug','news.summary')
//            ->where('newscategories.id',$newscategorysingle->id)
            ->where('news.live_news',1)
            ->where('news.status',1)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->limit(5)
            ->get();

        //related news
        $relatedgetsnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.image','news.date','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"),
                DB::raw("users.image AS reporter_pic"))
            ->where('news.status',1)
//            ->where('newscategories.id','=',$newscategorysingle->id)
            ->where('news.live_news',1)
            ->where('news.date', '<=', DB::raw('CURRENT_TIMESTAMP()'))
            ->orderByDesc('news.id')
            ->limit(4)
            ->get();


        $photogalleries = Photogallery::join('users','photogalleries.user_id','=','users.id')
            ->select('photogalleries.id','photogalleries.title','photogalleries.description','photogalleries.image','photogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('photogalleries.status',1)
            ->orderByDesc('photogalleries.id')
            ->paginate(10);
        $popularphotogalleries = Photogallery::where('status',1)
            ->orderByDesc('viewers')
            ->limit(4)
            ->get();
        $recentphotogalleries = Photogallery::where('status',1)
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $query = "SELECT `blogs`.id,`blogs`.title,`blogs`.summary FROM blogs join users on blogs.user_id=users.id WHERE blogs.status=1 order by blogs.id desc limit 10";
//        $blogs = Blog::paginate(10);
        $blogs = DB::select($query);
//        return "hhh";
//        return view('admin.pages.blog.blog.index',compact('blogs'));

            $reporter_list="";
            return view('frontend.pages.livenews1',compact('allnews','popularallnews','recentallnews','relatedgetsnews','reporter_list'));

    }

}
