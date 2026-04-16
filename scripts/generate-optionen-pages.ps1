param(
  [ValidateSet("all", "categories")]
  [string]$Mode = "all"
)

$ErrorActionPreference = "Stop"

$root = Split-Path -Parent $PSScriptRoot

$categories = @(
  @{
    slug = "finanzen"
    title = "Finanzen"
    intro = "Hier finden Sie Finanzthemen, die im Alltag wirklich relevant sind – vom Kredit bis zu sicheren Sparformen. Die Übersicht hilft, Optionen einfach und verständlich einzuordnen."
    orientation = "Die Themen helfen dabei, finanzielle Entscheidungen besser einzuordnen und passende Optionen strukturiert zu vergleichen."
    trust = "Orbita24 bietet Orientierung und ersetzt keine persönliche Finanzberatung. Prüfen Sie Konditionen immer sorgfältig."
    faqTitle = "Wie nutze ich die Finanzübersicht?"
    faqText = "Wählen Sie zuerst das Thema, das zu Ihrer aktuellen Situation passt. Auf der nächsten Seite finden Sie Hinweise, Vergleichsaspekte und mögliche nächste Schritte."
    items = @(
      @{ slug = "kredit"; title = "Kredit"; label = "Überblick"; text = "Kreditarten, Kosten und Rückzahlung einfach verstehen." },
      @{ slug = "girokonto"; title = "Girokonto"; label = "Alltag"; text = "Kontoführung, Gebühren und Funktionen einfach vergleichen." },
      @{ slug = "kreditkarte"; title = "Kreditkarte"; label = "Karten"; text = "Kreditkarten, Kosten und Nutzung schnell überblicken." },
      @{ slug = "tagesgeld"; title = "Tagesgeld"; label = "Sparen"; text = "Flexible Sparmöglichkeiten und Zinsen einfach vergleichen." },
      @{ slug = "festgeld"; title = "Festgeld"; label = "Stabil"; text = "Laufzeiten, feste Zinsen und Verfügbarkeit einfach prüfen." },
      @{ slug = "schufa-freundliche-finanzoptionen"; title = "Schufa-freundliche Finanzoptionen"; label = "Bonität"; text = "Finanzoptionen bei sensibler Bonität besser verstehen." }
    )
  },
  @{
    slug = "versicherungen"
    title = "Versicherungen"
    intro = "Hier finden Sie wichtige Versicherungsbereiche für Alltag, Mobilität und rechtliche Absicherung. Die Übersicht hilft, Leistungen und typische Unterschiede besser zu verstehen."
    orientation = "Vergleichen Sie verschiedene Absicherungen nach Bedarf, Alltagssituation und relevanten Leistungen."
    trust = "Die Informationen dienen als neutrale Orientierung. Welche Absicherung sinnvoll ist, hängt immer von der persönlichen Situation ab."
    faqTitle = "Welche Versicherung passt zu meinem Bedarf?"
    faqText = "Beginnen Sie mit dem Lebensbereich, in dem Sie Schutz benötigen. Danach lassen sich Leistungen, Kosten und Ausschlüsse gezielter prüfen."
    items = @(
      @{ slug = "kfz-versicherung"; title = "KFZ-Versicherung"; text = "Beiträge und Schutz rund ums Auto vergleichen." },
      @{ slug = "haftpflichtversicherung"; title = "Haftpflichtversicherung"; text = "Private Haftpflichtrisiken einfach absichern." },
      @{ slug = "hausratversicherung"; title = "Hausratversicherung"; text = "Einrichtung und persönliche Gegenstände schützen." },
      @{ slug = "rechtsschutzversicherung"; title = "Rechtsschutzversicherung"; text = "Rechtsschutz, Leistungen und Wartezeiten vergleichen." },
      @{ slug = "krankenversicherung-optionen"; title = "Krankenversicherung-Optionen"; text = "Gesundheitsoptionen klar und einfach vergleichen." },
      @{ slug = "versicherungen-vergleichen"; title = "Versicherungen vergleichen"; text = "Versicherungen nach Bedarf und Kosten vergleichen." }
    )
  },
  @{
    slug = "arbeit-einkommen"
    title = "Arbeit & Einkommen"
    intro = "Diese Kategorie bündelt Themen rund um Jobs, zusätzliche Einnahmen und berufliche Entwicklung. So finden Sie schneller den passenden Einstieg für Ihre Situation."
    orientation = "Die Unterseiten helfen, nächste Schritte im Arbeitsleben sachlich zu planen und passende Wege zu vergleichen."
    trust = "Berufliche Entscheidungen brauchen Kontext. Orbita24 liefert dafür eine klare erste Orientierung."
    faqTitle = "Wie finde ich den passenden Einstieg?"
    faqText = "Wählen Sie aus, ob Sie einen neuen Job, zusätzliche Einnahmen, Weiterbildung oder eine berufliche Veränderung prüfen möchten."
    items = @(
      @{ slug = "jobmoeglichkeiten-finden"; title = "Jobmöglichkeiten finden"; text = "Neue Jobs und passende Suchwege entdecken." },
      @{ slug = "nebenverdienst-optionen"; title = "Nebenverdienst Optionen"; text = "Zusätzliche Einnahmen einfach vergleichen." },
      @{ slug = "weiterbildung-umschulung"; title = "Weiterbildung & Umschulung"; text = "Kurse, Umschulung und neue Chancen prüfen." },
      @{ slug = "bewerbung-karrierehilfen"; title = "Bewerbung & Karrierehilfen"; text = "Hilfe für Bewerbung und Karriere finden." },
      @{ slug = "einkommen-verbessern"; title = "Einkommen verbessern"; text = "Möglichkeiten für mehr Einkommen entdecken." },
      @{ slug = "berufliche-neuorientierung"; title = "Berufliche Neuorientierung"; text = "Neue berufliche Wege einfach vergleichen." }
    )
  },
  @{
    slug = "energie-haushalt"
    title = "Energie & Haushalt"
    intro = "Hier geht es um laufende Kosten, Versorgung und einfache Entscheidungen im Haushalt. Die Themen zeigen, wo sich ein genauer Blick lohnen kann."
    orientation = "Die Themen zeigen, wo Vergleiche sinnvoll sind und welche Punkte bei Energie und Haushalt wichtig werden."
    trust = "Kosten im Haushalt hängen von Verbrauch, Region und Vertragsdetails ab. Eine klare Übersicht hilft beim Einordnen."
    faqTitle = "Wo kann ich im Haushalt beginnen?"
    faqText = "Starten Sie bei den regelmäßigen Kosten wie Strom, Gas oder Heizung und prüfen Sie danach weitere Alltagspunkte."
    items = @(
      @{ slug = "stromanbieter-vergleichen"; title = "Stromanbieter vergleichen"; text = "Stromtarife und Laufzeiten einfach vergleichen." },
      @{ slug = "gasanbieter-vergleichen"; title = "Gasanbieter vergleichen"; text = "Gastarife, Verbrauch und Kosten prüfen." },
      @{ slug = "heizkosten-senken"; title = "Heizkosten senken"; text = "Heizkosten verstehen und Einsparungen finden." },
      @{ slug = "haushaltskosten-optimieren"; title = "Haushaltskosten optimieren"; text = "Regelmäßige Ausgaben im Haushalt senken." },
      @{ slug = "umzug-versorgung-anmelden"; title = "Umzug & Versorgung anmelden"; text = "Versorgung beim Umzug rechtzeitig planen." },
      @{ slug = "energie-sparen-im-alltag"; title = "Energie sparen im Alltag"; text = "Energie im Alltag bewusster nutzen." }
    )
  },
  @{
    slug = "internet-vertraege"
    title = "Internet & Verträge"
    intro = "Hier finden Sie Orientierung zu Internet, Mobilfunk und laufenden Verträgen. Die Übersicht hilft, Leistungen, Laufzeiten und Kosten klarer zu vergleichen."
    orientation = "Diese Themen helfen, Anschlussarten, Tarife und Vertragswechsel besser zu verstehen."
    trust = "Verträge sollten zu Nutzung, Laufzeit und Budget passen. Orbita24 ordnet wichtige Vergleichspunkte ruhig ein."
    faqTitle = "Was ist bei Verträgen besonders wichtig?"
    faqText = "Achten Sie auf Laufzeit, Preis nach Aktionsphasen, verfügbare Leistung und Kündigungsfristen."
    items = @(
      @{ slug = "internetanschluss-vergleichen"; title = "Internetanschluss vergleichen"; text = "Internet für zuhause einfach vergleichen." },
      @{ slug = "mobilfunkvertraege-vergleichen"; title = "Mobilfunkverträge vergleichen"; text = "Datenvolumen, Netz und Laufzeiten prüfen." },
      @{ slug = "dsl-oder-glasfaser-optionen"; title = "DSL oder Glasfaser Optionen"; text = "DSL und Glasfaser passend vergleichen." },
      @{ slug = "sim-only-tarife"; title = "SIM-only Tarife"; text = "Tarife ohne neues Smartphone vergleichen." },
      @{ slug = "vertraege-pruefen-und-wechseln"; title = "Verträge prüfen und wechseln"; text = "Verträge prüfen und Wechseloptionen finden." },
      @{ slug = "streaming-zusatzpakete"; title = "Streaming & Zusatzpakete"; text = "Streaming und Zusatzpakete einfach prüfen." }
    )
  },
  @{
    slug = "vergleiche-angebote"
    title = "Vergleiche & Angebote"
    intro = "Diese Kategorie sammelt übergreifende Vergleiche und praktische Angebotsübersichten. Sie hilft, Optionen schneller zu sortieren und besser einzuordnen."
    orientation = "Die Unterseiten führen zu einfachen Einstiegen, Kostenvergleichen und bedarfsorientierten Übersichten."
    trust = "Vergleiche sind hilfreich, wenn sie verständlich bleiben. Der Fokus liegt auf Orientierung statt auf schnellen Versprechen."
    faqTitle = "Wann ist ein Vergleich sinnvoll?"
    faqText = "Ein Vergleich lohnt sich besonders, wenn Kosten regelmäßig anfallen oder mehrere ähnliche Optionen zur Auswahl stehen."
    items = @(
      @{ slug = "angebote-vergleichen"; title = "Angebote vergleichen"; text = "Angebote nach Nutzen und Kosten vergleichen." },
      @{ slug = "tarife-vergleichen"; title = "Tarife vergleichen"; text = "Tarife und Preisunterschiede schnell verstehen." },
      @{ slug = "monatliche-kosten-senken"; title = "Monatliche Kosten senken"; text = "Regelmäßige Kosten prüfen und reduzieren." },
      @{ slug = "beliebte-optionen-im-ueberblick"; title = "Beliebte Optionen im Überblick"; text = "Häufig gewählte Optionen schnell ansehen." },
      @{ slug = "empfohlene-loesungen-nach-bedarf"; title = "Empfohlene Lösungen nach Bedarf"; text = "Lösungen passend zur Situation finden." },
      @{ slug = "schnellvergleich-fuer-einsteiger"; title = "Schnellvergleich für Einsteiger"; text = "Ein einfacher Einstieg in passende Vergleiche." }
    )
  }
)

