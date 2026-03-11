#!/usr/bin/env python3
"""Generate all sub-pages for YPMD IRJA multi-page site."""
import os

BASE = os.path.dirname(os.path.abspath(__file__))

# ── Shared HTML fragments ──────────────────────────────────────────────

HEAD_COMMON = '''<meta charset="UTF-8"/><meta name="viewport" content="width=device-width, initial-scale=1.0"/><meta name="robots" content="noindex, nofollow"/>
  <link rel="icon" href="./img/logo-ypmd-irja.png"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <script>tailwind.config={theme:{extend:{colors:{primary:{50:'#f0f7f2',100:'#d9ede0',200:'#b4dbc3',300:'#82c19e',400:'#4fa174',500:'#2d8057',600:'#1f6642',700:'#1a5236',800:'#163f2b',900:'#0f2b1d'},accent:{50:'#fdf8ee',100:'#f9eccc',200:'#f2d68d',300:'#e8bc4f',400:'#c9972a',500:'#a67820'},neutral:{50:'#fafafa',100:'#f4f4f4',200:'#e8e8e8',300:'#d0d0d0',400:'#a0a0a0',500:'#707070',600:'#505050',700:'#383838',800:'#242424',900:'#141414'}},fontFamily:{display:['Lora','Georgia','serif'],body:['"Plus Jakarta Sans"','sans-serif']},boxShadow:{'card':'0 2px 12px rgba(0,0,0,0.08)','card-hover':'0 6px 24px rgba(0,0,0,0.12)'}}}}</script>
  <style>
    html{scroll-behavior:smooth;font-size:15px}body{font-family:'Plus Jakarta Sans',sans-serif;font-size:15px}h1,h2,h3,.font-display{font-family:'Lora',Georgia,serif}
    .nav-link{position:relative}.nav-link::after{content:'';position:absolute;bottom:-4px;left:0;width:0;height:2px;background:#2d8057;transition:width .25s ease}.nav-link:hover::after,.nav-link.active::after{width:100%}
    .fade-in{opacity:0;transform:translateY(20px);transition:opacity .5s ease,transform .5s ease}.fade-in.visible{opacity:1;transform:translateY(0)}
    .card-hover{transition:box-shadow .2s ease,transform .2s ease}.card-hover:hover{box-shadow:0 6px 24px rgba(0,0,0,0.12);transform:translateY(-2px)}
  </style>'''

TOPBAR = '''
  <div x-show="topbarVisible" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="bg-amber-400 text-amber-900 overflow-hidden" style="display:none;">
    <div class="max-w-6xl mx-auto px-4 py-2.5 flex items-center justify-between gap-4">
      <p class="text-xs font-medium leading-snug"><i class="fa-solid fa-triangle-exclamation mr-2"></i><strong>Draft Desain Penawaran</strong> — Prototipe hasil analisa tim pengembang. <a href="https://nokensoft.com" target="_blank" class="underline font-bold hover:text-amber-950 ml-1">Powered by Nokensoft.com</a></p>
      <button @click="topbarVisible=false" class="flex-shrink-0 w-6 h-6 flex items-center justify-center text-amber-800 hover:text-amber-950"><i class="fa-solid fa-xmark text-sm"></i></button>
    </div>
  </div>'''

