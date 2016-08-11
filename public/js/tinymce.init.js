	function intTinymce(seletor){
		 //############## TINYMCE
    tinyMCE.init({
        selector: seletor,
        language: 'pt_BR',
        menubar: false,
        theme: "modern",
        height: 300,
        skin: 'light',
        entity_encoding: "raw",
        theme_advanced_resizing: true,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor media"
        ],
        toolbar: "styleselect | forecolor | backcolor | pastetext | removeformat |  bold | italic | underline | strikethrough | bullist | numlist | alignleft | aligncenter | alignright |  link | unlink | btnimage | media |  outdent | indent | forecolor | fullscreen | preview | code",
        content_css: "/js/tinymce/tinyMCE.css",
        style_formats: [
            {title: 'Normal', block: 'p'},
            {title: 'Titulo 3', block: 'h3'},
            {title: 'Titulo 4', block: 'h4'},
            {title: 'Titulo 5', block: 'h5'},
            {title: 'Código', block: 'pre', classes: 'brush: php;'}
        ],
        setup: function (editor) {
            editor.addButton('btnimage', {
                title: 'Enviar Imagem',
                icon: 'image',
                onclick: function () {
                  $('._imageupload').fadeIn('fast');
                }
            });
        },
        link_title: false,
        target_list: false,
        theme_advanced_blockformats: "h1,h2,h3,h4,h5,p,pre",
        media_dimensions: false,
        media_poster: false,
        media_alt_source: false,
        media_embed: false,
        extended_valid_elements: "a[href|target=_blank|rel]",
        imagemanager_insert_template: '<img src="{$url}" title="{$title}" alt="{$title}" />',
        image_dimensions: false,
        relative_urls: true,
        remove_script_host: false
    });
}
$(function ()
{
    intTinymce("#table-class");
    intTinymce("#model-class");
    intTinymce("#form-class");
})
	 