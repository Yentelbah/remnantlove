<?php

namespace App\Providers;

use App\Models\TaskNotification;
use App\Models\TaskReminder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class NavBarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.flow.nav', function ($view) {
            if (Auth::check()) { // Check if the user is authenticated
                // Fetch unread notifications and their count
                $taskNotifications = TaskNotification::where('user_id', Auth::id())
                    ->where('is_read', false)  // Only show unread notifications
                    ->get();

                $unreadCount = TaskNotification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count();  // Get count of unread notifications

                $view->with('taskNotifications', $taskNotifications)
                     ->with('unreadCount', $unreadCount);
            } else {
                $view->with('taskNotifications', collect()) // Pass an empty collection if the user is not authenticated
                     ->with('unreadCount', 0); // No notifications if not authenticated
            }
        });

        View::composer('layouts.flow.nav', function ($view) {
            if (Auth::check()) { // Check if the user is authenticated
                // Fetch unread notifications and their count
                $messages = TaskReminder::where('user_id', Auth::id())
                    ->get();

                $messagesCount = TaskNotification::where('user_id', Auth::id())
                    ->count();  // Get count of unread notifications

                $view->with('messages', $messages)
                     ->with('messagesCount', $messagesCount);
            } else {
                $view->with('messages', collect()) // Pass an empty collection if the user is not authenticated
                     ->with('messagesCount', 0); // No notifications if not authenticated
            }
        });
    }
}
