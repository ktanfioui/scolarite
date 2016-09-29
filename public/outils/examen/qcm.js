function addQuestionQCM()
{
	if (document.getElementById("nbrChoix").value != "" && !isNaN(document.getElementById("nbrChoix").value)) 
	{
		nbrChoix = parseInt(document.getElementById("nbrChoix").value);
		document.getElementById("newQuestion").className = "hide";
		document.getElementById("btn-final").className = "hide";
		createQuestionsFormQCM(nbrChoix);
	};
}

function createQuestionsFormQCM(n)
{
	/* header */
	var block_web = document.createElement("div");
	block_web.setAttribute('class',"block-web");
	var header = document.createElement("div");
	header.setAttribute('class',"header");
	var content_header = document.createElement("h3");
	content_header.setAttribute('class',"content-header");
	content_header.appendChild(document.createTextNode("Nouvelle Question"));
	header.appendChild(content_header);
	block_web.appendChild(header);

	/* content */
	var porlets_content = document.createElement("div");
	porlets_content.setAttribute('class',"porlets-content");

	/* form */
	var form = document.createElement("form");
	form.setAttribute('class',"form-horizontal row-border");

	/* question */

	var form_group = document.createElement("div");
	form_group.setAttribute('class',"form-group");

	var label = document.createElement("label");
	label.setAttribute('class',"col-sm-3 control-label");
	label.appendChild(document.createTextNode("Question"));

	var textareaContainer = document.createElement("div");
	textareaContainer.setAttribute('class',"col-sm-9");

	var textarea = document.createElement("textarea");
	textarea.setAttribute('type',"text");
	textarea.setAttribute('name',"question");
	textarea.setAttribute('id',"question");
	textarea.setAttribute('class',"form-control");

	textareaContainer.appendChild(textarea);
	form_group.appendChild(label);
	form_group.appendChild(textareaContainer);
	form.appendChild(form_group);

	/* choix */
	for (var i = 1; i < n+1; i++) 
	{
		var form_group = document.createElement("div");
		form_group.setAttribute('class',"form-group");

		var label = document.createElement("label");
		label.setAttribute('class',"col-sm-3 control-label");
		label.appendChild(document.createTextNode("Choix " + i));

		var inputContainer = document.createElement("div");
		inputContainer.setAttribute('class',"col-sm-9");

		var input = document.createElement("input");
		input.setAttribute('type',"text");
		input.setAttribute('name',"choix_"+i);
		input.setAttribute('id',"choix_"+i);
		input.setAttribute('class',"form-control");

		inputContainer.appendChild(input);
		form_group.appendChild(label);
		form_group.appendChild(inputContainer);
		form.appendChild(form_group);
	};
	/* valide button */
	var form_group_b = document.createElement("div");
	form_group_b.setAttribute('class',"form-group");

	var inputContainer_b = document.createElement("div");
	inputContainer_b.setAttribute('class',"col-sm-12");

	var button = document.createElement("input");
	button.setAttribute('type',"button");
	button.setAttribute('name',"question");
	button.setAttribute('value',"Ajouter");
	button.setAttribute('onClick',"createQuestionQCM()");
	button.setAttribute('class',"btn btn-valider pull-right");

	inputContainer_b.appendChild(button);
	form_group_b.appendChild(inputContainer_b);
	form.appendChild(form_group_b);

	/* saved */

	var nbrChoix = document.createElement("input");
	nbrChoix.setAttribute('type',"hidden");
	nbrChoix.setAttribute('id',"q_nbrChoix");
	nbrChoix.setAttribute('value',n);

	form.appendChild(nbrChoix);

	porlets_content.appendChild(form);
	block_web.appendChild(porlets_content);

	var main = document.getElementById("questionsForm");
	main.appendChild(block_web);
}

function createQuestionQCM()
{
	document.getElementById("erreurMessage").innerHTML = "";
	var flag = false;
	question = document.getElementById("question").value;
	nbrChoix = parseInt(document.getElementById("q_nbrChoix").value);
	q_num = document.getElementById("q-number").value;
	var choix = new Object();
	for (var i = 1; i < nbrChoix+1; i++) {
		if (document.getElementById("choix_"+i).value == "") 
		{
			flag = true;
		} 
		else
		{
			choix["choix_"+i] = document.getElementById("choix_"+i).value;
		};
	};

	if (question == "" || flag) 
	{
		erreurMessage("Erreur Champ vide",document.getElementById("erreurMessage"));
	}
	else
	{
		/* header */
		var block_web = document.createElement("div");
		block_web.setAttribute('class',"block-web");
		var header = document.createElement("div");
		header.setAttribute('class',"header");
		var content_header = document.createElement("h3");
		content_header.setAttribute('class',"content-header colored");
		content_header.appendChild(document.createTextNode("Q "+ q_num));
		header.appendChild(content_header);
		block_web.appendChild(header);

		/* content */
		var porlets_content = document.createElement("div");
		porlets_content.setAttribute('class',"porlets-content");

		var q_holder = document.createElement("h4");
		q_holder.appendChild(document.createTextNode(question));
		porlets_content.appendChild(q_holder);

		for (var i in choix) {
			var choixHodler = document.createElement("p");

			var icon = document.createElement("i");
			icon.setAttribute('class',"fa fa-circle colored");

			choixHodler.appendChild(icon);
			choixHodler.appendChild(document.createTextNode(" " + choix[i]));
			porlets_content.appendChild(choixHodler);
		};

		block_web.appendChild(porlets_content);

		var main = document.getElementById("questionsContainer");
		main.appendChild(block_web);
		document.getElementById("questionsForm").innerHTML = "";
		document.getElementById("newQuestion").className = "block-web";
		document.getElementById("btn-final").className = "btn btn-valider full";
		document.getElementById("q-number").setAttribute('value',parseInt(q_num)+1);
		createSaveFormQCM(question,choix,nbrChoix,parseInt(q_num));
	};
}

function createSaveFormQCM(question,choix,nbrChoix,q_num)
{
	var mainForm = document.getElementById("saveFormQCM");

	var inputQuestion = document.createElement("input");
	inputQuestion.setAttribute('type',"hidden");
	inputQuestion.setAttribute('name',"question_"+q_num);
	inputQuestion.setAttribute('value',question);
	mainForm.appendChild(inputQuestion);

	var inputNbrChoix = document.createElement("input");
	inputNbrChoix.setAttribute('type',"hidden");
	inputNbrChoix.setAttribute('name',"nbrChoix_"+q_num);
	inputNbrChoix.setAttribute('value',nbrChoix);
	mainForm.appendChild(inputNbrChoix);
	for (var i in choix) 
	{
		var inputChoix = document.createElement("input");
		inputChoix.setAttribute('type',"hidden");
		inputChoix.setAttribute('name',i+q_num);
		inputChoix.setAttribute('value',choix[i]);
		mainForm.appendChild(inputChoix);
	};

	document.getElementById("nbrQuestion").setAttribute('value',q_num);
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