def nav_html(active_main='', active_sub=''):
    """Generate nav with correct active states."""
    def mc(item, is_active):
        if is_active:
            return 'nav-link active text-sm font-medium text-primary-600'
        return 'nav-link text-sm font-medium text-neutral-600 hover:text-primary-600 transition-colors'

    tentang_active = active_main == 'tentang'
    tentang_btn_cls = 'nav-link active text-sm font-medium text-primary-600 flex items-center gap-1' if tentang_active else 'nav-link text-sm font-medium text-neutral-600 hover:text-primary-600 transition-colors flex items-center gap-1'

    subs = ['sejarah','profil','tokoh','galeri']
    sub_labels = {'sejarah':'Sejarah Singkat','profil':'Profil Lembaga','tokoh':'Tokoh Kunci','galeri':'Galeri'}
    dropdown_items = ''
    mobile_sub_items = ''
    for s in subs:
        is_active_sub = (active_sub == s)
        if is_active_sub:
            dropdown_items += f'<a href="{s}.html" class="block px-4 py-2.5 text-sm font-semibold text-primary-600 bg-primary-50">{sub_labels[s]}</a>\n'
            mobile_sub_items += f'<a href="{s}.html" class="block px-10 py-2.5 text-sm font-semibold text-primary-600">{sub_labels[s]}</a>'
        else:
            dropdown_items += f'<a href="{s}.html" class="block px-4 py-2.5 text-sm text-neutral-600 hover:bg-primary-50 hover:text-primary-600">{sub_labels[s]}</a>\n'
            mobile_sub_items += f'<a href="{s}.html" class="block px-10 py-2.5 text-sm text-neutral-600 hover:text-primary-600">{sub_labels[s]}</a>'

    main_items = [
        ('index.html', 'Beranda', active_main == 'beranda'),
    ]
    after_tentang = [
        ('program.html', 'Program', active_main == 'program'),
        ('kdk.html', 'KDK', active_main == 'kdk'),
        ('blog.html', 'Papua Today', active_main == 'blog'),
        ('donasi.html', 'Donasi', active_main == 'donasi'),
        ('kontak.html', 'Kontak', active_main == 'kontak'),
    ]

    desktop_items = ''
    for href, label, is_act in main_items:
        desktop_items += f'<li><a href="{href}" class="{mc(label, is_act)}">{label}</a></li>\n'

    desktop_items += f'''<li class="relative" x-data="{{open:false}}" @mouseenter="open=true" @mouseleave="open=false">
          <button class="{tentang_btn_cls}">Tentang <i class="fa-solid fa-chevron-down text-[10px]"></i></button>
          <div x-show="open" x-transition class="absolute top-full left-0 mt-1 w-48 bg-white shadow-lg border border-neutral-100 py-1 z-50" style="display:none;">
            {dropdown_items}
          </div>
        </li>\n'''

    for href, label, is_act in after_tentang:
        desktop_items += f'<li><a href="{href}" class="{mc(label, is_act)}">{label}</a></li>\n'

    # Mobile items
    mobile_items = ''
    for href, label, is_act in main_items:
        if is_act:
            mobile_items += f'<li><a href="{href}" class="block px-6 py-3 text-sm font-semibold text-primary-600 bg-primary-50">{label}</a></li>\n'
        else:
            mobile_items += f'<li><a href="{href}" class="block px-6 py-3 text-sm text-neutral-700 hover:bg-neutral-50">{label}</a></li>\n'

    tent_mob_cls = 'text-sm text-primary-600 font-semibold bg-primary-50' if tentang_active else 'text-sm text-neutral-700 hover:bg-neutral-50'
    mobile_items += f'''<li>
          <button @click="tentangOpen=!tentangOpen" class="w-full flex items-center justify-between px-6 py-3 {tent_mob_cls}">Tentang <i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="tentangOpen&&'rotate-180'"></i></button>
          <div x-show="tentangOpen" x-transition class="bg-neutral-50" style="display:none;">{mobile_sub_items}</div>
        </li>\n'''

    for href, label, is_act in after_tentang:
        if is_act:
            mobile_items += f'<li><a href="{href}" class="block px-6 py-3 text-sm font-semibold text-primary-600 bg-primary-50">{label}</a></li>\n'
        else:
            mobile_items += f'<li><a href="{href}" class="block px-6 py-3 text-sm text-neutral-700 hover:bg-neutral-50">{label}</a></li>\n'

    return f'''
  <header class="sticky top-0 z-50 bg-white shadow-md border-b border-neutral-200">
    <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
      <a href="index.html" class="hidden md:flex items-center gap-3 flex-shrink-0"><img src="./img/logo-ypmd-irja.png" alt="" class="h-9"><div class="hidden sm:block"><span class="font-display font-bold text-primary-700 text-base leading-tight block">YPMD IRJA</span><span class="text-neutral-400 text-xs leading-none">Yayasan Pengembangan Masyarakat Desa Irian Jaya</span></div></a>
      <ul class="hidden md:flex items-center gap-6">
        {desktop_items}
      </ul>
      <div class="md:hidden absolute left-1/2 -translate-x-1/2 flex items-center gap-2"><img src="./img/logo-ypmd-irja.png" alt="" class="h-7"><span class="font-display font-bold text-primary-700 text-sm">YPMD IRJA</span></div>
      <button class="md:hidden ml-auto text-neutral-600" @click="menuOpen=!menuOpen"><i class="fa-solid text-lg" :class="menuOpen?'fa-xmark':'fa-bars'"></i></button>
    </nav>
    <div x-show="menuOpen" x-transition class="md:hidden bg-white border-t border-neutral-200 shadow-md" style="display:none;">
      <ul class="flex flex-col py-2">
        {mobile_items}
      </ul>
    </div>
  </header>'''

FOOTER = '''
  <footer class="bg-neutral-900 text-neutral-300">
    <div class="max-w-6xl mx-auto px-6 py-14 grid sm:grid-cols-2 md:grid-cols-4 gap-10">
      <div><div class="flex items-center gap-3 mb-4"><img src="./img/logo-ypmd-irja.png" alt="" class="h-8"><span class="font-display font-bold text-white text-base">YPMD IRJA</span></div><p class="text-neutral-400 text-sm leading-relaxed">Pionir pemberdayaan dan advokasi masyarakat adat di Tanah Papua sejak 1984.</p></div>
      <div><h4 class="text-white text-xs font-semibold uppercase tracking-widest mb-4">Navigasi</h4><ul class="space-y-2 text-sm"><li><a href="index.html" class="hover:text-white transition-colors">Beranda</a></li><li><a href="profil.html" class="hover:text-white transition-colors">Profil Lembaga</a></li><li><a href="sejarah.html" class="hover:text-white transition-colors">Sejarah</a></li><li><a href="program.html" class="hover:text-white transition-colors">Program</a></li><li><a href="kdk.html" class="hover:text-white transition-colors">Buletin KDK</a></li><li><a href="blog.html" class="hover:text-white transition-colors">Papua Today</a></li></ul></div>
      <div><h4 class="text-white text-xs font-semibold uppercase tracking-widest mb-4">Lainnya</h4><ul class="space-y-2 text-sm"><li><a href="tokoh.html" class="hover:text-white transition-colors">Tokoh Kunci</a></li><li><a href="galeri.html" class="hover:text-white transition-colors">Galeri</a></li><li><a href="donasi.html" class="hover:text-white transition-colors">Donasi</a></li><li><a href="kontak.html" class="hover:text-white transition-colors">Kontak</a></li></ul></div>
      <div><h4 class="text-white text-xs font-semibold uppercase tracking-widest mb-4">Kontak</h4><ul class="space-y-2 text-sm text-neutral-400"><li class="flex items-start gap-2"><i class="fa-solid fa-location-dot text-primary-400 mt-0.5 w-4"></i>Jl. Jeruk Nipis 117 Kotaraja, Jayapura 99225</li><li class="flex items-start gap-2"><i class="fa-solid fa-phone text-primary-400 mt-0.5 w-4"></i>0967-581071</li></ul></div>
    </div>
    <div class="border-t border-neutral-800"><div class="max-w-6xl mx-auto px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3"><p class="text-neutral-600 text-xs">&copy; 2025 YPMD IRJA. Berdiri sejak 8 Desember 1984.</p><p class="text-neutral-700 text-xs flex items-center gap-2"><i class="fa-solid fa-code text-neutral-600"></i>Draft desain oleh <a href="https://nokensoft.com" target="_blank" class="text-primary-400 hover:text-primary-300 font-semibold">Nokensoft.com</a></p></div></div>
  </footer>'''

