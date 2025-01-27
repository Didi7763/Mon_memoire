<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Récupérer le nombre de notifications non lues.
     */
    public function unreadCount()
    {
        $unreadCount = GlobalNotification::whereDoesntHave('read_by', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        return response()->json(['unreadCount' => $unreadCount]);
    }

    /**
     * Marquer une notification comme lue.
     */
    public function markAsRead($notificationId)
    {
        $notification = GlobalNotification::find($notificationId);
        if ($notification) {
            $notification->read_by()->attach(Auth::id(), ['read_at' => now()]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function markAllAsRead()
    {
        $unreadNotifications = GlobalNotification::whereDoesntHave('read_by', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        foreach ($unreadNotifications as $notification) {
            $notification->read_by()->attach(Auth::id(), ['read_at' => now()]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Récupérer la liste des notifications.
     */
    public function index()
    {
        $notifications = GlobalNotification::whereDoesntHave('read_by', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('layouts.app', compact('notifications'));
    }
}
