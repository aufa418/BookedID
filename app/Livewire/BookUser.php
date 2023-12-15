<?php

namespace App\Livewire;

use App\Models\book;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookUser extends Component
{
    public $books;
    public $books_list;

    public function render()
    {
        $list_books = book::where('borrowed', false);
        if ($list_books) {
            $this->books_list = $list_books->get();
        } else {
            return session()->flash('error', 'The book has been borrowed. Please refresh the application.');
        }

        $this->books = book::where('borrow_by', auth()->user()->name)->where('borrowed', true)->orderBy('created_at', 'asc')->get();
        return view('livewire.book-user');
    }

    public function returned($id)
    {
        book::find($id)->update([
            'borrow_by' => '',
            'borrowed' => false,
        ]);

        session()->flash('success', 'The book has been returned');
    }

    public function borrow($id)
    {
        book::find($id)->update([
            'borrow_by' => auth()->user()->name,
            'borrowed' => true
        ]);

        return session()->flash('success', 'The book has been borrowed');
    }
}
