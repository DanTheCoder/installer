@extends('installer::layout')

@section('header')
    <h2 class="text-3xl font-semibold tracking-tight text-gray-950">Configuration</h2>
    <p class="mt-2 text-base text-gray-600">Set your application environment variables</p>
@endsection

@section('content')
    <form class="space-y-8 divide-y" action="{{ route('installer::configuration.store') }}" method="POST">

        <div>
            @csrf

            <div>
                <label for="app_name" class="mb-1 block text-sm font-medium text-gray-800">App name</label>
                <input id="app_name" name="app_name" type="text" value="{{ old('app_name') ?? config('app.name') }}" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
            </div>

            <div class="mt-4">
                <label for="app_url" class="mb-1 block text-sm font-medium text-gray-800">App URL</label>
                <input id="app_url" name="app_url" type="text" value="{{ old('app_url') ?? url('/') }}" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
            </div>

            @foreach (config('installer.other_env_variables') as $field)
                <div class="mt-4">
                    <label for="{{ $field['name'] }}" class="mb-1 block text-sm font-medium text-gray-800">{{ $field['label'] }}</label>
                    <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="text" value="{{ old($field['name']) ?? $field['value'] }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                </div>
            @endforeach
        </div>

        {{-- Database --}}
        <div class="pt-6">

            <h3 class="text-lg font-medium">Database</h3>

            <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-12">
                <div class="col-span-2 sm:col-span-5">
                    <label for="db_connection" class="mb-1 block text-sm font-medium text-gray-800">Connection</label>
                    <input id="db_connection" name="db_connection" type="text" value="{{ old('db_connection') ?? config('database.default') }}" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                </div>

                <div class="col-span-2 sm:col-span-7">
                    <label for="db_name" class="mb-1 block text-sm font-medium text-gray-800">Databse name</label>
                    <input id="db_name" name="db_name" type="text" required value="{{ old('db_name') ?? config('database.connections.mysql.database') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                </div>

                <div class="col-span-2 sm:col-span-6">
                    <label for="db_username" class="mb-1 block text-sm font-medium text-gray-800">Username</label>
                    <input id="db_username" name="db_username" type="text" required value="{{ old('db_username') ?? config('database.connections.mysql.username') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                </div>

                <div class="col-span-2 sm:col-span-6">
                    <label for="db_password" class="mb-1 block text-sm font-medium text-gray-800">Password</label>
                    <input id="db_password" name="db_password" type="text" value="{{ old('db_password') ?? config('database.connections.mysql.password') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                </div>

                <div class="col-span-1 sm:col-span-4">
                    <label for="db_host" class="mb-1 block text-sm font-medium text-gray-800">Host</label>
                    <input id="db_host" name="db_host" type="text" value="{{ old('db_host') ?? config('database.connections.mysql.host') }}" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                </div>

                <div class="col-span-1 sm:col-span-3">
                    <label for="db_port" class="mb-1 block text-sm font-medium text-gray-800">Port</label>
                    <input id="db_port" name="db_port" type="text" value="{{ old('db_port') ?? config('database.connections.mysql.port') }}" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                </div>
            </div>
        </div>

        {{-- Mail --}}
        @if (config('installer.services.mail'))
            <div class="pt-6">

                <h3 class="text-lg font-medium">Mail</h3>

                <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-12">

                    <div class="col-span-2 sm:col-span-5">
                        <label for="mail_mailer" class="mb-1 block text-sm font-medium text-gray-800">Mailer</label>
                        <select id="mail_mailer" name="mail_mailer" value="{{ old('mail_mailer') ?? config('mail.default') }}" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                            <option value="sendmail">PHP SendMail</option>
                            <option value="smtp">SMTP Server</option>
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-7">
                        <label for="mail_from_email" class="mb-1 block text-sm font-medium text-gray-800">From email</label>
                        <input type="text" id="mail_from_email" name="mail_from_email" value="{{ old('mail_from_email') ?? config('mail.from.address') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                    </div>

                    {{-- SMPT driver --}}
                    <div id="mail_smtp_wrapper" class="col-span-2 grid grid-cols-2 gap-4 sm:col-span-12 sm:grid-cols-12" style="display: none;">
                        <div class="col-span-2 sm:col-span-5">
                            <label for="mail_host" class="mb-1 block text-sm font-medium text-gray-800">Host address</label>
                            <input type="mail_host" id="mail_host" name="mail_host" value="{{ old('mail_host') ?? config('mail.mailers.smtp.host') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="col-span-1 sm:col-span-3">
                            <label for="mail_port" class="mb-1 block text-sm font-medium text-gray-800">Port</label>
                            <input type="text" id="mail_port" name="mail_port" value="{{ old('mail_port') ?? config('mail.mailers.smtp.port') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="col-span-1 sm:col-span-3">
                            <label for="mail_encryption" class="mb-1 block text-sm font-medium text-gray-800">Encryption</label>
                            <select id="mail_encryption" name="mail_encryption" value="{{ old('mail_encryption') ?? config('mail.mailers.smtp.encryption') }}" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                                <option value="tls">TLS</option>
                                <option value="ssl">SSL</option>
                            </select>
                        </div>

                        <div class="col-span-2 sm:col-span-6">
                            <label for="mail_username" class="mb-1 block text-sm font-medium text-gray-800">Username</label>
                            <input type="text" id="mail_username" name="mail_username" value="{{ old('mail_username') ?? config('mail.mailers.smtp.username') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="col-span-2 sm:col-span-6">
                            <label for="mail_password" class="mb-1 block text-sm font-medium text-gray-800">Password</label>
                            <input type="text" id="mail_password" name="mail_password" value="{{ old('mail_password') ?? config('mail.mailers.smtp.password') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>
                    </div>

                </div>

            </div>
        @endif

        {{-- Open AI --}}
        @if (config('installer.services.openai'))
            <div class="pt-6">
                <h3 class="text-lg font-medium">Open AI</h3>

                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="openai_key" class="mb-1 block text-sm font-medium text-gray-800">API Key</label>
                        <input type="text" id="openai_key" name="openai_key" value="{{ old('openai_key') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="openai_organization" class="mb-1 block text-sm font-medium text-gray-800">Organization</label>
                        <input type="text" id="openai_organization" name="openai_organization" value="{{ old('openai_organization') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                    </div>

                </div>
            </div>
        @endif

        {{-- Pusher --}}
        @if (config('installer.services.pusher'))
            <div class="pt-6">

                <h3 class="text-lg font-medium">Pusher (broadcasting)</h3>

                <div class="mt-4 grid gap-4 sm:grid-cols-12">

                    <div class="sm:col-span-8">
                        <label for="pusher_app_id" class="mb-1 block text-sm font-medium text-gray-800">App ID</label>
                        <input id="pusher_app_id" name="pusher_app_id" type="text" value="{{ old('pusher_app_id') ?? config('broadcasting.connections.pusher.app_id') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                    </div>

                    <div class="sm:col-span-4">
                        <label for="pusher_cluster" class="mb-1 block text-sm font-medium text-gray-800">Cluster</label>
                        <input id="pusher_cluster" name="pusher_cluster" type="text" value="{{ old('pusher_cluster') ?? config('broadcasting.connections.pusher.options.cluster') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                    </div>

                    <div class="sm:col-span-6">
                        <label for="pusher_app_key" class="mb-1 block text-sm font-medium text-gray-800">Key</label>
                        <input id="pusher_app_key" name="pusher_app_key" type="text" value="{{ old('pusher_app_key') ?? config('broadcasting.connections.pusher.key') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                    </div>

                    <div class="sm:col-span-6">
                        <label for="pusher_app_secret" class="mb-1 block text-sm font-medium text-gray-800">Secret</label>
                        <input id="pusher_app_secret" name="pusher_app_secret" type="text" value="{{ old('pusher_app_secret') ?? config('broadcasting.connections.pusher.secret') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                    </div>
                </div>
            </div>
        @endif

        {{-- Queue --}}
        @if (config('installer.services.queue'))
            <div class="pt-6">

                <h3 class="text-lg font-medium">Queue</h3>

                <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-12">
                    <div class="col-span-2 sm:col-span-7">
                        <label for="queue_connection" class="mb-1 block text-sm font-medium text-gray-800">Driver</label>
                        <select id="queue_connection" name="queue_connection" value="{{ old('queue_connection') ?? config('queue.default.pusher.app_id') }}" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                            <option value="sync">Sync</option>
                            <option value="database">Database</option>
                            <option value="redis">Redis</option>
                        </select>
                    </div>

                    <div id="queue_redis_wrapper" class="col-span-2 grid grid-cols-2 gap-4 sm:col-span-12 sm:grid-cols-12" style="display: none;">
                        <div class="col-span-2 sm:col-span-6">
                            <label for="redis_password" class="mb-1 block text-sm font-medium text-gray-800">Redis password</label>
                            <input type="text" id="redis_password" name="redis_password" value="{{ old('redis_password') ?? config('database.redis.default.password') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="col-span-1 sm:col-span-3">
                            <label for="redis_host" class="mb-1 block text-sm font-medium text-gray-800">Redis host</label>
                            <input type="text" id="redis_host" name="redis_host" value="{{ old('redis_host') ?? config('database.redis.default.host') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="col-span-1 sm:col-span-3">
                            <label for="redis_port" class="mb-1 block text-sm font-medium text-gray-800">Redis port</label>
                            <input type="text" id="redis_port" name="redis_port" value="{{ old('redis_port') ?? config('database.redis.default.port') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>
                    </div>
                </div>

            </div>
        @endif

        {{-- Stoage --}}
        @if (config('installer.services.filesystem'))
            <div class="pt-6">

                <h3 class="text-lg font-medium">File storage</h3>

                <div class="mt-4 grid gap-4 sm:grid-cols-12">

                    <div class="sm:col-span-7">
                        <label for="filesystem_disk" class="mb-1 block text-sm font-medium text-gray-800">Driver</label>
                        <select id="filesystem_disk" name="filesystem_disk" value="{{ old('filesystem_disk') ?? config('filesystems.default') }}" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                            <option value="local">Local</option>
                            <option value="s3">Amazon S3</option>
                        </select>
                    </div>

                    <div id="s3_wrapper" class="grid gap-4 sm:col-span-12 sm:grid-cols-12" style="display: none;">
                        <div class="sm:col-span-6">
                            <label for="aws_key" class="mb-1 block text-sm font-medium text-gray-800">AWS access key ID</label>
                            <input type="text" id="aws_key" name="aws_key" value="{{ old('aws_key') ?? config('filesystems.disks.s3.key') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="sm:col-span-6">
                            <label for="aws_secret" class="mb-1 block text-sm font-medium text-gray-800">AWS secret access key</label>
                            <input type="text" id="aws_secret" name="aws_secret" value="{{ old('aws_secret') ?? config('filesystems.disks.s3.secret') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="sm:col-span-6">
                            <label for="aws_region" class="mb-1 block text-sm font-medium text-gray-800">AWS region</label>
                            <input type="text" id="aws_region" name="aws_region" value="{{ old('aws_region') ?? config('filesystems.disks.s3.region') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="sm:col-span-6">
                            <label for="aws_bucket" class="mb-1 block text-sm font-medium text-gray-800">AWS bucket</label>
                            <input type="text" id="aws_bucket" name="aws_bucket" value="{{ old('aws_bucket') ?? config('filesystems.disks.s3.bucket') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>

                        <div class="sm:col-span-12">
                            <label for="asset_url" class="mb-1 block text-sm font-medium text-gray-800">Asset URL</label>
                            <input type="text" id="asset_url" name="asset_url" value="{{ old('asset_url') ?? config('app.asset_url') }}" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:border-blue-500 focus:outline-none focus:ring-blue-500">
                        </div>
                    </div>
                </div>

            </div>
        @endif

        <div>
            <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-gray-900 px-4 py-3 text-sm font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2">Next Step</button>
        </div>
    </form>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {

        @if (config('installer.services.mail'))
            // Conditional input for mailer
            let inputMailMailer = document.getElementById('mail_mailer');

            inputMailMailer.addEventListener('change', function() {
                let wrapper = document.getElementById('mail_smtp_wrapper');
                wrapper.style.display = this.value == 'smtp' ? 'grid' : 'none';
            });
        @endif

        @if (config('installer.services.queue'))
            // Conditional input for queue
            let inputQueueConnection = document.getElementById('queue_connection');

            inputQueueConnection.addEventListener('change', function() {
                let wrapper = document.getElementById('queue_redis_wrapper');
                wrapper.style.display = this.value == 'redis' ? 'grid' : 'none';
            });
        @endif

        @if (config('installer.services.filesystem'))
            // Conditional input for filesystem
            let inputFilesystemDisk = document.getElementById('filesystem_disk');

            inputFilesystemDisk.addEventListener('change', function() {
                let wrapper = document.getElementById('s3_wrapper');
                wrapper.style.display = this.value == 's3' ? 'grid' : 'none';
            });
        @endif
    });
</script>
