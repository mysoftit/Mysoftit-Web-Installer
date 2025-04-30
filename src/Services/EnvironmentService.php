<?php

namespace MySoftITWebInstaller\Services;

use Exception;
use Illuminate\Support\Facades\File;

class EnvironmentService
{
    public function setDatabaseCredentials($request)
    {
        $envPath = base_path('.env');

        if (!File::exists($envPath)) {
            throw new Exception('.env file not found');
        }

        $envContent = File::get($envPath);

        $updates = [
            'DB_CONNECTION' => $request->database_connection,
            'DB_HOST' => $request->database_hostname,
            'DB_PORT' => $request->database_port,
            'DB_DATABASE' => $request->database_name,
            'DB_USERNAME' => $request->database_username,
            'DB_PASSWORD' => $request->database_password,
        ];

        foreach ($updates as $key => $value) {
            $envContent = preg_replace(
                "/^{$key}=.*/m",
                "{$key}={$value}",
                $envContent
            );
        }

        if (!File::put($envPath, $envContent)) {
            throw new Exception('Failed to update .env file');
        }

        // Test database connection
        $this->testDatabaseConnection($updates);
    }

    protected function testDatabaseConnection($config)
    {
        config([
            'database.connections.test' => [
                'driver' => $config['DB_CONNECTION'],
                'host' => $config['DB_HOST'],
                'port' => $config['DB_PORT'],
                'database' => $config['DB_DATABASE'],
                'username' => $config['DB_USERNAME'],
                'password' => $config['DB_PASSWORD'],
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ]
        ]);

        try {
            DB::connection('test')->getPdo();
        } catch (Exception $e) {
            throw new Exception('Could not connect to database: ' . $e->getMessage());
        }
    }
}