FLOATING_AND_SCRIPTS = '''
  <div class="fixed bottom-6 right-5 z-50 flex flex-col items-center gap-3">
    <button id="btnTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="w-11 h-11 bg-neutral-700 hover:bg-neutral-900 text-white flex items-center justify-center shadow-lg transition-all duration-300 opacity-0 translate-y-4 pointer-events-none"><i class="fa-solid fa-chevron-up text-sm"></i></button>
    <a href="https://wa.me/6282199558191" target="_blank" class="w-11 h-11 bg-[#25D366] hover:bg-[#1ebe5d] text-white flex items-center justify-center shadow-lg transition-colors"><i class="fa-brands fa-whatsapp text-xl"></i></a>
  </div>
  <script>
    const observer=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');observer.unobserve(e.target);}});},{threshold:0.12});
    document.querySelectorAll('.fade-in').forEach(el=>observer.observe(el));
    const btnTop=document.getElementById('btnTop');
    window.addEventListener('scroll',()=>{if(window.scrollY>300){btnTop.classList.remove('opacity-0','translate-y-4','pointer-events-none');btnTop.classList.add('opacity-100','translate-y-0');}else{btnTop.classList.add('opacity-0','translate-y-4','pointer-events-none');btnTop.classList.remove('opacity-100','translate-y-0');}});
  </script>'''

def page(title, active_main, active_sub, banner_icon, banner_label, banner_title, banner_desc, main_content, extra_head='', extra_scripts=''):
    return f'''<!DOCTYPE html>
<html lang="id" x-data="{{ menuOpen: false, tentangOpen: false }}">
<head>
  {HEAD_COMMON}
  <title>{title} — YPMD IRJA</title>{extra_head}
</head>
<body class="bg-white text-neutral-800" x-data="{{topbarVisible:true}}">
{TOPBAR}
{nav_html(active_main, active_sub)}

  <main>
    <section class="bg-primary-700 py-14">
      <div class="max-w-6xl mx-auto px-6">
        <div class="flex items-center gap-2 text-primary-200 text-xs mb-3"><a href="index.html" class="hover:text-white">Beranda</a><i class="fa-solid fa-chevron-right text-[8px]"></i><span>{banner_label}</span></div>
        <h1 class="text-3xl md:text-4xl font-display font-bold text-white"><i class="fa-solid {banner_icon} mr-3 text-primary-300"></i>{banner_title}</h1>
        <p class="text-primary-200 text-sm mt-3 max-w-lg">{banner_desc}</p>
      </div>
    </section>

{main_content}
  </main>

{FOOTER}
{FLOATING_AND_SCRIPTS}
{extra_scripts}
</body>
</html>'''


# ── PAGE CONTENTS ──────────────────────────────────────────────────────

