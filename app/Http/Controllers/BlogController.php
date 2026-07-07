<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Retorna la vista con el listado de entradas del blog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $entries = Blog::with(['user', 'category', 'tags'])->get();
        return view('blogs.index', ['entries' => $entries]);
    }

    /**
     * Retorna la entrada del blog solicitado
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $entry = Blog::with(['user', 'category', 'tags'])->findOrFail($id);
        return view('blogs.show', ['entry' => $entry]);
    }

    /**
     * Muestra la vista del panel de administrador para blogs
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function panel()
    {
        $entries = Blog::with(['user', 'category', 'tags'])->get();
        return view('blogs.admin.panel', ['entries' => $entries]);
    }

    /**
     * Retorna la vista para crear una entrada de blog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('blogs.admin.create', [
            'tags'       => $tags,
            'categories' => $categories
        ]);
    }

    /**
     * Crea una entrada de un post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['user_id'] = auth()->user()->id;
        $request->validate(Blog::VALIDATION_RULES, Blog::VALIDATION_MESSAGES);

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('img/blog_images');
        }

        $blog = Blog::create($data);
        $blog->tags()->sync($data['tags']);
        return redirect()->route('admin.blogs')->with('feedback.message', 'Se creó la entrada <b>' . e($data['title']) . '</b> con éxito.');
    }

    /**
     * Muestra la pantalla de edición de la entrada seleccionada
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $entry = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('blogs.admin.edit', [
            'entry'      => $entry,
            'tags'       => $tags,
            'categories' => $categories
        ]);
    }

    /**
     * Actualiza la entrada de blog
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate(Blog::VALIDATION_RULES, Blog::VALIDATION_MESSAGES);
        $data = $request->except('_token');
        $blog = Blog::findOrFail($id);

        $currentImage = $blog->image;

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('img/blog_images');
        }

        $blog->update($data);
        $blog->tags()->sync($request->get('tags'));

        if(
            $request->hasFile('image') &&
            $currentImage &&
            Storage::exists($currentImage)
        ) {
            Storage::delete($currentImage);
        }

        return redirect()->route('admin.blogs')->with('feedback.message', 'Se editó la entrada <b>' . e($request->get('title')) . '</b> con éxito.');
    }

    /**
     * Muestra la página de
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(int $id)
    {
        $entry = Blog::findOrFail($id);
        return view('blogs.admin.delete', ['entry' => $entry]);
    }

    /**
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $entry = Blog::findOrFail($id);
        $entry->delete();
        return redirect()->route('admin.blogs')->with('feedback.message', 'Se eliminó la entrada <b>' . e($entry->title) . '</b> con éxito.');
    }
}
