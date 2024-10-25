@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if (Session::has('message'))
          <div class="alert alert-success">
              {{ Session::get( 'message' ) }}`
          </div>
      @endif
      <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span>All Category</span>
                        <a href="{{route('category.create')}}">
                            <button class="btn btn-outline-light">
                                <i class="bi bi-plus-circle"></i>Add Category   
                            </button>
                        </a>
                </div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(count($categories)>0)
                        @foreach($categories as $key=>$category)
                      <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('category.edit', [$category->id]) }}"><button class="btn btn-outline-success">Edit</button></a>
                        </td>
                        
                        <td>
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                      </td>
                      </tr>
                      
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">

                                        <form action="{{ route('category.destroy', ['category' => $category->id]) }}"
                                            method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this category?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                      @endforeach
                      @else
                      <td>Tidak ada kategory yang dapat ditampilkan</td>
                      @endif
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection