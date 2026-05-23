<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Créer les rôles ───────────────────────────────────────────────────
        $roles = ['super_admin', 'expert', 'client'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // ── Super Admin (Diabel) ──────────────────────────────────────────────
        $admin = User::updateOrCreate(
            ['email' => 'academie.redactionohada@gmail.com'],
            [
                'prenom'             => 'Diabel',
                'nom'                => 'Admin',
                'email'              => 'academie.redactionohada@gmail.com',
                'password'           => Hash::make('Admin@2025!'),
                'email_verified_at'  => now(),
                'telephone'          => '+221775646246',
                'pays'               => 'Sénégal',
                'ville'              => 'Dakar',
                'actif'              => true,
            ]
        );

        $admin->syncRoles(['super_admin']);

        // Assigner le rôle client à tous les utilisateurs existants qui n'en ont pas (cas des comptes créés pendant que le rôle n'existait pas)
        User::where('email', '!=', 'academie.redactionohada@gmail.com')
            ->get()
            ->each(function ($user) {
                if ($user->roles->isEmpty()) {
                    $user->assignRole('client');
                }
            });

        $this->command->info('✅ Super Admin créé : academie.redactionohada@gmail.com / Admin@2025!');
        $this->command->warn('⚠️  Changez le mot de passe immédiatement après la première connexion !');
    }
}
