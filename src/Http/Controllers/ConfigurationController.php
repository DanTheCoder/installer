<?php

namespace DanTheCoder\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use DanTheCoder\Installer\Installer;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        return view('installer::configuration');
    }

    public function store(Request $request)
    {
        // Verify that we can connect to the database
        try {
            mysqli_connect($request->db_host, $request->db_username, $request->db_password, $request->db_name);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        // Update the .env file
        Installer::setEnvVariable('APP_ENV', 'production');
        Installer::setEnvVariable('APP_DEBUG', 'false');
        Installer::setEnvVariable('APP_NAME', $request->app_name ?? '');
        Installer::setEnvVariable('APP_URL', $request->app_url ?? url('/'));

        // Database
        Installer::setEnvVariable('DB_HOST', $request->db_host);
        Installer::setEnvVariable('DB_PORT', $request->db_port);
        Installer::setEnvVariable('DB_DATABASE', $request->db_name);
        Installer::setEnvVariable('DB_USERNAME', $request->db_username);
        Installer::setEnvVariable('DB_PASSWORD', $request->db_password ?? '');

        // Other env variables
        foreach (config('installer.other_env_variables') as $field) {
            Installer::setEnvVariable($field['name'], $request->{$field['name']} ?? '');
        }

        // Mail
        if (config('installer.services.mail')) {
            Installer::setEnvVariable('MAIL_MAILER', $request->mail_mailer);
            Installer::setEnvVariable('MAIL_FROM_ADDRESS', $request->mail_from_email ?? '');
            Installer::setEnvVariable('MAIL_HOST', $request->mail_host ?? '');
            Installer::setEnvVariable('MAIL_USERNAME', $request->mail_username ?? '');
            Installer::setEnvVariable('MAIL_PASSWORD', $request->mail_password ?? '');
            Installer::setEnvVariable('MAIL_PORT', $request->mail_port ?? '');
            Installer::setEnvVariable('MAIL_ENCRYPTION', $request->mail_encryption ?? '');
        }

        // Pusher
        if (config('installer.services.pusher')) {
            Installer::setEnvVariable('BROADCAST_DRIVER', 'pusher');
            Installer::setEnvVariable('PUSHER_APP_ID', $request->pusher_app_id ?? '');
            Installer::setEnvVariable('PUSHER_APP_KEY', $request->pusher_app_key ?? '');
            Installer::setEnvVariable('PUSHER_APP_SECRET', $request->pusher_app_secret ?? '');
            Installer::setEnvVariable('PUSHER_APP_CLUSTER', $request->pusher_cluster ?? '');
        }

        // Queue
        if (config('installer.services.queue')) {
            Installer::setEnvVariable('QUEUE_CONNECTION', $request->queue_connection);
            Installer::setEnvVariable('REDIS_PASSWORD', $request->redis_password ?? '');
            Installer::setEnvVariable('REDIS_HOST', $request->redis_host ?? '');
            Installer::setEnvVariable('REDIS_PORT', $request->redis_port ?? '');
        }

        // Filesystem
        if (config('installer.services.filesystem')) {
            Installer::setEnvVariable('FILESYSTEM_DISK', $request->filesystem_disk);
            Installer::setEnvVariable('AWS_ACCESS_KEY_ID', $request->aws_key ?? '');
            Installer::setEnvVariable('AWS_SECRET_ACCESS_KEY', $request->aws_secret ?? '');
            Installer::setEnvVariable('AWS_DEFAULT_REGION', $request->aws_region ?? '');
            Installer::setEnvVariable('AWS_BUCKET', $request->aws_bucket ?? '');
            Installer::setEnvVariable('ASSET_URL', $request->asset_url ?? '');
        }

        // Open AI
        if (config('installer.services.openai')) {
            Installer::setEnvVariable('OPENAI_API_KEY', $request->openai_key ?? '');
            Installer::setEnvVariable('OPENAI_ORGANIZATION', $request->openai_organization ?? '');
        }

        return redirect(route('installer::run-commands'));
    }
}
