<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $statusCounts = Order::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'cancelledOrders' => Order::where('status', 'cancel')->count(),
            'statusLabels' => ['Draft', 'Pending', 'Confirmed', 'Completed', 'Cancel'],
            'statusValues' => [
                $statusCounts['draft'] ?? 0,
                $statusCounts['pending'] ?? 0,
                $statusCounts['confirmed'] ?? 0,
                $statusCounts['completed'] ?? 0,
                $statusCounts['cancel'] ?? 0,
            ],
        ]);
    }

    public function orders(Request $request)
    {
        $query = Order::query();

        $status = $request->query('status');
        $search = $request->query('search');

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($sub) use ($search) {
                $sub->where('nama_penumpang', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%")
                    ->orWhere('kode_pesawat', 'like', "%{$search}%")
                    ->orWhere('lokasi_jemput', 'like', "%{$search}%")
                    ->orWhere('lokasi_tujuan', 'like', "%{$search}%");
            });
        }

        return view('admin.orders', [
            'orders' => $query->orderByDesc('created_at')->paginate(15)->withQueryString(),
            'status' => $status,
            'search' => $search,
        ]);
    }

    public function exportOrders(Request $request)
    {
        $query = Order::query();
        $status = $request->query('status');
        $search = $request->query('search');

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($sub) use ($search) {
                $sub->where('nama_penumpang', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%")
                    ->orWhere('kode_pesawat', 'like', "%{$search}%")
                    ->orWhere('lokasi_jemput', 'like', "%{$search}%")
                    ->orWhere('lokasi_tujuan', 'like', "%{$search}%");
            });
        }

        $orders = $query->orderByDesc('created_at')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.partials.export-orders-pdf', [
            'orders' => $orders,
            'status' => $status,
            'search' => $search,
        ]);

        $filename = 'orders_export_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    public function batchUpdateOrders(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array|min:1',
            'order_ids.*' => 'integer|exists:orders,id',
            'status' => 'required|in:draft,pending,confirmed,completed,cancel',
        ]);

        Order::whereIn('id', $request->order_ids)
            ->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui untuk pesanan terpilih.');
    }

    public function orderDetail(Order $order)
    {
        return view('admin.order-detail', [
            'order' => $order,
        ]);
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:draft,pending,confirmed,completed,cancel',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function users(Request $request)
    {
        $query = User::query();

        $search = $request->query('search');

        if ($search) {
            $query->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return view('admin.users', [
            'users' => $query->orderBy('name')->paginate(20)->withQueryString(),
            'search' => $search,
        ]);
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['role' => 'Anda tidak dapat mengubah peran akun Anda sendiri.']);
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Peran pengguna berhasil diperbarui.');
    }
}
