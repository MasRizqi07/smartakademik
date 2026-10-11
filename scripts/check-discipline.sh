#!/usr/bin/env bash
set -u
LIVE='resources/views'
EXCL='welcome|tentang|fitur|prestasi|kalender|bantuan|kontak|prestasi-galeri|kalender-akademik|kontak-support'
fail=0
hues=$(grep -rEo "(bg|text|border|ring|from|to|via|fill|stroke|shadow)-(emerald|green|amber|sky|rose|red|yellow|orange|teal)-[0-9]+" $LIVE --include=*.blade.php | grep -vE "/($EXCL)\.blade\.php" | wc -l)
decor=$(grep -rEn "backdrop-blur|animate-(float|pulse-subtle|ping)|hover-lift|glass-(card|panel|nav)|mesh-gradient|text-gradient|shadow-glow" $LIVE --include=*.blade.php | grep -vE "/($EXCL)\.blade\.php" | wc -l)
echo "raw_hues_live=$hues"
echo "decoration_live=$decor"
[ "$hues" -eq 0 ] || fail=1
[ "$decor" -eq 0 ] || fail=1
for c in $(grep -rEoh "(bg|text|border|ring)-(brand|status-(hadir|izin|sakit|alfa))(-hover|-surface|-dark)?/[0-9]+" $LIVE --include=*.blade.php | sort -u); do
  esc=$(printf '%s' "$c" | sed 's#/#\\\\/#g')
  grep -q "\.$esc" public/build/assets/*.css || { echo "MISSING: $c"; fail=1; }
done
exit $fail
