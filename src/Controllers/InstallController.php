<?php

namespace MySoftITWebInstaller\Controllers;

use Illuminate\Routing\Controller;
use MySoftITWebInstaller\Requests\LicenseRequest;
use MySoftITWebInstaller\Requests\DatabaseRequest;
use MySoftITWebInstaller\Requests\AdminRequest;
use MySoftITWebInstaller\Services\EnvironmentService;
use MySoftITWebInstaller\Services\DatabaseService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Exception;

class InstallController extends Controller
{
    protected $environmentService;
    protected $databaseService;

    public function __construct(
        EnvironmentService $environmentService,
        DatabaseService $databaseService
    ) {
        $this->environmentService = $environmentService;
        $this->databaseService = $databaseService;
    }

    public function index()
    {
        return view('installer::steps.requirements');
    }

    public function requirements()
    {
        $requirements = [
            'PHP Version (>= 8.0)' => version_compare(phpversion(), '8.0', '>='),
            'BCMath Extension' => extension_loaded('bcmath'),
            'Ctype Extension' => extension_loaded('ctype'),
            'JSON Extension' => extension_loaded('json'),
            'Mbstring Extension' => extension_loaded('mbstring'),
            'OpenSSL Extension' => extension_loaded('openssl'),
            'PDO Extension' => extension_loaded('pdo'),
            'Tokenizer Extension' => extension_loaded('tokenizer'),
            'XML Extension' => extension_loaded('xml'),
        ];

        $permissions = [
            'storage/' => is_writable(storage_path()),
            'bootstrap/cache/' => is_writable(base_path('bootstrap/cache')),
            '.env' => is_writable(base_path('.env')),
        ];

        return view('installer::steps.requirements', compact('requirements', 'permissions'));
    }

    public function license()
    {
        return view('installer::steps.license');
    }

    public function verifyLicense(LicenseRequest $request)
    {
        // Implement your license verification logic here
        $valid = $this->verifyWithLicenseServer($request->license_key);

        if (!$valid) {
            return redirect()->back()->with('error', 'Invalid license key');
        }

        session(['license_verified' => true]);
        return redirect()->route('installer.database');
    }

    public function database()
    {
        return view('installer::steps.database');
    }

    public function saveDatabase(DatabaseRequest $request)
    {
        try {
            $this->environmentService->setDatabaseCredentials($request);
            session(['database_configured' => true]);
            return redirect()->route('installer.import');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function import()
    {
        return view('installer::steps.import');
    }

    public function processImport()
    {
        try {
            $this->databaseService->importDatabase();
            session(['database_imported' => true]);
            return redirect()->route('installer.admin');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function admin()
    {
        return view('installer::steps.admin');
    }

    public function saveAdmin(AdminRequest $request)
    {
        try {
            $this->databaseService->createAdminUser($request->only([
                'name', 'email', 'password'
            ]));

            session(['admin_created' => true]);
            return redirect()->route('installer.complete');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function complete()
    {
        // Create installed file
        file_put_contents(storage_path('installed'), '');

        // Generate app key
        Artisan::call('key:generate');

        // Clear caches
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');

        $loginUrl = url('/login');
        $adminCredentials = session('admin_credentials');

        return view('installer::steps.complete', compact('loginUrl', 'adminCredentials'));
    }

    protected function verifyWithLicenseServer($licenseKey)
    {
        // Implement actual license verification logic
        // This is a placeholder
        return true;
    }
}