<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
//use Request;
use App\User;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request, Article $article){
        
         if(request()->isMethod('get')){
             
             $rows = Article::paginate(5);
           
//             $html = view('articles.index')->with(compact('article', 'rows'))->render();
//             
//             return response()->json(['success' => true, 'html' => $html]);
          return view('articles.index', compact('rows', 'article'));
         }
         
         if(request()->isMethod('post')){
              $search = Input::get('search');
        
            $rows = Article::whereHas('user', function($query) use($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })->get();
           return view('articles.index', compact('rows', 'article'));
         }
    }
    public function search(Request $request, Article $article){
          $search = Input::get('search');
        
    $rows = Article::query()->where('user_id', 'LIKE', '%'.$search.'%') ->get();
      
        
    return view('articles.index',compact('rows', 'article'));
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
            'image' => $data['image'],
            
        ]);
       
           
//             
       //return response()->json();
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
         return redirect()->route('articles.index');
// return response()->json();
        
        
    }
    
    public function show(Article $article)
    {
        return view('articles.show',compact('article'));
    }
 
     public function delete(Article $article) {
        $data = [
            'type' => 'error',
            'message' => ''
        ];
        
      if(request()->ajax()) {
            if($article->delete()) {
                  $data = [
                      'type' => 'success',
                      'message' => 'Article deleted successfully!'
                  ];
            } else {
                  $data = [
                      'type' => 'error',
                      'message' => 'There was an error'
                  ];
            }
        }
        
        return response()->json($data);
//           $article->delete();
//           
//           return response()->json();
//
     }     

}