PROFIL_CONTENT = '''
    <section class="py-20 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-8">
          <div class="md:col-span-2 fade-in">
            <div class="shadow-card overflow-hidden">
              <div class="bg-primary-500 px-6 py-4"><h3 class="text-white font-semibold text-sm uppercase tracking-wider">Data Kelembagaan</h3></div>
              <table class="w-full text-sm">
                <tbody>
                  <tr class="border-b border-neutral-100"><td class="px-6 py-4 text-neutral-400 font-medium w-40">Nama Lengkap</td><td class="px-6 py-4 text-neutral-800 font-medium">Yayasan Pengembangan Masyarakat Desa Irian Jaya</td></tr>
                  <tr class="border-b border-neutral-100 bg-neutral-50"><td class="px-6 py-4 text-neutral-400 font-medium">Akronim</td><td class="px-6 py-4 text-neutral-800 font-semibold text-primary-600">YPMD IRJA</td></tr>
                  <tr class="border-b border-neutral-100"><td class="px-6 py-4 text-neutral-400 font-medium">Tahun Berdiri</td><td class="px-6 py-4 text-neutral-800">8 Desember 1984</td></tr>
                  <tr class="border-b border-neutral-100 bg-neutral-50"><td class="px-6 py-4 text-neutral-400 font-medium">Bentuk Hukum</td><td class="px-6 py-4 text-neutral-800">Yayasan</td></tr>
                  <tr class="border-b border-neutral-100"><td class="px-6 py-4 text-neutral-400 font-medium">Alamat</td><td class="px-6 py-4 text-neutral-800">Jl. Jeruk Nipis 117 Kotaraja, Jayapura, Papua 99225</td></tr>
                  <tr class="border-b border-neutral-100 bg-neutral-50"><td class="px-6 py-4 text-neutral-400 font-medium">Telepon</td><td class="px-6 py-4 text-neutral-800">0967-581071</td></tr>
                  <tr class="border-b border-neutral-100"><td class="px-6 py-4 text-neutral-400 font-medium">Bentuk Organisasi</td><td class="px-6 py-4 text-neutral-800">Lembaga Swadaya Masyarakat (LSM)</td></tr>
                  <tr class="border-b border-neutral-100 bg-neutral-50"><td class="px-6 py-4 text-neutral-400 font-medium">Wilayah Kerja</td><td class="px-6 py-4 text-neutral-800">Papua, Maluku, Sulawesi, Timor Leste</td></tr>
                  <tr class="bg-neutral-50"><td class="px-6 py-4 text-neutral-400 font-medium">Jaringan &amp; Mitra</td><td class="px-6 py-4 text-neutral-800">FOKER LSM Papua, Alter Trade Japan (ATJ), Green Coop, UNDP, Canada Fund, Konsulat Jepang</td></tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="flex flex-col gap-6 fade-in">
            <div class="shadow-card p-6 border-l-4 border-primary-500">
              <div class="flex items-center gap-2 mb-3"><i class="fa-solid fa-eye text-primary-500 text-sm"></i><h3 class="text-xs font-semibold tracking-widest uppercase text-primary-500">Visi</h3></div>
              <p class="text-neutral-700 text-sm leading-relaxed font-display italic">"Terwujudnya masyarakat Papua yang mandiri secara sosial, ekonomi, budaya, politik, dan hukum dengan tetap menjunjung tinggi nilai-nilai adat yang selaras dengan nilai universal."</p>
            </div>
            <div class="shadow-card p-6 border-l-4 border-accent-400">
              <div class="flex items-center gap-2 mb-3"><i class="fa-solid fa-bullseye text-accent-400 text-sm"></i><h3 class="text-xs font-semibold tracking-widest uppercase text-accent-500">Misi</h3></div>
              <ul class="text-neutral-700 text-sm leading-relaxed space-y-2">
                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-primary-500 mt-1 text-xs"></i><span><strong>Pemberdayaan Partisipatif:</strong> Mengembangkan kapasitas masyarakat secara aktif.</span></li>
                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-primary-500 mt-1 text-xs"></i><span><strong>Pendidikan &amp; Pelatihan:</strong> Membekali masyarakat dengan keterampilan praktis.</span></li>
                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-primary-500 mt-1 text-xs"></i><span><strong>Diseminasi Informasi:</strong> Mengelola dan menyebarkan informasi strategis pembangunan.</span></li>
                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-primary-500 mt-1 text-xs"></i><span><strong>Mediasi Konflik:</strong> Menjadi penengah dalam konflik pengelolaan sumber daya alam.</span></li>
              </ul>
            </div>
            <div class="shadow-card p-6 bg-neutral-50">
              <div class="flex items-center gap-2 mb-3"><i class="fa-solid fa-tags text-neutral-400 text-sm"></i><h3 class="text-xs font-semibold tracking-widest uppercase text-neutral-400">Bidang Kegiatan</h3></div>
              <div class="flex flex-wrap gap-2">
                <span class="bg-primary-50 text-primary-700 text-xs px-3 py-1 font-medium">Advokasi</span>
                <span class="bg-primary-50 text-primary-700 text-xs px-3 py-1 font-medium">Akses Air Bersih</span>
                <span class="bg-accent-50 text-accent-500 text-xs px-3 py-1 font-medium">Ekonomi &amp; Ekspor Kakao</span>
                <span class="bg-accent-50 text-accent-500 text-xs px-3 py-1 font-medium">Keuangan Mikro</span>
                <span class="bg-neutral-200 text-neutral-600 text-xs px-3 py-1 font-medium">Hilirisasi Produk</span>
                <span class="bg-neutral-200 text-neutral-600 text-xs px-3 py-1 font-medium">Media &amp; Jurnalisme</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Metodologi -->
        <div class="mt-12 fade-in">
          <div class="mb-6">
            <span class="text-xs font-semibold tracking-widest uppercase text-primary-500"><i class="fa-solid fa-gears mr-2"></i>Pendekatan</span>
            <h2 class="text-xl md:text-2xl font-display font-bold text-neutral-900 mt-2">Metodologi &amp; Paradigma Pembangunan</h2>
            <p class="text-neutral-500 text-sm mt-2">YPMD IRJA percaya bahwa <em>"Pembangunan adalah Pembelajaran"</em> (Development is Education).</p>
          </div>
          <div class="grid sm:grid-cols-3 gap-6">
            <div class="shadow-card p-6 border-t-4 border-primary-500 bg-white card-hover"><div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-4"><i class="fa-solid fa-people-group text-primary-500"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2 text-sm">Community Based Development (CBD)</h3><p class="text-neutral-500 text-sm leading-relaxed">Pembangunan berbasis masalah dan kebutuhan dasar rakyat.</p></div>
            <div class="shadow-card p-6 border-t-4 border-accent-400 bg-white card-hover"><div class="w-10 h-10 bg-accent-50 flex items-center justify-center mb-4"><i class="fa-solid fa-bullhorn text-accent-400"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2 text-sm">Community Based Advocacy (CBA)</h3><p class="text-neutral-500 text-sm leading-relaxed">Mendorong masyarakat agar mampu mengadvokasi hak-haknya secara mandiri kepada pemerintah.</p></div>
            <div class="shadow-card p-6 border-t-4 border-primary-400 bg-white card-hover"><div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-4"><i class="fa-solid fa-leaf text-primary-500"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2 text-sm">Community Based Economic – NRM</h3><p class="text-neutral-500 text-sm leading-relaxed">Pengelolaan ekonomi rumah tangga berbasis sumber daya alam berkelanjutan dengan menjaga kearifan lokal.</p></div>
          </div>
        </div>
      </div>
    </section>'''