function Escape-Html([string]$value) {
  return $value.Replace("&", "&amp;").Replace("<", "&lt;").Replace(">", "&gt;").Replace('"', "&quot;")
}

function Get-RelativePrefix([int]$depth) {
  if ($depth -le 0) { return "" }
  return ("../" * $depth)
}

function Get-Header([string]$prefix) {
@"
    <header class="site-header">
      <div class="container nav">
        <a href="${prefix}index.html" class="logo" aria-label="Orbita24 Startseite">
          <img src="${prefix}images/logo-orbita24.svg" alt="Orbita24 Logo" class="logo-img" />
        </a>

        <button
          class="nav-toggle"
          aria-label="Menü öffnen"
          aria-expanded="false"
          aria-controls="main-navigation"
        >
          <span></span>
          <span></span>
          <span></span>
        </button>

        <nav class="nav-menu" id="main-navigation" aria-label="Hauptnavigation">
          <a href="${prefix}index.html">Startseite</a>
          <a href="${prefix}optionen.html" class="active" aria-current="page">Optionen</a>
          <a href="${prefix}about.html">Über uns</a>
          <a href="${prefix}kontakt.html">Kontakt</a>
        </nav>
      </div>
    </header>
"@
}

function Get-Footer([string]$prefix) {
@"
    <footer class="site-footer">
      <div class="container footer-grid">
        <div>
          <a href="${prefix}index.html" class="logo footer-logo" aria-label="Orbita24 Startseite">
            <img src="${prefix}images/logo-orbita24.svg" alt="Orbita24 Logo" class="logo-img" />
          </a>
          <p class="footer-text">
            Informationen und einfache Lösungen rund um verschiedene Dienstleistungen und Angebote.
          </p>
          <p class="footer-note">Unabhängige Informationen. Klar und verständlich aufbereitet.</p>
          <p class="footer-contact">
            <a href="mailto:kontakt@orbita24.de">kontakt@orbita24.de</a>
          </p>
        </div>

        <div class="footer-links">
          <div class="footer-link-group">
            <span>NAVIGATION</span>
            <a href="${prefix}about.html">Über uns</a>
            <a href="${prefix}kontakt.html">Kontakt</a>
          </div>
          <div class="footer-link-group">
            <span>RECHTLICHES</span>
            <a href="${prefix}impressum.html">Impressum</a>
            <a href="${prefix}datenschutz.html">Datenschutz</a>
          </div>
        </div>
      </div>
      <p class="footer-copy">© 2026 Orbita24. Alle Rechte vorbehalten.</p>
    </footer>
"@
}

