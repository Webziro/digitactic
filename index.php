<?php
require_once __DIR__ . '/db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fetch all content into a cache array to optimize performance
$content_cache = [];
if ($conn) {
  $result = $conn->query('SELECT section_key, content FROM editable_content');
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      $content_cache[$row['section_key']] = $row['content'];
    }
  }
}

// Optimized function with cache
function get_content($key, $conn, $fallback = '')
{
  global $content_cache;
  return (isset($content_cache[$key]) && $content_cache[$key] !== '') ? $content_cache[$key] : $fallback;
}
?>
<!doctype html>
<html class="first--load ajax--first" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <title>Creative Agency &#8211; Digitactic</title>
  <meta name='robots' content='max-image-preview:large' />
  <meta name="description" content="We Build to scale, not just to work - Digitactic">
  <meta name="keywords"
    content="digitactic, creative agency, web development, software scaling, digital marketing, ui/ux design, brand identity, tech solutions, build to scale">
  <style>
    img:is([sizes="auto" i], [sizes^="auto," i]) {
      contain-intrinsic-size: 3000px 1500px
    }
  </style>
  <link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
  <link rel='preconnect' href='https://fonts.gstatic.com/' crossorigin />
  <link rel="alternate" type="application/rss+xml" title="Creative Agency &raquo; Feed" href="feed/index.html" />
  <link rel="alternate" type="application/rss+xml" title="Creative Agency &raquo; Comments Feed"
    href="comments/feed/index.html" />
  <style id='global-styles-inline-css'>
    :root {
      --wp--preset--aspect-ratio--square: 1;
      --wp--preset--aspect-ratio--4-3: 4/3;
      --wp--preset--aspect-ratio--3-4: 3/4;
      --wp--preset--aspect-ratio--3-2: 3/2;
      --wp--preset--aspect-ratio--2-3: 2/3;
      --wp--preset--aspect-ratio--16-9: 16/9;
      --wp--preset--aspect-ratio--9-16: 9/16;
      --wp--preset--color--black: #000000;
      --wp--preset--color--cyan-bluish-gray: #abb8c3;
      --wp--preset--color--white: #ffffff;
      --wp--preset--color--pale-pink: #f78da7;
      --wp--preset--color--vivid-red: #cf2e2e;
      --wp--preset--color--luminous-vivid-orange: #ff6900;
      --wp--preset--color--luminous-vivid-amber: #fcb900;
      --wp--preset--color--light-green-cyan: #7bdcb5;
      --wp--preset--color--vivid-green-cyan: #00d084;
      --wp--preset--color--pale-cyan-blue: #8ed1fc;
      --wp--preset--color--vivid-cyan-blue: #0693e3;
      --wp--preset--color--vivid-purple: #9b51e0;
      --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
      --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
      --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
      --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
      --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
      --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
      --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
      --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
      --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
      --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
      --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
      --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
      --wp--preset--font-size--small: 13px;
      --wp--preset--font-size--medium: 20px;
      --wp--preset--font-size--large: 36px;
      --wp--preset--font-size--x-large: 42px;
      --wp--preset--spacing--20: 0.44rem;
      --wp--preset--spacing--30: 0.67rem;
      --wp--preset--spacing--40: 1rem;
      --wp--preset--spacing--50: 1.5rem;
      --wp--preset--spacing--60: 2.25rem;
      --wp--preset--spacing--70: 3.38rem;
      --wp--preset--spacing--80: 5.06rem;
      --wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);
      --wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);
      --wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);
      --wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);
      --wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);
    }

    :where(.is-layout-flex) {
      gap: 0.5em;
    }

    :where(.is-layout-grid) {
      gap: 0.5em;
    }

    body .is-layout-flex {
      display: flex;
    }

    .is-layout-flex {
      flex-wrap: wrap;
      align-items: center;
    }

    .is-layout-flex> :is(*, div) {
      margin: 0;
    }

    body .is-layout-grid {
      display: grid;
    }

    .is-layout-grid> :is(*, div) {
      margin: 0;
    }

    :where(.wp-block-columns.is-layout-flex) {
      gap: 2em;
    }

    :where(.wp-block-columns.is-layout-grid) {
      gap: 2em;
    }

    :where(.wp-block-post-template.is-layout-flex) {
      gap: 1.25em;
    }

    :where(.wp-block-post-template.is-layout-grid) {
      gap: 1.25em;
    }

    .has-black-color {
      color: var(--wp--preset--color--black) !important;
    }

    .has-cyan-bluish-gray-color {
      color: var(--wp--preset--color--cyan-bluish-gray) !important;
    }

    .has-white-color {
      color: var(--wp--preset--color--white) !important;
    }

    .has-pale-pink-color {
      color: var(--wp--preset--color--pale-pink) !important;
    }

    .has-vivid-red-color {
      color: var(--wp--preset--color--vivid-red) !important;
    }

    .has-luminous-vivid-orange-color {
      color: var(--wp--preset--color--luminous-vivid-orange) !important;
    }

    .has-luminous-vivid-amber-color {
      color: var(--wp--preset--color--luminous-vivid-amber) !important;
    }

    .has-light-green-cyan-color {
      color: var(--wp--preset--color--light-green-cyan) !important;
    }

    .has-vivid-green-cyan-color {
      color: var(--wp--preset--color--vivid-green-cyan) !important;
    }

    .has-pale-cyan-blue-color {
      color: var(--wp--preset--color--pale-cyan-blue) !important;
    }

    .has-vivid-cyan-blue-color {
      color: var(--wp--preset--color--vivid-cyan-blue) !important;
    }

    .has-vivid-purple-color {
      color: var(--wp--preset--color--vivid-purple) !important;
    }

    .has-black-background-color {
      background-color: var(--wp--preset--color--black) !important;
    }

    .has-cyan-bluish-gray-background-color {
      background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
    }

    .has-white-background-color {
      background-color: var(--wp--preset--color--white) !important;
    }

    .has-pale-pink-background-color {
      background-color: var(--wp--preset--color--pale-pink) !important;
    }

    .has-vivid-red-background-color {
      background-color: var(--wp--preset--color--vivid-red) !important;
    }

    .has-luminous-vivid-orange-background-color {
      background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
    }

    .has-luminous-vivid-amber-background-color {
      background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
    }

    .has-light-green-cyan-background-color {
      background-color: var(--wp--preset--color--light-green-cyan) !important;
    }

    .has-vivid-green-cyan-background-color {
      background-color: var(--wp--preset--color--vivid-green-cyan) !important;
    }

    .has-pale-cyan-blue-background-color {
      background-color: var(--wp--preset--color--pale-cyan-blue) !important;
    }

    .has-vivid-cyan-blue-background-color {
      background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
    }

    .has-vivid-purple-background-color {
      background-color: var(--wp--preset--color--vivid-purple) !important;
    }

    .has-black-border-color {
      border-color: var(--wp--preset--color--black) !important;
    }

    .has-cyan-bluish-gray-border-color {
      border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
    }

    .has-white-border-color {
      border-color: var(--wp--preset--color--white) !important;
    }

    .has-pale-pink-border-color {
      border-color: var(--wp--preset--color--pale-pink) !important;
    }

    .has-vivid-red-border-color {
      border-color: var(--wp--preset--color--vivid-red) !important;
    }

    .has-luminous-vivid-orange-border-color {
      border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
    }

    .has-luminous-vivid-amber-border-color {
      border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
    }

    .has-light-green-cyan-border-color {
      border-color: var(--wp--preset--color--light-green-cyan) !important;
    }

    .has-vivid-green-cyan-border-color {
      border-color: var(--wp--preset--color--vivid-green-cyan) !important;
    }

    .has-pale-cyan-blue-border-color {
      border-color: var(--wp--preset--color--pale-cyan-blue) !important;
    }

    .has-vivid-cyan-blue-border-color {
      border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
    }

    .has-vivid-purple-border-color {
      border-color: var(--wp--preset--color--vivid-purple) !important;
    }

    .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
      background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
    }

    .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
      background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
    }

    .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
      background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
    }

    .has-luminous-vivid-orange-to-vivid-red-gradient-background {
      background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
    }

    .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
      background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
    }

    .has-cool-to-warm-spectrum-gradient-background {
      background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
    }

    .has-blush-light-purple-gradient-background {
      background: var(--wp--preset--gradient--blush-light-purple) !important;
    }

    .has-blush-bordeaux-gradient-background {
      background: var(--wp--preset--gradient--blush-bordeaux) !important;
    }

    .has-luminous-dusk-gradient-background {
      background: var(--wp--preset--gradient--luminous-dusk) !important;
    }

    .has-pale-ocean-gradient-background {
      background: var(--wp--preset--gradient--pale-ocean) !important;
    }

    .has-electric-grass-gradient-background {
      background: var(--wp--preset--gradient--electric-grass) !important;
    }

    .has-midnight-gradient-background {
      background: var(--wp--preset--gradient--midnight) !important;
    }

    .has-small-font-size {
      font-size: var(--wp--preset--font-size--small) !important;
    }

    .has-medium-font-size {
      font-size: var(--wp--preset--font-size--medium) !important;
    }

    .has-large-font-size {
      font-size: var(--wp--preset--font-size--large) !important;
    }

    .has-x-large-font-size {
      font-size: var(--wp--preset--font-size--x-large) !important;
    }

    :where(.wp-block-post-template.is-layout-flex) {
      gap: 1.25em;
    }

    :where(.wp-block-post-template.is-layout-grid) {
      gap: 1.25em;
    }

    :where(.wp-block-columns.is-layout-flex) {
      gap: 2em;
    }

    :where(.wp-block-columns.is-layout-grid) {
      gap: 2em;
    }

    :root :where(.wp-block-pullquote) {
      font-size: 1.5em;
      line-height: 1.6;
    }
  </style>
  <link rel="preload" as="style"
    href="https://fonts.googleapis.com/css?family=Italiana:400&amp;display=swap&amp;ver=1767655063" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Italiana:400&amp;display=swap&amp;ver=1767655063"
    media="print" onload="this.media='all'"><noscript>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Italiana:400&amp;display=swap&amp;ver=1767655063" />
  </noscript>
  <link rel='stylesheet' id='elementor-gf-roboto-css'
    href='https://fonts.googleapis.com/css?family=Roboto:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;display=auto'
    media='all' />
  <link rel='stylesheet' id='elementor-gf-robotoslab-css'
    href='https://fonts.googleapis.com/css?family=Roboto+Slab:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;display=auto'
    media='all' />
  <link rel="https://api.w.org/" href="wp-json/index.html" />
  <link rel="alternate" title="JSON" type="application/json" href="wp-json/wp/v2/pages/15366.json" />
  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="xmlrpc0db0.html?rsd" />
  <meta name="generator" content="WordPress 6.8.3" />
  <link rel="canonical" href="index.html" />
  <link rel='shortlink' href='index.html' />
  <link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed"
    href="wp-json/oembed/1.0/embed4c3a.json?url=https%3A%2F%2Fzeyna.pethemes.com%2Fcreative-agency%2F" />
  <link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed"
    href="wp-json/oembed/1.0/embedf99a?url=https%3A%2F%2Fzeyna.pethemes.com%2Fcreative-agency%2F&amp;format=xml" />
  <meta name="generator" content="Redux 4.5.10" />
  <meta name="generator"
    content="Elementor 3.35.5; features: e_font_icon_svg, additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-auto">
  <link rel="icon" href="wp-content/uploads/sites/12/2025/11/digitactic_bg.png" sizes="32x32" />
  <link rel="icon" href="wp-content/uploads/sites/12/2025/11/digitactic_bg.png" sizes="192x192" />
  <link rel="apple-touch-icon" href="wp-content/uploads/sites/12/2025/11/digitactic_bg.png" />
  <meta name="msapplication-TileImage" content="wp-content/uploads/sites/12/2025/11/digitactic_bg.png" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-zeyna-css-plugins1c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-themes-zeyna-style1c34.css?ver=1772160162"
    rel="stylesheet" />
  <style type="text/css" media="all">
    img.wp-smiley,
    img.emoji {
      display: inline !important;
      border: none !important;
      box-shadow: none !important;
      height: 1em !important;
      width: 1em !important;
      margin: 0 0.07em !important;
      vertical-align: -0.1em !important;
      background: none !important;
      padding: 0 !important
    }
  </style>
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-inline_21c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-assets-fonts-fonts1c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-assets-css-frontend.min1c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-elementor-css-post-31c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-assets-css-widget-styles1c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-elementor-css-post-153661c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-material-icons-css-material-icons-regular1c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-inline_31c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-inline_41c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-inline_51c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-elementor-css-post-5531c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-elementor-css-post-4881c34.css?ver=1772160162"
    rel="stylesheet" />
  <link type="text/css" media="all"
    href="wp-content/cache/breeze-minification/12/css/breeze_zeyna-pethemes-com-creative-agency-12-15366-elementor-css-post-5471c34.css?ver=1772160162"
    rel="stylesheet" />
