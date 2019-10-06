<?php

namespace Ottaviano\Faker;

use Faker\Provider\Base;

class Gravatar extends Base
{
    private const MODES = [
        'blank',
        'identicon',
        'monsterid',
        'mp',
        'retro',
        'robohash',
        'wavatar',
    ];

    private const URL = 'https://www.gravatar.com/avatar/%s?d=%s&size=%d';

    public static function gravatarUrl(string $mode = null, string $email = null, int $size = 80): string
    {
        if (!$mode || !in_array($mode, static::MODES, true)) {
            $mode = 'retro';
        }

        $hash = $email ? md5(static::toLower($email)) : static::randomNumber(5, true);

        return sprintf(static::URL, $hash, $mode, $size);
    }

    public static function gravatar(string $dir = null, string $mode = null, string $email = null, int $size = 80, bool $fullPath = true): ?string
    {
        $dir = $dir ?? sys_get_temp_dir();

        if (!is_dir($dir) || !is_writable($dir)) {
            throw new \InvalidArgumentException(sprintf('Cannot write to directory "%s"', $dir));
        }

        $name = md5(uniqid($_SERVER['SERVER_ADDR'] ?? '', true));
        $filename = $name.'.jpg';
        $filepath = $dir.DIRECTORY_SEPARATOR.$filename;

        $url = static::gravatarUrl($mode, $email, $size);

        // save file
        if (function_exists('curl_exec')) {
            // use cURL
            $fp = fopen($filepath, 'w');
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            $success = curl_exec($ch) && 200 === curl_getinfo($ch, CURLINFO_HTTP_CODE);
            fclose($fp);
            curl_close($ch);

            if (!$success) {
                unlink($filepath);

                // could not contact the distant URL or HTTP error - fail silently.
                return null;
            }
        } elseif (ini_get('allow_url_fopen')) {
            copy($url, $filepath);
        } else {
            return new \RuntimeException('The image formatter downloads an image from a remote HTTP server. Therefore, it requires that PHP can request remote hosts, either via cURL or fopen()');
        }

        return $fullPath ? $filepath : $filename;
    }
}
