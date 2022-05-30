<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Stories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="mb-8 text-lg font-bold">ADD NEW STORY</h3>

                    @if (session()->has('success'))
                        <div class="px-4 py-3 mb-4 text-green-900 bg-green-200 rounded-md" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('story.store') }}" method="post" class="">
                        @csrf
                        <div class="mb-4">
                            <x-label for="title" value="Title" />
                            <x-input id="title" name="title" type="text" :value="old('title')" class="w-full mt-2" />
                            @error('title')
                                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <x-label for="description" value="Description" />
                            <x-textarea id="description" name="description" class="w-full mt-2" :value="old('description')" />
                            @error('description')
                                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-button type="submit">
                            Create Story
                        </x-button>
                    </form>
                </div>
                <div class="mt-8 bg-white border-b border-gray-200">
                    <h3 class="p-6 mb-4 text-lg font-bold">Story Lists</h3>

                    <div class="w-full overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="text-gray-500 bg-gray-100">
                                <tr class="text-xs tracking-wide text-left uppercase whitespace-nowrap">
                                    <th class="p-4 font-medium">ID</th>
                                    <th class="p-4 font-medium">Title</th>
                                    <th class="p-4 font-medium">Description</th>
                                    <th class="p-4 font-medium">Status</th>
                                    <th class="p-4 font-medium">Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($stories as $story)
                                    <tr>
                                        <td class="p-4 text-sm">
                                            {{ $story->id }}
                                        </td>
                                        <td class="p-4 text-xs font-semibold whitespace-nowrap">
                                            {!! $story->title !!}
                                        </td>
                                        <td class="p-4 text-sm whitespace-nowrap">
                                            {!! $story->description !!}
                                        </td>
                                        <td class="p-4 text-sm">
                                            {{ $story->approved ? 'Approved' : 'Pending' }}
                                        </td>
                                        <td class="p-4 space-x-3 text-sm text-right whitespace-nowrap">
                                            {{ $story->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-4 text-center">
                                            No posts yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
