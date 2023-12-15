<?php

namespace App\Livewire;

use App\Models\book;
use Livewire\Component;

class BooksComponent extends Component
{
    public $books;
    public $name;
    public $isbn;
    public $author;
    public $editData = false;
    public $dataID;

    public function updatedData()
    {
        $this->books = book::orderBy('created_at', 'desc')->get();
    }
    public function render()
    {
        $this->books = book::orderBy('created_at', 'desc')->get();
        return view('livewire.books-component');
    }

    public function clearData()
    {
        $this->name = '';
        $this->isbn = null;
        $this->author = '';

    }

    public function save()
    {
        $validate = $this->validate([
            'name' => 'required|string',
            'isbn' => 'required|integer|unique:books',
            'author' => 'required|string',
        ]);

        book::create($validate);
        session()->flash('success', 'Data added successfully');
        $this->clearData();
    }

    public function updateDialog($id)
    {
        $this->editData = true;
        $data = Book::find($id);
        if ($data) {
            $this->name = $data->name;
            $this->isbn = $data->isbn;
            $this->author = $data->author;

            $this->dataID = $id;
        }
    }

    public function updateData()
    {
        $validate = $this->validate([
            'name' => 'string',
            'isbn' => 'integer',
            'author' => 'string',
        ]);

        book::find($this->dataID)->update($validate);
        $this->clearData();

        session()->flash('success', 'Data updated successfully');
        $this->editData = false;
    }
    public function delete($id)
    {
        book::find($id)->delete();
        session()->flash('success', 'Data deleted successfully');
    }
}