function Get-Head([string]$prefix, [string]$title, [string]$description, [string]$canonical) {
@"
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>$title - Orbita24</title>
    <meta name="description" content="$description" />
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#111827" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="de_DE" />
    <meta property="og:site_name" content="Orbita24" />
    <meta property="og:title" content="$title - Orbita24" />
    <meta property="og:description" content="$description" />
    <meta property="og:url" content="$canonical" />
    <meta property="og:image" content="https://orbita24.de/images/hero-bg.webp" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="$title - Orbita24" />
    <meta name="twitter:description" content="$description" />
    <meta name="twitter:image" content="https://orbita24.de/images/hero-bg.webp" />
    <link rel="canonical" href="$canonical" />
    <link rel="icon" type="image/png" sizes="32x32" href="${prefix}favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="${prefix}favicon-16x16.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="${prefix}apple-touch-icon.png" />
    <link rel="manifest" href="${prefix}site.webmanifest" />
    <link rel="stylesheet" href="${prefix}css/style.css" />
    <link rel="stylesheet" href="${prefix}css/optionen-structure.css" />
  </head>
"@
}

function Get-Shell([string]$prefix, [string]$title, [string]$description, [string]$canonical, [string]$main) {
  $head = Get-Head $prefix $title $description $canonical
  $header = Get-Header $prefix
  $footer = Get-Footer $prefix
@"
<!doctype html>
<html lang="de">
$head
  <body class="optionen-structure-page">
    <div class="site-bg" aria-hidden="true"></div>

$header

$main

$footer

    <script src="${prefix}js/script.js"></script>
  </body>
</html>
"@
}

