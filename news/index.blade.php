@extends('layouts.admin')

@section('title', 'News List')

@section('content')
<style>
    /* Make the main container use flex layout */
    .main-content {
        display: flex;
        gap: 20px;
        padding: 20px;
        height: calc(100vh - 80px); /* Adjust based on your header/navbar height */
    }

    /* Sidebar placeholder: keeps existing sidebar width */
    .sidebar-placeholder {
        flex: 0 0 250px; /* fixed width sidebar */
    }

    /* News table container */
    .news-table-container {
        flex: 1;
        overflow-y: auto;
        max-height: 100%;
    }

    .news-table-container table {
        width: 100%;
    }

    /* Optional: fix header row when scrolling */
    .table thead th {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 10;
    }
</style>

<div class="main-content">
    
    <div class="sidebar-placeholder">
        @include('layouts.partials.admin._sidebar') 
    </div>

    <!-- News Table Container -->
    <div class="news-table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>News Articles</h2>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New News
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Published</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title_en }}</td>
                                <td>{{ Str::limit(strip_tags($item->excerpt_en), 50) }}</td>
                                <td>{{ Str::limit(strip_tags($item->content_en), 100) }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/'.$item->image) }}" alt="Image" width="80" height="50" style="object-fit:cover;">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $item->category?->name_en ?? 'N/A' }}</td>
                                <td>
                                    @if($item->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $item->views }}</td>
                                <td>
                                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-info mb-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:inline-block;" 
                                          onsubmit="return confirm('Are you sure you want to delete this news?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No news articles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