TOKOH_CONTENT = '''
    <section class="py-20 bg-neutral-50">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <article class="bg-white shadow-card card-hover fade-in"><div class="relative w-full pt-[100%] overflow-hidden"><img src="./img/avatar-decky-rumaropen.png" alt="" class="absolute inset-0 w-full h-full object-cover"/></div><div class="p-6"><h3 class="font-display font-bold text-neutral-900 text-lg">Decky Rumaropen</h3><span class="text-xs font-semibold text-primary-500 uppercase tracking-wider">Direktur (1998 – 2022)</span><p class="text-neutral-500 text-sm leading-relaxed mt-3">Alumnus FISIP Universitas Cenderawasih, bergabung YPMD IRJA sejak 1988. Penggerak utama kakao organik Papua dan kemitraan dengan ATJ/Green Coop. Salah satu pendiri FOKER LSM Papua. Wafat 26 Juli 2022.</p></div></article>
          <article class="bg-white shadow-card card-hover fade-in"><div class="relative w-full pt-[100%] overflow-hidden"><img src="./img/avatar-george-junus-aditjondro.png" alt="" class="absolute inset-0 w-full h-full object-cover"/></div><div class="p-6"><h3 class="font-display font-bold text-neutral-900 text-lg">George Junus Aditjondro</h3><span class="text-xs font-semibold text-accent-500 uppercase tracking-wider">Pendiri &amp; Direktur Pertama</span><p class="text-neutral-500 text-sm leading-relaxed mt-3">Mantan jurnalis majalah Tempo, pelopor jurnalisme kampung di Papua. Inisiator buletin <em>Kabar dari Kampung</em> (KDK) sejak 1982. Mendirikan YPMD IRJA bersama August Rumansara. Wafat 10 Desember 2016.</p></div></article>
          <article class="bg-white shadow-card card-hover fade-in"><div class="relative w-full pt-[100%] overflow-hidden"><img src="https://placehold.co/600x600/EEE/31343C" alt="" class="absolute inset-0 w-full h-full object-cover"/></div><div class="p-6"><h3 class="font-display font-bold text-neutral-900 text-lg">Ir. August Rumansara</h3><span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Ko-Pendiri</span><p class="text-neutral-500 text-sm leading-relaxed mt-3">Bersama George Aditjondro, membangun gerakan masyarakat sipil Papua sejak era 1980-an melalui KKO dan Irja DISC sebelum mendirikan YPMD IRJA pada 1984.</p></div></article>
        </div>
        <div class="mt-10 bg-white shadow-card p-6 fade-in">
          <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-500 mb-4"><i class="fa-solid fa-star text-accent-400 mr-2"></i>Tokoh yang Terlahir dari YPMD IRJA</h3>
          <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div class="border border-neutral-100 p-4"><div class="font-semibold text-neutral-800">Christian Warinussy</div><div class="text-neutral-400 text-xs mt-1">Pendiri LP3BH Manokwari</div></div>
            <div class="border border-neutral-100 p-4"><div class="font-semibold text-neutral-800">Markus You</div><div class="text-neutral-400 text-xs mt-1">Redaktur Suara Papua.com</div></div>
            <div class="border border-neutral-100 p-4"><div class="font-semibold text-neutral-800">Bambang Widjayanto</div><div class="text-neutral-400 text-xs mt-1">Direktur pertama LBH Papua</div></div>
            <div class="border border-neutral-100 p-4"><div class="font-semibold text-neutral-800">Pastor Neles Tebay</div><div class="text-neutral-400 text-xs mt-1">Kontributor buletin KDK</div></div>
          </div>
        </div>
      </div>
    </section>'''

GALERI_CONTENT = '''
    <section class="py-20 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 fade-in">
          <img src="./img/anak-anak-mendayung.png" alt="" class="w-full h-48 object-cover shadow-card"/>
          <img src="./img/pahatan-kayu-sentani.png" alt="" class="w-full h-48 object-cover shadow-card"/>
          <img src="./img/rumput-mei-wamena.png" alt="" class="w-full h-48 object-cover shadow-card"/>
          <img src="./img/honai.png" alt="" class="w-full h-48 object-cover shadow-card"/>
          <img src="./img/rumah-adat.png" alt="" class="w-full h-48 object-cover shadow-card"/>
          <img src="./img/danau-sentani.png" alt="" class="w-full h-48 object-cover shadow-card"/>
          <img src="./img/perahu-danau-sentani.png" alt="" class="w-full h-48 object-cover shadow-card"/>
          <img src="./img/raja-ampat.png" alt="" class="w-full h-48 object-cover shadow-card"/>
        </div>
      </div>
    </section>'''

