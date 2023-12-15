<div>
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
    <button type="button" class="btn btn-primary w-20" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Borrow Book
    </button>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="text-center">Book Borrowed</h5>
            <hr>
            {{-- Table Book List --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Book</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $value)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->isbn }}</td>
                            <td>{{ $value->author }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm"
                                    wire:click="returned({{ $value->id }})">Returned</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Book List --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Book List</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Book</th>
                                <th scope="col" class="text-center">Author</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books_list as $value)
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ $value->name }}</td>
                                    <td class="text-center">{{ $value->author }}</td>
                                    <td class="text-center">
                                        <form wire:submit.prevent="borrow({{ $value->id }})">
                                            <button class="btn btn-primary btn-sm"
                                                data-bs-dismiss="modal">Borrow</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