function Write-Utf8File([string]$path, [string]$content) {
  $directory = Split-Path -Parent $path
  if (!(Test-Path $directory)) {
    New-Item -ItemType Directory -Path $directory | Out-Null
  }
  [System.IO.File]::WriteAllText($path, $content, [System.Text.UTF8Encoding]::new($false))
}

function Get-ItemIcon($item) {
  $inner = switch ($item.slug) {
    "kredit" {
@"
                    <circle cx="64" cy="64" r="34" />
                    <path d="M76 45H58c-10 0-18 8-18 19s8 19 18 19h18" />
                    <path d="M46 58h28" />
                    <path d="M46 70h28" />
"@
    }
    "girokonto" {
@"
                    <path d="M28 52h72" />
                    <path d="M36 52v44" />
                    <path d="M92 52v44" />
                    <path d="M28 96h72" />
                    <path d="M64 24l42 28H22l42-28z" />
                    <path d="M52 64v20" />
                    <path d="M76 64v20" />
"@
    }
    "kreditkarte" {
@"
                    <rect x="22" y="38" width="84" height="52" rx="8" />
                    <path d="M22 56h84" />
                    <path d="M40 74h18" />
                    <path d="M74 74h14" />
"@
    }
    "tagesgeld" {
@"
                    <path d="M30 88h68" />
                    <path d="M38 78l18-20 14 12 24-30" />
                    <path d="M82 40h12v12" />
                    <circle cx="44" cy="42" r="9" />
"@
    }
    "festgeld" {
@"
                    <rect x="30" y="42" width="68" height="50" rx="7" />
                    <path d="M44 42V30h40v12" />
                    <circle cx="64" cy="66" r="10" />
                    <path d="M64 76v8" />
"@
    }
    "schufa-freundliche-finanzoptionen" {
@"
                    <rect x="32" y="32" width="64" height="64" rx="10" />
                    <path d="M48 66l12 12 24-28" />
"@
    }
    "kfz-versicherung" {
@"
                    <path d="M30 72l8-24h52l8 24" />
                    <rect x="24" y="66" width="80" height="26" rx="7" />
                    <circle cx="42" cy="92" r="6" />
                    <circle cx="86" cy="92" r="6" />
"@
    }
    "haftpflichtversicherung" {
@"
                    <circle cx="64" cy="52" r="18" />
                    <path d="M34 102c5-20 16-30 30-30s25 10 30 30" />
                    <path d="M86 34l10-10" />
"@
    }
    "hausratversicherung" {
@"
                    <path d="M24 60l40-32 40 32" />
                    <path d="M36 58v44h56V58" />
                    <path d="M52 102V76h24v26" />
"@
    }
    "rechtsschutzversicherung" {
@"
                    <path d="M64 26v70" />
                    <path d="M36 44h56" />
                    <path d="M42 44l-14 28h28L42 44z" />
                    <path d="M86 44L72 72h28L86 44z" />
"@
    }
    "krankenversicherung-optionen" {
@"
                    <path d="M64 28v72" />
                    <path d="M28 64h72" />
                    <rect x="28" y="28" width="72" height="72" rx="14" />
"@
    }
    "versicherungen-vergleichen" {
@"
                    <path d="M34 42h58" />
                    <path d="M34 64h58" />
                    <path d="M34 86h58" />
                    <path d="M26 42l4 4 8-10" />
                    <path d="M26 64l4 4 8-10" />
                    <path d="M26 86l4 4 8-10" />
"@
    }
    "jobmoeglichkeiten-finden" {
@"
                    <rect x="26" y="40" width="76" height="54" rx="8" />
                    <path d="M48 40v-8h32v8" />
                    <path d="M26 60h76" />
                    <path d="M64 74v10" />
"@
    }
    "nebenverdienst-optionen" {
@"
                    <circle cx="50" cy="58" r="18" />
                    <circle cx="76" cy="76" r="18" />
                    <path d="M50 50v16" />
                    <path d="M76 68v16" />
"@
    }
    "weiterbildung-umschulung" {
@"
                    <path d="M24 46l40-18 40 18-40 18-40-18z" />
                    <path d="M40 58v22c12 10 36 10 48 0V58" />
                    <path d="M104 46v24" />
"@
    }
    "bewerbung-karrierehilfen" {
@"
                    <rect x="34" y="24" width="60" height="80" rx="7" />
                    <path d="M48 48h32" />
                    <path d="M48 64h32" />
                    <path d="M48 80h20" />
"@
    }
    "einkommen-verbessern" {
@"
                    <path d="M30 92h68" />
                    <path d="M38 82l18-18 16 10 24-32" />
                    <path d="M84 42h12v12" />
                    <path d="M42 48h22" />
"@
    }
    "berufliche-neuorientierung" {
@"
                    <path d="M34 34h38c16 0 28 12 28 28s-12 28-28 28H42" />
                    <path d="M52 74L34 90l18 16" />
                    <path d="M78 50l18 12-18 12" />
"@
    }
    "stromanbieter-vergleichen" {
@"
                    <path d="M70 18L42 68h24l-8 42 32-56H66l4-36z" />
                    <path d="M32 104h64" />
"@
    }
    "gasanbieter-vergleichen" {
@"
                    <path d="M64 22c18 20 28 34 28 52 0 18-12 32-28 32S36 92 36 74c0-18 10-32 28-52z" />
                    <path d="M64 72c8 8 12 14 12 22 0 8-5 14-12 14s-12-6-12-14c0-8 4-14 12-22z" />
"@
    }
    "heizkosten-senken" {
@"
                    <path d="M48 28v44" />
                    <path d="M40 36h16" />
                    <path d="M40 52h16" />
                    <path d="M48 72c-10 6-14 14-14 22 0 11 8 18 18 18s18-7 18-18c0-8-4-16-14-22" />
                    <path d="M82 42l16 16-16 16" />
"@
    }
    "haushaltskosten-optimieren" {
@"
                    <path d="M28 56h72" />
                    <path d="M36 56l8 48h40l8-48" />
                    <path d="M52 56V38h24v18" />
                    <path d="M52 78h24" />
"@
    }
    "umzug-versorgung-anmelden" {
@"
                    <rect x="28" y="52" width="52" height="40" rx="6" />
                    <path d="M80 64h18v28H80" />
                    <circle cx="42" cy="96" r="6" />
                    <circle cx="86" cy="96" r="6" />
                    <path d="M42 36h44" />
"@
    }
    "energie-sparen-im-alltag" {
@"
                    <path d="M64 24c22 18 34 36 34 52 0 18-14 32-34 32S30 94 30 76c0-16 12-34 34-52z" />
                    <path d="M52 76c12-2 22-10 30-24" />
                    <path d="M52 76c2 14 10 24 22 30" />
"@
    }
    "internetanschluss-vergleichen" {
@"
                    <rect x="24" y="30" width="80" height="50" rx="7" />
                    <path d="M54 98h20" />
                    <path d="M64 80v18" />
                    <path d="M42 50h44" />
"@
    }
    "mobilfunkvertraege-vergleichen" {
@"
                    <rect x="42" y="20" width="44" height="88" rx="8" />
                    <path d="M54 34h20" />
                    <path d="M58 94h12" />
                    <path d="M50 76h28" />
"@
    }
    "dsl-oder-glasfaser-optionen" {
@"
                    <path d="M34 80c16-16 44-16 60 0" />
                    <path d="M46 64c10-10 26-10 36 0" />
                    <path d="M58 48c4-4 8-4 12 0" />
                    <path d="M64 80v24" />
"@
    }
    "sim-only-tarife" {
@"
                    <path d="M42 24h32l18 18v62H42V24z" />
                    <path d="M74 24v20h18" />
                    <path d="M54 66h26" />
                    <path d="M54 82h18" />
"@
    }
    "vertraege-pruefen-und-wechseln" {
@"
                    <rect x="32" y="24" width="54" height="78" rx="7" />
                    <path d="M48 48h24" />
                    <path d="M48 64h24" />
                    <path d="M82 78l16 10-16 10" />
"@
    }
    "streaming-zusatzpakete" {
@"
                    <rect x="24" y="34" width="80" height="58" rx="8" />
                    <path d="M58 52l22 12-22 12V52z" />
                    <path d="M44 104h40" />
"@
    }
    "angebote-vergleichen" {
@"
                    <path d="M28 34h48l24 24-48 48-24-24 48-48z" />
                    <circle cx="58" cy="54" r="6" />
                    <path d="M44 82l20-20" />
"@
    }
    "tarife-vergleichen" {
@"
                    <path d="M36 34h56" />
                    <path d="M36 64h56" />
                    <path d="M36 94h56" />
                    <circle cx="48" cy="34" r="8" />
                    <circle cx="76" cy="64" r="8" />
                    <circle cx="58" cy="94" r="8" />
"@
    }
    "monatliche-kosten-senken" {
@"
                    <path d="M30 44h68" />
                    <path d="M40 44v54h48V44" />
                    <path d="M50 72h28" />
                    <path d="M64 60v24" />
                    <path d="M82 26l18 18" />
"@
    }
    "beliebte-optionen-im-ueberblick" {
@"
                    <path d="M64 24l12 26 28 4-20 20 5 28-25-14-25 14 5-28-20-20 28-4 12-26z" />
"@
    }
    "empfohlene-loesungen-nach-bedarf" {
@"
                    <circle cx="64" cy="64" r="34" />
                    <path d="M64 42v22l16 10" />
                    <path d="M40 100l-10 12" />
                    <path d="M88 100l10 12" />
"@
    }
    "schnellvergleich-fuer-einsteiger" {
@"
                    <path d="M28 40h72" />
                    <path d="M28 64h72" />
                    <path d="M28 88h72" />
                    <path d="M88 34l12 6-12 6" />
                    <path d="M88 58l12 6-12 6" />
                    <path d="M88 82l12 6-12 6" />
"@
    }
    default {
@"
                    <rect x="24" y="24" width="26" height="26" rx="5" />
                    <rect x="78" y="24" width="26" height="26" rx="5" />
                    <rect x="24" y="78" width="26" height="26" rx="5" />
                    <rect x="78" y="78" width="26" height="26" rx="5" />
"@
    }
  }

@"
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" fill="none">
                  <g stroke="#ff5a1f" stroke-width="6" stroke-linecap="round" stroke-linejoin="round">
$inner
                  </g>
                </svg>
"@
}

