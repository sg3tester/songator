tinymce.init({
	    selector: "textarea#elm1",
	    theme: "modern",
	    menubar : false,
	    width: 722,
	    height: 300,
	    language: "cs",
	    plugins: [
		 "filemanager advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
		 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		 "save table contextmenu directionality emoticons template paste textcolor"
	   ],
	   image_advtab: true,
	   target_list: [
		{title: 'Tato stránka (_self)', value: '_self'},
		{title: 'Nová záložka (_blank)', value: '_blank'}
	    ],
	   content_css: "/css/editor.css",
	   toolbar: "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist table outdent indent | link unlink image media charmap | forecolor backcolor emoticons | code fullscreen", 
	   style_formats: [
		{title: 'Normální', block: 'p'},
		{title: 'Nadpis 2', block: 'h2'},
		{title: 'Nadpis 3', block: 'h3'},
		{title: 'Citace', block: 'p', classes: 'text-quote'},
		{title: 'Řeč', inline: 'span', classes: 'text-speech'}
	    ]
	 }); 