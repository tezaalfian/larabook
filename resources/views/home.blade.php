<x-layouts.client>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary w-100">Logout</button>
    </form>
</x-layouts.client>
