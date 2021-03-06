<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    private $postValidationArray = [
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'exists:categories,id',
        'tags' => 'exists:tags,id',
        'cover.*' => 'nullable|file|image|max:2048'
    ];

    private function createSlug($data) {
        $slug = Str::slug($data["title"], '-');

        $existingPost = Post::where('slug', $slug)->first();

        $slugBase = $slug;
        $counter = 1;

        while($existingPost) {
            $slug = $slugBase . "-" . $counter;

            $existingPost = Post::where('slug', $slug)->first();
            $counter++;
        }

        return $slug;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);

        // dd($posts);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $request->validate($this->postValidationArray);

        $newPost = new Post();

        // upload immagine
        if(array_key_exists('cover', $data)) {
            // versione in 2 passaggi
            // $img_path = Storage::put('post_covers', $data["cover"]);
            // // sovrascrivo l'oggetto di classe UploadedFile con il nome del file restituito dalla put
            // $data["cover"] = $img_path;

            // per fare operazioni di upload/cancellazione su disco diverso da quello di default
            // $data["cover"] = Storage::disk('public')->put('post_covers', $data["cover"]);

            $data["cover"] = Storage::put('post_covers', $data["cover"]);

        }

        // generazione slug
        $slug = $this->createSlug($data);
        $data['slug'] = $slug;
        $newPost->fill($data);

        $newPost->save();

        if(array_key_exists('tags', $data)) {
            $newPost->tags()->attach($data["tags"]);
        }

        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $request->validate($this->postValidationArray);

        if($post->title != $data["title"]) {
            $slug = $this->createSlug($data);
            $data["slug"] = $slug;
        }

        if(array_key_exists('cover', $data)) {
            if($post->cover) {
                Storage::delete($post->cover);
            }

            $data["cover"] = Storage::put('post_covers', $data["cover"]);
        }

        $post->update($data);

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data["tags"]);
        } else {
            $post->tags()->detach();
        }

        return redirect()
        ->route('admin.posts.show', $post->id)
        ->with('message', "$post->slug modificato con successo.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->cover) {
            Storage::delete($post->cover);
        }

        $post->delete();

        return redirect()
        ->route('admin.posts.index')
        ->with('deleted', "$post->slug eliminato con successo.");
    }
}