function Get-CategoryPage($category) {
  $prefix = Get-RelativePrefix 2
  $cards = foreach ($item in $category.items) {
    $href = "./$($item.slug)/"
    $icon = Get-ItemIcon $item
    $label = if ($item.ContainsKey("label")) { $item.label } else { "Einfach erklärt" }
@"
            <a href="$href" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
$icon
                </span>
                <span class="structure-card-meta">$label</span>
              </span>
              <h3>$($item.title)</h3>
              <p>$($item.text)</p>
              <span class="structure-link" aria-hidden="true">→</span>
            </a>
"@
  }
  $cardsHtml = $cards -join "`n"
  $title = "$($category.title) im Überblick"
  $description = $category.intro
  $canonical = "https://orbita24.de/optionen/$($category.slug)/"
  $main = @"
    <main>
      <section class="section structure-section">
        <div class="container structure-container">
          <nav class="structure-breadcrumb" aria-label="Breadcrumb">
            <a href="${prefix}optionen.html">Optionen</a>
            <span style="color: #ff5a1f">$($category.title)</span>
          </nav>

          <div class="structure-header">
            <h1>$title</h1>
            <p>$($category.intro)</p>
          </div>

          <div class="structure-grid">
$cardsHtml
          </div>

          <article class="card structure-final">
            <h2>Passende Optionen entdecken</h2>
            <p>Wählen Sie ein Thema und entdecken Sie die nächsten Schritte in Ruhe.</p>
          </article>
        </div>
      </section>
    </main>
"@
  Get-Shell $prefix $title $description $canonical $main
}

