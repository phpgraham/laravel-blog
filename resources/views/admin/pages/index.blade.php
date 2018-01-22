@extends('admin.layouts.app')

@section('content')
<div class="container col-md-8 col-md-offset-2">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h4">Manage Blog Pages</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{ url('admin/pages/create') }}" class="btn btn-sm btn-outline-secondary">Create Blog Page</a>
          </div>
        </div>
    </div>

    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th width="50">ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th width="100">Actions</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td class="push-right">
                        <a class="btn btn-primary btn-sm" title="Edit Page"
                            href="{{ route('admin.pages.edit', ['id' => $page->id]) }}">
                            <span class="far fa-edit fa-lg" aria-label="Click to edit page item"></span>
                        </a>
                        <a class="btn btn-warning btn-sm" title="Archive Page"
                            href="{{ route('admin.pages.delete', ['id' => $page->id]) }}"
                            onclick="return confirm('Are you sure?')">
                            <span class="far fa-trash-alt fa-lg" aria-label="Click to archive page"></span>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


    @if (count($archives)>0)
        <h4>Archived Blog Pages</h4>

        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th width="100">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($archives as $archive)
                    <tr>
                        <td>{{ $archive->id }}</td>
                        <td>{{ $archive->title }}</td>
                        <td>{{ $archive->slug }}</td>
                        <td class="push-right">
                            <a class="btn btn-primary btn-sm" title="Restore Page"
                                href="{{ route('admin.pages.restore', ['id' => $archive->id]) }}">
                                <span class="fas fa-undo fa-lg" aria-label="Click to restore page item"></span>
                            </a>
                            <a class="btn btn-danger btn-sm" title="Permantely Delete Page"
                                href="{{ route('admin.pages.force', ['id' => $archive->id]) }}"
                                onclick="return confirm('Are you sure?')">
                                <span class="far fa-trash-alt fa-lg" aria-label="Click to permantely delete page"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
