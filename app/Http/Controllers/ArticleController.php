<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function getAllArticle() {
        return Article::all();
    }
    
    // public function getArticle($id) {
    //     return Article::findOrFail($id);
    // }
    //another way of getting single article
    public function getArticle(Article $article) {
        return $article;
    }
    
    public function createArticle(Request $request){
        $title = $request->title;
        $content = $request->content;
        $user = $request->user();
        
        $article = new Article();
        $article->title = $title;
        $article->content = $content;
        $article->user_id = $user->id;
        $article->save();
        return $article;
    }
    
    public function updateArticle(Request $request, Article $article) {
        $user = $request->user();
        if ($user->id != $article->user_id) {
            return response()->json(["error"=>"You don't have permission to edit this post"],404);
        } else {
            $title = $request->title;
            $content = $request->content;
            $article->title = $title;
            $article->content = $content;
            $article->save();
            return $article;
        }
    }
    
    public function deleteArticle(Request $request, Article $article) {
        $user = $request->user();
        if ($user->id != $article->user_id) {
            return response()->json(["error"=>"You don't have permission to edit this post"],404);
        } else {
            $article->delete();
            return response()->json(["success" => "Article Deletion Completed."],200);
        }
    }
}
