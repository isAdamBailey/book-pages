<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Book;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

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
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
