<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - Gestion Supervision</title>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
            width: 100%;
        }

        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --background: #ffffff;
            --error-color: #ef4444;
            --error-bg: #fef2f2;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-primary);
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
            width: 100%;
            max-width: 100vw;
        }

        /* Ronds décoratifs animés dans les angles */
        body::before {
            content: '';
            position: fixed;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(37, 99, 235, 0.12) 40%, rgba(37, 99, 235, 0.05) 60%, transparent 85%);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            animation: float 20s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.22) 0%, rgba(99, 102, 241, 0.1) 40%, rgba(99, 102, 241, 0.04) 60%, transparent 85%);
            border-radius: 50%;
            bottom: -225px;
            left: -225px;
            animation: float 25s ease-in-out infinite reverse;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { 
                transform: translate(0, 0) scale(1);
            }
            50% { 
                transform: translate(30px, -30px) scale(1.1);
            }
        }

        /* Ronds supplémentaires dans les angles */
        .decoration-circle {
            position: fixed;
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        /* Angle supérieur gauche */
        .circle-1 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.2) 0%, rgba(37, 99, 235, 0.1) 35%, rgba(37, 99, 235, 0.05) 55%, transparent 80%);
            top: -200px;
            left: -200px;
            animation: float 18s ease-in-out infinite;
        }

        /* Angle supérieur droit */
        .circle-2 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.18) 0%, rgba(99, 102, 241, 0.09) 35%, rgba(99, 102, 241, 0.04) 55%, transparent 80%);
            top: -175px;
            right: -175px;
            animation: float 22s ease-in-out infinite reverse;
        }

        /* Angle inférieur droit */
        .circle-3 {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.16) 0%, rgba(139, 92, 246, 0.08) 35%, rgba(139, 92, 246, 0.04) 55%, transparent 80%);
            bottom: -190px;
            right: -190px;
            animation: float 15s ease-in-out infinite;
        }

        /* Angle inférieur gauche */
        .circle-4 {
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(37, 99, 235, 0.09) 40%, rgba(37, 99, 235, 0.04) 60%, transparent 85%);
            bottom: -160px;
            left: -160px;
            animation: float 16s ease-in-out infinite reverse;
        }
        
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }
        
        .login-card {
            background: var(--background);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 40px 32px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.05);
            animation: cardSlideUp 0.5s ease-out;
            position: relative;
            z-index: 1;
            width: 100%;
        }

        @keyframes cardSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-container {
            width: 56px;
            height: 56px;
            margin: 0 auto 20px;
            background: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
            animation: logoEntrance 0.6s ease-out;
        }

        @keyframes logoEntrance {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .logo-container:hover {
            transform: scale(1.05);
        }

        .logo-container i {
            font-size: 24px;
            color: white;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        
        .login-header p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .alert-container {
            margin-bottom: 20px;
            display: none;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--error-bg);
            color: var(--error-color);
            border: 1px solid #fecaca;
            word-break: break-word;
        }

        .alert i {
            font-size: 16px;
            flex-shrink: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 16px;
            z-index: 1;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 12px 40px 12px 40px;
            font-size: 15px;
            color: var(--text-primary);
            background: var(--background);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:hover {
            border-color: rgba(37, 99, 235, 0.5);
        }

        .form-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: var(--text-secondary);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 16px;
            padding: 4px;
            z-index: 2;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
            gap: 10px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: var(--primary-color);
            flex-shrink: 0;
        }

        .checkbox-wrapper label {
            color: var(--text-secondary);
            cursor: pointer;
            user-select: none;
            white-space: nowrap;
        }

        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            white-space: nowrap;
        }

        .forgot-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            font-size: 15px;
            font-weight: 500;
            color: white;
            background: var(--primary-color);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
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
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-submit:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-submit:active {
            transform: translateY(0) scale(0.98);
        }
        
        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .btn-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            z-index: 1;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            color: var(--text-secondary);
            font-size: 14px;
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
            white-space: nowrap;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
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
            html {
                overflow-x: hidden;
            }

            body {
                padding: 16px;
                min-height: 100dvh;
                height: auto;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow-x: hidden;
                overflow-y: auto;
                max-width: 100vw;
            }

            .login-wrapper {
                width: 100%;
                max-width: 100%;
                margin: auto 0;
            }

            .login-card {
                padding: 24px 20px;
                width: 100%;
                max-width: 100%;
            }

            .login-header {
                margin-bottom: 24px;
            }

            .login-header h1 {
                font-size: 20px;
                margin-bottom: 6px;
            }

            .login-header p {
                font-size: 13px;
            }

            .logo-container {
                width: 44px;
                height: 44px;
                margin-bottom: 16px;
            }

            .logo-container i {
                font-size: 18px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-label {
                font-size: 13px;
                margin-bottom: 6px;
            }

            .form-input {
                padding: 11px 36px 11px 36px;
                font-size: 14px;
                width: 100%;
            }

            .input-icon {
                left: 10px;
                font-size: 14px;
            }

            .password-toggle {
                right: 10px;
                font-size: 14px;
                padding: 6px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                margin-bottom: 20px;
                font-size: 13px;
                width: 100%;
            }

            .checkbox-wrapper {
                width: 100%;
            }

            .checkbox-wrapper label {
                font-size: 13px;
            }

            .forgot-link {
                width: 100%;
                text-align: left;
                font-size: 13px;
            }

            .btn-submit {
                padding: 11px;
                font-size: 14px;
                width: 100%;
            }

            .divider {
                margin: 20px 0;
                font-size: 13px;
            }

            .register-link {
                margin-top: 16px;
                font-size: 13px;
            }

            .alert {
                font-size: 13px;
                padding: 10px 14px;
            }

            .alert i {
                font-size: 14px;
            }

            /* Réduire les cercles décoratifs en mobile */
            body::before {
                width: 250px !important;
                height: 250px !important;
                top: -125px !important;
                right: -125px !important;
            }

            body::after {
                width: 200px !important;
                height: 200px !important;
                bottom: -100px !important;
                left: -100px !important;
            }

            .circle-1 {
                width: 200px !important;
                height: 200px !important;
                top: -100px !important;
                left: -100px !important;
            }

            .circle-2 {
                width: 180px !important;
                height: 180px !important;
                top: -90px !important;
                right: -90px !important;
            }

            .circle-3 {
                width: 190px !important;
                height: 190px !important;
                bottom: -95px !important;
                right: -95px !important;
            }

            .circle-4 {
                width: 160px !important;
                height: 160px !important;
                bottom: -80px !important;
                left: -80px !important;
            }
        }

        /* Extra small devices */
        @media (max-width: 360px) {
            body {
                padding: 12px;
            }

            .login-card {
                padding: 20px 16px;
            }

            .login-header h1 {
                font-size: 18px;
            }

            .form-input {
                padding: 10px 34px 10px 34px;
                font-size: 13px;
            }

            .btn-submit {
                padding: 10px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="decoration-circle circle-1"></div>
    <div class="decoration-circle circle-2"></div>
    <div class="decoration-circle circle-3"></div>
    <div class="decoration-circle circle-4"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1>Connexion</h1>
                <p>Accédez à votre espace de supervision</p>
            </div>
                        
            <div id="errorContainer" class="alert-container">
                <div class="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span id="errorMessage"></span>
                </div>
            </div>
                        
            <form id="loginForm">
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
                            autocomplete="current-password"
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
                            
                <div class="form-options">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Se souvenir de moi</label>
                    </div>
                    <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                </div>
                            
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-content">
                        <span>Se connecter</span>
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </button>
            </form>
                        
            <div class="divider">
                <span>ou</span>
            </div>
                        
            <div class="register-link">
                Pas encore de compte ? <a href="/register">Créer un compte</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fonction pour obtenir le token CSRF
            function getCsrfToken() {
                return $('meta[name="csrf-token"]').attr('content');
            }
            
            // Configuration CSRF
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            });
            
            // Rafraîchir le token CSRF si nécessaire
            function refreshCsrfToken() {
                $.get('/').done(function(html) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newToken = doc.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (newToken) {
                        $('meta[name="csrf-token"]').attr('content', newToken);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': newToken
                            }
                        });
                    }
                });
            }
            
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
            
            // Form submission
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                const $btn = $('#submitBtn');
                const $btnContent = $btn.find('.btn-content');
                const originalContent = $btnContent.html();
                
                // Disable button and show loading
                $btn.prop('disabled', true);
                $btnContent.html('<span class="spinner"></span> Connexion en cours...');
                
                // Hide previous errors
                $('#errorContainer').hide();
                
                // Get form values
                const email = $('#email').val().trim();
                const password = $('#password').val();
                const remember = $('#remember').is(':checked');
                
                // Validation
                if (!email || !password) {
                    showError('Veuillez remplir tous les champs');
                    resetButton($btn, $btnContent, originalContent);
                    return;
                }
                    
                if (!validateEmail(email)) {
                    showError('Veuillez entrer une adresse email valide');
                    resetButton($btn, $btnContent, originalContent);
                    return;
                }
                    
                // AJAX request
                $.ajax({
                    url: '/login',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    data: { 
                        email: email, 
                        password: password, 
                        remember: remember,
                        _token: getCsrfToken()
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Store token
                            if (response.token) {
                                localStorage.setItem('auth_token', response.token);
                            }
                                
                            // Success feedback
                            $btnContent.html('<i class="fas fa-check"></i> Connexion réussie !');
                            $btn.css('background', '#10b981');
                                
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
                        let errorMessage = 'Une erreur est survenue lors de la connexion';
                        
                        // Gestion spécifique du CSRF token mismatch
                        if (xhr.status === 419 || (response && response.message && (response.message.includes('CSRF') || response.message.includes('token')))) {
                            errorMessage = 'Session expirée. Rafraîchissement de la page...';
                            // Rafraîchir la page pour obtenir un nouveau token
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else if (response && response.message) {
                            errorMessage = response.message;
                        } else if (xhr.status === 422 && response && response.errors) {
                            const firstError = Object.values(response.errors)[0];
                            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                        } else if (xhr.status === 401) {
                            errorMessage = 'Email ou mot de passe incorrect';
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
                $btn.css('background', '');
            }

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            // Enter key to submit
            $('.form-input').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#loginForm').submit();
                }
            });
        });
    </script>
</body>
</html>