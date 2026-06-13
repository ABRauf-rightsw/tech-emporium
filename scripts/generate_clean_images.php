<?php

/**
 * Generates clean product SVGs — visual only, no model/price/tags text.
 */

$baseDirs = [
    __DIR__ . '/../public/assets/images',
    __DIR__ . '/../tech-emporium/assets/images',
];

function laptopSvg(string $accent, string $screenFill = '#0f172a'): string
{
    $accentEsc = htmlspecialchars($accent, ENT_QUOTES);

    return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300" width="400" height="300">
  <rect width="400" height="300" fill="#f8fafc" rx="8"/>
  <g transform="translate(72, 42)">
    <rect x="28" y="18" width="200" height="128" rx="9" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1.2"/>
    <rect x="36" y="26" width="184" height="112" rx="5" fill="{$screenFill}" stroke="#334155" stroke-width="0.5"/>
    <path d="M 58 118 Q 128 72 198 108" fill="none" stroke="{$accentEsc}" stroke-width="3" stroke-linecap="round" opacity="0.85"/>
    <circle cx="128" cy="82" r="14" fill="{$accentEsc}" opacity="0.3"/>
    <circle cx="128" cy="24" r="2" fill="#64748b"/>
    <path d="M 8 146 L 248 146 L 260 164 L -4 164 Z" fill="#cbd5e1" stroke="#94a3b8" stroke-width="1"/>
    <path d="M -4 164 L 260 164 L 256 170 L 0 170 Z" fill="#94a3b8"/>
    <rect x="108" y="165" width="44" height="3" rx="1.5" fill="{$accentEsc}" opacity="0.5"/>
    <ellipse cx="128" cy="182" rx="118" ry="9" fill="#000" opacity="0.07"/>
  </g>
</svg>
SVG;
}

function macbookSvg(): string
{
    return <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300" width="400" height="300">
  <rect width="400" height="300" fill="#f8fafc" rx="8"/>
  <g transform="translate(78, 48)">
    <path d="M 30 20 L 230 20 Q 238 20 238 28 L 238 130 Q 238 138 230 138 L 30 138 Q 22 138 22 130 L 22 28 Q 22 20 30 20 Z" fill="#d4d4d8" stroke="#a1a1aa" stroke-width="1"/>
    <rect x="30" y="28" width="200" height="102" rx="4" fill="#18181b"/>
    <path d="M 0 138 L 260 138 L 252 152 L 8 152 Z" fill="#e4e4e7" stroke="#a1a1aa" stroke-width="1"/>
    <rect x="108" y="152" width="44" height="4" rx="2" fill="#a1a1aa"/>
    <ellipse cx="130" cy="168" rx="115" ry="8" fill="#000" opacity="0.06"/>
  </g>
</svg>
SVG;
}

function accessorySvg(string $type): string
{
    $inner = match ($type) {
        'keyboard' => '<g transform="translate(80, 85)"><rect x="0" y="10" width="240" height="95" rx="10" fill="#cbd5e1" stroke="#94a3b8" stroke-width="1.2"/><rect x="10" y="20" width="220" height="75" rx="6" fill="#f1f5f9"/><g stroke="#0066ff" stroke-width="5" stroke-linecap="round" opacity="0.7"><path d="M20 38h200M20 55h180M20 72h160"/></g></g>',
        'mouse' => '<g transform="translate(145, 75)"><ellipse cx="55" cy="70" rx="48" ry="62" fill="#cbd5e1" stroke="#94a3b8" stroke-width="1.2"/><ellipse cx="55" cy="55" rx="28" ry="38" fill="#f1f5f9"/><line x1="55" y1="30" x2="55" y2="55" stroke="#0066ff" stroke-width="2" opacity="0.6"/></g>',
        'monitor' => '<g transform="translate(95, 55)"><rect x="20" y="15" width="170" height="105" rx="8" fill="#1e293b" stroke="#94a3b8" stroke-width="1.5"/><rect x="28" y="23" width="154" height="89" rx="4" fill="#0f172a"/><path d="M95 120 L95 145" stroke="#94a3b8" stroke-width="4"/><rect x="60" y="145" width="90" height="8" rx="4" fill="#cbd5e1"/></g>',
        'ssd' => '<g transform="translate(110, 100)"><rect x="0" y="20" width="180" height="50" rx="6" fill="#334155" stroke="#64748b" stroke-width="1.2"/><rect x="12" y="32" width="120" height="26" rx="3" fill="#1e293b"/><circle cx="155" cy="45" r="5" fill="#0066ff" opacity="0.8"/><rect x="168" y="38" width="8" height="14" rx="1" fill="#94a3b8"/></g>',
        'webcam' => '<g transform="translate(155, 80)"><rect x="25" y="55" width="50" height="35" rx="6" fill="#cbd5e1"/><circle cx="50" cy="50" r="32" fill="#334155" stroke="#64748b" stroke-width="2"/><circle cx="50" cy="50" r="18" fill="#0f172a"/><circle cx="50" cy="50" r="8" fill="#0066ff" opacity="0.5"/></g>',
        'headphones' => '<g transform="translate(120, 75)"><path d="M40 90 Q40 20 110 20 Q180 20 180 90" fill="none" stroke="#334155" stroke-width="10" stroke-linecap="round"/><rect x="22" y="85" width="36" height="55" rx="12" fill="#cbd5e1" stroke="#94a3b8"/><rect x="162" y="85" width="36" height="55" rx="12" fill="#cbd5e1" stroke="#94a3b8"/></g>',
        'bag' => '<g transform="translate(125, 70)"><rect x="20" y="35" width="110" height="95" rx="12" fill="#475569" stroke="#334155" stroke-width="1.2"/><path d="M50 35 Q75 5 100 35" fill="none" stroke="#64748b" stroke-width="5" stroke-linecap="round"/><rect x="45" y="55" width="60" height="40" rx="6" fill="#334155" opacity="0.5"/></g>',
        default => '',
    };

    return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300" width="400" height="300">
  <rect width="400" height="300" fill="#f8fafc" rx="8"/>
  {$inner}
</svg>
SVG;
}

