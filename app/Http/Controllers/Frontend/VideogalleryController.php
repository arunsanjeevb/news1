<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Videogallery;
use App\Models\Socialshare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use App\Models\Newscategory;


class VideogalleryController extends Controller
{
    public function maanVideogalleryIndex()
    {
        $videogalleries = Videogallery::join('users','videogalleries.user_id','=','users.id')
            ->select('videogalleries.id','videogalleries.title','videogalleries.description','videogalleries.video','videogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('videogalleries.status',1)
            ->orderByDesc('videogalleries.id')
            ->paginate(10);
        $popularvideogalleries = Videogallery::where('status',1)
//            ->orderByDesc('viewers')
            ->limit(4)
            ->get();
        $recentvideogalleries = Videogallery::where('status',1)
            ->orderByDesc('id')
            ->limit(5)
            ->get();


        return view('frontend.pages.videogallery',compact('videogalleries','popularvideogalleries','recentvideogalleries'));
    }

    public function maanVideogalleryDetails($id)
    {
//        $viewers = Videogallery::where('id',$id)->value('viewers');
//        $data['viewers'] = $viewers +1 ;
        //update
//        Videogallery::where('id',$id)->update($data) ;

        $videogallery = Videogallery::join('users','videogalleries.user_id','=','users.id')
            ->select('videogalleries.id','videogalleries.title','videogalleries.description','videogalleries.video','videogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('videogalleries.id',$id)
            ->where('videogalleries.status',1)
            ->first();
//        return$videogallery
        //related news
        $relatedvideogallery = Videogallery::join('users','videogalleries.user_id','=','users.id')
            ->select('videogalleries.id','videogalleries.title','videogalleries.description','videogalleries.video','videogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('videogalleries.id','!=',$id)
            ->where('videogalleries.status',1)
            ->orderByDesc('videogalleries.id')
            ->limit(3)
            ->get();
        $socials = Socialshare::all();

        $allnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
        ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
        ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
        ->where('newscategories.id',4)
        ->where('news.status',1)
        ->orderByDesc('news.viewers')
        ->limit(4)
        ->get();

        $popularsnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.status',1)
            ->orderByDesc('news.viewers')
            ->limit(3)
            ->get();

        return view('frontend.pages.videogallery_details',compact('videogallery','relatedvideogallery','socials', 'allnews','popularsnews'));
    }


    public function maanVideogalleryList($id)
    {
        $viewers = Videogallery::where('id',$id)->value('viewers');
        $data['viewers'] = $viewers +1 ;
        //update
        Videogallery::where('id',$id)->update($data) ;

        $videogallery = Videogallery::join('users','videogalleries.user_id','=','users.id')
            ->select('videogalleries.id','videogalleries.title','videogalleries.description','videogalleries.video','videogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('videogalleries.id',$id)
            ->where('videogalleries.status',1)
            ->first();
        //related news
        $relatedvideogallery = Videogallery::join('users','videogalleries.user_id','=','users.id')
            ->select('videogalleries.id','videogalleries.title','videogalleries.description','videogalleries.video','videogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('videogalleries.id','!=',$id)
            ->where('videogalleries.status',1)
            ->orderByDesc('videogalleries.id')
            ->limit(3)
            ->get();

        $allnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
            ->where('newscategories.id',4)
            ->where('news.status',1)
            ->orderByDesc('news.viewers')
            ->limit(4)
            ->get();

        $videogallerylist=Videogallery::join('users','videogalleries.user_id','=','users.id')
            ->select('videogalleries.id','videogalleries.title','videogalleries.description','videogalleries.video','videogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('videogalleries.status',1)
            ->limit(30)
            ->get();

        $popularsnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('news.status',1)
            ->orderByDesc('news.viewers')
            ->limit(3)
            ->get();

        $recentallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
            ->where('news.status',1)
            ->where('news.live_news',1)
            ->orderByDesc('news.id')
            ->limit(5)
            ->get();

        $socials = Socialshare::all();


        return view('frontend.pages.videogallerylist',compact('videogallery','relatedvideogallery','socials','allnews','videogallerylist','popularsnews','recentallnews'));
    }
}
