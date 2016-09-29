function addExercice()
{
	var data = CKEDITOR.instances.editorContent.getData();
	document.getElementById("erreurMessage").innerHTML = "";

	var e = document.getElementById("q_option");
	var optionSelected = e.options[e.selectedIndex].value;

	if (data != "") 
	{
		if (optionSelected != "null") 
		{
			createNewExercice(data,parseInt(optionSelected));
			document.getElementById("q_option").removeChild(document.getElementById(optionSelected));
			CKEDITOR.instances.editorContent.setData('');
			if (endCorrectionExercice()) 
			{
				document.getElementById("questionsForm").setAttribute('class',"hide");
				document.getElementById("btn-final").setAttribute('class',"btn btn-valider full");
			};
		} 
		else
		{
			erreurMessage("Vous devez sélectionner une question",document.getElementById("erreurMessage"));
		};
	}
	else
	{	
		erreurMessage("Erreur Champ vide",document.getElementById("erreurMessage"));
	};
}

function endCorrectionExercice()
{
	var nbrQuestionCorriger = document.getElementById("nbrQuestionCorriger").value;
	var nbrQuestion = document.getElementById("nbrQuestion").value;
	if (parseInt(nbrQuestion) == parseInt(nbrQuestionCorriger)) { return true; };
	return false;
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
	content_header.appendChild(document.createTextNode("Exercice "+numQuestion));
	header.appendChild(content_header);
	block_web.appendChild(header);

	/* content */
	var porlets_content = document.createElement("div");
	porlets_content.setAttribute('class',"porlets-content");
	porlets_content.innerHTML = data;
	block_web.appendChild(porlets_content);

	var main = document.getElementById("questionsContainer");
	main.appendChild(block_web);
	
	document.getElementById("nbrQuestionCorriger").setAttribute('value',parseInt(document.getElementById("nbrQuestionCorriger").value)+1);
	createSaveFormExercice(data,numQuestion);
}

function createSaveFormExercice(data,numQuestion)
{
	var mainForm = document.getElementById("saveForm");

	var textarea = document.createElement("textarea");
	textarea.setAttribute('class',"hide");
	textarea.setAttribute('name',"question_"+numQuestion);
	textarea.appendChild(document.createTextNode(data));
	mainForm.appendChild(textarea);
}

function erreurMessage(message,element)
{
	var bs_example = document.createElement("div");
	bs_example.setAttribute('class',"bs-example");

	var alert_warning = document.createElement("div");
	alert_warning.setAttribute('class',"alert alert-danger fade in");

	var btn = document.createElement("button");
	btn.setAttribute('aria-hidden',"true");
	btn.setAttribute('data-dismiss',"alert");
	btn.setAttribute('class',"close");
	btn.setAttribute('type',"button");
	btn.appendChild(document.createTextNode("×"));

	alert_warning.appendChild(btn);
	alert_warning.appendChild(document.createTextNode(message));
	bs_example.appendChild(alert_warning);

	element.appendChild(bs_example);
}

