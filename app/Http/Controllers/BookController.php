<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $books = Book::query()
            ->withCount('pages')
            ->with(['pages' => fn ($q) => $q->hasImage()])
            ->orderBy('updated_at', 'desc')
            ->get();

        return Inertia::render('Books/Index', [
            'books' => [
                'data' => $books,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookRequest  $request
     * @return Application|RedirectResponse|Redirector
     *
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
     * @return Response
     */
    public function show(Book $book): Response
    {
        return Inertia::render('Book/Show', [
            'book' => $book,
            'pages' => $book->pages()->paginate(2),
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
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Book $book): Redirector|RedirectResponse|Application
    {
        foreach ($book->pages() as $page) {
            Storage::disk('s3')->delete($page->image_path);
        }
        $book->pages()->delete();
        $book->delete();

        return redirect(route('dashboard'));
    }
}
