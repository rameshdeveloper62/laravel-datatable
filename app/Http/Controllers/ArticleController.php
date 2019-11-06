<?php 
namespace App\Http\Controllers;

use App\Article;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
 
class ArticleController extends Controller
{
    public function index()
    {
        $articles=Article::select('*','image as image_url')->paginate();
        return view('articles',compact('articles'));
    }
    
    public function getDatatable(Request $request)
    {
        $request=$request->all();
        $articles=Article::select('a.*','u.name')->from('articles as a')
        ->join('users as u','u.id','=','a.user_id');
        
        if($request['filterUser'])
            $articles = $articles->where('u.id','=',$request['filterUser']);

        if ($request['search']['value'] != '') {
            $search = $request['search']['value'];
            $articles = $articles->where(function ($where) use ($search) {
                $where->where('a.id', 'like', "%$search%")
                    ->orWhere('a.title', 'like', "%$search%")
                    ->orWhere('u.name', 'like', "%$search%")
                    ->orWhere('a.created_at', 'like', "%$search%");
            });
        }
        
        // $articles = $articles->groupBy('id');

        $datatable = DataTables::of($articles)->filter(function() { });
        return $datatable->make(true);
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $data=$request->except(['_token']);
        $request->validate([
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg',
        ]);

        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $fileName=$image->store('images');
            $data['image']=basename($fileName);
        }
        $data['user_id']=auth()->id();
        $article = Article::create($data);

        return redirect('articles');
    }

    public function show(Article $article)
    {
        return $article;
    }


    public function edit(Request $request,Article $article)
    {
        return view('form',compact('article'));
    }
    public function update(Request $request, Article $article)
    {
        $data=$request->except(['_token']);
        $request->validate([
            'title' => 'required|unique:articles,title,'.$article->id.',id|max:255',
            'body' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,svg',
        ]);

        if($request->hasFile('image'))
        {
            Storage::delete('images/'.$article->image);
            $image=$request->file('image');
            $fileName=$image->store('images');
            $data['image']=basename($fileName);
        }
        
        $data['user_id']=auth()->id();
        
        $article->update($data);

        return redirect('articles/datatable');
    }

    public function destroy(Article $article)
    {
        if($article->delete())
            return response()->json(["message"=>"Article is deleted successfully."],200);
        else
            return response()->json(["message"=>"something went wrong."],500);
    }
}