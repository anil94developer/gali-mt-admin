<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mime\MimeTypeGuesserInterface;
use Symfony\Component\Mime\MimeTypes;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerFallbackSymfonyMimeGuesser();
    }

    /**
     * When php_fileinfo is disabled and the Unix "file" binary is unavailable (e.g. Windows),
     * Symfony MimeTypes has no guessers and throws on any MIME lookup (e.g. uploaded files).
     * This guesser runs first and uses extension + application/octet-stream fallback.
     */
    private function registerFallbackSymfonyMimeGuesser(): void
    {
        if (!class_exists(MimeTypes::class)) {
            return;
        }

        MimeTypes::getDefault()->registerGuesser(new class implements MimeTypeGuesserInterface {
            public function isGuesserSupported(): bool
            {
                return true;
            }

            public function guessMimeType(string $path): ?string
            {
                if (!is_file($path) || !is_readable($path)) {
                    return null;
                }

                $ext = strtolower((string) pathinfo($path, PATHINFO_EXTENSION));
                $map = [
                    'jpg' => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                    'webp' => 'image/webp',
                    'svg' => 'image/svg+xml',
                    'pdf' => 'application/pdf',
                    'json' => 'application/json',
                    'txt' => 'text/plain',
                    'csv' => 'text/csv',
                ];

                return $map[$ext] ?? 'application/octet-stream';
            }
        });
    }
}
