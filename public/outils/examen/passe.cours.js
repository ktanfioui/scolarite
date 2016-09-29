function addCorrectionQuestionCours()
{
	var data = CKEDITOR.instances.editorContent_cours.getData();

	var e = document.getElementById("q_option_cours");
	var optionSelected = e.options[e.selectedIndex].value;

	if (data != "") 
	{
		if (optionSelected != "null") 
		{
			createNewQuestionCours(data,parseInt(optionSelected));
			document.getElementById("q_option_cours").removeChild(document.getElementById(optionSelected));
			CKEDITOR.instances.editorContent_cours.setData('');
		};
	};
}

function createNewQuestionCours(data,numQuestion)
{
	/* header */
	var block_web = document.createElement("div");
	block_web.setAttribute('class',"block-web");
	var header = document.createElement("div");
	header.setAttribute('class',"header");
	var content_header = document.createElement("h3");
	content_header.setAttribute('class',"content-header colored");
	content_header.appendChild(document.createTextNode("Repense de la Question "+numQuestion+" du cours"));
	header.appendChild(content_header);
	block_web.appendChild(header);

	/* content */
	var porlets_content = document.createElement("div");
	porlets_content.setAttribute('class',"porlets-content");
	porlets_content.innerHTML = data;
	block_web.appendChild(porlets_content);

	var main = document.getElementById("questionsContainer");
	main.appendChild(block_web);
	createSaveFormCours(data,numQuestion);
}

function createSaveFormCours(data,numQuestion)
{
	document.getElementById("cours"+numQuestion).appendChild(document.createTextNode(data));
}


