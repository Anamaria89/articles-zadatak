<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ArticlesController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        $rows = Article::where('deleted', 0)->get();
      
        
        return view('articles.index', compact('rows'));
    
    }
    
    public function create()
    {

        return view('articles.create');
    }
    
    public function store()
    {
         $data = request()->validate([
           
            'title' => 'required|string|max:191',
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg',
            'content' => 'required',
        ]);
        
         if(request()->has('image')){
            $file = request()->image;
            $fileExtension = $file->getClientOriginalExtension();
            
            $fileName = $file->getClientOriginalName();
            $fileName = pathinfo($fileName, PATHINFO_FILENAME);
            $fileName = Str::slug(request('title'), '-') . '-' . Str::slug(now(), '-') . '.' . $fileExtension;
            
            //echo public_path('/upload/pages/');
            $file->move(public_path('/upload/images/'), $fileName);
            
            request()->image = '/upload/images/' . $fileName;
            
            // intervetion
            // xl velicina
           
        }
        
       $data['image'] = request()->image;
      
        Auth::user()->articles()->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image']
        ]);
//        $row->title = request()->title;
//        $row->content = request()->content;
//           $html = '
//                
//                    <div class="card-body messages-success">
//                        Successfully added article!!!
//                    </div>
//              
//            ';
                
        
       // $row->save();
        //return $html;
    
         return redirect()->route('articles.index');
        }
        
   public function user(User $user)
    {

       $users = $user->articles;
    }
    
     public function edit(Article $article)
    {    
       // dd($article);
        
        return view('articles.edit', compact('article'));
    }
    
     public function update(Request $request, Article $article)
    {
        $data = request()->validate([
           
            'title' => 'required|string|max:191',
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg',
            'content' => 'required',
        ]);
        $row = $article;
        
        unset($data['image']);
        foreach ($data as $key => $value) {
            $row->$key = $value;
        }
        
        $row->image = $article->image;
        // provera da li uopste dolazi 'image' kroz request
        if(request()->has('image')){
            $file = request()->image;
            $fileExtension = $file->getClientOriginalExtension();
            
            $timeStamp = Str::slug(now(), '-');
            
            $fileName = $file->getClientOriginalName();
            $fileName = pathinfo($fileName, PATHINFO_FILENAME);
            $fileName = Str::slug(request('title'), '-') . '-' . $timeStamp . '.' . $fileExtension;
            
            //echo public_path('/upload/pages/');
            $file->move(public_path('/upload/images/'), $fileName);
            
            $row->image = '/upload/images/' . $fileName;
            
           
        }
        
        $row->save();
        
      
      
        
//        $row->title = request()->title;
//        $row->content = request()->content;
//           $html = '
//                
//                    <div class="card-body messages-success">
//                        Successfully added article!!!
//                    </div>
//              
//            ';
                
        
       // $article->save();
        //return $html;
    
         return redirect()->route('articles.index');
        
        
    }
}