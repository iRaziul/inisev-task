<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Notice Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" id="stories"
                    data-last-id="{{ $stories->first()->id ?? 0 }}">
                    @forelse ($stories as $story)
                        <div class="mb-8">
                            <div class="text-sm font-semibold text-gray-900">
                                {!! $story->title !!}
                            </div>
                            <div class="mt-3 text-sm text-gray-600">
                                {!! $story->description !!}
                            </div>
                        </div>
                    @empty
                        <div class="text-xl font-bold text-center">No story posted yet</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        last_id = $('#stories').data('last-id');
        setInterval(function() {
            $.ajax({
                url: '{{ route('api.notice-board.index') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    post_id: last_id
                },
                success: function(response) {
                    if (response.data.length < 1) return;
                    last_id = response.data[0].id;

                    $.each(response.data, function(index, story) {
                        $('#stories').prepend(
                            `<div class="mb-8" data-id="${story.id}">
                                <div class="text-sm font-semibold text-gray-900">
                                ${story.title}
                            </div>
                            <div class="mt-3 text-sm text-gray-600">
                                ${story.description}
                                </div>
                            </div>`
                        );
                    });
                }
            });
        }, 5000);
    </script>

</x-app-layout>