function Get-PrelandingPage($category, $item) {
  $prefix = Get-RelativePrefix 3
  $title = "$($item.title) vergleichen"
  $description = "$($item.title): neutrale Orientierung, wichtige Vergleichspunkte und nächste Schritte bei Orbita24."
  $canonical = "https://orbita24.de/optionen/$($category.slug)/$($item.slug)/"
  $main = @"
    <main>
      <section class="section structure-section">
        <div class="container structure-container">
          <nav class="structure-breadcrumb" aria-label="Breadcrumb">
            <a href="${prefix}optionen.html">Optionen</a>
            <a href="../">$($category.title)</a>
            <span>$($item.title)</span>
          </nav>

          <div class="structure-header">
            <p class="eyebrow">$($category.title.ToUpper())</p>
            <h1>$title</h1>
            <p>$($item.text) Diese Seite hilft Ihnen, wichtige Punkte einzuordnen und den nächsten Schritt ruhiger zu planen.</p>
          </div>

          <div class="structure-content-grid">
            <article class="card structure-content-card">
              <h2>Für wen ist diese Option interessant?</h2>
              <p>Diese Option ist interessant, wenn Sie sich einen klaren Überblick verschaffen möchten, bevor Sie konkrete Angebote oder Anbieter prüfen.</p>
            </article>

            <article class="card structure-content-card">
              <h2>Worauf sollte man achten?</h2>
              <p>Achten Sie auf Kosten, Laufzeiten, Bedingungen und darauf, ob die Lösung wirklich zu Ihrer persönlichen Situation passt.</p>
            </article>

            <article class="card structure-content-card">
              <h2>Typische Vergleichsaspekte</h2>
              <p>Wichtige Unterschiede zeigen sich häufig bei Preis, Leistung, Flexibilität, Verfügbarkeit und langfristiger Planbarkeit.</p>
            </article>

            <article class="card structure-content-card">
              <h2>Nächste Schritte</h2>
              <p>Notieren Sie Ihren Bedarf, vergleichen Sie mehrere Möglichkeiten und prüfen Sie Details, bevor Sie eine Entscheidung treffen.</p>
            </article>
          </div>

          <section class="card structure-cta" aria-labelledby="next-step-title">
            <div>
              <h2 id="next-step-title">Passende Möglichkeiten vergleichen</h2>
              <p>Nutzen Sie die Übersicht als Ausgangspunkt, um Optionen ruhig und nachvollziehbar zu prüfen.</p>
            </div>
            <a href="../" class="btn btn-secondary">Zur Kategorie</a>
          </section>
        </div>
      </section>
    </main>
"@
  Get-Shell $prefix $title $description $canonical $main
}

