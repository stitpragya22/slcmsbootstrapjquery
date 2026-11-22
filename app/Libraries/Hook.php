<?php

namespace App\Libraries;

/**
 * Event & Filter Hook System for SLCMS
 * Allows core and third-party plugins to hook into lifecycle actions and filters.
 */
class Hook
{
    private static array $actions = [];
    private static array $filters = [];

    /**
     * Register an Action Hook
     */
    public static function addAction(string $tag, callable $callback, int $priority = 10, int $acceptedArgs = 1): void
    {
        self::$actions[$tag][$priority][] = [
            'callback'     => $callback,
            'acceptedArgs' => $acceptedArgs,
        ];
    }

    /**
     * Trigger an Action Hook
     */
    public static function doAction(string $tag, ...$args): void
    {
        if (!isset(self::$actions[$tag])) {
            return;
        }

        ksort(self::$actions[$tag]);

        foreach (self::$actions[$tag] as $priority => $callbacks) {
            foreach ($callbacks as $item) {
                $params = array_slice($args, 0, $item['acceptedArgs']);
                call_user_func_array($item['callback'], $params);
            }
        }
    }

    /**
     * Register a Filter Hook
     */
    public static function addFilter(string $tag, callable $callback, int $priority = 10, int $acceptedArgs = 1): void
    {
        self::$filters[$tag][$priority][] = [
            'callback'     => $callback,
            'acceptedArgs' => $acceptedArgs,
        ];
    }

    /**
     * Apply a Filter Hook to modify a value
     */
    public static function applyFilter(string $tag, $value, ...$args)
    {
        if (!isset(self::$filters[$tag])) {
            return $value;
        }

        ksort(self::$filters[$tag]);

        foreach (self::$filters[$tag] as $priority => $callbacks) {
            foreach ($callbacks as $item) {
                $passArgs = array_merge([$value], array_slice($args, 0, $item['acceptedArgs'] - 1));
                $value = call_user_func_array($item['callback'], $passArgs);
            }
        }

        return $value;
    }

    public static function hasAction(string $tag): bool
    {
        return !empty(self::$actions[$tag]);
    }

    public static function hasFilter(string $tag): bool
    {
        return !empty(self::$filters[$tag]);
    }
}
