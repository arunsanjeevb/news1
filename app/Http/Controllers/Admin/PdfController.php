<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photogallery;
use App\Models\Seooptimization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    //
    public function maanNewsEpaperIndex()
    {
//        $epaper = Pdf->get();
        $epaper = DB::table('pdfs')->get();
//        $epaper_array= $epaper;

//        return $epaper;
        return view('admin.pages.news.epaper.index',['value'=>$epaper]);
    }

    public function maanNewsPdfStore(Request $request)
    {
//        return $request;
//        return $request->epaper->getClientOriginalName();
//        if ($request->hasFile('epaper')) {
//            return $request->file('epaper')->getClientOriginalName();
//        } else {
//            return 'no file!';
//        }
        //image validation..
        if ($request->hasFile('epaper')){
//            $request->validate([
//                'image'=> 'required',
//            ]);

        }
//        $getnewscategoryexist = Pdf::where('type',$request->type)->exists();
        //return $getnewscategoryexist;
//        if ($getnewscategoryexist) {
//            $getnewscategory = Newscategory::where('type',$request->type)->first();
//            if ($getnewscategory->type=='home' || $getnewscategory->type=='contact') {
//                $newscategories = $getnewscategory ;
//            }else{
//                $newscategories           = new Newscategory();
//            }
//        }else {
//            $newscategories           = new Newscategory();
//        }

        // image..
        if ($request->hasFile('epaper')){
//            return "fdg";
//            if ($request->epaper!=''){
//            return "cx";
//                if ($getnewscategory->type=='home' || $getnewscategory->type=='contact') {
//                    if (File::exists($newscategories->image)){
//                        unlink($newscategories->image);
//                    }
//                }


            $image            = trim(str_replace(' ', '_', strtolower($request->epaper->getClientOriginalName())));

            // image path
//            return $image;
//            return base_path(). '/public/uploads/images/news_category/';
            $image_url          = 'public/uploads/images/epaper/' . $request->epaper->getClientOriginalName();
            //image base path
            $destinationPath    = base_path() . '/public/uploads/images/epaper/';
            $success            = $request->epaper->move($destinationPath, $image);
            if ($success){
                $image_urls     = $image_url ;
            }
//        }else{
//            $image_urls         = '' ;
//        }
        }
        $data['title']=$request->title;
        $data['image']=$image_urls;
        $data['paper_date']=$request->paper_date;
        DB::table('pdfs')->insert($data);
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.news.epaper');

    }

    public function maanNewsPdfUpdate(Request $request,$epaperid)
    {
//        return $epaperid;
//        return $request->epaper->getClientOriginalName();
//        if ($request->hasFile('epaper')) {
//            return $request->file('epaper')->getClientOriginalName();
//        } else {
//            return 'no file!';
//        }
        //image validation..
        if ($request->hasFile('epaper')){
//            $request->validate([
//                'image'=> 'required',
//            ]);

        }

        // image..
        if ($request->hasFile('epaper')){
            $image            = trim(str_replace(' ', '_', strtolower($request->epaper->getClientOriginalName())));

            // image path
            $image_url          = 'public/uploads/images/epaper/' . $request->epaper->getClientOriginalName();
            //image base path
            $destinationPath    = base_path() . '/public/uploads/images/epaper/';
            $success            = $request->epaper->move($destinationPath, $image);
            if ($success){
                $image_urls     = $image_url ;
            }
            $data['image']=$image_urls;
//        }else{
//            $image_urls         = '' ;
//        }
        }
        $data['title']=$request->title;
        $data['paper_date']=$request->paper_date;
        DB::table('pdfs')->where('id', $epaperid)->update($data);
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.news.epaper');

    }

    public function maanNewsPdfDestroy($epaperid)
    {
        DB::table('pdfs')->where('id', $epaperid)->delete();
        return redirect()->route('admin.news.epaper');
    }

}
