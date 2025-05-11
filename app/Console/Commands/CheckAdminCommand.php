<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class CheckAdminCommand extends Command
{
    protected $signature = 'admin:check';
    protected $description = 'Check if admin user exists and has proper permissions';

    public function handle()
    {
        $admin = User::where('email', 'admin@example.com')->first();

        if (!$admin) {
            $this->error('Admin user not found!');
            return;
        }

        $this->info('Admin user found:');
        $this->line("ID: {$admin->id}");
        $this->line("Name: {$admin->name}");
        $this->line("Email: {$admin->email}");
        $this->line("Is admin: {$admin->is_admin}");
        $this->line("Created at: {$admin->created_at}");

        // Проверка прав
        $this->newLine();
        $this->info('Permission checks:');
        $this->line("isAdmin(): " . ($admin->isAdmin() ? 'YES' : 'NO'));
        $this->line("Gate check: " . (Gate::forUser($admin)->allows('admin') ? 'YES' : 'NO'));
    }
}