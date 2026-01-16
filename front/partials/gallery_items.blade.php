@forelse($galleries as $gallery)
    <div class="gallery-item bg-white shadow rounded-lg overflow-hidden">
        @if($gallery->type === 'photo')
            <img src="{{ asset('storage/'.$gallery->file_path) }}" 
                 alt="Gallery Photo" 
                 class="w-full h-48 object-cover">
        @elseif($gallery->type === 'video')
            <video controls class="w-full h-48">
                <source src="{{ asset('storage/'.$gallery->file_path) }}" type="video/mp4">
            </video>
        @endif
        <div class="p-3">
            <h4 class="font-semibold">{{ $gallery->title }}</h4>
            <p class="text-sm text-gray-500">
                {{ $gallery->department->department_name ?? 'General' }} | {{ $gallery->year }}
            </p>
        </div>
    </div>
@empty
    <div class="col-span-3 text-center text-gray-500 py-10">
        No items found for this filter.
    </div>
@endforelse