PROGRAM_CONTENT = '''
    <section class="py-20 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in"><div class="h-1.5 bg-primary-500"></div><div class="p-6"><div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-4"><i class="fa-solid fa-seedling text-primary-500"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2">Ekonomi &amp; Ekspor Kakao Organik</h3><p class="text-neutral-500 text-sm leading-relaxed">Ekspor biji kakao organik dari Lembah Grime ke Jepang sejak 2010 melalui kemitraan dengan Alter Trade Japan (ATJ) dan Green Coop. Dikelola oleh PT Kakao Kita Papua sebagai unit bisnis dari hulu hingga hilir.</p></div></article>
          <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in"><div class="h-1.5 bg-accent-400"></div><div class="p-6"><div class="w-10 h-10 bg-accent-50 flex items-center justify-center mb-4"><i class="fa-solid fa-users text-accent-400"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2">Pendampingan Masyarakat Adat</h3><p class="text-neutral-500 text-sm leading-relaxed">Mendampingi dan mengorganisir masyarakat adat Papua sebagai subjek pembangunan. Memastikan hak-hak komunitas lokal terlindungi dalam isu pertanahan, lingkungan, dan otonomi ekonomi.</p></div></article>
          <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in"><div class="h-1.5 bg-primary-400"></div><div class="p-6"><div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-4"><i class="fa-solid fa-piggy-bank text-primary-500"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2">Keuangan Mikro</h3><p class="text-neutral-500 text-sm leading-relaxed">Mendirikan BPR Phidectama pada 1992 untuk membentuk kebiasaan menabung bagi masyarakat kampung. Sebagian hasil penjualan kakao ditabung untuk biaya pendidikan anak dan modal usaha.</p></div></article>
          <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in"><div class="h-1.5 bg-neutral-400"></div><div class="p-6"><div class="w-10 h-10 bg-neutral-100 flex items-center justify-center mb-4"><i class="fa-solid fa-newspaper text-neutral-500"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2">Advokasi Media</h3><p class="text-neutral-500 text-sm leading-relaxed">Penerbitan Buletin <em>Kabar Dari Kampung</em> (KDK) sejak 1982 untuk menyuarakan persoalan masyarakat adat ke publik nasional dan internasional.</p></div></article>
          <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in"><div class="h-1.5 bg-primary-500"></div><div class="p-6"><div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-4"><i class="fa-solid fa-droplet text-primary-500"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2">Akses Air Bersih</h3><p class="text-neutral-500 text-sm leading-relaxed">Pembangunan sarana air bersih di Kampung Tablanusu, Tablasupa, Dormena, Muris Besar, Yougapsa, Yanim, Braso (Kab. Jayapura), Adibai (Biak), Menawi (Yapen), hingga Maluku dan Timor Leste.</p></div></article>
          <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in"><div class="h-1.5 bg-accent-400"></div><div class="p-6"><div class="w-10 h-10 bg-accent-50 flex items-center justify-center mb-4"><i class="fa-solid fa-industry text-accent-400"></i></div><h3 class="font-display font-bold text-neutral-900 mb-2">Hilirisasi Produk</h3><p class="text-neutral-500 text-sm leading-relaxed">Mendirikan PT Kakao Kita Papua dan Kakao Kita Caf&eacute; di Jayapura sebagai unit bisnis pengolahan cokelat dari petani lokal — dari hulu hingga hilir.</p></div></article>
        </div>
      </div>
    </section>'''

KDK_CONTENT = '''
    <section class="py-20 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <p class="text-neutral-500 text-sm leading-relaxed mb-10 max-w-2xl fade-in">Buletin <em>Kabar Dari Kampung</em> (KDK) diterbitkan sejak 1982 sebagai media alternatif untuk menyuarakan persoalan masyarakat adat Papua. Berikut arsip edisi buletin yang tersedia.</p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
''' + ''.join([f'''
          <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in">
            <img src="https://placehold.co/400x560/f0f7f2/2d8057?text=KDK+Edisi+{i}" alt="Cover KDK Edisi {i}" class="w-full h-64 object-cover"/>
            <div class="p-5">
              <span class="text-xs font-semibold text-primary-500 uppercase tracking-wider">Edisi {i}</span>
              <h3 class="font-display font-bold text-neutral-900 mt-1 mb-2">Kabar dari Kampung — Edisi {i}</h3>
              <p class="text-neutral-400 text-xs mb-4">Terbit {["Januari 1985","Maret 1986","Juli 1987","November 1988","April 1990","September 1992"][i-1]}</p>
              <a href="#" class="inline-flex items-center gap-2 bg-primary-500 text-white px-4 py-2 text-xs font-semibold hover:bg-primary-600 transition-colors"><i class="fa-solid fa-file-pdf"></i>Unduh PDF</a>
            </div>
          </article>''' for i in range(1, 7)]) + '''
        </div>
      </div>
    </section>'''

