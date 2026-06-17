<?php

if (! function_exists('format_pkr')) {
    function format_pkr(int $amount): string
    {
        return 'Rs. ' . number_format($amount);
    }
}

if (! function_exists('clean_rich_text')) {
    function clean_rich_text(?string $html): ?string
    {
        if ($html === null || trim($html) === '') {
            return null;
        }

        $allowed = '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><a><blockquote><span><div><hr>';
        $cleaned = trim(strip_tags($html, $allowed));

        return $cleaned === '' ? null : $cleaned;
    }
}

if (! function_exists('placeholder_image_path')) {
    function placeholder_image_path(string $type = 'product'): string
    {
        return match ($type) {
            'category' => 'assets/images/placeholders/no-category.svg',
            'brand' => 'assets/images/placeholders/no-brand.svg',
            default => 'assets/images/placeholders/no-image.svg',
        };
    }
}

if (! function_exists('image_path_or_placeholder')) {
    function image_path_or_placeholder(?string $path, string $type = 'product'): string
    {
        if ($path && trim($path) !== '') {
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            $publicPath = public_path(str_replace('/', DIRECTORY_SEPARATOR, ltrim($path, '/')));

            if (is_file($publicPath)) {
                return $path;
            }
        }

        return placeholder_image_path($type);
    }
}

if (! function_exists('image_url')) {
    function image_url(?string $path, string $type = 'product'): string
    {
        $resolved = image_path_or_placeholder($path, $type);

        if (str_starts_with($resolved, 'http://') || str_starts_with($resolved, 'https://')) {
            return $resolved;
        }

        return asset($resolved);
    }
}

if (! function_exists('shipping_cost')) {
    function shipping_cost(int $subtotal): int
    {
        return $subtotal > 10000 ? 0 : 250;
    }
}

if (! function_exists('hero_background')) {
    function hero_background(): string
    {
        return \App\Models\SiteSetting::get(
            \App\Models\SiteSetting::HERO_BACKGROUND_KEY,
            \App\Models\SiteSetting::DEFAULT_HERO_BACKGROUND
        );
    }
}

if (! function_exists('seo_absolute_url')) {
    function seo_absolute_url(?string $path = null): string
    {
        if (! $path) {
            return url()->current();
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return rtrim(config('app.url'), '/') . '/' . ltrim($path, '/');
    }
}

if (! function_exists('seo_canonical_url')) {
    function seo_canonical_url(): string
    {
        $query = request()->except('page');

        if (empty($query)) {
            return url()->current();
        }

        return url()->current() . '?' . http_build_query($query);
    }
}

if (! function_exists('seo_robots')) {
    function seo_robots(): string
    {
        if ($custom = trim((string) view()->yieldContent('robots'))) {
            return $custom;
        }

        $routeName = request()->route()?->getName() ?? '';

        foreach (config('seo.noindex_routes', []) as $pattern) {
            if (str_ends_with($pattern, '.*') && str_starts_with($routeName, rtrim($pattern, '.*'))) {
                return 'noindex, nofollow';
            }
            if ($routeName === $pattern) {
                return 'noindex, nofollow';
            }
        }

        return 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    }
}

if (! function_exists('seo_title')) {
    function seo_title(): string
    {
        $pageTitle = trim((string) view()->yieldContent('seo_title'));
        if ($pageTitle !== '') {
            return $pageTitle;
        }

        $legacyTitle = trim((string) view()->yieldContent('title'));
        if ($legacyTitle !== '') {
            return $legacyTitle;
        }

        return config('seo.default_title');
    }
}

if (! function_exists('seo_description')) {
    function seo_description(): string
    {
        $description = trim((string) view()->yieldContent('meta_description'));

        return $description !== '' ? $description : config('seo.default_description');
    }
}

if (! function_exists('seo_keywords')) {
    function seo_keywords(): string
    {
        $keywords = trim((string) view()->yieldContent('meta_keywords'));

        return $keywords !== '' ? $keywords : config('seo.default_keywords');
    }
}

if (! function_exists('seo_og_image')) {
    function seo_og_image(): string
    {
        $image = trim((string) view()->yieldContent('og_image'));

        return seo_absolute_url($image !== '' ? $image : config('seo.og_image'));
    }
}

if (! function_exists('seo_og_type')) {
    function seo_og_type(): string
    {
        $type = trim((string) view()->yieldContent('og_type'));

        return $type !== '' ? $type : 'website';
    }
}
