<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $books = Book::query()
            ->withCount('pages')
            ->orderBy('updated_at', 'desc')
            ->simplePaginate();

        return Inertia::render('Books', [
            'books' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookRequest  $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(StoreBookRequest $request): Redirector|RedirectResponse|Application
    {
        $book = Book::create($request->validated());
        return redirect(route('books.show', $book));
    }

    /**
     * Display the specified resource.
     *
     * @param  Book  $book
     * @return \Inertia\Response
     */
    public function show(Book $book): \Inertia\Response
    {
        $book = $book->load('pages');

        return Inertia::render('Book/Show', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBookRequest  $request
     * @param  Book  $book
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateBookRequest $request, Book $book): Application|RedirectResponse|Redirector
    {
        $book->update($request->validated());
        return redirect(route('books.show', Book::find($book->id)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book  $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
