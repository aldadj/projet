{{-- Inclusion des bibliothèques Toastr --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Configuration globale
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    }

    // Affichage des messages de session de manière plus concise
    @foreach (['success', 'error', 'info', 'warning'] as $type)
        @if (Session::has($type))
            toastr.{{ $type }}("{{ Session::get($type) }}");
        @endif
    @endforeach
    
    // Gestion des erreurs de validation (optionnel, si vous voulez des toasts pour ça aussi)
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
