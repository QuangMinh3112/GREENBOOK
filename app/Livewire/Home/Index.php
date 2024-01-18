<?php

namespace App\Livewire\Home;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use App\Models\Warehouse;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

#[Layout('Layout.app')]
#[Title('Trang chủ')]

class Index extends Component
{
    use WithPagination;
    public $totalPrice = 0;
    public $totalProductPrice = 0;
    public $type;
    public $comments = [];
    public $topRatting;
    public $ratting;
    public $chart_options;
    public $completed;
    public $rattingCount;
    public $topUser;
    public $page = 5;
    public function mount()
    {
        $warehouses = Warehouse::all();
        foreach ($warehouses as $data) {
            $this->totalPrice += ($data->import_price * ($data->quantity + $data->returned_quantity + $data->defective_quantity + $data->stock));
        }
        $orders = Order::where('status', 'like', 'completed')->get();
        foreach ($orders as $data) {
            $this->totalProductPrice += $data->total_product_amount;
        }
        $ratings = Review::groupBy('rating')->selectRaw('rating, COUNT(*) as count')->pluck('count', 'rating')->toArray();
        for ($i = 0; $i <= 5; $i++) {
            $this->comments[$i] = $ratings[$i] ?? 0;
        }
        $this->topRatting = Book::select('books.id', 'books.name', DB::raw('COUNT(reviews.id) as total_reviews'))
            ->leftJoin('reviews', 'books.id', '=', 'reviews.book_id')
            ->groupBy('books.id', 'books.name')
            ->orderByDesc('total_reviews')
            ->take(5)
            ->get();
        $currentDateTime = Carbon::now();
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $this->completed = Order::where('status', 'completed')
            ->whereBetween('created_at', [$sixMonthsAgo, $currentDateTime])
            ->orderBy('created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            })
            ->map(function ($orders) {
                return $orders->count();
            })
            ->values()
            ->toArray();
        $this->ratting = Review::all();
        $this->rattingCount = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];
        foreach ($this->ratting as $data) {
            $rating = $data->rating;
            if ($rating >= 1 && $rating <= 5) {
                $this->rattingCount[$rating]++;
            }
        }
        $this->topUser = Order::select('user_id')
            ->selectRaw('COUNT(*) as order_count')
            ->selectRaw('SUM(total) as total_amount')
            ->where('user_id', '!=', null)
            ->groupBy('user_id')
            ->orderByDesc('order_count')
            ->orderByDesc('total_amount')
            ->take(5)
            ->with('user')
            ->get();
    }
    public function render()
    {
        return view('livewire.home.index', [
            "allProduct" => Book::all()->count(),
            "totalPrice" => $this->totalPrice,
            "totalProductPrice" => $this->totalProductPrice,
            "pending" => Order::where('status', 'pending')->count(),
            "completed" => $this->completed,
            "rattingCount" => $this->rattingCount,
            "user" => $this->topUser,
        ]);
    }
}