BLOG_CONTENT = '''
    <section class="py-20 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-4 gap-8">

          <!-- Sidebar -->
          <aside class="lg:col-span-1 order-2 lg:order-1 fade-in">
            <div class="shadow-card p-5 mb-6">
              <h3 class="text-xs font-semibold uppercase tracking-widest text-neutral-500 mb-3"><i class="fa-solid fa-magnifying-glass mr-2"></i>Pencarian</h3>
              <div class="flex"><input type="text" placeholder="Cari artikel..." class="flex-1 border border-neutral-200 px-3 py-2 text-sm focus:outline-none focus:border-primary-400"/><button class="bg-primary-500 text-white px-3 py-2 text-sm hover:bg-primary-600"><i class="fa-solid fa-search"></i></button></div>
            </div>
            <div class="shadow-card p-5">
              <h3 class="text-xs font-semibold uppercase tracking-widest text-neutral-500 mb-3"><i class="fa-solid fa-folder mr-2"></i>Kategori</h3>
              <ul class="space-y-2 text-sm">
                <li><a href="#" class="flex items-center justify-between text-neutral-600 hover:text-primary-600"><span>Ekonomi Papua</span><span class="bg-primary-50 text-primary-600 text-xs px-2 py-0.5 font-semibold">5</span></a></li>
                <li><a href="#" class="flex items-center justify-between text-neutral-600 hover:text-primary-600"><span>Budaya &amp; Adat</span><span class="bg-primary-50 text-primary-600 text-xs px-2 py-0.5 font-semibold">3</span></a></li>
                <li><a href="#" class="flex items-center justify-between text-neutral-600 hover:text-primary-600"><span>Lingkungan</span><span class="bg-primary-50 text-primary-600 text-xs px-2 py-0.5 font-semibold">4</span></a></li>
                <li><a href="#" class="flex items-center justify-between text-neutral-600 hover:text-primary-600"><span>Pendidikan</span><span class="bg-primary-50 text-primary-600 text-xs px-2 py-0.5 font-semibold">2</span></a></li>
                <li><a href="#" class="flex items-center justify-between text-neutral-600 hover:text-primary-600"><span>Kakao Organik</span><span class="bg-primary-50 text-primary-600 text-xs px-2 py-0.5 font-semibold">6</span></a></li>
              </ul>
            </div>
          </aside>

          <!-- Blog Posts -->
          <div class="lg:col-span-3 order-1 lg:order-2 space-y-6">
''' + ''.join([f'''
            <article class="shadow-card card-hover bg-white border border-neutral-100 flex flex-col sm:flex-row overflow-hidden fade-in">
              <img src="https://placehold.co/400x300/f0f7f2/2d8057?text=Artikel+{i}" alt="" class="w-full sm:w-48 h-48 sm:h-auto object-cover flex-shrink-0"/>
              <div class="p-5 flex flex-col justify-center">
                <div class="flex items-center gap-3 text-xs text-neutral-400 mb-2"><span>{["Ekonomi Papua","Budaya & Adat","Lingkungan","Kakao Organik"][i-1]}</span><span>•</span><span>{["10 Jan 2025","25 Feb 2025","12 Mar 2025","5 Apr 2025"][i-1]}</span></div>
                <h3 class="font-display font-bold text-neutral-900 mb-2">{["Petani Kakao Lembah Grime Raih Pasar Jepang","Tradisi Adat dalam Pengelolaan Sumber Daya","Menjaga Hutan Papua untuk Generasi Mendatang","Kakao Kita Café: Dari Kebun ke Cangkir"][i-1]}</h3>
                <p class="text-neutral-500 text-sm leading-relaxed mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis voluptatum earum quo sapiente...</p>
                <a href="#" class="text-primary-600 text-sm font-semibold hover:text-primary-700">Baca Selengkapnya <i class="fa-solid fa-arrow-right text-xs ml-1"></i></a>
              </div>
            </article>''' for i in range(1, 5)]) + '''
          </div>
        </div>
      </div>
    </section>'''

DONASI_CONTENT = '''
    <section class="py-20 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-start">
          <div class="fade-in">
            <h2 class="text-2xl font-display font-bold text-neutral-900 mb-4">Dukung Masyarakat Adat Papua</h2>
            <p class="text-neutral-500 text-sm leading-relaxed mb-6">Donasi Anda membantu YPMD IRJA melanjutkan program pemberdayaan masyarakat adat, pengembangan ekonomi berbasis kakao organik, akses air bersih, dan pendampingan komunitas di kampung-kampung Papua.</p>
            <div class="space-y-4">
              <div class="shadow-card p-5 border-l-4 border-primary-500">
                <h3 class="font-semibold text-neutral-900 text-sm mb-1"><i class="fa-solid fa-seedling text-primary-500 mr-2"></i>Kakao Organik</h3>
                <p class="text-neutral-500 text-xs">Mendukung petani kakao organik di Lembah Grime untuk ekspor ke Jepang.</p>
              </div>
              <div class="shadow-card p-5 border-l-4 border-accent-400">
                <h3 class="font-semibold text-neutral-900 text-sm mb-1"><i class="fa-solid fa-droplet text-accent-400 mr-2"></i>Air Bersih</h3>
                <p class="text-neutral-500 text-xs">Membangun sarana air bersih di kampung-kampung terpencil Papua.</p>
              </div>
              <div class="shadow-card p-5 border-l-4 border-primary-400">
                <h3 class="font-semibold text-neutral-900 text-sm mb-1"><i class="fa-solid fa-graduation-cap text-primary-400 mr-2"></i>Pendidikan</h3>
                <p class="text-neutral-500 text-xs">Tabungan pendidikan anak melalui BPR Phidectama dari hasil penjualan kakao.</p>
              </div>
            </div>
          </div>
          <div class="fade-in">
            <div class="shadow-card p-8 bg-neutral-50 border border-neutral-200">
              <h3 class="font-display font-bold text-neutral-900 text-lg mb-4 text-center">Informasi Donasi</h3>
              <div class="space-y-4 mb-6">
                <div class="bg-white p-4 border border-neutral-100">
                  <div class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Bank</div>
                  <div class="font-semibold text-neutral-800">Bank Papua</div>
                </div>
                <div class="bg-white p-4 border border-neutral-100">
                  <div class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Nomor Rekening</div>
                  <div class="font-semibold text-neutral-800 font-mono text-lg">XXX-XXX-XXXX</div>
                  <div class="text-xs text-neutral-400 mt-1">a.n. Yayasan Pengembangan Masyarakat Desa Irian Jaya</div>
                </div>
              </div>
              <p class="text-neutral-400 text-xs text-center mb-6">Konfirmasi donasi melalui WhatsApp:</p>
              <a href="https://wa.me/6282199558191?text=Halo%20YPMD%20IRJA%2C%20saya%20ingin%20berdonasi" target="_blank" class="flex items-center justify-center gap-2 w-full bg-[#25D366] hover:bg-[#1ebe5d] text-white font-semibold text-sm py-3 transition-colors">
                <i class="fa-brands fa-whatsapp text-lg"></i>Konfirmasi via WhatsApp
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>'''

