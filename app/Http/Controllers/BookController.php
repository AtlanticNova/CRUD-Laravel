<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function getAll()
    {       
        return response()->json([
            'status' => 'success',
            'data' => Book::all()
        ], 200);
    }
    
    public function createBook(Request $request)
    {
        if (!$request->has('name')) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Gagal menambahkan buku. Mohon isi nama buku'
            ], 400);
        }
        $book = Book::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil ditambahkan',
            'data' => [
                'bookId' => $book->id
            ]
        ], 201);
    }

    public function getByID($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => [
                'book' => $book
            ]
        ], 200);
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);
        if(!$book){
            return response()->json([
                'status' => 'fail',
                'message' => 'Gagal memperbarui buku. Id tidak ditemukan'
            ], 404);
        }

        if(!$request->name){
            return response()->json([
                'status' => 'fail',
                'message' => 'Gagal memperbarui buku. Mohon isi nama buku'
            ], 400);
        }
        $book->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil diperbarui',
        ], 200);
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);
        if(!$book){
            return response()->json([
                'status' => 'fail',
                'message' => 'Buku gagal dihapus. Id tidak ditemukan'
            ], 404);
        }
        $book->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil dihapus',
        ], 200);
    }
}
