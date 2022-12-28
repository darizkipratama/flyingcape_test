<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->ProductName }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl"> Description: </div>
                <div class="max-w-xl">
                    {{ $product->ProductDescription }}
                </div>
                <div class="max-w-xl"> Video URL: </div>
                <div class="max-w-xl">
                    {{ $product->VideoUrl }}
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl"> Price </div>
                <div class="max-w-xl">
                    {{ $product->Price }}
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('products.purchase') }}">
                    @csrf
                    <input type="hidden" value={{$product->id}} name="productId" />
                    <x-primary-button class="mt-4">
                        Subscribe
                    </x-primary-button>
                    <a href="{{route('dashboard')}}" class="btn btn-blue ml-3">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>