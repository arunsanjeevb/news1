<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\News;
use App\Models\Newscategory;
use Illuminate\Support\Facades\DB;

class LivenewsController extends Controller
{
    //
    public function maanNewsLivenews()
    {
//        return $a;
//        $newscategorysingle = Newscategory::where('name',ucfirst($newscategory))->first();
        $allnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->join('users','news.reporter_id','=','users.id')
            ->select('news.id','news.title','news.summary','news.description','news.image','news.date','newssubcategories.name as news_subcategory','newscategories.name as news_category','newscategories.slug as news_categoryslug',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
//            ->where('newscategories.id',$newscategorysingle->id)
            ->where('news.status',1)
            ->where('news.live_news',1)
            ->orderByDesc('news.id')
            ->paginate(10);

        $popularallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug')
//            ->where('newscategories.id',$newscategorysingle->id)
            ->where('news.status',1)
            ->where('news.live_news',1)
            ->orderByDesc('news.viewers')
            ->limit(4)
            ->get();
        $recentallnews = News::join('newssubcategories','news.subcategory_id','=','newssubcategories.id')
            ->join('newscategories','newssubcategories.category_id','=','newscategories.id')
            ->select('news.id','news.title','news.image','news.date','newscategories.slug as news_categoryslug','news.summary')
//            ->where('newscategories.id',$newscategorysingle->id)
            ->where('news.status',1)
            ->where('news.live_news',1)
            ->orderBy('news.id')
            ->limit(5)
            ->get();
        return view('frontend.pages.livenews',compact('allnews','popularallnews','recentallnews'));
//        return view('frontend.pages.livenews',compact('getnews'));
    }
}