KONTAK_CONTENT = '''
    <section class="py-20 bg-neutral-50">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-8">
          <div class="fade-in flex flex-col gap-4">
            <div class="bg-white shadow-card p-5 flex items-start gap-4"><div class="w-10 h-10 bg-primary-50 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-location-dot text-primary-500"></i></div><div><div class="text-xs font-semibold uppercase tracking-wider text-neutral-400 mb-1">Alamat</div><p class="text-neutral-700 text-sm">Jl. Jeruk Nipis 117 Kotaraja (Furia),<br/>Jayapura, Papua 99225</p></div></div>
            <div class="bg-white shadow-card p-5 flex items-start gap-4"><div class="w-10 h-10 bg-primary-50 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-phone text-primary-500"></i></div><div><div class="text-xs font-semibold uppercase tracking-wider text-neutral-400 mb-1">Telepon</div><p class="text-neutral-700 text-sm">0967-581071</p></div></div>
            <div class="bg-white shadow-card p-5 flex items-start gap-4"><div class="w-10 h-10 bg-accent-50 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-mug-hot text-accent-400"></i></div><div><div class="text-xs font-semibold uppercase tracking-wider text-neutral-400 mb-1">Kafe Kakao Kita Papua</div><p class="text-neutral-700 text-sm">Di samping Kantor YPMD, Kotaraja, Jayapura.</p></div></div>
            <div class="bg-white shadow-card p-5 flex items-start gap-4"><div class="w-10 h-10 bg-primary-50 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-network-wired text-primary-500"></i></div><div><div class="text-xs font-semibold uppercase tracking-wider text-neutral-400 mb-1">Jaringan &amp; Mitra</div><p class="text-neutral-700 text-sm">FOKER LSM Papua<br/>Alter Trade Japan (ATJ) &amp; Green Coop<br/>UNDP, Canada Fund, Konsulat Jepang</p></div></div>
          </div>
          <div class="fade-in">
            <div class="w-full h-full min-h-[400px] bg-neutral-200 shadow-card flex items-center justify-center">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.7292167261926!2d140.67387397405315!3d-2.5942523973837863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x686cf5f6f988a501%3A0x46658cf19a11d8d0!2sYPMD%20Papua!5e0!3m2!1sen!2sid!4v1772952435449!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>'''


# ── Generate pages ─────────────────────────────────────────────────────

pages = [
    ('profil.html', 'Profil Lembaga', 'tentang', 'profil', 'fa-building-columns', 'Profil Lembaga', 'Profil Lembaga', 'Identitas, visi misi, dan metodologi pembangunan YPMD IRJA.', PROFIL_CONTENT),
    ('tokoh.html', 'Tokoh Kunci', 'tentang', 'tokoh', 'fa-person-chalkboard', 'Tokoh Kunci', 'Tokoh Kunci YPMD IRJA', 'Orang-orang di balik perjalanan panjang YPMD IRJA.', TOKOH_CONTENT),
    ('galeri.html', 'Galeri', 'tentang', 'galeri', 'fa-images', 'Galeri', 'Galeri Kegiatan', 'Dokumentasi visual kegiatan dan program YPMD IRJA.', GALERI_CONTENT),
    ('program.html', 'Program Kegiatan', 'program', '', 'fa-list-check', 'Program Kegiatan', 'Program Unggulan', 'Enam program utama YPMD IRJA untuk pemberdayaan masyarakat Papua.', PROGRAM_CONTENT),
    ('kdk.html', 'Buletin KDK', 'kdk', '', 'fa-newspaper', 'Buletin KDK', 'Kabar Dari Kampung', 'Arsip buletin KDK — pelopor jurnalisme kampung di Papua sejak 1982.', KDK_CONTENT),
    ('blog.html', 'Papua Today', 'blog', '', 'fa-blog', 'Papua Today', 'Papua Today', 'Berita dan artikel terkini seputar Papua dan program YPMD IRJA.', BLOG_CONTENT),
    ('donasi.html', 'Donasi', 'donasi', '', 'fa-heart', 'Donasi', 'Donasi', 'Dukung program pemberdayaan masyarakat adat Papua.', DONASI_CONTENT),
    ('kontak.html', 'Kontak', 'kontak', '', 'fa-envelope', 'Kontak', 'Kontak & Lokasi', 'Hubungi YPMD IRJA atau kunjungi kantor kami di Jayapura.', KONTAK_CONTENT),
]

for filename, title, active_main, active_sub, icon, label, h1_title, desc, content in pages:
    filepath = os.path.join(BASE, filename)
    html = page(title, active_main, active_sub, icon, label, h1_title, desc, content)
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(html)
    print(f'✓ Created {filename}')

print('\nAll pages generated successfully!')
