$( document ).ready(function() {

    // Header "Action!" Button
    $("#sign-up").click(function() {
        $('html, body').animate({
            scrollTop: $(".sign-up").offset().top
        }, 2000);
        return false;
    });

    // Go to Top
    $("a[href='#top']").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
    
    // Reveal
    window.sr = ScrollReveal();
    sr.reveal('header');
    sr.reveal('.categories');
    sr.reveal('.wrapid-screenshots');
    sr.reveal('.main-sections');
    sr.reveal('.sign-up');
    sr.reveal('footer');
    
    sr.reveal('.about-us');
    
    
});