<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica os usuários criados no banco de dados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔐 Usuários no banco de dados:');
        $this->info('================================');

        $users = User::all();

        if ($users->isEmpty()) {
            $this->warn('❌ Nenhum usuário encontrado no banco de dados.');
            return;
        }

        foreach ($users as $user) {
            $this->line("✅ {$user->name}");
            $this->line("   📧 Email: {$user->email}");
            $this->line("   📅 Criado em: {$user->created_at->format('d/m/Y H:i:s')}");
            $this->line("   ---");
        }

        $this->info("📊 Total de usuários: {$users->count()}");

        // Verificar se os usuários específicos estão presentes
        $expectedUsers = [
            'admin@paulinho.com' => 'Administrador',
            'paulinho@gmail.com' => 'Paulinho Polimentos',
            'elisa@gmail.com' => 'Elisa Car-Detail'
        ];

        $this->info('');
        $this->info('🎯 Verificação dos usuários esperados:');

        foreach ($expectedUsers as $email => $expectedName) {
            $user = $users->firstWhere('email', $email);
            if ($user) {
                $this->info("✅ {$email} - {$user->name}");
            } else {
                $this->error("❌ {$email} - NÃO ENCONTRADO");
            }
        }
    }
}
