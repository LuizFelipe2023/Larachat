document.addEventListener("DOMContentLoaded", function () {
    let ckeditorConfig = {
        extraPlugins: 'wordcount',
        wordcount: {
            showCharCount: true,
            maxCharCount: 10000,
            charCountMsg: 'Caracteres restantes: {0}',
            maxCharCountMsg: 'Você atingiu o limite máximo de caracteres permitidos.'
        }
    };

    if (document.getElementById('descricao')) {
        CKEDITOR.replace('descricao', ckeditorConfig);
    }
    
});