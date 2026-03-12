<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Halaman;
use App\Models\Kdk;
use App\Models\KategoriBerita;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Dynamic robots.txt
     */
    public function robots(): Response
    {
        $sitemapUrl = url('/sitemap.xml');

        $content = implode("\n", [
            'User-agent: *',
            'Disallow: /admin/',
            'Disallow: /penulis/',
            'Disallow: /login',
            'Disallow: /logout',
            'Disallow: /storage/donasi/',
            '',
            'User-agent: Googlebot',
            'Allow: /',
            '',
            'User-agent: Bingbot',
            'Allow: /',
            '',
            "Sitemap: {$sitemapUrl}",
        ]);

        return response($content, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Dynamic XML Sitemap
     */
    public function sitemap(): Response
    {
        $urls = collect();

        // --- Static pages ---
        $staticPages = [
            ['loc' => route('beranda'),     'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => route('berita'),      'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => route('kdk'),         'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('galeri'),      'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => route('donasi'),      'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => route('program'),     'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => route('kontak'),      'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('sejarah'),     'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('profil'),      'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('mitra'),       'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => route('bidang-kerja'),'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => route('tokoh'),       'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => route('peta-situs'),  'priority' => '0.4', 'changefreq' => 'weekly'],
        ];

        foreach ($staticPages as $page) {
            $urls->push($page);
        }

        // --- Berita (published articles) ---
        Berita::where('status', 'terbit')
            ->orderByDesc('tanggal_terbit')
            ->select('slug', 'updated_at')
            ->chunk(200, function ($items) use ($urls) {
                foreach ($items as $item) {
                    $urls->push([
                        'loc'        => route('berita.detail', $item->slug),
                        'lastmod'    => $item->updated_at?->toW3cString(),
                        'priority'   => '0.8',
                        'changefreq' => 'weekly',
                    ]);
                }
            });

        // --- Kategori Berita ---
        KategoriBerita::whereNotNull('slug')
            ->select('slug', 'updated_at')
            ->get()
            ->each(function ($kat) use ($urls) {
                $urls->push([
                    'loc'        => route('berita.kategori', $kat->slug),
                    'lastmod'    => $kat->updated_at?->toW3cString(),
                    'priority'   => '0.6',
                    'changefreq' => 'weekly',
                ]);
            });

        // --- Galeri albums ---
        Galeri::select('slug', 'updated_at')
            ->get()
            ->each(function ($galeri) use ($urls) {
                $urls->push([
                    'loc'        => route('galeri.detail', $galeri->slug),
                    'lastmod'    => $galeri->updated_at?->toW3cString(),
                    'priority'   => '0.6',
                    'changefreq' => 'monthly',
                ]);
            });

        // --- Halaman (active CMS pages) ---
        Halaman::where('is_active', true)
            ->select('slug', 'updated_at')
            ->get()
            ->each(function ($halaman) use ($urls) {
                // Skip slugs that already have dedicated routes
                if (in_array($halaman->slug, ['sejarah', 'profil', 'mitra', 'bidang-kerja'])) {
                    return;
                }
                $urls->push([
                    'loc'        => route('halaman.show', $halaman->slug),
                    'lastmod'    => $halaman->updated_at?->toW3cString(),
                    'priority'   => '0.5',
                    'changefreq' => 'monthly',
                ]);
            });

        // --- Build XML ---
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            if (!empty($url['lastmod'])) {
                $xml .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
            }
            $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
