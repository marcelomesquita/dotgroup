<?php

use yii\helpers\Url;

/**
 * @var $this yii\web\View
 */

$this->title = Yii::$app->name;

?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
				<button type="button" class="btn btn-primary novaTarefa">Nova Tarefa</button>
				<hr />

                <div class="tarefas"></div>

				<hr />
				<button type="button" class="btn btn-primary novaTarefa">Nova Tarefa</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs('
var prioridade = 0;

function carregarTarefas() {
	$(".tarefas").html("");

    $.ajax({
        url: "' . Url::toRoute('tarefa/index') . '",
        beforeSend: function() {
            $("#carregando").show();
        },
        complete: function() {
            $("#carregando").hide();
        },
        success: function(json) {
            if (json.tarefas.length == 0) {
                alert("Nenhuma tarefa encontrada!");
            } else {
                $.each(json.tarefas, function(i, tarefa) {
                    $(".tarefas").append(panel(tarefa));
                });
            }
        },
        error: function(error) {
            alert(error.statusText);
        }
    });
}

function panel(tarefa = {id: null, prioridade: 0, titulo: "", descricao: ""}) {
	if (prioridade <= tarefa.prioridade) {
		prioridade = tarefa.prioridade + 1;
	}

	var panel = "";

	panel += "<div class=\"panel panel-default tarefa\" id=\"tarefa-" + tarefa.id + "\">";
	panel += "<div class=\"panel-heading\">";
	panel += "<a href=\"#tarefa-content-" + tarefa.id + "\" class=\"text-muted titulo\" data-toggle=\"collapse\">";
	panel += tarefa.titulo == "" ? "nova tarefa" : tarefa.titulo;
	panel += "</a>";
	panel += "<a href=\"#\" class=\"close deletar\"><span>&times;</span></a>";
	panel += "</div>";
	panel += "<div class=\"panel-body collapse " + (tarefa.id == null ? "in" : "") + "\" id=\"tarefa-content-" + tarefa.id + "\">";
	panel += "<form>";
	panel += "<input type=\"hidden\" name=\"id\" value=\"" + tarefa.id + "\" />";
	panel += "<input type=\"hidden\" name=\"prioridade\" value=\"" + (tarefa.prioridade == 0 ? prioridade++ : tarefa.prioridade) + "\" />";
	panel += "<div class=\"form-group titulo\">";
	panel += "<input type=\"text\" name=\"titulo\" value=\"" + tarefa.titulo + "\" class=\"form-control\" placeholder=\"titulo\" autofocus />";
	panel += "<p class=\"help-block\"></p>";
	panel += "</div>";
	panel += "<div class=\"form-group descricao\">";
	panel += "<textarea name=\"descricao\" placeholder=\"descrição\" class=\"form-control\">" + tarefa.descricao + "</textarea>";
	panel += "</div>";
	panel += "<button type=\"submit\" class=\"btn btn-default salvar\">Salvar</button>";
	panel += "</div>";
	panel += "</div>";

	return panel;
}

carregarTarefas();

$(".novaTarefa").on("click", function() {
	$(".tarefas").append(panel());

	$(".tarefas .tarefa:last-child").find("input[name=\"titulo\"]").focus();
});

$(".tarefas").on("submit", ".tarefa form", function(e) {
	e.preventDefault();

	var panel = $(this).parents(".tarefa");
	var nova = isNaN(panel.find("input[name=\"id\"]").val());
	var tarefa = {
		prioridade: panel.find("input[name=\"prioridade\"]").val(),
		titulo: panel.find("input[name=\"titulo\"]").val(),
		descricao: panel.find("textarea[name=\"descricao\"]").val()
	};

	if (!nova) {
		tarefa.id = panel.find("input[name=\"id\"]").val();
	}

	$.ajax({
		url: nova ? "' . Url::toRoute('tarefa/create') . '" : "' . Url::toRoute('tarefa/update') . '?id=" + tarefa.id,
		method: "POST",
		data: {
			Tarefa: tarefa
		},
        beforeSend: function() {
            $("#carregando").show();
        },
        complete: function() {
            $("#carregando").hide();
        },
        success: function(json) {
			if (nova) {
				panel.find("input[name=\"id\"]").val(json.tarefa.id);
				panel.find(".titulo").html(json.tarefa.titulo);
			}

			panel.find("input[name=\"titulo\"]").focus();

			alert(json.mensagem);
        },
        error: function(error) {
            alert(error.statusText);
        }
    });
});

$(".tarefas").on("click", ".deletar", function() {
	var panel = $(this).parents(".tarefa");
	var tarefa = {
		id: panel.find("input[name=\"id\"]").val()
	};

	$.ajax({
		url: "' . Url::toRoute('tarefa/delete') . '?id=" + tarefa.id,
		method: "DELETE",
        beforeSend: function() {
            $("#carregando").show();
        },
        complete: function() {
            $("#carregando").hide();
        },
        success: function(json) {
			panel.remove();

			alert(json.mensagem);
        },
        error: function(error) {
            alert(error.statusText);
        }
	});
});
');
