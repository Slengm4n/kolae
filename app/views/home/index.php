<?php
// Lógica de Tradução (Vem da branch language-features)
require_once __DIR__ . '/Includes/i18n.php';

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Usuário';
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['idioma']; ?>" class="transition-colors duration-500">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kolae</title>
    
    <link rel="icon" href="https://i.postimg.cc/Ss21pvVJ/Favicon.png" type="image/png">
    
    <?php include 'app/views/partials/theme_script.php'; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet">

    <style>
        /* Estilos críticos do Swiper/Video que não estão no Tailwind */
        .vimeo-bg-cover {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.1);
            z-index: -2; width: 100vw; height: 56.25vw; min-height: 100vh; min-width: 177.78vh;
            pointer-events: none; filter: blur(8px);
        }
        .swiper-pagination-bullet { background: #B0B0B0; }
        .swiper-pagination-bullet-active { background: #38BDF8; }
        .animate-scroll { animation: scroll 30s linear infinite; }
        @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(calc(-240px * 6)); } }
    </style>
</head>

<body class="bg-surface-base text-content-primary transition-colors duration-500">

    <header class="absolute top-0 left-0 w-full z-30 py-6">
        <div class="container mx-auto px-4 flex justify-between items-center">

            <a href="#" class="block">
                <img src="<?php echo BASE_URL; ?>/assets/img/kolae_branca.png" alt="Logo Kolae" class="h-10 drop-shadow-md filter dark:filter-none invert dark:invert-0">
            </a>

            <nav class="hidden md:block">
                <ul class="flex items-center space-x-10">
                    <li>
                        <a href="#sobre-nos" class="font-semibold text-content-primary hover:text-cyan-400 transition-colors drop-shadow-md">
                            <?php echo $lang['global_menu_about']; ?>
                        </a>
                    </li>
                    <?php if ($isLoggedIn): ?>
                        <li>
                            <a href="<?php echo BASE_URL; ?>/dashboard" class="font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-500 transition-colors border border-cyan-600 dark:border-cyan-400 px-4 py-2 rounded-full backdrop-blur-sm">
                                <?php echo $lang['global_home_panel']; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="flex items-center gap-4">

                <div class="relative">
                    <button id="lang-btn" class="flex items-center justify-center w-10 h-10 rounded-full bg-surface-elevated/50 backdrop-blur-sm border border-content-secondary/20 hover:bg-surface-elevated transition-all" title="<?php echo $lang['global_button_language']; ?>">
                        <i class="fas fa-globe text-content-primary"></i>
                    </button>

                    <div id="lang-modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 opacity-0 invisible transition-opacity duration-300">
                        <div id="lang-box" class="bg-surface-elevated border border-content-secondary/20 rounded-2xl shadow-2xl w-72 p-6 transform scale-90 opacity-0 transition-all duration-300">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-content-primary text-lg font-bold"><?php echo $lang['global_button_language']; ?></h3>
                                <button onclick="document.getElementById('lang-modal').classList.add('invisible', 'opacity-0')" class="text-content-secondary hover:text-red-500"><i class="fas fa-times"></i></button>
                            </div>
                            <ul class="space-y-2">
                                <li><button class="w-full text-left px-4 py-3 rounded-xl hover:bg-surface-secondary text-content-primary transition-colors flex items-center gap-3" data-lang="pt-br">🇧🇷 Português</button></li>
                                <li><button class="w-full text-left px-4 py-3 rounded-xl hover:bg-surface-secondary text-content-primary transition-colors flex items-center gap-3" data-lang="en-us">🇺🇸 English</button></li>
                                <li><button class="w-full text-left px-4 py-3 rounded-xl hover:bg-surface-secondary text-content-primary transition-colors flex items-center gap-3" data-lang="es-es">🇪🇸 Español</button></li>
                                </ul>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div id="user-menu-button" class="flex items-center gap-4 p-2 border border-content-secondary/30 rounded-full cursor-pointer transition-colors hover:bg-surface-secondary bg-surface-elevated/80 backdrop-blur-sm text-content-primary">
                        <i class="fas fa-bars text-lg ml-2"></i>
                        <?php if ($isLoggedIn): ?>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                                <?php echo strtoupper(substr($userName, 0, 1)); ?>
                            </div>
                        <?php else: ?>
                            <i class="fas fa-user-circle text-3xl text-content-secondary"></i>
                        <?php endif; ?>
                    </div>

                    <div id="profile-dropdown" class="absolute top-full right-0 mt-4 w-72 bg-surface-elevated border border-content-secondary/20 rounded-xl shadow-2xl opacity-0 invisible transform -translate-y-2 transition-all duration-300 z-50">
                        <ul class="py-2 text-content-primary">
                            <li class="md:hidden"><a href="#sobre-nos" class="flex items-center gap-4 px-5 py-3 text-sm hover:bg-surface-secondary transition-colors"><i class="fas fa-info-circle w-5 text-center text-content-secondary"></i> <?php echo $lang['global_menu_about']; ?></a></li>
                            <li class="border-t border-content-secondary/20 my-2 md:hidden"></li>

                            <?php if ($isLoggedIn): ?>
                                <li><div class="px-5 py-2 text-xs text-content-secondary uppercase font-bold"><?php echo $lang['global_account']; ?></div></li>
                                <li><a href="<?php echo BASE_URL; ?>/dashboard" class="flex items-center gap-4 px-5 py-3 text-sm hover:bg-surface-secondary transition-colors"><i class="fas fa-columns w-5 text-center text-cyan-500"></i> <?php echo $lang['global_home_panel']; ?></a></li>
                                <li><a href="<?php echo BASE_URL; ?>/dashboard/perfil" class="flex items-center gap-4 px-5 py-3 text-sm hover:bg-surface-secondary transition-colors"><i class="fas fa-user-cog w-5 text-center text-content-secondary"></i> <?php echo $lang['global_menu_profile']; ?></a></li>
                                <li class="border-t border-content-secondary/20 my-2"></li>
                                <li><a href="<?php echo BASE_URL; ?>/logout" class="flex items-center gap-4 px-5 py-3 text-sm text-red-500 hover:bg-surface-secondary transition-colors"><i class="fas fa-sign-out-alt w-5 text-center"></i> <?php echo $lang['global_menu_exit']; ?></a></li>
                            <?php else: ?>
                                <li><a href="<?php echo BASE_URL; ?>/login" class="flex items-center gap-4 px-5 py-3 text-sm hover:bg-surface-secondary transition-colors"><i class="fas fa-sign-in-alt w-5 text-center text-content-secondary"></i> <?php echo $lang['global_menu_login']; ?></a></li>
                                <li><a href="<?php echo BASE_URL; ?>/register" class="flex items-center gap-4 px-5 py-3 text-sm font-bold text-cyan-500 hover:bg-surface-secondary transition-colors"><i class="fas fa-user-plus w-5 text-center"></i> <?php echo $lang['global_menu_register']; ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="relative h-screen flex items-center justify-center text-center md:justify-start md:text-left p-0 overflow-hidden">
            <video autoplay muted loop playsinline class="vimeo-bg-cover">
                <source src="<?php echo BASE_URL; ?>/assets/img/hero-bg.mp4" type="video/mp4">
            </video>
            <div class="absolute top-0 left-0 w-full h-full bg-black/60 z-[-1]"></div>

            <div class="container mx-auto px-4 relative z-10 text-white">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold max-w-lg leading-tight mx-auto md:mx-0"><?php echo $lang['global_slogan_headline']; ?></h1>
                <div class="flex flex-wrap gap-4 mt-8 justify-center md:justify-start">
                    <a href="<?php echo BASE_URL; ?>/login" class="py-3 px-8 rounded-full font-semibold transition-all duration-300 bg-white text-black border-2 border-white hover:bg-transparent hover:text-white"><?php echo $lang['home_start_free']; ?></a>
                </div>
            </div>
        </section>

        <section class="bg-surface-secondary py-16 md:py-24 overflow-hidden transition-colors duration-500">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold max-w-2xl mx-auto text-content-primary"><?php echo $lang['home_connect_message']; ?></h2>
                <p class="max-w-3xl mx-auto mt-4 text-content-secondary"><?php echo $lang['home_search_message']; ?></p>
            </div>
            
            <div class="container mx-auto px-4 mt-12 md:mt-16 pb-10">
                <div class="swiper intro-carousel h-[480px]">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide h-[450px] rounded-xl overflow-hidden"><img src="https://images.pexels.com/photos/47730/the-ball-stadion-football-the-pitch-47730.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="w-full h-full object-cover"></div>
                        </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <section id="sobre-nos" class="py-16 md:py-24 bg-surface-base text-content-primary transition-colors duration-500">
            <div class="container mx-auto px-4 grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-last lg:order-first">
                    <img src="./assets/img/about_us_img.png" alt="About" class="w-full rounded-xl shadow-lg" loading="lazy">
                </div>
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl md:text-4xl font-bold"><?php echo $lang['global_title_about']; ?></h2>
                    <p class="mt-4 text-content-secondary"><?php echo $lang['global_text_about']; ?></p>
                    
                    <div class="mt-8 flex flex-col sm:flex-row gap-8 justify-center lg:justify-start">
                        <div>
                            <i class="fas fa-users text-cyan-500 text-3xl mb-3"></i>
                            <h3 class="text-lg font-bold"><?php echo $lang['home_title_community']; ?></h3>
                            <p class="text-sm text-content-secondary"><?php echo $lang['home_text_community']; ?></p>
                        </div>
                        <div>
                            <i class="fas fa-map-marker-alt text-cyan-500 text-3xl mb-3"></i>
                            <h3 class="text-lg font-bold"><?php echo $lang['home_title_location']; ?></h3>
                            <p class="text-sm text-content-secondary"><?php echo $lang['home_text_location']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-surface-secondary py-16 md:py-24 transition-colors duration-500">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-content-primary"><?php echo $lang['home_title_supporters']; ?></h2>
                <p class="max-w-3xl mx-auto mt-4 text-content-secondary"><?php echo $lang['home_text_supporters']; ?></p>
            </div>
            <div class="w-full overflow-hidden relative mt-16">
                </div>
        </section>
    </main>

    <footer class="bg-surface-elevated pt-16 md:pt-20 border-t border-content-secondary/10 transition-colors duration-500">
        <div class="container mx-auto px-4 grid md:grid-cols-2 lg:grid-cols-3 gap-12">
            <div class="mb-8 text-center md:text-left">
                <img src="<?php echo BASE_URL; ?>/assets/img/kolae_branca.png" alt="Logo" class="h-10 mx-auto md:mx-0 filter dark:filter-none invert dark:invert-0">
                <p class="text-sm text-content-secondary mt-4"><?php echo $lang['home_footer_activity']; ?></p>
                </div>
            <div class="mb-8 text-center md:text-left">
                <h3 class="text-lg font-semibold mb-4 text-content-primary"><?php echo $lang['global_contact_kolae']; ?></h3>
                </div>
            <div class="mb-8 text-center md:text-left">
                <h3 class="text-lg font-semibold mb-4 text-content-primary"><?php echo $lang['home_footer_activity']; ?></h3> <p class="text-sm text-content-secondary"><?php echo $lang['home_footer_register']; ?></p>
                </div>
        </div>
        <div class="mt-8 md:mt-12 py-6 border-t border-content-secondary/10 text-center">
            <p class="text-sm text-content-secondary">&copy; <?php echo $lang['global_Copyright_message']; ?></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script type="module" src="<?php echo BASE_URL; ?>/assets/js/bundle.js"></script>

</body>
</html>