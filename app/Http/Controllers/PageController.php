<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Book;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePageRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StorePageRequest $request): Redirector|RedirectResponse|Application
    {
        $book = Book::find($request->book_id);
        $image = $request->hasFile('image')
            ? $request->file('image')->storePublicly('book/'.$book->slug)
            : '';

        $book->pages()->create([
            'content' => $request->input('content'),
            'page_number' => $request->page_number,
            'image_path' => $image
        ]);

        return redirect(route('books.show', $book));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePageRequest  $request
     * @param  Page  $page
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdatePageRequest $request, Page $page): Redirector|RedirectResponse|Application
    {
        if($request->hasFile('image')) {
            Storage::disk('s3')->delete($page->image_path);
            $image = $request->file('image')->storePublicly('book/'.$page->book->slug);
            $page->image_path = $image;
        }

        if ($request->has('content')) {
            $page->content = $request->input('content');
        }

        $page->save();

        return redirect(route('books.show', $page->book));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page  $page
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Page $page): Redirector|RedirectResponse|Application
    {
        Storage::disk('s3')->delete($page->image_path);
        $page->delete();

        return redirect(route('books.show', $page->book));
    }
}
