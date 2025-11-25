<?php
require_once __DIR__ . '/../../../includes/i18n.php';

$message = null;
$messageType = 'error';

if (isset($_GET['error'])) {
    $messageType = 'error';
    switch ($_GET['error']) {
        case 'email_exists': $message = $lang['register_email_exists']; break;
        case 'password_mismatch': $message = $lang['password_mismatch']; break;
        case 'registration_failed': $message = $lang['register_failed']; break;
        case 'weak_password': $message = $lang['register_password_character']; break;
        default: $message = $lang['unknown_error'];
    }
} elseif (isset($_GET['status'])) {
    $messageType = 'success';
    switch ($_GET['status']) {
        case 'password_reset': $message = $lang['message_password_redefinition']; break;
        case 'registered': $message = $lang['message_registration_success']; break;
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['idioma']; ?>" class="transition-colors duration-500">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kolae - <?php echo $lang['global_menu_register'] ?? 'Cadastro'; ?></title>

    <?php include 'app/views/partials/theme_script.php'; ?>

    <link rel="icon" href="https://i.postimg.cc/Ss21pvVJ/Favicon.png" type="image/png">
    <link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        .animate-enter { animation: enter 0.6s cubic-bezier(0.16, 1, 0.3, 1) both; }
        @keyframes enter { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>

<body class="bg-surface-base text-content-primary font-poppins transition-colors duration-500 antialiased flex items-center justify-center min-h-screen p-4 lg:p-0">

    <div class="flex w-full h-full lg:h-screen max-w-[1920px] mx-auto rounded-3xl overflow-hidden shadow-2xl lg:shadow-none lg:rounded-none bg-surface-base lg:bg-transparent">

        <div class="hidden lg:flex lg:w-1/2 relative items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[20s] hover:scale-110"
                 style="background-image: url('<?php echo BASE_URL; ?>/assets/img/register_bg.webp');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/30"></div>

            <div class="relative z-10 text-center px-12 animate-enter" style="animation-delay: 100ms;">
                <img src="<?php echo BASE_URL; ?>/assets/img/kolae_branca.png" alt="Logo Kolae" class="h-20 mx-auto mb-8 drop-shadow-xl">
                <h1 class="text-4xl xl:text-5xl font-bold leading-tight text-white drop-shadow-lg"><?php echo $lang['register_img_title']; ?></h1>
                <p class="mt-6 text-lg text-gray-200 drop-shadow-md max-w-md mx-auto font-medium"><?php echo $lang['register_img_text']; ?></p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 relative overflow-y-auto bg-surface-base">

            <div class="absolute inset-0 z-0 lg:hidden">
                 <img src="<?php echo BASE_URL; ?>/assets/img/register_bg.webp" alt="Background" class="w-full h-full object-cover opacity-5 dark:opacity-20">
            </div>

            <div class="relative w-full max-w-md z-10 animate-enter my-auto py-8" style="animation-delay: 200ms;">

                <a href="<?php echo BASE_URL; ?>/"
                    class="group inline-flex items-center text-content-secondary hover:text-cyan-500 transition-colors mb-6"
                    title="<?php echo $lang['global_back'] ?? 'Voltar'; ?>">
                    <i class="fas fa-arrow-left text-lg transform group-hover:-translate-x-1 transition-transform mr-2"></i>
                    <span class="font-medium"><?php echo $lang['global_back'] ?? 'Voltar'; ?></span>
                </a>

                <a href="<?php echo BASE_URL; ?>/" class="lg:hidden mb-8 block w-full text-center">
                    <img src="<?php echo BASE_URL; ?>/assets/img/kolae_branca.png" alt="Logo Kolae" class="h-10 mx-auto filter dark:filter-none invert dark:invert-0 opacity-90">
                </a>

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-content-primary mb-2 tracking-tight"><?php echo $lang['register_title_forms']; ?></h2>
                    <p class="text-content-secondary"><?php echo $lang['register_subtitle_forms']; ?></p>
                </div>

                <?php if ($message): ?>
                    <?php
                    $alertClasses = ($messageType === 'success')
                        ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20'
                        : 'bg-red-500/10 text-red-600 dark:text-red-400 border-red-500/20';
                    ?>
                    <div class="<?= $alertClasses ?> border px-5 py-4 rounded-xl text-center mb-8 text-sm font-medium flex items-center justify-center">
                        <i class="fas fa-info-circle mr-3 text-lg"></i>
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <form id="register-form" action="<?php echo BASE_URL; ?>/register/store" method="POST" class="space-y-5">

                    <div class="group">
                        <label for="name" class="block text-sm font-bold text-content-primary mb-2 ml-1"><?php echo $lang['register_name']; ?></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user text-content-secondary/70 transition-colors group-focus-within:text-cyan-500"></i>
                            </div>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="w-full bg-white dark:bg-surface-secondary/50 border border-gray-200 dark:border-gray-700/50 rounded-xl pl-12 pr-4 py-3.5 text-content-primary placeholder-content-secondary/50 focus:outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300 font-medium shadow-sm"
                                placeholder="<?php echo $lang['register_name_ph']; ?>">
                        </div>
                    </div>

                    <div class="group">
                        <label for="email" class="block text-sm font-bold text-content-primary mb-2 ml-1"><?php echo $lang['global_email']; ?></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-content-secondary/70 transition-colors group-focus-within:text-cyan-500"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full bg-white dark:bg-surface-secondary/50 border border-gray-200 dark:border-gray-700/50 rounded-xl pl-12 pr-4 py-3.5 text-content-primary placeholder-content-secondary/50 focus:outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300 font-medium shadow-sm"
                                placeholder="<?php echo $lang['register_email_ph']; ?>">
                        </div>
                    </div>

                    <div class="group">
                        <label for="birthdate" class="block text-sm font-bold text-content-primary mb-2 ml-1"><?php echo $lang['register_birthday']; ?></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-content-secondary/70 transition-colors group-focus-within:text-cyan-500"></i>
                            </div>
                            <input id="birthdate" name="birthdate" type="date" required
                                class="w-full bg-white dark:bg-surface-secondary/50 border border-gray-200 dark:border-gray-700/50 rounded-xl pl-12 pr-4 py-3.5 text-content-primary placeholder-content-secondary/50 focus:outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300 font-medium shadow-sm appearance-none">
                        </div>
                    </div>

                    <div class="group">
                        <label for="password" class="block text-sm font-bold text-content-primary mb-2 ml-1"><?php echo $lang['register_password']; ?></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-content-secondary/70 transition-colors group-focus-within:text-cyan-500"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="w-full bg-white dark:bg-surface-secondary/50 border border-gray-200 dark:border-gray-700/50 rounded-xl pl-12 pr-4 py-3.5 text-content-primary placeholder-content-secondary/50 focus:outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300 font-medium shadow-sm"
                                placeholder="<?php echo $lang['register_password_ph']; ?>">
                        </div>
                    </div>

                    <div class="group">
                        <label for="password_confirmation" class="block text-sm font-bold text-content-primary mb-2 ml-1"><?php echo $lang['register_password_two']; ?></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-key text-content-secondary/70 transition-colors group-focus-within:text-cyan-500"></i>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                class="w-full bg-white dark:bg-surface-secondary/50 border border-gray-200 dark:border-gray-700/50 rounded-xl pl-12 pr-4 py-3.5 text-content-primary placeholder-content-secondary/50 focus:outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all duration-300 font-medium shadow-sm"
                                placeholder="<?php echo $lang['register_password_ph_two']; ?>">
                        </div>
                    </div>

                    <div class="flex items-start pt-2">
                        <label for="terms" class="flex items-start cursor-pointer group select-none relative">
                            <input id="terms" name="terms" type="checkbox" required class="sr-only peer">

                            <span class="flex items-center justify-center w-5 h-5 min-w-[1.25rem] bg-white dark:bg-surface-secondary/50 border-2 border-gray-300 dark:border-gray-600 rounded mr-3 transition-all peer-checked:bg-cyan-500 peer-checked:border-cyan-500 group-hover:border-cyan-500/50 shadow-sm mt-0.5">
                                <i class="fas fa-check text-xs text-white scale-0 transition-transform peer-checked:scale-100 font-bold"></i>
                            </span>

                            <span class="text-sm font-medium text-content-secondary group-hover:text-content-primary transition-colors leading-snug">
                                <?php echo $lang['register_accept_agree']; ?> 
                                <a href="#" class="text-cyan-600 dark:text-cyan-400 hover:underline decoration-2 underline-offset-2 z-10 relative"><?php echo $lang['register_terms_btn']; ?></a> 
                                <?php echo $lang['global_and']; ?> 
                                <a href="#" class="text-cyan-600 dark:text-cyan-400 hover:underline decoration-2 underline-offset-2 z-10 relative"><?php echo $lang['register_privacy_btn']; ?></a>.
                            </span>
                        </label>
                    </div>

                    <div class="pt-4">
                        <button id="register-button" type="submit" class="w-full flex justify-center items-center py-4 px-6 rounded-xl shadow-lg shadow-cyan-500/20 text-base font-bold text-white bg-gradient-to-r from-cyan-500 to-cyan-400 hover:from-cyan-400 hover:to-cyan-300 hover:shadow-cyan-500/40 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-cyan-500/30 transition-all duration-300 active:scale-[0.98]">
                            <?php echo $lang['register_create_btn']; ?>
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-content-secondary font-medium pb-8">
                    <?php echo $lang['register_confirm_answer']; ?>
                    <a href="<?php echo BASE_URL; ?>/login" class="font-bold text-cyan-600 dark:text-cyan-400 hover:text-cyan-500 transition-colors hover:underline decoration-2 underline-offset-4 ml-1"><?php echo $lang['register_answer_btn']; ?></a>
                </p>
            </div>
        </div>
    </div>

    <script type="module" src="<?php echo BASE_URL; ?>/assets/js/bundle.js"></script>

</body>
</html>