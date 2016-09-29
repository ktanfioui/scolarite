function addExercice()
{
	var data = CKEDITOR.instances.editorContent.getData();

	var e = document.getElementById("q_option");
	var optionSelected = e.options[e.selectedIndex].value;

	if (data != "") 
	{
		if (optionSelected != "null") 
		{
			createNewExercice(data,parseInt(optionSelected));
			document.getElementById("q_option").removeChild(document.getElementById(optionSelected));
			CKEDITOR.instances.editorContent.setData('');
		};
	};
}


function createNewExercice(data,numQuestion)
{
	/* header */
	var block_web = document.createElement("div");
	block_web.setAttribute('class',"block-web");
	var header = document.createElement("div");
	header.setAttribute('class',"header");
	var content_header = document.createElement("h3");
	content_header.setAttribute('class',"content-header colored");
	content_header.appendChild(document.createTextNode("Repense Exercice "+numQuestion));
	header.appendChild(content_header);
	block_web.appendChild(header);

	/* content */
	var porlets_content = document.createElement("div");
	porlets_content.setAttribute('class',"porlets-content");
	porlets_content.innerHTML = data;
	block_web.appendChild(porlets_content);

	var main = document.getElementById("exercicesContainer");
	main.appendChild(block_web);
	createSaveFormExercice(data,numQuestion);
}

function createSaveFormExercice(data,numQuestion)
{
	document.getElementById("exercice"+numQuestion).appendChild(document.createTextNode(data));
}

