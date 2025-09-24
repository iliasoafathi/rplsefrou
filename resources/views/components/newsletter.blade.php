<!-- Modern Newsletter Subscription Component -->
<div class="relative bg-gradient-to-br from-darker via-dark to-darker text-light py-16 overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 opacity-20">
        <div class="w-full h-full bg-gradient-to-r from-gold/5 to-mint/5"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-10 left-10 w-16 h-16 bg-gold/10 rounded-full blur-xl animate-float"></div>
    <div class="absolute bottom-10 right-10 w-24 h-24 bg-mint/10 rounded-full blur-xl animate-float" style="animation-delay: 1.5s;"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="animate-fade-in-up">
                <h3 class="text-3xl md:text-4xl font-bold mb-4 gradient-text">Restez informé</h3>
                <p class="text-lg text-light/80 mb-8 max-w-2xl mx-auto leading-relaxed">
                    Abonnez-vous à notre newsletter pour recevoir les dernières actualités et événements de RPL Sefrou directement dans votre boîte mail.
                </p>
                
                <form id="newsletter-form" class="max-w-md mx-auto">
                    @csrf
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-gold/20 to-yellow-400/20 rounded-2xl blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex flex-col sm:flex-row gap-4">
                            <input type="email" 
                                   id="newsletter-email" 
                                   name="email" 
                                   placeholder="Votre adresse email" 
                                   required
                                   class="flex-1 px-6 py-4 text-dark bg-light/90 backdrop-blur-sm border border-mint/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold focus:bg-light transition-all duration-300 placeholder:text-dark/60">
                            <button type="submit" 
                                    class="group relative px-8 py-4 bg-gradient-to-r from-gold to-yellow-400 text-dark font-bold rounded-xl hover-lift ripple-btn overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    S'abonner
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-gold opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </button>
                        </div>
                    </div>
                    <div id="newsletter-message" class="mt-4 text-sm"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const email = document.getElementById('newsletter-email').value;
    const messageDiv = document.getElementById('newsletter-message');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Disable button and show loading animation
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="relative z-10 flex items-center justify-center"><svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Envoi...</span>';
    
    // Add loading effect
    submitBtn.classList.add('loading');
    
    fetch('{{ route("newsletter.subscribe") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            email: email
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageDiv.innerHTML = '<div class="flex items-center justify-center text-green-400 animate-fade-in-up"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' + data.message + '</div>';
            form.reset();
        } else {
            messageDiv.innerHTML = '<div class="flex items-center justify-center text-red-400 animate-fade-in-up"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' + data.message + '</div>';
        }
    })
    .catch(error => {
        messageDiv.innerHTML = '<div class="flex items-center justify-center text-red-400 animate-fade-in-up"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>Une erreur est survenue. Veuillez réessayer.</div>';
    })
    .finally(() => {
        // Reset button
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<span class="relative z-10 flex items-center justify-center"><svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>S\'abonner</span>';
        submitBtn.classList.remove('loading');
        
        // Clear message after 5 seconds
        setTimeout(() => {
            messageDiv.innerHTML = '';
        }, 5000);
    });
});
</script>