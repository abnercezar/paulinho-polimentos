<?php

use App\Models\User;

// Script simples para verificar usuários
echo "Usuários criados no banco de dados:\n";
echo "==================================\n";

$users = User::all();

foreach ($users as $user) {
    echo "Nome: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Data de criação: {$user->created_at}\n";
    echo "---\n";
}

echo "\nTotal de usuários: " . $users->count() . "\n";
