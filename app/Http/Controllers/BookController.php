<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        // return response json with status 200 and pass all Books
        return response()->json([
            'status' => 'success',
            'data' => Book::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createBook(Request $request)
    {
        // if request name doesnt exist, return error
        if (!$request->has('name')) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Gagal menambahkan buku. Mohon isi nama buku'
            ], 400);
        }
        // store a new Book
        $book = Book::create($request->all());
        // return response json with status 201 and pass the new Book
        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil ditambahkan',
            'data' => [
                'bookId' => $book->id
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function getByID($id)
    {
        $book = Book::find($id);
        // if there is no book return message Buku tidak ditemukan
        if (!$book) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }
        // return book
        return response()->json([
            'status' => 'success',
            'data' => [
                'book' => $book
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);
        if(!$book){
            // return status fail and message failed
            return response()->json([
                'status' => 'fail',
                'message' => 'Gagal memperbarui buku. Id tidak ditemukan'
            ], 404);
        }

        if(!$request->name){
            // return fail and message
            return response()->json([
                'status' => 'fail',
                'message' => 'Gagal memperbarui buku. Mohon isi nama buku'
            ], 400);
        }
        // update book
        $book->update($request->all());
        // return response json with status 200 and pass the updated Book
        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil diperbarui',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function deleteBook($id)
    {
        $book = Book::find($id);
        // if there is no book rturn error
        if(!$book){
            // return status fail and message failed
            return response()->json([
                'status' => 'fail',
                'message' => 'Buku gagal dihapus. Id tidak ditemukan'
            ], 404);
        }
        // delete book
        $book->delete();
        // return response json with status 200 and pass the deleted Book
        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil dihapus',
        ], 200);
    }
}
