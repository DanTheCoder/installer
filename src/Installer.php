<?php

namespace DanTheCoder\Installer;

class Installer
{
    // Set or update env variable.
    public static function setEnvVariable(string $key, string $value): void
    {
        $envFileContent = file_get_contents(base_path('.env'));

        $oldPair = self::readEnvKeyValue($envFileContent, $key);

        // Wrap values that have a space or equals in quotes to escape them
        if (preg_match('/\s/', $value) || strpos($value, '=') !== false) {
            $value = '"'.$value.'"';
        }

        $newPair = $key.'='.$value;

        // For existed key.
        if ($oldPair !== null) {
            $replaced = preg_replace('/^'.preg_quote($oldPair, '/').'$/uimU', $newPair, $envFileContent);

            file_put_contents(base_path('.env'), $replaced, LOCK_SH);
        } else {
            // For a new key.
            file_put_contents(base_path('.env'), [$envFileContent."\n".$newPair."\n"], LOCK_SH);
        }
    }

    /**
     * Read the "key=value" string of a given key from an environment file.
     * This function returns original "key=value" string and doesn't modify it.
     *
     * @return string|null Key=value string or null if the key is not exists.
     */
    public static function readEnvKeyValue(string $envFileContent, string $key): ?string
    {
        // Match the given key at the beginning of a line
        if (preg_match("#^ *{$key} *= *[^\r\n]*$#uimU", $envFileContent, $matches)) {
            return $matches[0];
        }

        return null;
    }
}
