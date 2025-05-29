<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - Design Innovant</title>
    <!-- MDB CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
        }
        
        .register-container {
            animation: slideInUp 0.8s ease-out;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card {
            border-radius: 20px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .card-body {
            position: relative;
            z-index: 1;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .register-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #474849 0%, #131314 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4); }
            50% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
        }
        
        .form-outline {
            margin-bottom: 1.5rem;
        }
        
        .form-outline input:focus {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-register {
            background: linear-gradient(135deg, #474849 0%, #131314 100%);
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .alert-modern {
            background: #fff3cd;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="register-header">
                            <div class="register-icon">
                                <i class="fas fa-user-plus fa-2x text-white"></i>
                            </div>
                            <h2 class="fw-bold mb-0">Inscription</h2>
                            <p class="text-muted">Créez votre compte en quelques étapes</p>
                        </div>
                        
                        <!-- Alertes d'erreur -->
                        <div id="errorContainer" style="display: none;">
                            <div class="alert alert-modern alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span id="errorMessage"></span>
                                <button type="button" class="btn-close" data-mdb-dismiss="alert"></button>
                            </div>
                        </div>
                        
                        <form id="registerForm">
                            <!-- Nom -->
                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" id="name" class="form-control form-control-lg" required>
                                <label class="form-label" for="name">
                                    <i class="fas fa-user me-2"></i>Nom complet
                                </label>
                            </div>
                            
                            <!-- Email -->
                            <div class="form-outline" data-mdb-input-init>
                                <input type="email" id="email" class="form-control form-control-lg" required>
                                <label class="form-label" for="email">
                                    <i class="fas fa-envelope me-2"></i>Adresse email
                                </label>
                            </div>
                            
                            <!-- Mot de passe -->
                            <div class="form-outline" data-mdb-input-init>
                                <input type="password" id="password" class="form-control form-control-lg" required>
                                <label class="form-label" for="password">
                                    <i class="fas fa-lock me-2"></i>Mot de passe
                                </label>
                            </div>
                            
                            <!-- Confirmation du mot de passe -->
                            <div class="form-outline" data-mdb-input-init>
                                <input type="password" id="password_confirmation" class="form-control form-control-lg" required>
                                <label class="form-label" for="password_confirmation">
                                    <i class="fas fa-lock me-2"></i>Confirmer le mot de passe
                                </label>
                            </div>
                            
                            <!-- Bouton d'inscription -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block w-100 btn-register">
                                <span style="position: relative; z-index: 1;">
                                    S'inscrire <i class="fas fa-arrow-right ms-2"></i>
                                </span>
                            </button>
                            
                            <!-- Lien vers la connexion -->
                            <div class="text-center mt-4">
                                <p class="mb-0">Déjà un compte ? 
                                    <a href="/login" class="fw-bold" style="color: #764ba2;">Connectez-vous</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MDB JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Configuration du token CSRF pour toutes les requêtes AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Animation au chargement des inputs
            $('.form-outline input').on('focus', function() {
                $(this).parent().addClass('focused');
            }).on('blur', function() {
                if (!$(this).val()) {
                    $(this).parent().removeClass('focused');
                }
            });
            
            // Gestion du formulaire
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                
                // Animation du bouton
                const $btn = $('.btn-register');
                const originalText = $btn.html();
                $btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Inscription...');
                $btn.prop('disabled', true);
                
                // Récupération des valeurs
                const name = $('#name').val();
                const email = $('#email').val();
                const password = $('#password').val();
                const password_confirmation = $('#password_confirmation').val();
                
                // Validation simple
                if (!name || !email || !password || !password_confirmation) {
                    showError('Veuillez remplir tous les champs');
                    $btn.html(originalText).prop('disabled', false);
                    return;
                }
                
                if (!validateEmail(email)) {
                    showError('Veuillez entrer une adresse email valide');
                    $btn.html(originalText).prop('disabled', false);
                    return;
                }
                
                if (password !== password_confirmation) {
                    showError('Les mots de passe ne correspondent pas');
                    $btn.html(originalText).prop('disabled', false);
                    return;
                }
                
                // Envoi de la requête AJAX
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
                        console.log('response::::::::', response);
                        if (response.status === 'success') {
                            // Stockage du token dans le localStorage
                            localStorage.setItem('auth_token', response.token);
                            
                            // Message de succès
                            $btn.html('<i class="fas fa-check me-2"></i>Inscription réussie !');
                            
                            // Redirection après un court délai
                            setTimeout(() => {
                                window.location.href = '/dashboard';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        showError(response.message || 'Une erreur est survenue');
                        $btn.html(originalText).prop('disabled', false);
                    }
                });
            });
            
            // Fonction pour afficher les erreurs
            function showError(message) {
                $('#errorMessage').text(message);
                $('#errorContainer').fadeIn();
                setTimeout(() => {
                    $('#errorContainer').fadeOut();
                }, 5000);
            }
            
            // Validation email
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        });
    </script>
</body>
</html> 