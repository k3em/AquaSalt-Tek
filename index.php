<?php
declare(strict_types=1);
$pageTitle = 'AquaSalt-Tek';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@600;700&display=swap" rel="stylesheet">
</head>
<body>

<button
  type="button"
  class="sidebar-backdrop"
  id="sidebar_backdrop"
  hidden
  tabindex="-1"
  aria-hidden="true"
  aria-label="Close navigation menu"
></button>

<aside class="sidebar sidebar--home-collapsed" id="sidebar" aria-label="Site navigation">
  <button type="button" class="sidebar-nav-item sidebar-toggle-menu" onclick="toggleSidebarDrawer()" title="Toggle sidebar menu">
    <i class="fas fa-bars" aria-hidden="true"></i>
  </button>

  <nav class="sidebar-nav" aria-label="Main navigation">
    

    <div class="sidebar-home-block">
      <button
        type="button"
        class="sidebar-nav-item sidebar-nav-item--home"
        data-view="home"
        onclick="showHomeScroll('home')"
        title="Go to Home — BFAR portal and AquaSalt-Tek overview"
      >
        <i class="fas fa-home" aria-hidden="true"></i>
        <span class="nav-label">Home</span>
      </button>
      <button
        type="button"
        class="sidebar-nav-chevron"
        id="sidebar_home_toggle"
        onclick="toggleHomeSubnav(event)"
        aria-expanded="false"
        aria-controls="sidebar_home_sub"
        title="Expand or collapse BFAR page shortcuts"
      >
        <i class="fas fa-chevron-down" aria-hidden="true"></i>
      </button>
    </div>

    <div class="sidebar-subnav" id="sidebar_home_sub">
      <button type="button" class="sidebar-sublink" onclick="sidebarGoHomeSection('about-bfar')" title="About BFAR — agency mandate and role">
        <i class="fas fa-landmark" aria-hidden="true"></i>
        <span class="nav-label">About BFAR</span>
      </button>
      <button type="button" class="sidebar-sublink" onclick="sidebarGoHomeSection('mission-vision')" title="Mission &amp; Vision — strategic direction">
        <i class="fas fa-bullseye" aria-hidden="true"></i>
        <span class="nav-label">Mission &amp; Vision</span>
      </button>
      <button type="button" class="sidebar-sublink" onclick="sidebarGoHomeSection('programs')" title="Programs — flagship initiatives">
        <i class="fas fa-layer-group" aria-hidden="true"></i>
        <span class="nav-label">Programs</span>
      </button>
      <button type="button" class="sidebar-sublink" onclick="sidebarGoHomeSection('services')" title="Services — regulatory and technical assistance">
        <i class="fas fa-hand-holding-heart" aria-hidden="true"></i>
        <span class="nav-label">Services</span>
      </button>
      <button type="button" class="sidebar-sublink" onclick="sidebarGoHomeSection('contact')" title="Contact — website, social media, address">
        <i class="fas fa-address-book" aria-hidden="true"></i>
        <span class="nav-label">Contact</span>
      </button>
    </div>

    <div class="sidebar-divider" role="presentation"></div>

    <button type="button" class="sidebar-nav-item" data-view="dashboard" onclick="showDashboard()" title="Dashboard — monitoring register and statistics">
      <i class="fas fa-chart-line" aria-hidden="true"></i>
      <span class="nav-label">Dashboard</span>
    </button>
    <button type="button" class="sidebar-nav-item" data-view="monitoring" onclick="showMonitoring()" title="Monitoring — encode production returns">
      <i class="fas fa-clipboard-list" aria-hidden="true"></i>
      <span class="nav-label">Monitoring</span>
    </button>
    <button type="button" class="sidebar-nav-item" data-view="mapping" onclick="showMapping()" title="Mapping — GIS view of encoded sites">
      <i class="fas fa-map-location-dot" aria-hidden="true"></i>
      <span class="nav-label">Mapping</span>
    </button>
    <button type="button" class="sidebar-nav-item" data-view="reports" onclick="showReports()" title="Reports — charts and CSV export">
      <i class="fas fa-file-export" aria-hidden="true"></i>
      <span class="nav-label">Reports</span>
    </button>
  </nav>
</aside>

<div class="main">
  <header class="bfar-site-header" role="banner">
    <div class="bfar-site-header__bar">
      <button
        type="button"
        class="bfar-site-header__sidebar-toggle mobile-sidebar-toggle"
        onclick="toggleSidebarDrawer()"
        aria-label="Toggle sidebar: expand full navigation or collapse to icon bar"
        title="Toggle sidebar (full width or compact icons)"
      >
        <i class="fas fa-bars" aria-hidden="true"></i>
      </button>
      <div class="bfar-site-header__brand">
        <img class="bfar-site-header__logo" src="/AquaSalt-Tek/img/bfar_logo.png" width="50" height="50" alt="BFAR logo">
        <p class="bfar-site-header__institution-wrap">
          <span class="bfar-site-header__institution">Bureau of Fisheries and Aquatic Resources <small>(BFAR)</small></span>
        </p>
      </div>
      <div class="bfar-site-header__meta">
        <time id="datetime" class="bfar-site-header__time" datetime="" aria-live="polite"></time>
        <div class="bfar-profile" id="bfar_profile">
          <button type="button" class="bfar-profile__trigger" onclick="toggleProfileMenu(event)" aria-expanded="false" aria-haspopup="true" aria-controls="bfar_profile_menu" id="bfar_profile_btn" title="Account menu — quick links">
            <span class="bfar-profile__avatar" aria-hidden="true">DA</span>
            <span class="bfar-profile__name">Registry User</span>
            <i class="fas fa-chevron-down bfar-profile__chev" aria-hidden="true"></i>
          </button>
          <ul class="bfar-profile__menu" id="bfar_profile_menu" role="menu" hidden>
            <li role="none"><span class="bfar-profile__menu-hint" role="menuitem">AquaSalt-Tek monitoring account</span></li>
            <li role="none"><button type="button" class="bfar-profile__menu-item" role="menuitem" onclick="closeProfileMenu(); showDashboard();">Open dashboard</button></li>
            <li role="none"><button type="button" class="bfar-profile__menu-item" role="menuitem" onclick="closeProfileMenu(); showHomeScroll('contact');">Contact section</button></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="flag-accent flag-accent--slim" role="presentation"></div>
  </header>

  <main class="container" id="content"></main>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" crossorigin="anonymous"></script>
<script src="assets/js/app.js"></script>
<script>
  showHome();
</script>
</body>
</html>
