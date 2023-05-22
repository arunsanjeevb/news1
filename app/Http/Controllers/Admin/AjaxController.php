<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Company;
use App\Models\News;
use App\Models\Newscategory;
use App\Models\Photogallery;
use App\Models\Videogallery;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function maanPublishStatus(Request $request)
    {

        if ($request->ajax()){
            if ($request->statustext=='Blog'){
                Blog::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='Video'){
                Videogallery::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='Photo'){
                Photogallery::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='News'){
                News::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='Breaking News'){
                News::where('id',$request->id)->update(['breaking_news'=>$request->status]);
            }
            if ($request->statustext=='Contact Us'){
                Company::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='News Category'){
                Newscategory::where('id',$request->id)->update(['menu_publish'=>$request->status]);

            }


            return $request;
        }
    }
}