<style>.site-branding, .site-logo, .site-logo a, .elementor-widget-pesitelogo { width: auto !important; max-width: none !important; min-width: max-content !important; overflow: visible !important; flex-shrink: 0 !important; } .site-branding .site-logo img, .site-branding .sticky-logo img, .main__logo { height: 75px !important; width: auto !important; max-width: none !important; max-height: none !important; object-fit: contain !important; }.pe--scroll--button i, .pe--scroll--button .pe--icon--caption { color: #000 !important; }
.loader--caption { color: #000 !important; font-weight: bold !important; font-size: 15px !important; text-transform: uppercase !important; letter-spacing: 2px !important; }
</style>
<style id='loading-fix'>.responsive-hero-title .customized--word, .responsive-hero-title .elementor-repeater-item-806b59e, .customized--word, .elementor-element-7ebdfb70, .elementor-element-7ebdfb70 *, .md-language { color: #D6A94E !important; } .responsive-hero-title .customized--word *, .customized--word * { color: #D6A94E !important; } h1, h2, h3, h4, h5, h6, .elementor-heading-title, p, a, span:not(.customized--word):not(.elementor-repeater-item-cc61341) { color: #fff !important; } .page--loader--block, .page--transition--block, .container--bg, .page--loader, .page--transitions { background-color: #e5d3a1 !important; }</style>
</head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G8QKS6RS1E"></script>
<script>window.dataLayer = window.dataLayer || [];
  function gtag() { dataLayer.push(arguments); }
  gtag('js', new Date());

  gtag('config', 'G-G8QKS6RS1E');</script>

<body
  class="home wp-singular page-template-default page page-id-15366 wp-theme-zeyna page--loader--active page--transitions--active show--footer layout--default loader__blocks smooth-scroll lenis-scroll-vertical elementor-default elementor-kit-3 elementor-page elementor-page-15366"
  data-barba="wrapper"> <span hidden class="layout--colors"></span>
  <div id="page" class="site"><a class="skip-link screen-reader-text" href="#primary">Skip to content</a>
    <div id="mouseCursor" class="cursor--circle "><svg height="100%" width="100%" viewbox="-1 -1 101 102">
        <circle class="main-circle" cx="50" cy="50" r="50" />
      </svg><span class="cursor-text"></span> <span class="cursor-icon"></span><span class="cursor--drag--icons">
      </span></div>
    <div data-stagger=random data-blocks-animation=right data-type="blocks" data-direction="up"
      class="page--transitions pt__blocks pt__   ">
      <div class="pt--wrapper pt__blocks-right"><span class="page--transition--block"
          style="--index: 0; --grid:225"></span><span class="page--transition--block"
          style="--index: 1; --grid:225"></span><span class="page--transition--block"
          style="--index: 2; --grid:225"></span><span class="page--transition--block"
          style="--index: 3; --grid:225"></span><span class="page--transition--block"
          style="--index: 4; --grid:225"></span><span class="page--transition--block"
          style="--index: 5; --grid:225"></span><span class="page--transition--block"
          style="--index: 6; --grid:225"></span><span class="page--transition--block"
          style="--index: 7; --grid:225"></span><span class="page--transition--block"
          style="--index: 8; --grid:225"></span><span class="page--transition--block"
          style="--index: 9; --grid:225"></span><span class="page--transition--block"
          style="--index: 10; --grid:225"></span><span class="page--transition--block"
          style="--index: 11; --grid:225"></span><span class="page--transition--block"
          style="--index: 12; --grid:225"></span><span class="page--transition--block"
          style="--index: 13; --grid:225"></span><span class="page--transition--block"
          style="--index: 14; --grid:225"></span><span class="page--transition--block"
          style="--index: 15; --grid:225"></span><span class="page--transition--block"
          style="--index: 16; --grid:225"></span><span class="page--transition--block"
          style="--index: 17; --grid:225"></span><span class="page--transition--block"
          style="--index: 18; --grid:225"></span><span class="page--transition--block"
          style="--index: 19; --grid:225"></span><span class="page--transition--block"
          style="--index: 20; --grid:225"></span><span class="page--transition--block"
          style="--index: 21; --grid:225"></span><span class="page--transition--block"
          style="--index: 22; --grid:225"></span><span class="page--transition--block"
          style="--index: 23; --grid:225"></span><span class="page--transition--block"
          style="--index: 24; --grid:225"></span><span class="page--transition--block"
          style="--index: 25; --grid:225"></span><span class="page--transition--block"
          style="--index: 26; --grid:225"></span><span class="page--transition--block"
          style="--index: 27; --grid:225"></span><span class="page--transition--block"
          style="--index: 28; --grid:225"></span><span class="page--transition--block"
          style="--index: 29; --grid:225"></span><span class="page--transition--block"
          style="--index: 30; --grid:225"></span><span class="page--transition--block"
          style="--index: 31; --grid:225"></span><span class="page--transition--block"
          style="--index: 32; --grid:225"></span><span class="page--transition--block"
          style="--index: 33; --grid:225"></span><span class="page--transition--block"
          style="--index: 34; --grid:225"></span><span class="page--transition--block"
          style="--index: 35; --grid:225"></span><span class="page--transition--block"
          style="--index: 36; --grid:225"></span><span class="page--transition--block"
          style="--index: 37; --grid:225"></span><span class="page--transition--block"
          style="--index: 38; --grid:225"></span><span class="page--transition--block"
          style="--index: 39; --grid:225"></span><span class="page--transition--block"
          style="--index: 40; --grid:225"></span><span class="page--transition--block"
          style="--index: 41; --grid:225"></span><span class="page--transition--block"
          style="--index: 42; --grid:225"></span><span class="page--transition--block"
          style="--index: 43; --grid:225"></span><span class="page--transition--block"
          style="--index: 44; --grid:225"></span><span class="page--transition--block"
          style="--index: 45; --grid:225"></span><span class="page--transition--block"
          style="--index: 46; --grid:225"></span><span class="page--transition--block"
          style="--index: 47; --grid:225"></span><span class="page--transition--block"
          style="--index: 48; --grid:225"></span><span class="page--transition--block"
          style="--index: 49; --grid:225"></span><span class="page--transition--block"
          style="--index: 50; --grid:225"></span><span class="page--transition--block"
          style="--index: 51; --grid:225"></span><span class="page--transition--block"
          style="--index: 52; --grid:225"></span><span class="page--transition--block"
          style="--index: 53; --grid:225"></span><span class="page--transition--block"
          style="--index: 54; --grid:225"></span><span class="page--transition--block"
          style="--index: 55; --grid:225"></span><span class="page--transition--block"
          style="--index: 56; --grid:225"></span><span class="page--transition--block"
          style="--index: 57; --grid:225"></span><span class="page--transition--block"
          style="--index: 58; --grid:225"></span><span class="page--transition--block"
          style="--index: 59; --grid:225"></span><span class="page--transition--block"
          style="--index: 60; --grid:225"></span><span class="page--transition--block"
          style="--index: 61; --grid:225"></span><span class="page--transition--block"
          style="--index: 62; --grid:225"></span><span class="page--transition--block"
          style="--index: 63; --grid:225"></span><span class="page--transition--block"
          style="--index: 64; --grid:225"></span><span class="page--transition--block"
          style="--index: 65; --grid:225"></span><span class="page--transition--block"
          style="--index: 66; --grid:225"></span><span class="page--transition--block"
          style="--index: 67; --grid:225"></span><span class="page--transition--block"
          style="--index: 68; --grid:225"></span><span class="page--transition--block"
          style="--index: 69; --grid:225"></span><span class="page--transition--block"
          style="--index: 70; --grid:225"></span><span class="page--transition--block"
          style="--index: 71; --grid:225"></span><span class="page--transition--block"
          style="--index: 72; --grid:225"></span><span class="page--transition--block"
          style="--index: 73; --grid:225"></span><span class="page--transition--block"
          style="--index: 74; --grid:225"></span><span class="page--transition--block"
          style="--index: 75; --grid:225"></span><span class="page--transition--block"
          style="--index: 76; --grid:225"></span><span class="page--transition--block"
          style="--index: 77; --grid:225"></span><span class="page--transition--block"
          style="--index: 78; --grid:225"></span><span class="page--transition--block"
          style="--index: 79; --grid:225"></span><span class="page--transition--block"
          style="--index: 80; --grid:225"></span><span class="page--transition--block"
          style="--index: 81; --grid:225"></span><span class="page--transition--block"
          style="--index: 82; --grid:225"></span><span class="page--transition--block"
          style="--index: 83; --grid:225"></span><span class="page--transition--block"
          style="--index: 84; --grid:225"></span><span class="page--transition--block"
          style="--index: 85; --grid:225"></span><span class="page--transition--block"
          style="--index: 86; --grid:225"></span><span class="page--transition--block"
          style="--index: 87; --grid:225"></span><span class="page--transition--block"
          style="--index: 88; --grid:225"></span><span class="page--transition--block"
          style="--index: 89; --grid:225"></span><span class="page--transition--block"
          style="--index: 90; --grid:225"></span><span class="page--transition--block"
          style="--index: 91; --grid:225"></span><span class="page--transition--block"
          style="--index: 92; --grid:225"></span><span class="page--transition--block"
          style="--index: 93; --grid:225"></span><span class="page--transition--block"
          style="--index: 94; --grid:225"></span><span class="page--transition--block"
          style="--index: 95; --grid:225"></span><span class="page--transition--block"
          style="--index: 96; --grid:225"></span><span class="page--transition--block"
          style="--index: 97; --grid:225"></span><span class="page--transition--block"
          style="--index: 98; --grid:225"></span><span class="page--transition--block"
          style="--index: 99; --grid:225"></span><span class="page--transition--block"
          style="--index: 100; --grid:225"></span><span class="page--transition--block"
          style="--index: 101; --grid:225"></span><span class="page--transition--block"
          style="--index: 102; --grid:225"></span><span class="page--transition--block"
          style="--index: 103; --grid:225"></span><span class="page--transition--block"
          style="--index: 104; --grid:225"></span><span class="page--transition--block"
          style="--index: 105; --grid:225"></span><span class="page--transition--block"
          style="--index: 106; --grid:225"></span><span class="page--transition--block"
          style="--index: 107; --grid:225"></span><span class="page--transition--block"
          style="--index: 108; --grid:225"></span><span class="page--transition--block"
          style="--index: 109; --grid:225"></span><span class="page--transition--block"
          style="--index: 110; --grid:225"></span><span class="page--transition--block"
          style="--index: 111; --grid:225"></span><span class="page--transition--block"
          style="--index: 112; --grid:225"></span><span class="page--transition--block"
          style="--index: 113; --grid:225"></span><span class="page--transition--block"
          style="--index: 114; --grid:225"></span><span class="page--transition--block"
          style="--index: 115; --grid:225"></span><span class="page--transition--block"
          style="--index: 116; --grid:225"></span><span class="page--transition--block"
          style="--index: 117; --grid:225"></span><span class="page--transition--block"
          style="--index: 118; --grid:225"></span><span class="page--transition--block"
          style="--index: 119; --grid:225"></span><span class="page--transition--block"
          style="--index: 120; --grid:225"></span><span class="page--transition--block"
          style="--index: 121; --grid:225"></span><span class="page--transition--block"
          style="--index: 122; --grid:225"></span><span class="page--transition--block"
          style="--index: 123; --grid:225"></span><span class="page--transition--block"
          style="--index: 124; --grid:225"></span><span class="page--transition--block"
          style="--index: 125; --grid:225"></span><span class="page--transition--block"
          style="--index: 126; --grid:225"></span><span class="page--transition--block"
          style="--index: 127; --grid:225"></span><span class="page--transition--block"
          style="--index: 128; --grid:225"></span><span class="page--transition--block"
          style="--index: 129; --grid:225"></span><span class="page--transition--block"
          style="--index: 130; --grid:225"></span><span class="page--transition--block"
          style="--index: 131; --grid:225"></span><span class="page--transition--block"
          style="--index: 132; --grid:225"></span><span class="page--transition--block"
          style="--index: 133; --grid:225"></span><span class="page--transition--block"
          style="--index: 134; --grid:225"></span><span class="page--transition--block"
          style="--index: 135; --grid:225"></span><span class="page--transition--block"
          style="--index: 136; --grid:225"></span><span class="page--transition--block"
          style="--index: 137; --grid:225"></span><span class="page--transition--block"
          style="--index: 138; --grid:225"></span><span class="page--transition--block"
          style="--index: 139; --grid:225"></span><span class="page--transition--block"
          style="--index: 140; --grid:225"></span><span class="page--transition--block"
          style="--index: 141; --grid:225"></span><span class="page--transition--block"
          style="--index: 142; --grid:225"></span><span class="page--transition--block"
          style="--index: 143; --grid:225"></span><span class="page--transition--block"
          style="--index: 144; --grid:225"></span><span class="page--transition--block"
          style="--index: 145; --grid:225"></span><span class="page--transition--block"
          style="--index: 146; --grid:225"></span><span class="page--transition--block"
          style="--index: 147; --grid:225"></span><span class="page--transition--block"
          style="--index: 148; --grid:225"></span><span class="page--transition--block"
          style="--index: 149; --grid:225"></span><span class="page--transition--block"
          style="--index: 150; --grid:225"></span><span class="page--transition--block"
          style="--index: 151; --grid:225"></span><span class="page--transition--block"
          style="--index: 152; --grid:225"></span><span class="page--transition--block"
          style="--index: 153; --grid:225"></span><span class="page--transition--block"
          style="--index: 154; --grid:225"></span><span class="page--transition--block"
          style="--index: 155; --grid:225"></span><span class="page--transition--block"
          style="--index: 156; --grid:225"></span><span class="page--transition--block"
          style="--index: 157; --grid:225"></span><span class="page--transition--block"
          style="--index: 158; --grid:225"></span><span class="page--transition--block"
          style="--index: 159; --grid:225"></span><span class="page--transition--block"
          style="--index: 160; --grid:225"></span><span class="page--transition--block"
          style="--index: 161; --grid:225"></span><span class="page--transition--block"
          style="--index: 162; --grid:225"></span><span class="page--transition--block"
          style="--index: 163; --grid:225"></span><span class="page--transition--block"
          style="--index: 164; --grid:225"></span><span class="page--transition--block"
          style="--index: 165; --grid:225"></span><span class="page--transition--block"
          style="--index: 166; --grid:225"></span><span class="page--transition--block"
          style="--index: 167; --grid:225"></span><span class="page--transition--block"
          style="--index: 168; --grid:225"></span><span class="page--transition--block"
          style="--index: 169; --grid:225"></span><span class="page--transition--block"
          style="--index: 170; --grid:225"></span><span class="page--transition--block"
          style="--index: 171; --grid:225"></span><span class="page--transition--block"
          style="--index: 172; --grid:225"></span><span class="page--transition--block"
          style="--index: 173; --grid:225"></span><span class="page--transition--block"
          style="--index: 174; --grid:225"></span><span class="page--transition--block"
          style="--index: 175; --grid:225"></span><span class="page--transition--block"
          style="--index: 176; --grid:225"></span><span class="page--transition--block"
          style="--index: 177; --grid:225"></span><span class="page--transition--block"
          style="--index: 178; --grid:225"></span><span class="page--transition--block"
          style="--index: 179; --grid:225"></span><span class="page--transition--block"
          style="--index: 180; --grid:225"></span><span class="page--transition--block"
          style="--index: 181; --grid:225"></span><span class="page--transition--block"
          style="--index: 182; --grid:225"></span><span class="page--transition--block"
          style="--index: 183; --grid:225"></span><span class="page--transition--block"
          style="--index: 184; --grid:225"></span><span class="page--transition--block"
          style="--index: 185; --grid:225"></span><span class="page--transition--block"
          style="--index: 186; --grid:225"></span><span class="page--transition--block"
          style="--index: 187; --grid:225"></span><span class="page--transition--block"
          style="--index: 188; --grid:225"></span><span class="page--transition--block"
          style="--index: 189; --grid:225"></span><span class="page--transition--block"
          style="--index: 190; --grid:225"></span><span class="page--transition--block"
          style="--index: 191; --grid:225"></span><span class="page--transition--block"
          style="--index: 192; --grid:225"></span><span class="page--transition--block"
          style="--index: 193; --grid:225"></span><span class="page--transition--block"
          style="--index: 194; --grid:225"></span><span class="page--transition--block"
          style="--index: 195; --grid:225"></span><span class="page--transition--block"
          style="--index: 196; --grid:225"></span><span class="page--transition--block"
          style="--index: 197; --grid:225"></span><span class="page--transition--block"
          style="--index: 198; --grid:225"></span><span class="page--transition--block"
          style="--index: 199; --grid:225"></span><span class="page--transition--block"
          style="--index: 200; --grid:225"></span><span class="page--transition--block"
          style="--index: 201; --grid:225"></span><span class="page--transition--block"
          style="--index: 202; --grid:225"></span><span class="page--transition--block"
          style="--index: 203; --grid:225"></span><span class="page--transition--block"
          style="--index: 204; --grid:225"></span><span class="page--transition--block"
          style="--index: 205; --grid:225"></span><span class="page--transition--block"
          style="--index: 206; --grid:225"></span><span class="page--transition--block"
          style="--index: 207; --grid:225"></span><span class="page--transition--block"
          style="--index: 208; --grid:225"></span><span class="page--transition--block"
          style="--index: 209; --grid:225"></span><span class="page--transition--block"
          style="--index: 210; --grid:225"></span><span class="page--transition--block"
          style="--index: 211; --grid:225"></span><span class="page--transition--block"
          style="--index: 212; --grid:225"></span><span class="page--transition--block"
          style="--index: 213; --grid:225"></span><span class="page--transition--block"
          style="--index: 214; --grid:225"></span><span class="page--transition--block"
          style="--index: 215; --grid:225"></span><span class="page--transition--block"
          style="--index: 216; --grid:225"></span><span class="page--transition--block"
          style="--index: 217; --grid:225"></span><span class="page--transition--block"
          style="--index: 218; --grid:225"></span><span class="page--transition--block"
          style="--index: 219; --grid:225"></span><span class="page--transition--block"
          style="--index: 220; --grid:225"></span><span class="page--transition--block"
          style="--index: 221; --grid:225"></span><span class="page--transition--block"
          style="--index: 222; --grid:225"></span><span class="page--transition--block"
          style="--index: 223; --grid:225"></span><span class="page--transition--block"
          style="--index: 224; --grid:225"></span>
        <div class="pt--element v-align-middle h-align-center">
          <div class="page--transition--caption capt--words capt--simple">BUILDING SOMETHING AMAZING</div>
        </div>
      </div>
    </div>
    <div data-stagger=center data-blocks-animation=left data-type="blocks" data-direction="left" data-duration="1000"
      class="pe--page--loader pl__blocks pl__left  "><span class="page--loader--ov pl__blocks-left"><span
          class="page--loader--block" style="--index: 0; --grid:225"></span><span class="page--loader--block"
          style="--index: 1; --grid:225"></span><span class="page--loader--block"
          style="--index: 2; --grid:225"></span><span class="page--loader--block"
          style="--index: 3; --grid:225"></span><span class="page--loader--block"
          style="--index: 4; --grid:225"></span><span class="page--loader--block"
          style="--index: 5; --grid:225"></span><span class="page--loader--block"
          style="--index: 6; --grid:225"></span><span class="page--loader--block"
          style="--index: 7; --grid:225"></span><span class="page--loader--block"
          style="--index: 8; --grid:225"></span><span class="page--loader--block"
          style="--index: 9; --grid:225"></span><span class="page--loader--block"
          style="--index: 10; --grid:225"></span><span class="page--loader--block"
          style="--index: 11; --grid:225"></span><span class="page--loader--block"
          style="--index: 12; --grid:225"></span><span class="page--loader--block"
          style="--index: 13; --grid:225"></span><span class="page--loader--block"
          style="--index: 14; --grid:225"></span><span class="page--loader--block"
          style="--index: 15; --grid:225"></span><span class="page--loader--block"
          style="--index: 16; --grid:225"></span><span class="page--loader--block"
          style="--index: 17; --grid:225"></span><span class="page--loader--block"
          style="--index: 18; --grid:225"></span><span class="page--loader--block"
          style="--index: 19; --grid:225"></span><span class="page--loader--block"
          style="--index: 20; --grid:225"></span><span class="page--loader--block"
          style="--index: 21; --grid:225"></span><span class="page--loader--block"
          style="--index: 22; --grid:225"></span><span class="page--loader--block"
          style="--index: 23; --grid:225"></span><span class="page--loader--block"
          style="--index: 24; --grid:225"></span><span class="page--loader--block"
          style="--index: 25; --grid:225"></span><span class="page--loader--block"
          style="--index: 26; --grid:225"></span><span class="page--loader--block"
          style="--index: 27; --grid:225"></span><span class="page--loader--block"
          style="--index: 28; --grid:225"></span><span class="page--loader--block"
          style="--index: 29; --grid:225"></span><span class="page--loader--block"
          style="--index: 30; --grid:225"></span><span class="page--loader--block"
          style="--index: 31; --grid:225"></span><span class="page--loader--block"
          style="--index: 32; --grid:225"></span><span class="page--loader--block"
          style="--index: 33; --grid:225"></span><span class="page--loader--block"
          style="--index: 34; --grid:225"></span><span class="page--loader--block"
          style="--index: 35; --grid:225"></span><span class="page--loader--block"
          style="--index: 36; --grid:225"></span><span class="page--loader--block"
          style="--index: 37; --grid:225"></span><span class="page--loader--block"
          style="--index: 38; --grid:225"></span><span class="page--loader--block"
          style="--index: 39; --grid:225"></span><span class="page--loader--block"
          style="--index: 40; --grid:225"></span><span class="page--loader--block"
          style="--index: 41; --grid:225"></span><span class="page--loader--block"
          style="--index: 42; --grid:225"></span><span class="page--loader--block"
          style="--index: 43; --grid:225"></span><span class="page--loader--block"
          style="--index: 44; --grid:225"></span><span class="page--loader--block"
          style="--index: 45; --grid:225"></span><span class="page--loader--block"
          style="--index: 46; --grid:225"></span><span class="page--loader--block"
          style="--index: 47; --grid:225"></span><span class="page--loader--block"
          style="--index: 48; --grid:225"></span><span class="page--loader--block"
          style="--index: 49; --grid:225"></span><span class="page--loader--block"
          style="--index: 50; --grid:225"></span><span class="page--loader--block"
          style="--index: 51; --grid:225"></span><span class="page--loader--block"
          style="--index: 52; --grid:225"></span><span class="page--loader--block"
          style="--index: 53; --grid:225"></span><span class="page--loader--block"
          style="--index: 54; --grid:225"></span><span class="page--loader--block"
          style="--index: 55; --grid:225"></span><span class="page--loader--block"
          style="--index: 56; --grid:225"></span><span class="page--loader--block"
          style="--index: 57; --grid:225"></span><span class="page--loader--block"
          style="--index: 58; --grid:225"></span><span class="page--loader--block"
          style="--index: 59; --grid:225"></span><span class="page--loader--block"
          style="--index: 60; --grid:225"></span><span class="page--loader--block"
          style="--index: 61; --grid:225"></span><span class="page--loader--block"
          style="--index: 62; --grid:225"></span><span class="page--loader--block"
          style="--index: 63; --grid:225"></span><span class="page--loader--block"
          style="--index: 64; --grid:225"></span><span class="page--loader--block"
          style="--index: 65; --grid:225"></span><span class="page--loader--block"
          style="--index: 66; --grid:225"></span><span class="page--loader--block"
          style="--index: 67; --grid:225"></span><span class="page--loader--block"
          style="--index: 68; --grid:225"></span><span class="page--loader--block"
          style="--index: 69; --grid:225"></span><span class="page--loader--block"
          style="--index: 70; --grid:225"></span><span class="page--loader--block"
          style="--index: 71; --grid:225"></span><span class="page--loader--block"
          style="--index: 72; --grid:225"></span><span class="page--loader--block"
          style="--index: 73; --grid:225"></span><span class="page--loader--block"
          style="--index: 74; --grid:225"></span><span class="page--loader--block"
          style="--index: 75; --grid:225"></span><span class="page--loader--block"
          style="--index: 76; --grid:225"></span><span class="page--loader--block"
          style="--index: 77; --grid:225"></span><span class="page--loader--block"
          style="--index: 78; --grid:225"></span><span class="page--loader--block"
          style="--index: 79; --grid:225"></span><span class="page--loader--block"
          style="--index: 80; --grid:225"></span><span class="page--loader--block"
          style="--index: 81; --grid:225"></span><span class="page--loader--block"
          style="--index: 82; --grid:225"></span><span class="page--loader--block"
          style="--index: 83; --grid:225"></span><span class="page--loader--block"
          style="--index: 84; --grid:225"></span><span class="page--loader--block"
          style="--index: 85; --grid:225"></span><span class="page--loader--block"
          style="--index: 86; --grid:225"></span><span class="page--loader--block"
          style="--index: 87; --grid:225"></span><span class="page--loader--block"
          style="--index: 88; --grid:225"></span><span class="page--loader--block"
          style="--index: 89; --grid:225"></span><span class="page--loader--block"
          style="--index: 90; --grid:225"></span><span class="page--loader--block"
          style="--index: 91; --grid:225"></span><span class="page--loader--block"
          style="--index: 92; --grid:225"></span><span class="page--loader--block"
          style="--index: 93; --grid:225"></span><span class="page--loader--block"
          style="--index: 94; --grid:225"></span><span class="page--loader--block"
          style="--index: 95; --grid:225"></span><span class="page--loader--block"
          style="--index: 96; --grid:225"></span><span class="page--loader--block"
          style="--index: 97; --grid:225"></span><span class="page--loader--block"
          style="--index: 98; --grid:225"></span><span class="page--loader--block"
          style="--index: 99; --grid:225"></span><span class="page--loader--block"
          style="--index: 100; --grid:225"></span><span class="page--loader--block"
          style="--index: 101; --grid:225"></span><span class="page--loader--block"
          style="--index: 102; --grid:225"></span><span class="page--loader--block"
          style="--index: 103; --grid:225"></span><span class="page--loader--block"
          style="--index: 104; --grid:225"></span><span class="page--loader--block"
          style="--index: 105; --grid:225"></span><span class="page--loader--block"
          style="--index: 106; --grid:225"></span><span class="page--loader--block"
          style="--index: 107; --grid:225"></span><span class="page--loader--block"
          style="--index: 108; --grid:225"></span><span class="page--loader--block"
          style="--index: 109; --grid:225"></span><span class="page--loader--block"
          style="--index: 110; --grid:225"></span><span class="page--loader--block"
          style="--index: 111; --grid:225"></span><span class="page--loader--block"
          style="--index: 112; --grid:225"></span><span class="page--loader--block"
          style="--index: 113; --grid:225"></span><span class="page--loader--block"
          style="--index: 114; --grid:225"></span><span class="page--loader--block"
          style="--index: 115; --grid:225"></span><span class="page--loader--block"
          style="--index: 116; --grid:225"></span><span class="page--loader--block"
          style="--index: 117; --grid:225"></span><span class="page--loader--block"
          style="--index: 118; --grid:225"></span><span class="page--loader--block"
          style="--index: 119; --grid:225"></span><span class="page--loader--block"
          style="--index: 120; --grid:225"></span><span class="page--loader--block"
          style="--index: 121; --grid:225"></span><span class="page--loader--block"
          style="--index: 122; --grid:225"></span><span class="page--loader--block"
          style="--index: 123; --grid:225"></span><span class="page--loader--block"
          style="--index: 124; --grid:225"></span><span class="page--loader--block"
          style="--index: 125; --grid:225"></span><span class="page--loader--block"
          style="--index: 126; --grid:225"></span><span class="page--loader--block"
          style="--index: 127; --grid:225"></span><span class="page--loader--block"
          style="--index: 128; --grid:225"></span><span class="page--loader--block"
          style="--index: 129; --grid:225"></span><span class="page--loader--block"
          style="--index: 130; --grid:225"></span><span class="page--loader--block"
          style="--index: 131; --grid:225"></span><span class="page--loader--block"
          style="--index: 132; --grid:225"></span><span class="page--loader--block"
          style="--index: 133; --grid:225"></span><span class="page--loader--block"
          style="--index: 134; --grid:225"></span><span class="page--loader--block"
          style="--index: 135; --grid:225"></span><span class="page--loader--block"
          style="--index: 136; --grid:225"></span><span class="page--loader--block"
          style="--index: 137; --grid:225"></span><span class="page--loader--block"
          style="--index: 138; --grid:225"></span><span class="page--loader--block"
          style="--index: 139; --grid:225"></span><span class="page--loader--block"
          style="--index: 140; --grid:225"></span><span class="page--loader--block"
          style="--index: 141; --grid:225"></span><span class="page--loader--block"
          style="--index: 142; --grid:225"></span><span class="page--loader--block"
          style="--index: 143; --grid:225"></span><span class="page--loader--block"
          style="--index: 144; --grid:225"></span><span class="page--loader--block"
          style="--index: 145; --grid:225"></span><span class="page--loader--block"
          style="--index: 146; --grid:225"></span><span class="page--loader--block"
          style="--index: 147; --grid:225"></span><span class="page--loader--block"
          style="--index: 148; --grid:225"></span><span class="page--loader--block"
          style="--index: 149; --grid:225"></span><span class="page--loader--block"
          style="--index: 150; --grid:225"></span><span class="page--loader--block"
          style="--index: 151; --grid:225"></span><span class="page--loader--block"
          style="--index: 152; --grid:225"></span><span class="page--loader--block"
          style="--index: 153; --grid:225"></span><span class="page--loader--block"
          style="--index: 154; --grid:225"></span><span class="page--loader--block"
          style="--index: 155; --grid:225"></span><span class="page--loader--block"
          style="--index: 156; --grid:225"></span><span class="page--loader--block"
          style="--index: 157; --grid:225"></span><span class="page--loader--block"
          style="--index: 158; --grid:225"></span><span class="page--loader--block"
          style="--index: 159; --grid:225"></span><span class="page--loader--block"
          style="--index: 160; --grid:225"></span><span class="page--loader--block"
          style="--index: 161; --grid:225"></span><span class="page--loader--block"
          style="--index: 162; --grid:225"></span><span class="page--loader--block"
          style="--index: 163; --grid:225"></span><span class="page--loader--block"
          style="--index: 164; --grid:225"></span><span class="page--loader--block"
          style="--index: 165; --grid:225"></span><span class="page--loader--block"
          style="--index: 166; --grid:225"></span><span class="page--loader--block"
          style="--index: 167; --grid:225"></span><span class="page--loader--block"
          style="--index: 168; --grid:225"></span><span class="page--loader--block"
          style="--index: 169; --grid:225"></span><span class="page--loader--block"
          style="--index: 170; --grid:225"></span><span class="page--loader--block"
          style="--index: 171; --grid:225"></span><span class="page--loader--block"
          style="--index: 172; --grid:225"></span><span class="page--loader--block"
          style="--index: 173; --grid:225"></span><span class="page--loader--block"
          style="--index: 174; --grid:225"></span><span class="page--loader--block"
          style="--index: 175; --grid:225"></span><span class="page--loader--block"
          style="--index: 176; --grid:225"></span><span class="page--loader--block"
          style="--index: 177; --grid:225"></span><span class="page--loader--block"
          style="--index: 178; --grid:225"></span><span class="page--loader--block"
          style="--index: 179; --grid:225"></span><span class="page--loader--block"
          style="--index: 180; --grid:225"></span><span class="page--loader--block"
          style="--index: 181; --grid:225"></span><span class="page--loader--block"
          style="--index: 182; --grid:225"></span><span class="page--loader--block"
          style="--index: 183; --grid:225"></span><span class="page--loader--block"
          style="--index: 184; --grid:225"></span><span class="page--loader--block"
          style="--index: 185; --grid:225"></span><span class="page--loader--block"
          style="--index: 186; --grid:225"></span><span class="page--loader--block"
          style="--index: 187; --grid:225"></span><span class="page--loader--block"
          style="--index: 188; --grid:225"></span><span class="page--loader--block"
          style="--index: 189; --grid:225"></span><span class="page--loader--block"
          style="--index: 190; --grid:225"></span><span class="page--loader--block"
          style="--index: 191; --grid:225"></span><span class="page--loader--block"
          style="--index: 192; --grid:225"></span><span class="page--loader--block"
          style="--index: 193; --grid:225"></span><span class="page--loader--block"
          style="--index: 194; --grid:225"></span><span class="page--loader--block"
          style="--index: 195; --grid:225"></span><span class="page--loader--block"
          style="--index: 196; --grid:225"></span><span class="page--loader--block"
          style="--index: 197; --grid:225"></span><span class="page--loader--block"
          style="--index: 198; --grid:225"></span><span class="page--loader--block"
          style="--index: 199; --grid:225"></span><span class="page--loader--block"
          style="--index: 200; --grid:225"></span><span class="page--loader--block"
          style="--index: 201; --grid:225"></span><span class="page--loader--block"
          style="--index: 202; --grid:225"></span><span class="page--loader--block"
          style="--index: 203; --grid:225"></span><span class="page--loader--block"
          style="--index: 204; --grid:225"></span><span class="page--loader--block"
          style="--index: 205; --grid:225"></span><span class="page--loader--block"
          style="--index: 206; --grid:225"></span><span class="page--loader--block"
          style="--index: 207; --grid:225"></span><span class="page--loader--block"
          style="--index: 208; --grid:225"></span><span class="page--loader--block"
          style="--index: 209; --grid:225"></span><span class="page--loader--block"
          style="--index: 210; --grid:225"></span><span class="page--loader--block"
          style="--index: 211; --grid:225"></span><span class="page--loader--block"
          style="--index: 212; --grid:225"></span><span class="page--loader--block"
          style="--index: 213; --grid:225"></span><span class="page--loader--block"
          style="--index: 214; --grid:225"></span><span class="page--loader--block"
          style="--index: 215; --grid:225"></span><span class="page--loader--block"
          style="--index: 216; --grid:225"></span><span class="page--loader--block"
          style="--index: 217; --grid:225"></span><span class="page--loader--block"
          style="--index: 218; --grid:225"></span><span class="page--loader--block"
          style="--index: 219; --grid:225"></span><span class="page--loader--block"
          style="--index: 220; --grid:225"></span><span class="page--loader--block"
          style="--index: 221; --grid:225"></span><span class="page--loader--block"
          style="--index: 222; --grid:225"></span><span class="page--loader--block"
          style="--index: 223; --grid:225"></span><span class="page--loader--block"
          style="--index: 224; --grid:225"></span> </span>
      <div data-elementor-type="pe-loader-transitions" data-elementor-id="553" class="elementor elementor-553">
        <div class="container--bg bg--customcss bg--for--50405ea"></div>
        <div class="elementor-element elementor-element-50405ea e-con-full e-flex no e-con e-parent" data-id="50405ea"
          data-element_type="container" data-e-type="container">
          <div
            class="elementor-element elementor-element-3fbd6469 element--logo logo--direction--vertical used--for--loader logo--fill intro--none out--fade fade_out_out elementor-widget elementor-widget-peloadertransitionelement"
            data-id="3fbd6469" data-element_type="widget" data-e-type="widget"
            data-widget_type="peloadertransitionelement.default">
            <div class="elementor-widget-container">
              <div class="pe--lt--element element--logo">
                <div class="loader--logo"><img fetchpriority="high" src="wp-content/uploads/sites/12/2025/11/digitactic_bg.png"
                    class="attachment-full size-full wp-image-15359" alt="" decoding="async" /></div>
                <div class="loader--logo loader--logo--clone"><img fetchpriority="high" src="wp-content/uploads/sites/12/2025/11/digitactic_bg.png"
                    class="attachment-full size-full wp-image-15359" alt="" decoding="async" /></div>
              </div>
            </div>
          </div>
          <div
            class="elementor-element elementor-element-2030716 used--for--loader element--caption caption--style--simple caption--animation--none intro--none out--fade fade_out_out elementor-widget elementor-widget-peloadertransitionelement"
            data-id="2030716" data-element_type="widget" data-e-type="widget"
            data-widget_type="peloadertransitionelement.default">
            <div class="elementor-widget-container">
              <div class="pe--lt--element element--caption">
                <div class="loader--caption">Loading, please wait..</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <header id="masthead" class="site-header header--template pe-items-center header--fixed header--default ">
      <div data-elementor-type="pe-header" data-elementor-id="488" class="elementor elementor-488">
        <div class="elementor-element elementor-element-1b4e9392 e-con-full e-flex no e-con e-parent" data-id="1b4e9392"
          data-element_type="container" data-e-type="container">
          <div class="elementor-element elementor-element-6bbbb21c e-con-full e-flex no e-con e-child"
            data-id="6bbbb21c" data-element_type="container" data-e-type="container">
            <div class="elementor-element elementor-element-1846483a no elementor-widget elementor-widget-pesitelogo"
              data-id="1846483a" data-element_type="widget" data-e-type="widget" data-widget_type="pesitelogo.default">
              <div class="elementor-widget-container">
                <div class="site-branding pe--styled--object align-left">
                  <div class="site-logo"><a href="./" data-barba-prevent="all"><img src="wp-content/uploads/sites/12/2025/11/digitactic_bg.png"
                        class="main__logo" alt="" decoding="async" /> </a></div>
                  <div class="sticky-logo"><a href="./" data-barba-prevent="all"> </a></div> 
                </div>
              </div>
            </div>
          </div>
          <div class="elementor-element elementor-element-648f40d5 e-con-full e-flex no e-con e-child"
            data-id="648f40d5" data-element_type="container" data-e-type="container">
            <div
              class="elementor-element elementor-element-49f71af5 menu--horizontal has--bg menu--items--align--center nav--menu--has--backdrop elementor-fixed e-transform sub--style--expand menu--items--align--center hover--opacity elementor-hidden-mobile active--none st--icon--row elementor-widget elementor-widget-penavmenu"
              data-id="49f71af5" data-element_type="widget" data-e-type="widget"
              data-settings="{&quot;_position&quot;:&quot;fixed&quot;,&quot;_transform_translateX_effect&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;-50&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateX_effect_tablet&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateX_effect_mobile&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateY_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateY_effect_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateY_effect_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
              data-widget_type="penavmenu.default">
              <div class="elementor-widget-container">
                <nav id="site-navigation" class="text--anim--multi main-navigation st--only"
                  data-sub-toggle="&lt;span class=&quot;sub--toggle st--plus&quot;&gt;&lt;span class=&quot;toggle--line&quot;&gt;&lt;/span&gt;&lt;span class=&quot;toggle--line&quot;&gt;&lt;/span&gt;&lt;/span&gt;">
                  <ul id="menu-menu-2" class="menu main-menu menu--horizontal ">
                    <li
                      class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-15366 current_page_item menu-item-15383">
                      <a href="./" data-barba-prevent="all" aria-current="page" class="pe--styled--object  text--anim--inner menu--link">Home</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15388"><a
                        href="works/" class="pe--styled--object  text--anim--inner menu--link">Works</a></li>
                    <li
                      class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-15389">
                      <a href="#." class="pe--styled--object  text--anim--inner menu--link">Studio</a>
                      <ul class="sub-menu">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15384"><a
                            href="about/" class="pe--styled--object  text--anim--inner menu--link">About</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15386"><a
                            href="services/"
                            class="pe--styled--object  text--anim--inner menu--link">Services</a></li>



                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15385"><a
                            href="contact/"
                            class="pe--styled--object  text--anim--inner menu--link">Contact</a></li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
            <div
              class="elementor-element elementor-element-562bd043 menu--toggled elementor-fixed menu__flex--styled elementor-hidden-desktop elementor-hidden-tablet sub--style--default sub--behavior--hover hover--none active--none menu--items--align--left st--icon--row elementor-widget elementor-widget-penavmenu"
              data-id="562bd043" data-element_type="widget" data-e-type="widget"
              data-settings="{&quot;_position&quot;:&quot;fixed&quot;}" data-widget_type="penavmenu.default">
              <div class="elementor-widget-container">
                <nav id="site-navigation" class="text--anim--multi main-navigation st--only"
                  data-sub-toggle="&lt;span class=&quot;sub--toggle st--plus&quot;&gt;&lt;span class=&quot;toggle--line&quot;&gt;&lt;/span&gt;&lt;span class=&quot;toggle--line&quot;&gt;&lt;/span&gt;&lt;/span&gt;">
                  <div class="pe--menu--toggle pe--styled--object">
                    <div class="pe--menu--toggle--text pe--styled--object"> <span class="toggle--open--text">Menu</span>
                      <span class="toggle--close--text">Close</span>
                    </div>
                  </div>
                  <ul id="menu-mobile-menu-1" class="menu main-menu menu--toggled ">
                    <li
                      class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-15366 current_page_item menu-item-15397">
                      <a href="./" data-barba-prevent="all" aria-current="page" class="pe--styled--object  text--anim--inner menu--link">Home</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15392"><a
                        href="works/" class="pe--styled--object  text--anim--inner menu--link">Works</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15396"><a
                        href="about/" class="pe--styled--object  text--anim--inner menu--link">About</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15394"><a
                        href="services/" class="pe--styled--object  text--anim--inner menu--link">Services</a>
                    </li>

                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15395"><a
                        href="contact/" class="pe--styled--object  text--anim--inner menu--link">Contact</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
            <div
              class="elementor-element elementor-element-7ebdfb70 text--align--center wd--show--on--top text-stroke-no elementor-widget elementor-widget-petextwrapper"
              data-id="7ebdfb70" data-element_type="widget" data-e-type="widget"
              data-widget_type="petextwrapper.default">
              <div class="elementor-widget-container">
                <div class="text-wrapper pe--styled--object">
                  <p class="no-margin   "><span
                      class="inner--icon inserted--element false  elementor-repeater-item-cc61341 me--rotate  "
                      data-duration="5" data-delay="0"><i aria-hidden="true" class="material-icons md-language"
                        data-md-icon="language"></i></span> Estonia</p>
                </div>
              </div>
            </div>
          </div>
          <div class="elementor-element elementor-element-5e6c30de e-con-full e-flex no e-con e-child"
            data-id="5e6c30de" data-element_type="container" data-e-type="container">
            <div
              class="elementor-element elementor-element-180c74de bt--bordered wd--show--on--top elementor-widget elementor-widget-pebutton"
              data-id="180c74de" data-element_type="widget" data-e-type="widget" data-widget_type="pebutton.default">
              <div class="elementor-widget-container">
                <div class="pe--button   button--bordered hover--custom button-- " data-text-hover="none"
                  data-background-hover="slide-up" data-icon-hover="none">
                  <div class="pe--button--wrapper"><a class="pb--handle" href="contact/" data-cursor="true"
                      data-cursor-type="hidden" data-cursor-text="" data-cursor-icon=""> <span
                        class="pe--button--text pe--styled--object"> LET'S TALK </span> </a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main id="primary" class="site-main" data-barba="container">
      <article id="post-15366" class="post-15366 page type-page status-publish hentry">
        <div class="entry-content">
          <div data-elementor-type="wp-page" data-elementor-id="15366" class="elementor elementor-15366">
            <div class="elementor-element elementor-element-4c5be33d e-con-full e-flex no e-con e-parent"
              data-id="4c5be33d" data-element_type="container" data-e-type="container" id="hero">
              <!-- Optimized Background Animation -->
              <div
                class="elementor-element elementor-element-7c71a2bb elementor-fixed elementor-widget elementor-widget-pesplineloader"
                data-id="7c71a2bb" data-element_type="widget" data-settings='{"_position":"fixed"}'
                data-widget_type="pesplineloader.default">
                <div class="elementor-widget-container">
                  <div class="pe--spline--loader" id="background-animation">
                    <spline-viewer url="https://prod.spline.design/NWkF47gvhcfIE1vj/scene.splinecode"></spline-viewer>
                  </div>
                </div>
              </div>
              <style>
                #background-animation {
                  width: 100%;
                  height: 100vh;
                  position: fixed;
                  top: 0;
                  left: 0;
                  z-index: -1;
                }

                spline-viewer {
                  width: 100%;
                  height: 100%;
                }

                .responsive-hero-title {
                  font-size: 70px !important;
                  line-height: 1.1 !important;
                  text-align: center !important;
                  width: 100% !important;
                  margin-bottom: 10px !important;
                }

                .responsive-hero-subtext {
                  font-size: 18px !important;
                  line-height: 1.6 !important;
                  margin-bottom: 12px !important;
                  text-align: center !important;
                  width: 100% !important;
                  max-width: 800px !important;
                  margin-left: auto !important;
                  margin-right: auto !important;
                  display: block !important;
                }

                .hero-action-btn {
                  margin-top: 0px !important;
                  display: flex !important;
                  justify-content: center !important;
                  width: 100% !important;
                }

                .elementor-element-1a19d7e0,
                .elementor-element-4046fbb3 {
                  display: flex !important;
                  flex-direction: column !important;
                  align-items: center !important;
                  justify-content: center !important;
                  width: 100% !important;
                  text-align: center !important;
                }

                .hero-action-btn .pe--button {
                  border-width: 2px !important;
                  font-weight: 600 !important;
                  letter-spacing: 1px !important;
                  margin: 0 auto !important;
                }

                @media (max-width: 767px) {
                  .responsive-hero-title {
                    font-size: 24px !important;
                    line-height: 1.1 !important;
                    margin-bottom: 8px !important;
                  }

                  .responsive-hero-subtext {
                    font-size: 14px !important;
                    line-height: 1.4 !important;
                    margin-bottom: 10px !important;
                  }
                }
              </style>
              <div
                class="elementor-element elementor-element-1a19d7e0 e-con-full container--pointer--events--all e-flex no e-con e-child"
                data-id="1a19d7e0" data-element_type="container" data-e-type="container"
                data-settings="{&quot;position&quot;:&quot;absolute&quot;}">
                <div
                  class="elementor-element elementor-element-7ac21826 e-con-full elementor-hidden-mobile e-flex no e-con e-child"
                  data-id="7ac21826" data-element_type="container" data-e-type="container"></div>
                <div class="elementor-element elementor-element-36d3ffd e-con-full e-flex no e-con e-child"
                  data-id="36d3ffd" data-element_type="container" data-e-type="container">
                  <div
                    class="elementor-element elementor-element-9f7c5a1 text--align--center text-stroke-no text--anim--fade-false elementor-widget elementor-widget-petextwrapper"
                    data-id="9f7c5a1" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin responsive-hero-title" data-animate="true" data-animation="wordsUp"
                          data-settings="{duration=1.5;delay=0;mobile_delay=;stagger=0.25;pin=false;pinTarget=;scrub=false;repeat=true;item_ref_start=top;window_ref_start=bottom;item_ref_end=bottom;window_ref_end=top;out=false;fade=false;justifyReveal=;inserted=false;easing=default}">
                          <?= get_content('hero_line_1', $conn, 'Built to Scale,'); ?> <Br> <span
                            class="no-underline  inner--element customized--word elementor-repeater-item-806b59e"><?= get_content('hero_line_2', $conn, 'Not Just to'); ?></span>
                          <Br> <?= get_content('hero_line_3', $conn, 'Work.'); ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>


                <div
                  class="elementor-element elementor-element-4046fbb3 e-con-full container--pointer--events--all e-flex no e-con e-child"
                  data-id="4046fbb3" data-element_type="container" data-e-type="container">



                  <div
                    class="elementor-element elementor-element-45b20822 text--align--center text-stroke-no elementor-widget elementor-widget-petextwrapper"
                    data-id="45b20822" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin hide-br-mobile responsive-hero-subtext"><span
                            class="no-underline  inner--element customized--word elementor-repeater-item-b638ee2">
                            <?= get_content('hero_sub_part1', $conn, ''); ?>
                          </span>
                          <?= get_content('hero_sub_part2', $conn, 'Engineering premium digital infrastructure for the world’s most ambitious Entrepreneurs and Creators.'); ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-5a330d21  wd--show--on--top elementor-widget elementor-widget-pebutton hero-action-btn"
                    data-id="5a330d21" data-element_type="widget" data-e-type="widget"
                    data-widget_type="pebutton.default">
                    <div class="elementor-widget-container">
                      <div class="pe--button   button--bordered hover--custom button-- " data-text-hover="none"
                        data-background-hover="slide-up" data-icon-hover="none">
                        <div class="pe--button--wrapper">
                          <a class="pb--handle" href="https://cal.com/digitactic" target="_blank" rel="noopener"
                            data-cursor="true" data-cursor-type="hidden" data-cursor-text="" data-cursor-icon=""> <span
                              class="pe--button--text pe--styled--object"> BOOK A CALL </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>


              </div>
            </div>


            <div class="elementor-element elementor-element-63e888de e-con-full e-flex no e-con e-parent"
              data-id="63e888de" data-element_type="container" data-e-type="container" id="aboutUs">
              <div
                class="elementor-element elementor-element-699015e8 text--align--center text-stroke-no elementor-widget elementor-widget-petextwrapper"
                data-id="699015e8" data-element_type="widget" data-e-type="widget"
                data-widget_type="petextwrapper.default">
                <div class="elementor-widget-container">
                  <div class="text-wrapper pe--styled--object">
                    <p class="no-margin   ">Who we are?</p>
                  </div>
                </div>
              </div>
              <div
                class="elementor-element elementor-element-3af82d9 text--align--center text-stroke-no text--anim--fade-false elementor-widget elementor-widget-petextwrapper"
                data-id="3af82d9" data-element_type="widget" data-e-type="widget"
                data-widget_type="petextwrapper.default">
                <div class="elementor-widget-container">
                  <div class="text-wrapper pe--styled--object">
                    <p class="no-margin   " data-animate="true" data-animation="wordsUp"
                      data-settings="{duration=1.5;delay=0;mobile_delay=;stagger=0.01;pin=false;pinTarget=;scrub=false;repeat=true;item_ref_start=top;window_ref_start=bottom;item_ref_end=bottom;window_ref_end=top;out=false;fade=false;justifyReveal=;inserted=false;easing=default}">
                      <?= get_content('who_we_are', $conn, "Digitactic is a boutique digital studio for ambitious businesses that refuse to settle for average We don't take on every client."); ?>
                    </p>
                  </div>
                </div>
              </div>

              <div
                class="elementor-element elementor-element-5a330d21 bt--bordered wd--show--on--top elementor-widget elementor-widget-pebutton"
                data-id="5a330d21" data-element_type="widget" data-e-type="widget" data-widget_type="pebutton.default">
                <div class="elementor-widget-container">
                  <div class="pe--button   button--bordered hover--custom button-- " data-text-hover="none"
                    data-background-hover="slide-up" data-icon-hover="none">
                    <div class="pe--button--wrapper"><a class="pb--handle" href="about" data-cursor="true"
                        data-cursor-type="hidden" data-cursor-text="" data-cursor-icon=""> <span
                          class="pe--button--text pe--styled--object"> ABOUT US </span> </a></div>
                  </div>
                </div>
              </div>

            </div>


            <div class="elementor-element elementor-element-797a84a7 e-con-full e-flex no e-con e-parent"
              data-id="797a84a7" data-element_type="container" data-e-type="container" id="featuredWorks">
              <div class="elementor-element elementor-element-c344dd0 e-flex e-con-boxed no e-con e-child"
                data-id="c344dd0" data-element_type="container" data-e-type="container">
                <div class="e-con-inner">
                  <div
                    class="elementor-element elementor-element-4abb4456 text--align--left text-stroke-no text--anim--fade-false elementor-widget elementor-widget-petextwrapper"
                    data-id="4abb4456" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin   " data-animate="true" data-animation="wordsUp"
                          data-settings="{duration=1.5;delay=0;mobile_delay=;stagger=0.25;pin=false;pinTarget=;scrub=false;repeat=true;item_ref_start=top;window_ref_start=bottom;item_ref_end=bottom;window_ref_end=top;out=false;fade=false;justifyReveal=;inserted=false;easing=default}">
                          FEATURED <br> <span
                            class="no-underline  inner--element customized--word elementor-repeater-item-806b59e">PROJECTS</span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="elementor-element elementor-element-349b8ef8 e-flex e-con-boxed no e-con e-child"
                data-id="349b8ef8" data-element_type="container" data-e-type="container">
                <div class="e-con-inner">
                  <div
                    class="elementor-element elementor-element-688154e9 text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                    data-id="688154e9" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin   "><?= get_content('stats_5_label', $conn, 'Years in Business'); ?></p>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-29ca2b50 hover--font-swap images--style--static pe__list_items_flex--styled sub_items--pop--styled list--type--classic list--style--none elementor-widget elementor-widget-pelist"
                    data-id="29ca2b50" data-element_type="widget" data-e-type="widget"
                    data-widget_type="pelist.default">
                    <div class="elementor-widget-container">
                      <div class="pe--list text--anim--multi">
                        <div class="pe--list--images--wrap">
                          <div class="pe--list--item--image image--0"><img decoding="async" width="300" height="300"
                              src="wp-content/uploads/sites/12/2025/07/project_featured_4x4-5-300x300.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-5-300x300.webp 300w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-5-1024x1024.webp 1024w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-5-150x150.webp 150w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-5-768x768.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-5-1536x1536.webp 1536w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-5.webp 2000w"
                              sizes="(max-width: 300px) 100vw, 300px" /></div>
                          <div class="pe--list--item--image image--1"><img loading="lazy" decoding="async" width="206"
                              height="300" src="wp-content/uploads/sites/12/2025/07/project_featured_11x16-206x300.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_11x16-206x300.webp 206w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_11x16-704x1024.webp 704w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_11x16-768x1117.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_11x16-1056x1536.webp 1056w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_11x16.webp 1375w"
                              sizes="(max-width: 206px) 100vw, 206px" /></div>
                          <div class="pe--list--item--image image--2"><img loading="lazy" decoding="async" width="225"
                              height="300" src="wp-content/uploads/sites/12/2025/07/project_featured_3x4-225x300.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-225x300.webp 225w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-768x1024.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-1152x1536.webp 1152w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4.webp 1500w"
                              sizes="(max-width: 225px) 100vw, 225px" /></div>
                          <div class="pe--list--item--image image--3"><img loading="lazy" decoding="async" width="225"
                              height="300" src="wp-content/uploads/sites/12/2025/07/project_featured_3x4-1-225x300.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-1-225x300.webp 225w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-1-768x1024.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-1-1152x1536.webp 1152w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-1.webp 1500w"
                              sizes="(max-width: 225px) 100vw, 225px" /></div>
                          <div class="pe--list--item--image image--4"><img loading="lazy" decoding="async" width="300"
                              height="300" src="wp-content/uploads/sites/12/2025/07/project_featured_4x4-4-300x300.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-4-300x300.webp 300w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-4-1024x1024.webp 1024w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-4-150x150.webp 150w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-4-768x768.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-4-1536x1536.webp 1536w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-4.webp 2000w"
                              sizes="(max-width: 300px) 100vw, 300px" /></div>
                          <div class="pe--list--item--image image--5"><img loading="lazy" decoding="async" width="225"
                              height="300" src="wp-content/uploads/sites/12/2025/07/project_featured_3x4-5-225x300.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-5-225x300.webp 225w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-5-768x1024.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-5-1152x1536.webp 1152w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_3x4-5.webp 1500w"
                              sizes="(max-width: 225px) 100vw, 225px" /></div>
                          <div class="pe--list--item--image image--6"><img loading="lazy" decoding="async" width="300"
                              height="300" src="wp-content/uploads/sites/12/2025/07/project_featured_4x4-8-300x300.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-8-300x300.webp 300w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-8-1024x1024.webp 1024w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-8-150x150.webp 150w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-8-768x768.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-8-1536x1536.webp 1536w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-8.webp 2000w"
                              sizes="(max-width: 300px) 100vw, 300px" /></div>
                          <div class="pe--list--item--image image--7"><img loading="lazy" decoding="async" width="300"
                              height="300" src="wp-content/uploads/sites/12/2025/07/project_featured_4x4-6-300x300.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-6-300x300.webp 300w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-6-1024x1024.webp 1024w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-6-150x150.webp 150w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-6-768x768.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-6-1536x1536.webp 1536w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x4-6.webp 2000w"
                              sizes="(max-width: 300px) 100vw, 300px" /></div>
                          <div class="pe--list--item--image image--8"><img loading="lazy" decoding="async" width="300"
                              height="225" src="wp-content/uploads/sites/12/2025/07/project_featured_4x3-3-300x225.html"
                              class="attachment-medium size-medium" alt=""
                              srcset="https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x3-3-300x225.webp 300w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x3-3-1024x768.webp 1024w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x3-3-768x576.webp 768w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x3-3-1536x1152.webp 1536w, https://zeyna.pethemes.com/creative-agency/wp-content/uploads/sites/12/2025/07/project_featured_4x3-3.webp 2000w"
                              sizes="(max-width: 300px) 100vw, 300px" /></div>
                        </div>

                        <ul class="pe--list--wrapper">


                          <li data-index="2" class=" pe--list--item pe--hover--trigger
                              pe--styled--object text--anim--inner"> <a data-cursor="true" data-cursor-type="default"
                              data-cursor-text="" data-cursor-icon="" target="_self"
                              href="portfolio/astra-vision/"><span class="list--sub--text pe--styled--object">[ 01
                                ]</span>
                              <div class="list--main">Astra Vision</div>
                            </a></li>

                          <li data-index="3" class=" pe--list--item pe--hover--trigger
                              pe--styled--object text--anim--inner"> <a data-cursor="true" data-cursor-type="default"
                              data-cursor-text="" data-cursor-icon="" target="_self" href="portfolio/boldly/"><span
                                class="list--sub--text pe--styled--object">[ 02 ]</span>
                              <div class="list--main">Boldly®</div>
                            </a></li>

                          <li data-index="4" class=" pe--list--item pe--hover--trigger
                              pe--styled--object text--anim--inner"> <a data-cursor="true" data-cursor-type="default"
                              data-cursor-text="" data-cursor-icon="" target="_self" href="portfolio/velora/"><span
                                class="list--sub--text pe--styled--object">[ 03 ]</span>
                              <div class="list--main">Velora</div>
                            </a></li>

                          <li data-index="5" class=" pe--list--item pe--hover--trigger
                              pe--styled--object text--anim--inner"> <a data-cursor="true" data-cursor-type="default"
                              data-cursor-text="" data-cursor-icon="" target="_self" href="portfolio/ancorli/"><span
                                class="list--sub--text pe--styled--object">[ 04 ]</span>
                              <div class="list--main">Ancorli</div>
                            </a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-669d512f bt--bordered wd--show--on--top elementor-widget elementor-widget-pebutton"
                    data-id="669d512f" data-element_type="widget" data-e-type="widget"
                    data-widget_type="pebutton.default">
                    <div class="elementor-widget-container">
                      <div class="pe--button   button--bordered hover--custom button-- " data-text-hover="none"
                        data-background-hover="slide-up" data-icon-hover="none">
                        <div class="pe--button--wrapper"><a class="pb--handle" href="works/" data-cursor="true"
                            data-cursor-type="hidden" data-cursor-text="" data-cursor-icon=""> <span
                              class="pe--button--text pe--styled--object"> VIEW ALL OUR WORK </span> </a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="elementor-element elementor-element-6b0ef7c1 e-con-full e-flex no e-con e-parent"
              data-id="6b0ef7c1" data-element_type="container" data-e-type="container" id="clients">
              <div
                class="elementor-element elementor-element-7812c309 e-con-full e-flex no e-con e-child text--align--center"
                data-id="7812c309" data-element_type="container" data-e-type="container"
                style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div
                  class="elementor-element elementor-element-74bd3e16 text--align--center text-stroke-no text--anim--fade-false elementor-widget elementor-widget-petextwrapper"
                  data-id="74bd3e16" data-element_type="widget" data-e-type="widget"
                  data-widget_type="petextwrapper.default">
                  <div class="elementor-widget-container">
                    <div class="text-wrapper pe--styled--object">
                      <p class="no-margin" data-animate="true" data-animation="wordsUp"
                        data-settings="{duration=1.5;delay=0;mobile_delay=;stagger=0.25;pin=false;pinTarget=;scrub=false;repeat=true;item_ref_start=top;window_ref_start=bottom;item_ref_end=bottom;window_ref_end=top;out=false;fade=false;justifyReveal=;inserted=false;easing=default}">
                        OUR <span
                          class="no-underline  inner--element customized--word elementor-repeater-item-806b59e">COMMITMENT</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-3e636a92 text--align--center text-stroke-no elementor-widget elementor-widget-petextwrapper"
                  data-id="3e636a92" data-element_type="widget" data-e-type="widget"
                  data-widget_type="petextwrapper.default" style="width: 100%;">
                  <div class="elementor-widget-container">
                    <div class="text-wrapper pe--styled--object">
                      <p class="no-margin" style="text-align: center; max-width: 700px; margin: 0 auto 20px auto;"><span
                          class="no-underline inner--element customized--word elementor-repeater-item-b638ee2"></span>
                        We design high converting digital systems that turn traffic into real clients.
                        We only work with clients who are passionate about their business and
                        are willing to invest in their success. This is a commitment we take seriously and we deliver
                        results that matter.
                      </p>
                    </div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-5a330d21 text--align--center bt--bordered wd--show--on--top elementor-widget elementor-widget-pebutton"
                  data-id="5a330d21" data-element_type="widget" data-e-type="widget"
                  data-widget_type="pebutton.default">
                  <div class="elementor-widget-container">
                    <div class="pe--button button--bordered hover--custom button--" data-text-hover="none"
                      data-background-hover="slide-up" data-icon-hover="none" style="margin: 0 auto;">
                      <div class="pe--button--wrapper">
                        <a class="pb--handle" href="https://cal.com/digitactic" target="_blank" rel="noopener"
                            data-cursor="true" data-cursor-type="hidden" data-cursor-text="" data-cursor-icon=""> <span
                              class="pe--button--text pe--styled--object"> BOOK A CALL </span>
                          </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="elementor-element elementor-element-50a05261 e-con-full e-flex no e-con e-child"
                data-id="50a05261" data-element_type="container" data-e-type="container">
                <div
                  class="elementor-element elementor-element-3e636a92 text--align--center text-stroke-no elementor-widget elementor-widget-petextwrapper"
                  data-id="3e636a92" data-element_type="widget" data-e-type="widget"
                  data-widget_type="petextwrapper.default">
                  <div class="elementor-widget-container">
                    <div class="text-wrapper pe--styled--object">
                      <p class="no-margin   "><span
                          class="no-underline  inner--element customized--word elementor-repeater-item-b638ee2"> </span>
                        We don't take on every client. We work with a limited number of entrepreneurs, creators, and business owners who are ready to
                        build something exceptional - not just functional, but
                        future-driven
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="elementor-element elementor-element-1894a382 e-con-full e-flex no e-con e-parent"
              data-id="1894a382" data-element_type="container" data-e-type="container" id="services">
              <div
                class="elementor-element elementor-element-6092eed elementor-absolute e-transform marquee--autoplay elementor-widget elementor-widget-pemarquee"
                data-id="6092eed" data-element_type="widget" data-e-type="widget"
                data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_transform_translateY_effect&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;-50&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateY_effect_tablet&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateY_effect_mobile&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateX_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateX_effect_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_translateX_effect_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                data-widget_type="pemarquee.default">
                <div class="elementor-widget-container">
                  <h1 class="pe-marquee pe--styled--object rotating_seperator right-to-left   cursor-default"
                    data-duration=30 data-sepduration=10><span class="big-title">SERVICES</span>
                    <div class="seperator big-title"> <i aria-hidden="true" class="material-icons md-square"
                        data-md-icon="square"></i></div>
                  </h1>
                </div>
              </div>
              <div class="elementor-element elementor-element-39e5c003 e-con-full e-flex no e-con e-child"
                data-id="39e5c003" data-element_type="container" data-e-type="container">
                <div
                  class="elementor-element elementor-element-367507bb text--align--center text-stroke-no elementor-widget elementor-widget-petextwrapper"
                  data-id="367507bb" data-element_type="widget" data-e-type="widget"
                  data-widget_type="petextwrapper.default">
                  <div class="elementor-widget-container">
                    <div class="text-wrapper pe--styled--object">
                      <p class="no-margin   ">WHAT WE BUILD ?</p>
                    </div>
                  </div>
                </div>
              </div>
              <div data-pin-start="center center+=0" data-pin-end="bottom+=0 top" data-pin-mobile=""
                class="elementor-element elementor-element-6683f82b e-con-full stack--inners pin_container_#services stack--type--scatter e-flex pin-disabled-mobile-yes no e-con e-child"
                data-id="6683f82b" data-element_type="container" data-e-type="container">
                <div
                  class="elementor-element elementor-element-3d01460d elementor-widget elementor-widget-pecalltoaction"
                  data-id="3d01460d" data-element_type="widget" data-e-type="widget"
                  data-widget_type="pecalltoaction.default">
                  <div class="elementor-widget-container">
                    <div class="pe--call--to--action pe--hover--trigger pe--styled--object to-page-post"> <a
                        data-cursor="true" data-cursor-type="default" data-cursor-text="" data-cursor-icon=""
                        href="services/">
                        <div class="pe--cta--wrapper ">
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--title elementor-repeater-item-ff8ac83  ">
                            <h3> <span data-text-hover="slide-up" data-text="01. Branding" class="text-hover"> <span>01.
                                  Digital Infrastructure</span> </span></h3>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--icon elementor-repeater-item-146cd43  ">
                            <div class="pe-icon"> <span data-icon-hover="rotate" class="pe--icon--hover"> <span><i
                                    aria-hidden="true" class="material-icons md-south_west"
                                    data-md-icon="south_west"></i></span></span></div>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-f03aee7  ">
                            <p>End-to-end digital business systems that cover every aspect of your online presence. From
                              strategy to execution, we build infrastructures designed to scale:</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-89098c6  ">
                            <p>Brand Positioning and Messaging</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-e7e4fca  ">
                            <p> Website and App Development</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-fc3efc1  ">
                            <p>Operations and Workflow design</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-8395bad  ">
                            <p>Analytics and Performance tracking</p>
                          </div>
                        </div>
                      </a></div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-5ca2a4fd elementor-widget elementor-widget-pecalltoaction"
                  data-id="5ca2a4fd" data-element_type="widget" data-e-type="widget"
                  data-widget_type="pecalltoaction.default">
                  <div class="elementor-widget-container">
                    <div class="pe--call--to--action pe--hover--trigger pe--styled--object to-page-post"> <a
                        data-cursor="true" data-cursor-type="default" data-cursor-text="" data-cursor-icon="" href="#">
                        <div class="pe--cta--wrapper ">
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--title elementor-repeater-item-ff8ac83  ">
                            <h3> <span data-text-hover="slide-up" data-text="02. Marketing" class="text-hover">
                                <span>02. Content Creation & Visual Identity</span> </span></h3>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--icon elementor-repeater-item-146cd43  ">
                            <div class="pe-icon"> <span data-icon-hover="rotate" class="pe--icon--hover"> <span><i
                                    aria-hidden="true" class="material-icons md-south_west"
                                    data-md-icon="south_west"></i></span></span></div>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-f03aee7  ">
                            <p>Premium brand systems that communicate confidence and clarity. We create identities that
                              command attention and reflect your ambition.
                            </p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-89098c6  ">
                            <p>Logo and Visual Identity Design</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-e7e4fca  ">
                            <p>Typography &amp; Color Systems </p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-1402186  ">
                            <p>Brand guidelines and style guide</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-fc3efc1  ">
                            <p> Marketing collateral design</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-8395bad  ">
                            <p>Social media visual templates </p>
                          </div>
                        </div>
                      </a></div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-1c205970 elementor-widget elementor-widget-pecalltoaction"
                  data-id="1c205970" data-element_type="widget" data-e-type="widget"
                  data-widget_type="pecalltoaction.default">
                  <div class="elementor-widget-container">
                    <div class="pe--call--to--action pe--hover--trigger pe--styled--object to-page-post"> <a
                        data-cursor="true" data-cursor-type="default" data-cursor-text="" data-cursor-icon="" href="#">
                        <div class="pe--cta--wrapper ">
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--title elementor-repeater-item-ff8ac83  ">
                            <h3> <span data-text-hover="slide-up" data-text="03. Web Design" class="text-hover">
                                <span>03. Marketing Systems</span> </span></h3>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--icon elementor-repeater-item-146cd43  ">
                            <div class="pe-icon"> <span data-icon-hover="rotate" class="pe--icon--hover"> <span><i
                                    aria-hidden="true" class="material-icons md-south_west"
                                    data-md-icon="south_west"></i></span></span></div>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-f03aee7  ">
                            <p>Strategic marketing infrastructure built for sustainable growth. Content, campaigns, and
                              conversion systems designed to work together seamlessly</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-89098c6  ">
                            <p>Social media management</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-e7e4fca  ">
                            <p>Email marketing and Automation</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-1402186  ">
                            <p>Advertising campaigns</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-fc3efc1  ">
                            <p>SEO and organic growth strategy</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-8395bad  ">
                            <p>Optimization</p>
                          </div>
                        </div>
                      </a></div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-341101e8 elementor-widget elementor-widget-pecalltoaction"
                  data-id="341101e8" data-element_type="widget" data-e-type="widget"
                  data-widget_type="pecalltoaction.default">
                  <div class="elementor-widget-container">
                    <div class="pe--call--to--action pe--hover--trigger pe--styled--object to-page-post"> <a
                        data-cursor="true" data-cursor-type="default" data-cursor-text="" data-cursor-icon="" href="#">
                        <div class="pe--cta--wrapper ">
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--title elementor-repeater-item-ff8ac83  ">
                            <h3> <span data-text-hover="slide-up" data-text="04. Digital" class="text-hover"> <span>04.
                                  Websites & Apps Platforms</span> </span></h3>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--icon elementor-repeater-item-146cd43  ">
                            <div class="pe-icon"> <span data-icon-hover="rotate" class="pe--icon--hover"> <span><i
                                    aria-hidden="true" class="material-icons md-south_west"
                                    data-md-icon="south_west"></i></span></span></div>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-f03aee7  ">
                            <p>High-performance websites and e-commerce platforms designed for conversion. Premium
                              aesthetic meets future-driven functionality.</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-89098c6  ">
                            <p>Custom website </p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-e7e4fca  ">
                            <p>E-commerce Platform setup </p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-1402186  ">
                            <p>Mobile App </p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-fc3efc1  ">
                            <p>SEO Optimization</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-8395bad  ">
                            <p>CRM and Payment Integration</p>
                          </div>
                        </div>
                      </a></div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-77e7b759 elementor-widget elementor-widget-pecalltoaction"
                  data-id="77e7b759" data-element_type="widget" data-e-type="widget"
                  data-widget_type="pecalltoaction.default">
                  <div class="elementor-widget-container">
                    <div class="pe--call--to--action pe--hover--trigger pe--styled--object to-page-post"> <a
                        data-cursor="true" data-cursor-type="default" data-cursor-text="" data-cursor-icon="" href="#">
                        <div class="pe--cta--wrapper ">
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--title elementor-repeater-item-ff8ac83  ">
                            <h3> <span data-text-hover="slide-up" data-text="05. Storytelling" class="text-hover">
                                <span>05. Business Consulting </span> </span></h3>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--icon elementor-repeater-item-146cd43  ">
                            <div class="pe-icon"> <span data-icon-hover="rotate" class="pe--icon--hover"> <span><i
                                    aria-hidden="true" class="material-icons md-south_west"
                                    data-md-icon="south_west"></i></span></span></div>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-f03aee7  ">
                            <p>Behind-the-scenes systems that keep your business running smoothly. Workflows,
                              automation, and strategic frameworks for sustainable growth.</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-89098c6  ">
                            <p>Business Process Documentation</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-e7e4fca  ">
                            <p>Project Management Systems</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-1402186  ">
                            <p>Client Onboarding Systems</p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-fc3efc1  ">
                            <p>Strategic Planning </p>
                          </div>
                          <div data-image-hover=""
                            class="cta--element pe--styled--object element--text elementor-repeater-item-8395bad  ">
                            <p>Consulting</p>
                          </div>
                        </div>
                      </a></div>
                  </div>
                </div>
              </div>
              <div class="elementor-element elementor-element-7ed86dfd e-con-full e-flex no e-con e-child"
                data-id="7ed86dfd" data-element_type="container" data-e-type="container">
                <div
                  class="elementor-element elementor-element-5b7f9ab5 text--align--center text-stroke-no elementor-widget elementor-widget-petextwrapper"
                  data-id="5b7f9ab5" data-element_type="widget" data-e-type="widget"
                  data-widget_type="petextwrapper.default">
                  <div class="elementor-widget-container">
                    <div class="text-wrapper pe--styled--object">
                      <p class="no-margin hide-br-mobile  "><span
                          class="no-underline  inner--element customized--word elementor-repeater-item-b638ee2"> </span>
                        <span
                          class="no-underline  inner--element customized--word elementor-repeater-item-b638ee2"> </span>Since Inception, we’ve been using creativity to help shape and grow some of the world’s most ambitious brands.
                      </p>
                    </div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-a99b99c bt--bordered wd--show--on--top elementor-widget elementor-widget-pebutton"
                  data-id="a99b99c" data-element_type="widget" data-e-type="widget" data-widget_type="pebutton.default">
                  <div class="elementor-widget-container">
                    <div class="pe--button   button--bordered hover--custom button-- " data-text-hover="none"
                      data-background-hover="slide-up" data-icon-hover="none">
                      <div class="pe--button--wrapper"><a class="pb--handle" href="services/" data-cursor="true"
                          data-cursor-type="hidden" data-cursor-text="" data-cursor-icon=""> <span
                            class="pe--button--text pe--styled--object"> OUR SERVICES </span> </a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="elementor-element elementor-element-418cb892 e-con-full e-flex no e-con e-parent"
              data-id="418cb892" data-element_type="container" data-e-type="container" id="impact">
              <div class="elementor-element elementor-element-44f451cb e-con-full e-flex no e-con e-child"
                data-id="44f451cb" data-element_type="container" data-e-type="container">
                <div
                  class="elementor-element elementor-element-99a8f21 text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                  data-id="99a8f21" data-element_type="widget" data-e-type="widget"
                  data-widget_type="petextwrapper.default">
                  <div class="elementor-widget-container">
                    <div class="text-wrapper pe--styled--object">
                      <p class="no-margin   ">What we do?</p>
                    </div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-5784c5ea text--align--left text-stroke-no text--anim--fade-false elementor-widget elementor-widget-petextwrapper"
                  data-id="5784c5ea" data-element_type="widget" data-e-type="widget"
                  data-widget_type="petextwrapper.default">
                  <div class="elementor-widget-container">
                    <div class="text-wrapper pe--styled--object">
                      <p class="no-margin   " data-animate="true" data-animation="wordsUp"
                        data-settings="{duration=1.5;delay=0;mobile_delay=;stagger=0.25;pin=false;pinTarget=;scrub=false;repeat=;item_ref_start=top;window_ref_start=bottom;item_ref_end=bottom;window_ref_end=top;out=false;fade=false;justifyReveal=;inserted=false;easing=default}">
                        IMPACTS WE'RE &amp; <br> <span
                          class="no-underline  inner--element customized--word elementor-repeater-item-806b59e">PROUD
                          OF!</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div
                  class="elementor-element elementor-element-30e2728f text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                  data-id="30e2728f" data-element_type="widget" data-e-type="widget"
                  data-widget_type="petextwrapper.default">
                  <div class="elementor-widget-container">
                    <div class="text-wrapper pe--styled--object">
                      <p class="   "><span
                          class="no-underline  inner--element customized--word elementor-repeater-item-b638ee2"> </span>
                        <span
                          class="no-underline  inner--element customized--word elementor-repeater-item-b638ee2"> </span>Since Inception, we’ve been using creativity to help shape and grow some of the world’s most ambitious brands.
                      </p>
                    </div>
                  </div>
                </div>

                <!-- <div
                  class="elementor-element elementor-element-6ea3eb7 bt--bordered wd--show--on--top elementor-widget elementor-widget-pebutton"
                  data-id="6ea3eb7" data-element_type="widget" data-e-type="widget" data-widget_type="pebutton.default">
                  <div class="elementor-widget-container">
                    <div class="pe--button   button--bordered hover--custom button-- " data-text-hover="none"
                      data-background-hover="slide-up" data-icon-hover="none">
                      <div class="pe--button--wrapper"><a class="pb--handle" href="team/" data-cursor="true"
                          data-cursor-type="hidden" data-cursor-text="" data-cursor-icon=""> <span
                            class="pe--button--text pe--styled--object"> OUR TEAM </span> </a></div>
                    </div>
                  </div>
                </div> -->

              </div>
              <div class="elementor-element elementor-element-51a3a92e e-con-full e-flex no e-con e-child"
                data-id="51a3a92e" data-element_type="container" data-e-type="container">
                <div class="elementor-element elementor-element-2c67a0e0 e-con-full e-flex no e-con e-child"
                  data-id="2c67a0e0" data-element_type="container" data-e-type="container">
                  <div
                    class="elementor-element elementor-element-66814e01 counter--animated elementor-widget elementor-widget-penumbercounter"
                    data-id="66814e01" data-element_type="widget" data-e-type="widget"
                    data-widget_type="penumbercounter.default">
                    <div class="elementor-widget-container">
                      <div class="pe--number--counter pe--styled--object" data-pin-target="" data-pin="" data-scrub=""
                        data-start="0" data-end="<?= get_content('stats_1_value', $conn, '10'); ?>"
                        data-duration="2000">
                        <div class="counter--numbers--wrap">
                          <div class="number--count"> <span class="count--inner count--0"> <span>0</span> <span>1</span>
                              <span>2</span> <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span>
                              <span>8</span> <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span>
                              <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span>
                            </span><span class="count--inner count--1"> <span>0</span> <span>1</span> <span>2</span>
                              <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span>
                              <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span> <span>4</span>
                              <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span> </span></div>
                          <span class="counter--fix counter--suffix">+</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-4b41891a text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                    data-id="4b41891a" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin   "><?= get_content('stats_1_label', $conn, 'YEARS OF EXPERIENCE'); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="elementor-element elementor-element-20a6c91 e-con-full e-flex no e-con e-child"
                  data-id="20a6c91" data-element_type="container" data-e-type="container">
                  <div
                    class="elementor-element elementor-element-cd10352 counter--animated elementor-widget elementor-widget-penumbercounter"
                    data-id="cd10352" data-element_type="widget" data-e-type="widget"
                    data-widget_type="penumbercounter.default">
                    <div class="elementor-widget-container">
                      <div class="pe--number--counter pe--styled--object" data-pin-target="" data-pin="" data-scrub=""
                        data-start="0" data-end="<?= get_content('stats_2_value', $conn, '07'); ?>"
                        data-duration="2000">
                        <div class="counter--numbers--wrap">
                          <div class="number--count"> <span class="count--inner count--0"> <span>0</span> <span>1</span>
                              <span>2</span> <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span>
                              <span>8</span> <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span>
                              <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span>
                            </span><span class="count--inner count--1"> <span>0</span> <span>1</span> <span>2</span>
                              <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span>
                              <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span> <span>4</span>
                              <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span> </span></div>
                          <span class="counter--fix counter--suffix"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-6b81394 text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                    data-id="6b81394" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin   "><?= get_content('stats_2_label', $conn, 'Dedicated Staff'); ?></p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="elementor-element elementor-element-7f5b8397 e-con-full e-flex no e-con e-child"
                  data-id="7f5b8397" data-element_type="container" data-e-type="container">
                  <div
                    class="elementor-element elementor-element-1b15ac26 counter--animated elementor-widget elementor-widget-penumbercounter"
                    data-id="1b15ac26" data-element_type="widget" data-e-type="widget"
                    data-widget_type="penumbercounter.default">
                    <div class="elementor-widget-container">
                      <div class="pe--number--counter pe--styled--object" data-pin-target="" data-pin="" data-scrub=""
                        data-start="0" data-end="<?= get_content('stats_3_value', $conn, '34'); ?>"
                        data-duration="2000">
                        <div class="counter--numbers--wrap">
                          <div class="number--count">
                            <span class="count--inner count--0"> <span>0</span> <span>1</span>
                              <span>2</span> <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span>
                              <span>8</span> <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span>
                              <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span>
                            </span>
                            <span class="count--inner count--1"> <span>0</span> <span>1</span> <span>2</span>
                              <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span>
                              <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span> <span>4</span>
                              <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-edcc84b text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                    data-id="edcc84b" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin   ">
                          <?= get_content('stats_3_label', $conn, 'Number of Completed Projects'); ?></p>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="elementor-element elementor-element-38eb211a e-con-full e-flex no e-con e-child"
                  data-id="38eb211a" data-element_type="container" data-e-type="container">
                  <div
                    class="elementor-element elementor-element-6f926db8 counter--animated elementor-widget elementor-widget-penumbercounter"
                    data-id="6f926db8" data-element_type="widget" data-e-type="widget"
                    data-widget_type="penumbercounter.default">
                    <div class="elementor-widget-container">
                      <div class="pe--number--counter pe--styled--object" data-pin-target="" data-pin="" data-scrub=""
                        data-start="0" data-end="<?= get_content('stats_4_value', $conn, '99'); ?>"
                        data-duration="2000">
                        <div class="counter--numbers--wrap"><span class="counter--fix counter--prefix">%</span>
                          <div class="number--count"> <span class="count--inner count--0"> <span>0</span> <span>1</span>
                              <span>2</span> <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span>
                              <span>8</span> <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span>
                              <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span>
                            </span><span class="count--inner count--1"> <span>0</span> <span>1</span> <span>2</span>
                              <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span>
                              <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span> <span>4</span>
                              <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span> </span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-5a79825e text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                    data-id="5a79825e" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin   "><?= get_content('stats_4_label', $conn, 'Customer Satisfaction'); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="elementor-element elementor-element-f156624 e-con-full e-flex no e-con e-child"
                  data-id="f156624" data-element_type="container" data-e-type="container">
                  <div
                    class="elementor-element elementor-element-47778947 counter--animated elementor-widget elementor-widget-penumbercounter"
                    data-id="47778947" data-element_type="widget" data-e-type="widget"
                    data-widget_type="penumbercounter.default">
                    <div class="elementor-widget-container">
                      <div class="pe--number--counter pe--styled--object" data-pin-target="" data-pin="" data-scrub=""
                        data-start="0" data-end="<?= get_content('stats_5_value', $conn, '97'); ?>"
                        data-duration="2000">
                        <div class="counter--numbers--wrap"><span class="counter--fix counter--prefix">%</span>
                          <div class="number--count"> <span class="count--inner count--0"> <span>0</span> <span>1</span>
                              <span>2</span> <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span>
                              <span>8</span> <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span>
                              <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span>
                            </span><span class="count--inner count--1"> <span>0</span> <span>1</span> <span>2</span>
                              <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span>
                              <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span> <span>4</span>
                              <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span> </span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-a71c145 text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                    data-id="a71c145" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin   "><?= get_content('stats_5_label', $conn, 'Satisfied Clients'); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="elementor-element elementor-element-1eb6eb6a e-con-full e-flex no e-con e-child"
                  data-id="1eb6eb6a" data-element_type="container" data-e-type="container">
                  <div
                    class="elementor-element elementor-element-7b0590b7 counter--animated elementor-widget elementor-widget-penumbercounter"
                    data-id="7b0590b7" data-element_type="widget" data-e-type="widget"
                    data-widget_type="penumbercounter.default">
                    <div class="elementor-widget-container">
                      <div class="pe--number--counter pe--styled--object" data-pin-target="" data-pin="" data-scrub=""
                        data-start="0" data-end="<?= get_content('stats_6_value', $conn, '96'); ?>"
                        data-duration="2000">
                        <div class="counter--numbers--wrap">
                          <div class="number--count"> <span class="count--inner count--0"> <span>0</span> <span>1</span>
                              <span>2</span> <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span>
                              <span>8</span> <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span>
                              <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span>
                            </span><span class="count--inner count--1"> <span>0</span> <span>1</span> <span>2</span>
                              <span>3</span> <span>4</span> <span>5</span> <span>6</span> <span>7</span> <span>8</span>
                              <span>9</span> <span>0</span> <span>1</span> <span>2</span> <span>3</span> <span>4</span>
                              <span>5</span> <span>6</span> <span>7</span> <span>8</span> <span>9</span> </span></div>
                          <span class="counter--fix counter--suffix">%</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="elementor-element elementor-element-5ef39608 text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                    data-id="5ef39608" data-element_type="widget" data-e-type="widget"
                    data-widget_type="petextwrapper.default">
                    <div class="elementor-widget-container">
                      <div class="text-wrapper pe--styled--object">
                        <p class="no-margin   "><?= get_content('stats_6_label', $conn, 'Rate of Returned Clients'); ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
    </main>

    <footer id="colophon" class="site-footer  footer--overlay">
      <div data-elementor-type="pe-footer" data-elementor-id="547" class="elementor elementor-547">
        <div class="elementor-element elementor-element-410c50ab e-con-full e-flex no e-con e-parent" data-id="410c50ab"
          data-element_type="container" data-e-type="container" id="footer">
          <div class="elementor-element elementor-element-7c81ad78 e-con-full e-flex no e-con e-child"
            data-id="7c81ad78" data-element_type="container" data-e-type="container">
            <div
              class="elementor-element elementor-element-4fd7a402 text--align--left text-stroke-no text--anim--fade-false elementor-widget elementor-widget-petextwrapper"
              data-id="4fd7a402" data-element_type="widget" data-e-type="widget"
              data-widget_type="petextwrapper.default">
              <div class="elementor-widget-container">
                <div class="text-wrapper pe--styled--object">
                  <p class="no-margin   " data-animate="true" data-animation="wordsUp"
                    data-settings="{duration=1.5;delay=0;mobile_delay=;stagger=0.25;pin=false;pinTarget=;scrub=false;repeat=;item_ref_start=top;window_ref_start=bottom;item_ref_end=bottom;window_ref_end=top;out=false;fade=false;justifyReveal=;inserted=false;easing=default}">
                    LET’S MAKE <span
                      class="no-underline  inner--element customized--word elementor-repeater-item-806b59e">SOMETHING</span>
                    <br> <span
                      class="no-underline  inner--element customized--word elementor-repeater-item-806b59e">GREAT</span>
                    TOGETHER.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="elementor-element elementor-element-108639b4 e-con-full e-flex no e-con e-child"
            data-id="108639b4" data-element_type="container" data-e-type="container">
            <div class="elementor-element elementor-element-7904145b e-con-full e-flex no e-con e-child"
              data-id="7904145b" data-element_type="container" data-e-type="container">
              <div
                class="elementor-element elementor-element-497fb69d text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                data-id="497fb69d" data-element_type="widget" data-e-type="widget"
                data-widget_type="petextwrapper.default">
                <div class="elementor-widget-container">
                  <div class="text-wrapper pe--styled--object">
                    <p class="no-margin   ">Navigate</p>
                  </div>
                </div>
              </div>
              <div
                class="elementor-element elementor-element-52418303 hover--font-swap menu__flex--styled menu--vertical sub--style--default sub--behavior--hover menu--items--align--left st--icon--row elementor-widget elementor-widget-penavmenu"
                data-id="52418303" data-element_type="widget" data-e-type="widget" data-widget_type="penavmenu.default">
                <div class="elementor-widget-container">
                  <nav id="site-navigation" class="text--anim--multi main-navigation st--only"
                    data-sub-toggle="&lt;span class=&quot;sub--toggle st--plus&quot;&gt;&lt;span class=&quot;toggle--line&quot;&gt;&lt;/span&gt;&lt;span class=&quot;toggle--line&quot;&gt;&lt;/span&gt;&lt;/span&gt;">
                    <ul id="menu-mobile-menu-3" class="menu main-menu menu--vertical ">
                      <li
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-15366 current_page_item menu-item-15397">
                        <a href="./" data-barba-prevent="all" aria-current="page"
                          class="pe--styled--object  text--anim--inner menu--link">Home</a>
                      </li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15392"><a
                          href="works/" class="pe--styled--object  text--anim--inner menu--link">Works</a>
                      </li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15396"><a
                          href="about/" class="pe--styled--object  text--anim--inner menu--link">About</a>
                      </li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15394"><a
                          href="services/" class="pe--styled--object  text--anim--inner menu--link">Services</a></li>

                      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15395"><a
                          href="contact/" class="pe--styled--object  text--anim--inner menu--link">Contact</a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>


            <div class="elementor-element elementor-element-70866eb4 e-con-full e-flex no e-con e-child"
              data-id="70866eb4" data-element_type="container" data-e-type="container">


              <div
                class="elementor-element elementor-element-5804cf75 bt--simple elementor-widget elementor-widget-pebutton"
                data-id="5804cf75" data-element_type="widget" data-e-type="widget" data-widget_type="pebutton.default">
                <div class="elementor-widget-container">
                  <div class="pe--button   button--simple hover--custom button-- " data-text-hover="none"
                    data-background-hover="none" data-icon-hover="slide-up-right">
                    <div class="pe--button--wrapper"><a href="tel:%20+9298286008" rel="nofollow"
                        class="pb--handle" data-cursor="true" data-cursor-type="default" data-cursor-text=""
                        data-cursor-icon=""> <span class="pe--button--text pe--styled--object">
                          <?= get_content('footer_phone', $conn, '+9298286008'); ?>
                        </span> <span class="pe--button--icon pe--styled--object"> <span class="button--icon--main"><i
                              aria-hidden="true" class="material-icons md-arrow_outward"
                              data-md-icon="arrow_outward"></i></span> <span class="button--icon--hover"><i
                              aria-hidden="true" class="material-icons md-arrow_outward"
                              data-md-icon="arrow_outward"></i></span> </span> </a></div>
                  </div>
                </div>
              </div>


              <div
                class="elementor-element elementor-element-5d1cab61 bt--simple elementor-widget elementor-widget-pebutton"
                data-id="5d1cab61" data-element_type="widget" data-e-type="widget" data-widget_type="pebutton.default">
                <div class="elementor-widget-container">
                  <div class="pe--button   button--simple hover--custom button-- " data-text-hover="none"
                    data-background-hover="none" data-icon-hover="slide-up-right">
                    <div class="pe--button--wrapper"><a href="mailto:%20nis@digitactic.net" rel="nofollow"
                        class="pb--handle" data-cursor="true" data-cursor-type="default" data-cursor-text=""
                        data-cursor-icon=""> <span class="pe--button--text pe--styled--object"> nis@digitactic.net
                        </span> <span class="pe--button--icon pe--styled--object"> <span class="button--icon--main"><i
                              aria-hidden="true" class="material-icons md-arrow_outward"
                              data-md-icon="arrow_outward"></i></span> <span class="button--icon--hover"><i
                              aria-hidden="true" class="material-icons md-arrow_outward"
                              data-md-icon="arrow_outward"></i></span> </span> </a></div>
                  </div>
                </div>
              </div>
              <div
                class="elementor-element elementor-element-5469658d list--style--custom list--type--classic images--style--default hover--none elementor-widget elementor-widget-pelist"
                data-id="5469658d" data-element_type="widget" data-e-type="widget" data-widget_type="pelist.default">
                <div class="elementor-widget-container">
                  <div class="pe--list text--anim--multi">
                    <ul class="pe--list--wrapper">
                      <li data-index="1" class=" pe--list--item pe--hover--trigger
pe--styled--object text--anim--inner"> <a data-cursor="true" data-cursor-type="default" data-cursor-text=""
                          data-cursor-icon="" target="_blank" href="#"><span class="list--icon pe--styled--object">
                            <span data-icon-hover="slide-up-right" class="pe--icon--hover"> <span><i aria-hidden="true"
                                  class="material-icons md-arrow_outward" data-md-icon="arrow_outward"></i></span><span
                                class="icon--hover--wrap"><i aria-hidden="true" class="material-icons md-arrow_outward"
                                  data-md-icon="arrow_outward"></i></span> </span> </span>
                          <div class="list--main">Facebook</div>
                        </a></li>
                      <li data-index="2" class=" pe--list--item pe--hover--trigger
pe--styled--object text--anim--inner"> <a data-cursor="true" data-cursor-type="default" data-cursor-text=""
                          data-cursor-icon="" target="_blank" href="#"><span class="list--icon pe--styled--object">
                            <span data-icon-hover="slide-up-right" class="pe--icon--hover"> <span><i aria-hidden="true"
                                  class="material-icons md-arrow_outward" data-md-icon="arrow_outward"></i></span><span
                                class="icon--hover--wrap"><i aria-hidden="true" class="material-icons md-arrow_outward"
                                  data-md-icon="arrow_outward"></i></span> </span> </span>
                          <div class="list--main">Instagram</div>
                        </a></li>
                      <li data-index="3" class=" pe--list--item pe--hover--trigger
pe--styled--object text--anim--inner"> <a data-cursor="true" data-cursor-type="default" data-cursor-text=""
                          data-cursor-icon="" target="_blank" href="#"><span class="list--icon pe--styled--object">
                            <span data-icon-hover="slide-up-right" class="pe--icon--hover"> <span><i aria-hidden="true"
                                  class="material-icons md-arrow_outward" data-md-icon="arrow_outward"></i></span><span
                                class="icon--hover--wrap"><i aria-hidden="true" class="material-icons md-arrow_outward"
                                  data-md-icon="arrow_outward"></i></span> </span> </span>
                          <div class="list--main">LinkedIn</div>
                        </a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div
                class="elementor-element elementor-element-429e24 text--align--left text-stroke-no elementor-widget elementor-widget-petextwrapper"
                data-id="429e24" data-element_type="widget" data-e-type="widget"
                data-widget_type="petextwrapper.default">
                <div class="elementor-widget-container">
                  <div class="text-wrapper pe--styled--object">

                    &copy;
                    <script>document.write(new Date().getFullYear())</script> Digitactic. Designed with care ❤️
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="elementor-element elementor-element-125f816 e-con-full e-flex no e-con e-child" data-id="125f816"
            data-element_type="container" data-e-type="container">
            <div
              class="elementor-element elementor-element-2045810c caption__style--simple icon--fill--yes elementor-widget elementor-widget-peicon"
              data-id="2045810c" data-element_type="widget" data-e-type="widget" data-widget_type="peicon.default">
              <div class="elementor-widget-container">
                <div data-cursor="true" data-cursor-type="default" data-cursor-text="" data-cursor-icon=""
                  class="pe--icon pe--styled--object pe--scroll--button" data-scroll-to="0" data-scroll-duration="1">
                  <div class="pe--icon--wrap " data-duration="1" data-delay="0" data-fade=""> <span
                      data-icon-hover="slide-up" class="pe--icon--hover"> <span><i aria-hidden="true"
                          class="material-icons md-arrow_upward" data-md-icon="arrow_upward"></i></span><span
                        class="icon--hover--wrap"><i aria-hidden="true" class="material-icons md-arrow_upward"
                          data-md-icon="arrow_upward"></i></span> </span></div>
                  <div class="pe--icon--caption"> Back to Top</div>
                </div>
              </div>
            </div>
            <div
              class="elementor-element elementor-element-183ec971 text--align--left text-stroke-no text--anim--fade-false elementor-widget elementor-widget-petextwrapper"
              data-id="183ec971" data-element_type="widget" data-e-type="widget"
              data-widget_type="petextwrapper.default">
              <div class="elementor-widget-container">
                <div class="text-wrapper pe--styled--object">
                  <p class="no-margin   " data-animate="true" data-animation="wordsUp"
                    data-settings="{duration=1.5;delay=0;mobile_delay=;stagger=0.02;pin=false;pinTarget=;scrub=false;repeat=;item_ref_start=top;window_ref_start=bottom;item_ref_end=bottom;window_ref_end=top;out=false;fade=false;justifyReveal=;inserted=false;easing=default}">
                    Ready to elevate your brand?
                    Drop us a message, and let's start building something amazing together.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <script
    type="speculationrules">{"prefetch":[{"source":"document","where":{"and":[{"href_matches":"\/creative-agency\/*"},{"not":{"href_matches":["\/creative-agency\/wp-*.php","\/creative-agency\/wp-admin\/*","\/creative-agency\/wp-content\/uploads\/sites\/12\/*","\/creative-agency\/wp-content\/*","\/creative-agency\/wp-content\/plugins\/*","\/creative-agency\/wp-content\/themes\/zeyna\/*","\/creative-agency\/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}</script>
  <script src="wp-content/plugins/pe-core/assets/js/pe-spline.iife32d4.js?ver=6.8.3" id="pe-spline-js" defer
    data-wp-strategy="defer"></script>
  <script type="text/javascript" defer
    src="wp-content/cache/breeze-minification/12/js/breeze_zeyna-pethemes-com-creative-agency-12-153661c34.js?ver=1772160162"></script>

  <!-- Digitactic Lead Gen Popup -->
  <div id="digitactic-lead-popup" class="lead-popup-overlay" style="display: none;">
    <div class="lead-popup-content">
      <button id="lead-popup-close" class="lead-popup-close">&times;</button>
      <div class="lead-popup-inner">
        <h2>Interested in our services?</h2>
        <p>Drop your email below and one of our experts will get back to you shortly.</p>
        <form id="lead-popup-form">
          <input type="email" id="lead-popup-email" name="Email" placeholder="Enter your email address" required>
          <button type="submit" class="lead-popup-submit">Let's Talk</button>
        </form>
        <div id="lead-popup-message" style="display: none; margin-top: 15px;"></div>
      </div>
    </div>
  </div>

  <style>
    .lead-popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(5px);
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .lead-popup-overlay.show {
      opacity: 1;
    }

    .lead-popup-content {
      background: #0f0f0f;
      border: 1px solid #333;
      border-radius: 12px;
      width: 90%;
      max-width: 450px;
      padding: 40px 30px;
      position: relative;
      transform: translateY(20px);
      transition: transform 0.4s ease;
      color: #fff;
      text-align: center;
      font-family: inherit;
    }

    .lead-popup-overlay.show .lead-popup-content {
      transform: translateY(0);
    }

    .lead-popup-close {
      position: absolute;
      top: 15px;
      right: 15px;
      background: rgba(255, 255, 255, 0.1);
      width: 34px;
      height: 34px;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #fff;
      font-size: 22px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 10;
      line-height: 1;
      padding: 0;
      padding-bottom: 2px; /* Visual alignment for &times; */
      box-sizing: border-box;
    }

    .lead-popup-close:hover {
      background: #a6a6a6;
      border-color: #a6a6a6;
      transform: rotate(90deg) scale(1.1);
      box-shadow: 0 0 15px rgba(166, 166, 166, 0.4);
    }

    .lead-popup-inner h2 {
      margin-top: 0;
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 10px;
      color: #fff;
    }

    .lead-popup-inner p {
      color: #aaa;
      font-size: 15px;
      margin-bottom: 25px;
      line-height: 1.5;
    }

    .lead-popup-inner input[type="email"] {
      width: 100%;
      padding: 15px;
      background: #1a1a1a;
      border: 1px solid #444;
      border-radius: 6px;
      color: #fff;
      font-size: 16px;
      margin-bottom: 15px;
      box-sizing: border-box;
      outline: none;
      transition: border-color 0.3s;
    }

    .lead-popup-inner input[type="email"]:focus {
      border-color: #a6a6a6;
    }

    .lead-popup-submit {
      width: 100%;
      padding: 15px;
      background: #a6a6a6;
      color: #fff;
      border: none;
      border-radius: 2px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s, opacity 0.3s;
    }

    .lead-popup-submit:hover {
      background: #8c8c8c;
    }

    .lead-popup-submit:disabled {
      opacity: 0.7;
      cursor: not-allowed;
    }

    .lead-msg-success {
      color: #4caf50;
      font-size: 15px;
    }

    .lead-msg-error {
      color: #f44336;
      font-size: 15px;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Allow testing override of wait time
      const waitTime = parseInt(localStorage.getItem('digitactic_lead_popup_test_time') || "60000");

      if (!localStorage.getItem('digitactic_lead_popup_shown')) {
        setTimeout(() => {
          const overlay = document.getElementById('digitactic-lead-popup');
          overlay.style.display = 'flex';
          // Trigger reflow
          overlay.offsetHeight;
          overlay.classList.add('show');
          localStorage.setItem('digitactic_lead_popup_shown', 'true');
        }, waitTime);
      }

      document.getElementById('lead-popup-close').addEventListener('click', function () {
        const overlay = document.getElementById('digitactic-lead-popup');
        overlay.classList.remove('show');
        setTimeout(() => overlay.style.display = 'none', 400);
      });

      document.getElementById('lead-popup-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const btn = this.querySelector('.lead-popup-submit');
        const msgDiv = document.getElementById('lead-popup-message');
        const email = document.getElementById('lead-popup-email').value;

        btn.disabled = true;
        btn.textContent = 'Subscribing...';
        msgDiv.style.display = 'none';

        const formData = new FormData();
        formData.append('Email', email);

        fetch('contact/lead_gen.php', {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              this.style.display = 'none';
              msgDiv.innerHTML = 'Thank you! We\'ve sent you an email and will be in touch soon.';
              msgDiv.className = 'lead-msg-success';
              msgDiv.style.display = 'block';
            } else {
              msgDiv.innerHTML = data.errors.join('<br>');
              msgDiv.className = 'lead-msg-error';
              msgDiv.style.display = 'block';
              btn.disabled = false;
              btn.textContent = 'Let\'s Talk';
            }
          })
          .catch(err => {
            msgDiv.innerHTML = 'Something went wrong. Please try again.';
            msgDiv.className = 'lead-msg-error';
            msgDiv.style.display = 'block';
            btn.disabled = false;
            btn.textContent = 'Let\'s Talk';
          });
      });
    });
  </script>
  <!-- Optimized Spline Viewer Script -->
  <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.15/build/spline-viewer.js"></script>
</body>

</html>




















