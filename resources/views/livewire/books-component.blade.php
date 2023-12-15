<div>
    <h2 class="text-center">
        Welcome back {{ Auth::user()->name }}
    </h2>
    <br>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
        Create Data
    </button>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="text-center">Book List</h5>
            <hr>
            {{-- Table Book List --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">Book</th>
                        <th scope="col" class="text-center">ISBN</th>
                        <th scope="col" class="text-center">Author</th>
                        <th scope="col" class="text-center">Borrow</th>
                        <th scope="col" class="text-center">Borrowed By</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $value)
                        <tr>
                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $value->name }}</td>
                            <td class="text-center">{{ $value->isbn }}</td>
                            <td class="text-center">{{ $value->author }}</td>
                            <td class="text-center">
                                @if ($value->borrowed == true)
                                    <i class="bi bi-check"></i>
                                @else
                                    <i class="bi bi-x-circle"></i>
                                @endif
                            </td>
                            <td class="text-center">{{ $value->borrow_by }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" wire:click="updateDialog({{ $value->id }})"
                                    data-bs-toggle="modal" data-bs-target="#modal">Edit</button>
                                <form wire:submit.prevent="delete({{ $value->id }})" wire:confirm="Are you sure?"
                                    class="d-inline">
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Create Data --}}
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" wire:transition>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        {{ $editData == true ? 'Edit Data' : 'Create Data' }}</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="clearData()"></button>
                </div>
                <form wire:submit.prevent="{{ $editData == true ? 'updateData()' : 'save()' }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="book" class="form-label">Book Name</label>
                            <input type="text" class="form-control" id="book" wire:model="name">
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="number" class="form-control" id="isbn" wire:model="isbn">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" wire:model="author">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click="clearData()">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
