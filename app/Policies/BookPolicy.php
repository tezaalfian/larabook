<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    public function view(User $user, Book $book): bool
    {
        return match ($user->role) {
            'admin' => true,
            'client' => Order::where('user_id', $user->id)
                ->where('book_id', $book->id)
                ->where('status', 'settlement')
                ->exists(),
            default => false,
        };
    }
}
