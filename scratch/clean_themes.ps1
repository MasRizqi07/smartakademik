$files = @(
    "resources/views/tentang.blade.php",
    "resources/views/prestasi.blade.php",
    "resources/views/kontak.blade.php",
    "resources/views/kalender.blade.php",
    "resources/views/fitur.blade.php",
    "resources/views/bantuan.blade.php"
)

foreach ($path in $files) {
    $fullPath = Join-Path "d:\MY CODE\ANTIGRAVITY\PHP\smartakademik" $path
    if (Test-Path $fullPath) {
        $content = Get-Content $fullPath -Raw
        $content = $content -replace '<x-theme-init />\r?\n?', ''
        $content = $content -replace '<x-theme-toggle[^>]*>\r?\n?', ''
        
        Set-Content -Path $fullPath -Value $content -NoNewline
        Write-Host "Cleaned $path"
    }
}
