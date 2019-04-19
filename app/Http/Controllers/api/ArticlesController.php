<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
     public function __construct()
    {
        //$this->middleware('api.auth');
    }
    public function index(){
        
       return response()->json(ArticleResource::collection(Article::all()),200); 
    
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
      
        Auth::user()->articles()->create( [
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image']
        ]);
        
        
       $message = [
           'type' => 'success',
            'message' => 'Uspesno obrisan artikal'
       ];
        
        if(request()->ajax()) {
            if( Auth::user()->articles()->create( [
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image']
        ])){
              
       $message = [
           'type' => 'success',
            'message' => 'Uspesno obrisan artikal'
       ];    
            }
        } 
        return response()->json($message);
         
//        return response()->json(['success'=>'Data is successfully added']);
         //return redirect()->route('articles.index');
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
       
      $response = [
          'status' => 'success',
            'msg' => 'Setting created successfully'
          ];
        return Response::json($response);
        
        
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
