window.googleTranslateElementInit = function() {
    new google.translate.TranslateElement({
        pageLanguage: 'es', 
        includedLanguages: 'es,en',
        autoDisplay: false
    }, 'google_translate_element');
};

window.cambiarIdiomaGTranslate = function(idioma) {
    var select = document.querySelector('.goog-te-combo');
    if (select) {
        select.value = idioma;
        select.dispatchEvent(new Event('change'));
    }
};
