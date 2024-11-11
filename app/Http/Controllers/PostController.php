<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts/index', ['posts' => $posts]);
    }

    public function show($id): View
    {
        $post = Post::findOrFail($id);

        return view('posts/show',['post' => $post]);
    }
    public function create(): View
    {
        return view('posts/create');
    }

    public function edit($id): View
    {
        $post = Post::findOrFail($id);
        return view('posts/edit', ['post' => $post]);
    }

    public function store(PostFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $post = Post::create($data);
        return redirect()->route('admin.post.show', ['id' => $post->id]);
    }

    public function update(Post $post, PostFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($post->imageUrl) {
            Storage::disk('public')->delete($post->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $post->update($data);

        return redirect()->route('admin.post.show', ['id' => $post->id]);
    }

    public function updateSpeed(Post $post, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $post->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Post $post)
    {
            if ($post->imageUrl) {
        Storage::disk('public')->delete($post->imageUrl);
    }
        $post->delete();

        return [
            'isSuccess' => true
        ];
    }

        private function handleImageUpload(\Illuminate\Http\UploadedFile|array $images): string|array
    {
        if (is_array($images)) {
            $uploadedImages = [];
            foreach ($images as $image) {
                $imageName = uniqid() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $imageName, 'public');
                $uploadedImages[] = 'images/' . $imageName;
            }
            return $uploadedImages;
        } else {
            $imageName = uniqid() . '_' . $images->getClientOriginalName();
            $images->storeAs('images', $imageName, 'public');
            return 'images/' . $imageName;
        }
    }
}