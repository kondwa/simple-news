<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\User;
use App\Mail\NewArticleMail;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function show(Article $article)
    {
        return $article;
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());
        $users = User::all();
        foreach($users as $user){
            \Mail::to($user->email)->send(new NewArticleMail($user,$article));
        }
        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();

        return response()->json(null, 204);
    }
}
