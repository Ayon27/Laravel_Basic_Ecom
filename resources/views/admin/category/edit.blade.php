<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>

    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center"><b> Edit Category </b></div>
                    <div class="card-body">
                        <form action="{{ url('category/update/'.$category->id) }}" method="POST">
                            @csrf
                            @error('category_name')
                            <div class="card-text">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label for="addCategory">Update Category name</label>
                                <input type="text" class="form-control" id="addCategory" name="category_name"
                                    placeholder="Category Name" value="{{ $category->category_name }}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