$css = @"
.optionen-structure-page .structure-section {
  padding-top: 32px;
  padding-bottom: 40px;
}

.optionen-structure-page .structure-container {
  width: min(100% - 32px, 1180px);
}

.structure-breadcrumb {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 24px;
  color: var(--muted);
  font-size: 0.9rem;
}

.structure-breadcrumb a {
  color: var(--text-strong);
  text-decoration: underline;
  text-underline-offset: 4px;
}

.structure-breadcrumb span::before {
  content: "/";
  margin-right: 8px;
  color: var(--muted);
}

.structure-header {
  max-width: 740px;
  margin-bottom: 28px;
}

.structure-header h1 {
  margin: 0 0 10px;
  color: var(--text-strong);
  font-size: clamp(1.9rem, 3.2vw, 2.7rem);
  line-height: 1.08;
}

.structure-header p:not(.eyebrow) {
  max-width: 680px;
  margin: 0;
  color: var(--muted);
  font-size: 1rem;
  line-height: 1.55;
}

.structure-info,
.structure-note,
.structure-final,
.structure-content-card,
.structure-cta {
  padding: 22px;
  background: #ffffff;
}

.structure-info {
  margin-bottom: 22px;
}

.structure-info h2,
.structure-note h2,
.structure-final h2,
.structure-content-card h2,
.structure-cta h2 {
  margin: 0 0 8px;
  color: var(--text-strong);
  font-size: 1.25rem;
  line-height: 1.2;
}

.structure-info p,
.structure-note p,
.structure-final p,
.structure-content-card p,
.structure-cta p,
.structure-card p {
  margin: 0;
  color: var(--muted);
  line-height: 1.55;
}

.structure-grid,
.structure-content-grid {
  display: grid;
  gap: 18px;
}

.structure-grid {
  margin-bottom: 28px;
}

.structure-card {
  min-height: 100%;
  padding: 20px;
  display: flex;
  flex-direction: column;
  color: inherit;
  text-decoration: none;
  background: #ffffff;
  cursor: pointer;
}

.structure-card-top {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 14px;
  margin-bottom: 14px;
}

