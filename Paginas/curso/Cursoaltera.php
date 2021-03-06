<?php 
require_once 'ControllerCurso.php';
$curso1= new Curso();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Alteracao Curso</title>

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">

      <!-- Alteracao do curso -->

    <div class="container">
      <div class="py-5 text-center">
        <h2>Dados do Curso</h2>
        </div>

      <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Curso</h4>
          <form name=form1 action="Cursofazer.php" METHOD="post" enctype="multipart/form-data" class="needs-validation" novalidate>
              <div class="mb-3">
                <label for="firstName">Nome</label>
                <!--Id do curso sendo passado--> 
                <?php
                $IdCurso=$_POST["IdCurso"];
                $curso = $curso1 -> exibir_curso($IdCurso);?>
                
                <input type=text Name=Nome class=form-control id=Nome value=<?php echo $curso['Nome']; ?>
                <input type=hidden name=IdCurso value=<?php echo $IdCurso ?>>
                <div class="invalid-feedback">
                 Por favor colocar um Nome valido.
                </div>
                <label>Quantidade de aulas</label>
                <input type=number class=form-control name=QtdAula min=1 value=<?php  echo $curso['QtdAula']?>>
                <div class="invalid-feedback">
                 Por favor colocar um Nome valido.
                </div>
                
                <label for="Descricao">Descrição do curso</label>
                <textarea type="text" Name="Descricao" class="form-control" id="Descricao" value="" rows="3" required> <?php echo $curso['Descricao']?></textarea>
              

             
                <label for="Data inicio">Digite a Data de Inicio</label>
                <input  type="date" Name="DateStart" class="form-control" id="DateStart"  value=<?php echo $curso['DateStart'] ?> required>
                <div class="invalid-feedback">
                 Por favor colocar um numero valido.
                </div>
              

              
                <label for="Data Final">Digite a Data de Final</label>
                <input type="date" Name="DateEnd" class="form-control" id="DateEnd" min="1" value=<?php echo $curso['DateEnd'] ?> required>
                <div class="invalid-feedback">
                 Por favor colocar um numero valido.
                </div>
                 
                <label>Ícone do curso.</label>
                <input type="file" Name="imagem" class="form-control" id="imagem"  value="" accept="image/png, image/jpeg"  required>
                <div class="invalid-feedback">
                 Por favor colocar um arquivo valido.
                </div>
                </div>
              	
              </div>
              </br>
              
              </div>		
            <hr class="mb-4">			
            <button class="btn btn-primary btn-lg btn-block" type=submit name=acao value=Alterar>Alterar</button>
            <a href="/professor/professor.php" class="btn btn-danger btn-lg btn-block" role="button">Cancelar</a>
          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"></script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/vendor/holder.min.js"></script>
    <script>
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          var forms = document.getElementsByClassName('needs-validation');

          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>