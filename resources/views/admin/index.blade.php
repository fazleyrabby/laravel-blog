@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          
            <div class="card">
                <div class="card-header">Latest Categories</div>

                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <td scope="col" width="60">#</td>
                                <td scope="col" width="60">Name</td>
                                <td scope="col" width="60">Created By</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <th>{{ $category->id }}</th>
                                <th>{{ $category->name }}</th>
                                <th>{{ $category->user->name }}</th>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Latest Post</div>

                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <td scope="col" width="60">#</td>
                                <td scope="col" width="60">Title</td>
                                <td scope="col" width="60">Created By</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <th>{{ $post->id }}</th>
                                <th>{{ $post->title }}</th>
                                <th>{{ $post->user->name }}</th>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Latest Page</div>

                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <td scope="col" width="60">#</td>
                                <td scope="col" width="60">Title</td>
                                <td scope="col" width="60">Created By</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                            <tr>
                                <th>{{ $page->id }}</th>
                                <th>{{ $page->title }}</th>
                                <th>{{ $page->user->name }}</th>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