.structure-card-icon {
  width: 40px;
  height: 40px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex: 0 0 auto;
  transition: transform 0.2s ease, filter 0.2s ease;
}

.structure-card-icon svg {
  width: 40px;
  height: 40px;
  display: block;
}

.structure-card:hover,
.structure-card:focus-visible {
  transform: translateY(-4px);
  box-shadow:
    0 10px 25px rgba(0, 0, 0, 0.08),
    var(--glow-orange);
  border-color: rgba(255, 90, 31, 0.18);
}

.structure-card:hover .structure-card-icon,
.structure-card:focus-visible .structure-card-icon {
  transform: translateY(-2px);
  filter: drop-shadow(0 6px 10px rgba(255, 90, 31, 0.12));
}

.structure-card-meta {
  width: max-content;
  max-width: calc(100% - 48px);
  padding: 3px 7px;
  border-radius: 999px;
  color: #1f7a5a;
  background: rgba(0, 255, 136, 0.06);
  border: 1px solid rgba(0, 255, 136, 0.12);
  font-size: 0.65625rem;
  font-weight: 500;
  line-height: 1.2;
  white-space: nowrap;
}

.structure-final {
  margin-bottom: 35px;
  padding: 20px 22px;
}

.structure-card h3 {
  margin: 0 0 6px;
  color: var(--text-strong);
  font-size: 1.125rem;
  font-weight: 700;
  line-height: 1.2;
}

.structure-card p {
  flex: 1 1 auto;
  font-size: 0.875rem;
  line-height: 1.5;
}

.structure-link {
  width: max-content;
  margin-top: 18px;
  color: var(--text-strong);
  font-size: 1.25rem;
  font-weight: 600;
  line-height: 1;
  text-decoration: none;
  transition: color 0.2s ease, transform 0.2s ease;
}

.structure-card:hover .structure-link,
.structure-card:focus-visible .structure-link {
  color: #ff5a1f;
  transform: translateX(3px);
}

.structure-split {
  display: grid;
  gap: 18px;
}

.structure-content-grid {
  margin-bottom: 28px;
}

.structure-cta {
  display: grid;
  gap: 18px;
  align-items: center;
}

.structure-cta .btn {
  width: 100%;
  background: #ffffff;
  border-color: rgba(17, 24, 39, 0.14);
  color: var(--text-strong);
}

.structure-cta .btn:hover,
.structure-cta .btn:focus-visible {
  color: #ffffff;
  background: #ff5a1f;
  border-color: #ff5a1f;
}

@media (min-width: 768px) {
  .structure-grid,
  .structure-content-grid,
  .structure-split {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .structure-cta {
    grid-template-columns: 1fr minmax(220px, 280px);
  }
}

@media (min-width: 1120px) {
  .structure-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

@media (max-width: 767px) {
  .optionen-structure-page .structure-section {
    padding-top: 28px;
    padding-bottom: 32px;
  }

  .structure-final {
    margin-bottom: 26px;
  }
}
"@

Write-Utf8File (Join-Path $root "css\optionen-structure.css") $css

foreach ($category in $categories) {
  $categoryPath = Join-Path $root "optionen\$($category.slug)\index.html"
  Write-Utf8File $categoryPath (Get-CategoryPage $category)

  if ($Mode -eq "all") {
    foreach ($item in $category.items) {
      $itemPath = Join-Path $root "optionen\$($category.slug)\$($item.slug)\index.html"
      Write-Utf8File $itemPath (Get-PrelandingPage $category $item)
    }
  }
}

if ($Mode -eq "all") {
  $sitemapUrls = @(
    "https://orbita24.de/",
    "https://orbita24.de/optionen.html",
    "https://orbita24.de/about.html",
    "https://orbita24.de/kontakt.html",
    "https://orbita24.de/impressum.html",
    "https://orbita24.de/datenschutz.html"
  )

  foreach ($category in $categories) {
    $sitemapUrls += "https://orbita24.de/optionen/$($category.slug)/"
    foreach ($item in $category.items) {
      $sitemapUrls += "https://orbita24.de/optionen/$($category.slug)/$($item.slug)/"
    }
  }

  $sitemapEntries = ($sitemapUrls | ForEach-Object {
@"
  <url>
    <loc>$_</loc>
  </url>
"@
  }) -join "`n"

  $sitemap = @"
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
$sitemapEntries
</urlset>
"@

  Write-Utf8File (Join-Path $root "sitemap.xml") $sitemap
}

if ($Mode -eq "categories") {
  Write-Output "Generated $($categories.Count) category pages."
} else {
  Write-Output "Generated $($categories.Count) category pages and $($categories.items.Count) prelanding pages."
}















