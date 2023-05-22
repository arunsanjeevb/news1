<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Newscomment;
use App\Models\Socialshare;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
class StoriesController extends Controller
{
    public function maanNewsStories()
    {
        $allnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.description','news.image','news.date','newssubcategories.name as news_subcategory','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.status',1)
            ->where('news.live_news',1)
            ->orderByDesc('news.id')
            ->paginate(10);

        $popularallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
            ->where('news.status',1)
            ->where('news.live_news',1)
            ->orderByDesc('news.viewers')
            ->limit(4)
            ->get();
        $recentallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
            ->where('news.status',1)
            ->where('news.live_news',1)
            ->orderByDesc('news.id')
            ->limit(5)
            ->get();
        return view('frontend.pages.specialstories',compact('allnews','popularallnews','recentallnews'));
    }

    public function maanNewsDetails($id,$slug=null)
    {
        $blogstories=Blog::join('blogsubcategories','blogsubcategories.id','=','blogs.blogsubcategory_id')
            ->select('blogs.id','blogs.title','blogs.image','blogs.description','blogsubcategories.name','blogs.created_at')
            ->where('status',1)
            ->where('blogs.id','=',$id)
            ->first();
        //related news
        $relatedstories=Blog::join('blogsubcategories','blogsubcategories.id','=','blogs.blogsubcategory_id')
            ->select('blogs.id','blogs.title','blogs.image','blogsubcategories.name')
            ->where('status',1)
            ->where('blogs.id','!=',$id)
            ->limit(3)
            ->get();
        
        $toptories=Blog::join('blogsubcategories','blogsubcategories.id','=','blogs.blogsubcategory_id')
            ->select('blogs.id','blogs.title','blogs.image','blogsubcategories.name')
            ->where('status',1)
            // ->inRandomOrder()
            ->take(5)
            ->get();

        $socials = Socialshare::all();

        return view('frontend.pages.specialstories',compact('blogstories','relatedstories','socials', 'toptories'));
    }

}
