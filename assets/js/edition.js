

function Fichier(){
	this.id;
	this.nom;
	this.date;
	this.heure;
	this.retard;
	this.getInfos = function(e){
	
		this.id = $(e).find("[data-fichier-id]").attr("data-fichier-id");
		this.nom = $(e).find(".fichier-name").val();
		this.date = $(e).find(".fichier-date").val();
		this.heure = $(e).find(".fichier-heure").val();
		this.retard = $(e).find(".fichier-retard").find("input:checked").val();
		
	}
}


function Devoir(){
	this.id;
	this.nom;
	this.groupe;
	this.fichiers;
	this.getInfos = function(e){
		
		this.id = $(e).find("[data-devoir-id]").attr("data-devoir-id");
		this.nom = $(e).find(".devoir-name").val();
		this.groupe = $(e).find(".devoir-groupe").find("input:checked").val();
		
		this.fichiers = new Array();
		var files = $(e).find(".fichiers").children(".fichier");
		
		for(var i=0; i < files.length; i++){
			var file = new Fichier();
			file.getInfos(files[i]);
			this.fichiers.push(file);
		}
		
		return this;
	}
}

function Matiere(){
	this.id;
	this.nom;
	this.devoirs;
	
	this.loadInfos = function(){
		this.id = $("[data-matiere-id]").attr("data-matiere-id");
		this.nom = $("#matiere-name").val();
		this.devoirs = new Array();
		var devs = $("#devoirs").children(".devoir");
		for(var i=0; i < devs.length; i++){
			
			var devoir = new Devoir();
			devoir.getInfos(devs[i]);
			this.devoirs.push(devoir);
		}
		
		
	}
	this.getJSON = function(){
		return JSON.stringify(this);
	}
	this.loadInfos();
}

function sendJSON(){

	event.preventDefault();
	var matiere = new Matiere();
	
	$.ajax({
		url:"/Users/Cours?i="+matiere.id,
		type:"POST",
		data:{
			jsonData : matiere.getJSON()
		},success : function(data){
			var data = JSON.parse(data);
			if(data.result == "ok"){
				$.UIkit.notify({message:"Le cours à bien été modifié", status:"success", timeout:5000,pos:'top-right'});	
			}else{
				$.UIkit.notify({message:"Erreur : "+data.result, status:"danger", timeout:5000,pos:'top-right'});		
			}
		}
	});
	return false;
}

function getTemplateFichier(){
	
}

function addFichier(){
	var block = $(this).parents(".devoir").find(".fichiers");
		$(block).append(gen.templateFichier());
}

function addDevoir(){
	$(".well").append(gen.templateDevoir());
}

function IdGen(){
	this.id_d = 0;
	this.id_f = 0;
	this.templateFichier = function(){
		this.id_f--;
		return $("#fichier-template").html().replace(new RegExp("{id_f}","g"),this.id_f);
	}
	this.templateDevoir = function(){
		this.id_d--;
		this.id_f--;
		return $("#devoir-template").html().replace(new RegExp("{id_d}","g"),this.id_d).replace(new RegExp("{id_f}","g"), this.id_f);
	}
}

$(document).ready(function(){

	gen = new IdGen();
	
	//$("#enregistrer").click(sendJSON);

	$(".btn-fichier").click(addFichier);
	$(".btn-devoir").click(addDevoir);
	
	
});