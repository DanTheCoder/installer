<?php

namespace DanTheCoder\Installer\Http\Controllers;

use App\Http\Controllers\Controller;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = [
            'PHP Version >= '.config('installer.php_version') => phpversion() >= config('installer.php_version'),
            'Ctype PHP Extension' => extension_loaded('ctype'),
            'cURL PHP Extension' => extension_loaded('curl'),
            'DOM PHP Extension' => extension_loaded('dom'),
            'Fileinfo PHP Extension' => extension_loaded('fileinfo'),
            'Filter PHP Extension' => extension_loaded('filter'),
            'Hash PHP Extension' => extension_loaded('hash'),
            'Mbstring PHP Extension' => extension_loaded('mbstring'),
            'OpenSSL PHP Extension' => extension_loaded('openssl'),
            'PCRE PHP Extension' => extension_loaded('pcre'),
            'PDO PHP Extension' => extension_loaded('pdo'),
            'Session PHP Extension' => extension_loaded('session'),
            'Tokenizer PHP Extension' => extension_loaded('tokenizer'),
            'XML PHP Extension' => extension_loaded('xml'),

            '<b>.env</b> file is writable' => is_writable(base_path('.env')),
            '<b>storage</b> folder is writable' => is_writable(base_path('storage')),
            '<b>bootstrap/cache</b> folder is writable' => is_writable(base_path('bootstrap/cache')),
        ];

        return view('installer::requirements', compact('requirements'));
    }
}
