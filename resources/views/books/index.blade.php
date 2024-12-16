<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form method="GET" action="{{ route('book') }}" class="mb-4">
                        <div class="flex items-center space-x-4">
                            
                            <input type="text" name="search" class="mt-1 block w-full" placeholder="Cari Buku..." value="{{ request('search') }}" />

                           
        

                            <x-primary-button type="submit" class="mt-2">{{ __('Search') }}</x-primary-button>
                        </div>
                    </form>

                    
                    <x-primary-button tag="a" href="{{ route('book.create') }}">Tambah Data Buku</x-primary-button>
                    <x-primary-button tag="a" href="{{ route('book.print') }}">Print PDF</x-primary-button>
                    <x-primary-button tag="a" href="{{ route('book.export') }}" target="_blank">Export Excel</x-primary-button>
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'import-book')">{{ __('Import Excel') }}</x-primary-button>

                 
                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Kode Rak</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->city }}</td>
                                <td>
                                    <img src="{{ asset('storage/cover_buku/' . $book->cover) }}" width="100px" />
                                </td>
                                <td>{{ $book->bookshelf->code }}-{{ $book->bookshelf->name }}</td>
                                <td>
                                    <x-primary-button tag="a" href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button>
                                    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')" x-on:click="$dispatch('set-action', '{{ route('book.destroy', $book->id) }}')">{{ __('Delete') }}</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>

                   
                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>