<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $section = $request->query('p', 'profile');

        switch ($section) {
            case 'shipping-address':
                $address = Address::where('user_id', Auth::id())->get();

                return view('profile.shipping-address', compact('address'));
                break;

            case 'set-password':
                return view('profile.set-password');
                break;

            case 'deactive-account':
                return view('profile.deactive-account');
                break;

            case 'waiting-for-payment':
                $orders = Order::with(['orderItems.product.images', 'orderItems.stock.size'])->where('status', 'pending')->orderBy('created_at', 'desc')->get();

                return view('profile.waiting-for-payment', compact('orders'));
                break;

            case 'order-history':
                $orders = Order::with(['orderItems.product.images', 'orderItems.stock.size'])->where('status', '!=', 'pending')->orderBy('created_at', 'desc')->get();

                return view('profile.order-history', compact('orders'));
                break;

            default:
                return view('profile.index', [
                    'user' => $request->user(),
                ]);
                break;
        }
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.index')->with('success', 'Profile successfully updated!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