function heroLaptopSvg(): string
{
    return <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" width="600" height="400">
  <rect width="600" height="400" fill="#f0f4f8" rx="12"/>
  <g transform="translate(120, 50)">
    <rect x="40" y="30" width="280" height="175" rx="12" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1.5"/>
    <rect x="52" y="42" width="256" height="151" rx="6" fill="#0f172a"/>
    <path d="M 80 165 Q 180 95 280 150" fill="none" stroke="#0066ff" stroke-width="4" stroke-linecap="round" opacity="0.8"/>
    <circle cx="180" cy="115" r="22" fill="#ff9900" opacity="0.35"/>
    <path d="M 10 205 L 350 205 L 368 232 L -8 232 Z" fill="#cbd5e1" stroke="#94a3b8" stroke-width="1"/>
    <path d="M -8 232 L 368 232 L 362 240 L -2 240 Z" fill="#94a3b8"/>
    <ellipse cx="180" cy="255" rx="165" ry="12" fill="#000" opacity="0.08"/>
  </g>
</svg>
SVG;
}

$laptops = [
    'gaming-laptop.svg' => ['#ff3366', '#0f172a'],
    'business-laptop.svg' => ['#0066ff', '#0f172a'],
    'student-laptop.svg' => ['#10b981', '#0f172a'],
    'dell-xps.svg' => ['#0076ce', '#0f172a'],
    'hp-spectre.svg' => ['#0096d6', '#0f172a'],
    'lenovo-thinkpad.svg' => ['#e2231a', '#0f172a'],
    'asus-rog.svg' => ['#ff0050', '#0f172a'],
    'acer-predator.svg' => ['#83b81a', '#0f172a'],
    'msi-stealth.svg' => ['#ff0000', '#0f172a'],
    'apple-macbook.svg' => null,
];

$accessories = ['keyboard', 'mouse', 'monitor', 'ssd', 'webcam', 'headphones', 'bag'];

foreach ($baseDirs as $base) {
    $laptopDir = $base . '/laptops';
    $accDir = $base . '/accessories';
    $bannerDir = $base . '/banners';

    if (! is_dir($laptopDir)) {
        mkdir($laptopDir, 0755, true);
    }
    if (! is_dir($accDir)) {
        mkdir($accDir, 0755, true);
    }

    // Remove old laptop & accessory SVGs
    foreach (glob($laptopDir . '/*.svg') ?: [] as $f) {
        unlink($f);
    }
    foreach (glob($accDir . '/*.svg') ?: [] as $f) {
        unlink($f);
    }

    foreach ($laptops as $file => $colors) {
        $content = $file === 'apple-macbook.svg'
            ? macbookSvg()
            : laptopSvg($colors[0], $colors[1]);
        file_put_contents($laptopDir . '/' . $file, $content);
    }

    foreach ($accessories as $type) {
        file_put_contents($accDir . '/' . $type . '.svg', accessorySvg($type));
    }

    file_put_contents($bannerDir . '/hero.svg', heroLaptopSvg());

    // Brand logos — icon only, no text
    $brandDir = $base . '/brands';
    if (is_dir($brandDir)) {
        foreach (glob($brandDir . '/*.svg') ?: [] as $f) {
            unlink($f);
        }
        $brands = [
            'dell' => '#0076ce',
            'hp' => '#0096d6',
            'lenovo' => '#e2231a',
            'asus' => '#00539b',
            'acer' => '#83b81a',
            'msi' => '#ff0000',
            'apple' => '#555555',
        ];
        foreach ($brands as $slug => $color) {
            $c = htmlspecialchars($color, ENT_QUOTES);
            $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100" width="200" height="100">
  <rect width="200" height="100" fill="#f8fafc" rx="8"/>
  <circle cx="100" cy="50" r="28" fill="{$c}" opacity="0.15"/>
  <rect x="78" y="38" width="44" height="24" rx="4" fill="{$c}" opacity="0.85"/>
</svg>
SVG;
            file_put_contents($brandDir . '/' . $slug . '.svg', $svg);
        }
    }
}

echo "Clean images generated in public/assets and tech-emporium/assets.\n";
