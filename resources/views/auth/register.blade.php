<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - Gestion Supervision</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --error-color: #ef4444;
            --background: #f8fafc;
            --surface: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background decoration */
        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            animation: float 20s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
            animation: float 25s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, -30px) rotate(180deg); }
        }

        .register-wrapper {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-card {
            background: var(--surface);
            border-radius: 24px;
            box-shadow: var(--shadow-xl);
            padding: 48px 40px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: cardEntrance 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes cardEntrance {
            0% {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-container {
            width: 72px;
            height: 72px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            position: relative;
            animation: logoEntrance 1s ease-out, logoFloat 3s ease-in-out infinite 1s;
            transform-origin: center;
        }

        @keyframes logoEntrance {
            0% {
                opacity: 0;
                transform: scale(0.3) rotate(-180deg);
            }
            60% {
                transform: scale(1.1) rotate(10deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0px) scale(1);
            }
            50% {
                transform: translateY(-8px) scale(1.02);
            }
        }

        .logo-container::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary-color), #764ba2);
            opacity: 0;
            z-index: -1;
            animation: logoGlow 2s ease-in-out infinite;
        }

        @keyframes logoGlow {
            0%, 100% {
                opacity: 0;
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.1);
                box-shadow: 0 0 20px 10px rgba(37, 99, 235, 0.3);
            }
        }

        .logo-container::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 20px;
            padding: 4px;
            background: linear-gradient(135deg, var(--primary-color), #764ba2);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .logo-container:hover {
            animation: logoFloat 3s ease-in-out infinite, logoHover 0.5s ease-out forwards;
        }

        @keyframes logoHover {
            0% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-5px) scale(1.05) rotate(5deg);
            }
            100% {
                transform: translateY(-3px) scale(1.03) rotate(0deg);
            }
        }

        .logo-container:hover::after {
            opacity: 1;
        }

        .logo-container i {
            font-size: 32px;
            color: white;
            animation: iconPulse 2s ease-in-out infinite 1.5s;
            position: relative;
            z-index: 1;
        }

        @keyframes iconPulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .register-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            animation: titleFadeIn 0.8s ease-out 0.3s both;
        }

        @keyframes titleFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header p {
            font-size: 15px;
            color: var(--text-secondary);
            font-weight: 400;
            animation: subtitleFadeIn 0.8s ease-out 0.5s both;
        }

        @keyframes subtitleFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-container {
            margin-bottom: 24px;
            animation: slideDown 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-20px) scale(0.9);
            }
            60% {
                transform: translateY(5px) scale(1.02);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid;
        }

        .alert-error {
            background: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .alert i {
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
            animation: formSlideIn 0.6s ease-out both;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.7s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.8s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.9s;
        }

        .form-group:nth-child(4) {
            animation-delay: 1s;
        }

        @keyframes formSlideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 8px;
            transition: color 0.2s;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 18px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            font-size: 15px;
            font-weight: 400;
            color: var(--text-primary);
            background: var(--background);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .form-input:hover {
            border-color: rgba(37, 99, 235, 0.5);
            transform: translateY(-1px);
        }

        .form-input:focus {
            border-color: var(--primary-color);
            background: var(--surface);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
            animation: inputFocus 0.3s ease-out;
        }

        @keyframes inputFocus {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.1);
            }
            50% {
                box-shadow: 0 0 0 8px rgba(37, 99, 235, 0.15);
            }
            100% {
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            }
        }

        .form-input:focus + .input-icon {
            color: var(--primary-color);
            animation: iconBounce 0.5s ease-out;
        }

        @keyframes iconBounce {
            0%, 100% {
                transform: translateY(-50%) scale(1);
            }
            50% {
                transform: translateY(-50%) scale(1.2);
            }
        }

        .form-input::placeholder {
            color: var(--text-secondary);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 18px;
            padding: 4px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
        }

        .password-toggle:hover {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.2);
        }

        .password-toggle:active {
            transform: translateY(-50%) scale(0.9);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, var(--primary-color) 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            animation: buttonSlideIn 0.6s ease-out 1.1s both;
        }

        @keyframes buttonSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1), height 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-submit:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-submit:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.3);
            animation: buttonHover 0.3s ease-out;
        }

        @keyframes buttonHover {
            0% {
                transform: translateY(-2px) scale(1);
            }
            50% {
                transform: translateY(-4px) scale(1.03);
            }
            100% {
                transform: translateY(-3px) scale(1.02);
            }
        }

        .btn-submit:active {
            transform: translateY(-1px) scale(0.98);
            transition: all 0.1s;
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 32px 0;
            color: var(--text-secondary);
            font-size: 14px;
            animation: dividerFadeIn 0.6s ease-out 1.2s both;
        }

        @keyframes dividerFadeIn {
            from {
                opacity: 0;
                transform: scaleX(0);
            }
            to {
                opacity: 1;
                transform: scaleX(1);
            }
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        .divider span {
            padding: 0 16px;
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: var(--text-secondary);
            animation: loginLinkFadeIn 0.6s ease-out 1.3s both;
        }

        @keyframes loginLinkFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .login-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-card {
                padding: 32px 24px;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .logo-container {
                width: 64px;
                height: 64px;
            }
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-header">
                <div class="logo-container">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Inscription</h1>
                <p>Créez votre compte en quelques étapes</p>
            </div>

            <div id="errorContainer" class="alert-container" style="display: none;">
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span id="errorMessage"></span>
                </div>
            </div>

            <form id="registerForm">
                <div class="form-group">
                    <label for="name" class="form-label">Nom complet</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            id="name" 
                            class="form-input" 
                            placeholder="Votre nom complet"
                            required
                            autocomplete="name"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            type="email" 
                            id="email" 
                            class="form-input" 
                            placeholder="votre@email.com"
                            required
                            autocomplete="email"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="password" 
                            class="form-input" 
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            id="togglePassword"
                            aria-label="Afficher le mot de passe"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            class="form-input" 
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                        >
                        <button 
                            type="button" 
                            class="password-toggle" 
                            id="togglePasswordConfirmation"
                            aria-label="Afficher le mot de passe"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-content">
                        <span>S'inscrire</span>
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </button>
            </form>

            <div class="divider">
                <span>ou</span>
            </div>

            <div class="login-link">
                Déjà un compte ? <a href="/login">Se connecter</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Configuration CSRF
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Toggle password visibility
            $('#togglePassword').on('click', function() {
                const passwordInput = $('#password');
                const icon = $(this).find('i');
                
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $('#togglePasswordConfirmation').on('click', function() {
                const passwordInput = $('#password_confirmation');
                const icon = $(this).find('i');
                
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Form submission
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                
                const $btn = $('#submitBtn');
                const $btnContent = $btn.find('.btn-content');
                const originalContent = $btnContent.html();
                
                // Disable button and show loading
                $btn.prop('disabled', true);
                $btnContent.html('<span class="spinner"></span> Inscription en cours...');
                
                // Hide previous errors
                $('#errorContainer').slideUp();
                
                // Get form values
                const name = $('#name').val().trim();
                const email = $('#email').val().trim();
                const password = $('#password').val();
                const password_confirmation = $('#password_confirmation').val();
                
                // Validation
                if (!name || !email || !password || !password_confirmation) {
                    showError('Veuillez remplir tous les champs');
                    resetButton($btn, $btnContent, originalContent);
                    return;
                }
                
                if (!validateEmail(email)) {
                    showError('Veuillez entrer une adresse email valide');
                    resetButton($btn, $btnContent, originalContent);
                    return;
                }
                
                if (password.length < 8) {
                    showError('Le mot de passe doit contenir au moins 8 caractères');
                    resetButton($btn, $btnContent, originalContent);
                    return;
                }
                
                if (password !== password_confirmation) {
                    showError('Les mots de passe ne correspondent pas');
                    resetButton($btn, $btnContent, originalContent);
                    return;
                }
                
                // AJAX request
                $.ajax({
                    url: '/register',
                    method: 'POST',
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Store token
                            if (response.token) {
                                localStorage.setItem('auth_token', response.token);
                            }
                            
                            // Success feedback
                            $btnContent.html('<i class="fas fa-check"></i> Inscription réussie !');
                            $btn.css('background', 'linear-gradient(135deg, #10b981 0%, #059669 100%)');
                            
                            // Redirect
                            setTimeout(() => {
                                window.location.href = '/dashboard';
                            }, 800);
                        } else {
                            showError(response.message || 'Une erreur est survenue');
                            resetButton($btn, $btnContent, originalContent);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        let errorMessage = 'Une erreur est survenue lors de l\'inscription';
                        
                        if (response && response.message) {
                            errorMessage = response.message;
                        } else if (xhr.status === 422 && response.errors) {
                            const firstError = Object.values(response.errors)[0];
                            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                        } else if (xhr.status === 409) {
                            errorMessage = 'Cet email est déjà utilisé';
                        }
                        
                        showError(errorMessage);
                        resetButton($btn, $btnContent, originalContent);
                    }
                });
            });

            function showError(message) {
                $('#errorMessage').text(message);
                $('#errorContainer').slideDown();
                
                // Auto hide after 5 seconds
                setTimeout(() => {
                    $('#errorContainer').slideUp();
                }, 5000);
            }

            function resetButton($btn, $btnContent, originalContent) {
                $btn.prop('disabled', false);
                $btnContent.html(originalContent);
                $btn.css('background', 'linear-gradient(135deg, #2563eb 0%, #764ba2 100%)');
            }

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Enter key to submit
            $('.form-input').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#registerForm').submit();
                }
            });
        });
    </script>
</body>
</html>
