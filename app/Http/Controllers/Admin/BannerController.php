<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct(private ImageUploadService $images)
    {
    }

    public function index()
    {
        return view('admin.banners.index', [
            'heroBackground' => $this->currentHeroPath(),
        ]);
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_background' => 'required|image|max:8192',
        ]);

        $oldPath = SiteSetting::get(SiteSetting::HERO_BACKGROUND_KEY);
        if ($oldPath && $oldPath !== SiteSetting::DEFAULT_HERO_BACKGROUND) {
            $this->images->deleteByPath($oldPath);
        }

        $stored = $this->images->compressAndStore(
            $request->file('hero_background'),
            'banners'
        );

        SiteSetting::set(SiteSetting::HERO_BACKGROUND_KEY, $stored->path);

        return back()->with('success', 'Hero background updated.');
    }

    public function removeHero()
    {
        $oldPath = SiteSetting::get(SiteSetting::HERO_BACKGROUND_KEY);

        if ($oldPath && $oldPath !== SiteSetting::DEFAULT_HERO_BACKGROUND) {
            $this->images->deleteByPath($oldPath);
        }

        SiteSetting::set(SiteSetting::HERO_BACKGROUND_KEY, null);

        return back()->with('success', 'Hero background reset to default.');
    }

    private function currentHeroPath(): string
    {
        return SiteSetting::get(SiteSetting::HERO_BACKGROUND_KEY, SiteSetting::DEFAULT_HERO_BACKGROUND);
    }
}
