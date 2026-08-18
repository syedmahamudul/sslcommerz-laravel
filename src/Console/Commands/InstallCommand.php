<?php

namespace Syedmahamudul\Sslcommerz\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'sslcommerz:install';
    protected $description = 'Install SSLCommerz package';

    public function handle()
    {
        $this->info('🚀 Installing SSLCommerz Package...');

        $this->call('vendor:publish', [
            '--tag' => 'sslcommerz-config',
            '--force' => true,
        ]);

        $this->updateEnvFile();

        $this->info('✅ SSLCommerz installed successfully!');
        $this->info('');
        $this->info('📝 Add your credentials to .env:');
        $this->info('   SSLC_SANDBOX=true');
        $this->info('   SSLC_STORE_ID=your_store_id');
        $this->info('   SSLC_STORE_PASSWORD=your_store_password');
        $this->info('   SSLC_CURRENCY=BDT');
        $this->info('');
        $this->info('🔒 Add to VerifyCsrfToken.php:');
        $this->info('   protected $except = [\'sslcommerz/*\'];');
        $this->info('');
        $this->info('🧪 Test with: php artisan sslcommerz:make-payment 100');
    }

    protected function updateEnvFile()
    {
        $envPath = base_path('.env');
        if (!File::exists($envPath)) {
            return;
        }

        $envContent = File::get($envPath);
        
        $variables = [
            'SSLC_SANDBOX' => 'true',
            'SSLC_STORE_ID' => 'your_store_id_here',
            'SSLC_STORE_PASSWORD' => 'your_store_password_here',
            'SSLC_CURRENCY' => 'BDT',
        ];

        foreach ($variables as $key => $value) {
            if (!str_contains($envContent, "{$key}=")) {
                $envContent .= "\n{$key}={$value}";
            }
        }

        File::put($envPath, $envContent);
    }
}