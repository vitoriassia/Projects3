<?php
//INICIO A SESSÃO
session_start();
 include("../checarprofessor.php");
 require_once '../curso/ControllerCurso.php';
 require_once 'ControllerProfessor.php';
 $curso = new Curso();
 $professor = new Professor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="../imagens/favicon.png" type="image/x-icon" />
  <title>Professores</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="../Style.css" rel="stylesheet" type="text/css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<!-- Menu -->

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../home.php">CDC</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
           
                <!-- <li><a class="menu-white" href="curso.php">Curso</a></li>
                <li><a class="menu-white" href="aluno.php">Aluno</a></li> -->
               <!-- <h5 class="menu-white">Bem vindo <?php echo $_SESSION['tipo'];?></h5> -->
                <li><a class="menu-white" href="professor.php">Meus Cursos</a></li>
                <li><a class="menu-white" href="../sair.php">Sair</a></li>
                
            </ul>
        </div>
    </div>
</nav>

<!-- Logo central -->

<div class="jumbotron text-center alignProf jumbotron-padding">
  <h1>Fatec Jundiai</h1> 
  <p>Área do professor</p>
</div>

<!-- Professor dados -->
<div>
<?php 

$exibir= $professor->get_professor($_SESSION['Id']);
$email =$_SESSION['Email'];

    

?>
</div>

<div class="row page--space">
    <div class=" col-sm-4">
        <div id="services" class="container-fluid text-center">
          <h4>

              Controle e Cadastro de Cursos

          </h4>
          <br>
          <div class="row">
          <?php
          include("../conexao/conexao.php");

          // Cadastro de cursos

          // Colocando o Início da tabela


          // Fazendo uma consulta SQL e retornando os resultados em uma tabela HTML
          $resultado = $curso -> get_cursos();
          $condicao = False;

          while ($linha = mysqli_fetch_array($resultado)) {
              if ($_SESSION['Id'] == $linha['IdProfessor']) {

                  echo "<td>";
                  ?>
                  <div class="display-menu" style="width: 90%">

                      <tr>
                          <td>
                              <img src="../curso/iconecurso/<?php echo $linha['NomeImagem']; ?>" width="50" height="50">
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <p><b>ID Curso:</b><?php echo $linha['IdCurso']; ?></p>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <p><b>Professor:</b><?php echo $linha['IdProfessor']; ?></p>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <p><b>Nome:</b><?php echo $linha['Nome']; ?></p>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <p><b>Quantidade de Aulas:</b><?php echo $linha['QtdAula']; ?></p>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <p><b>Data
                                      Inicio/Final</b><br><?php echo $linha['DateStart'] . '/' . $linha['DateEnd']; ?>
                              </p>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <p><b> Descrição: </b><?php echo $linha['Descricao']; ?></p>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <form method=post action=../curso/Cursoaltera.php name=form2>
                                  <input type=hidden name=IdCurso value=<?php echo $linha['IdCurso']; ?>>
                                  <input type=submit class="btn btn-primary margin-btn" value=Alterar>
                              </form>
                              <form method=post action=../curso/Cursoexclui.php name=form3>
                                  <input type=hidden name=IdCurso value= <?php echo $linha['IdCurso']; ?>>
                                  <input type=hidden name=IdProfessor value=<?php echo $linha['IdProfessor']; ?>>
                                  <input type=hidden name=Nome value=<?php echo $linha['Nome']; ?>>
                                  <input type=hidden name=QtdAula value=<?php echo $linha['QtdAula']; ?>>
                                  <input type=submit class="btn btn-danger margin-btn" value=Excluir></li>
                              </form>
                          </td>
                      </tr>
                      </td>
                  </div>
                  </td>
                  <?php $condicao = True;
              } ?>

              <?php
              echo '</tr>';
              echo "<tr>";
              echo "<td colspan=5>";
          }
              echo "<form method=post action=../curso/Cursoinclui.php name=form3>";
              echo "<br>";
              echo "<a><span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span></a>
                    <input type=submit class=btn btn-info value=Incluir>
                    <a><span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span></a>";
              echo "</form>";
              echo "</td>";

          if ($condicao == False){echo "<h2 style='color: red'>Você não possui nenhum curso.</h2>"; }


        ?>
        </div>
    </div>
    </div>
    <div class="col-sm-8">
        <!-- Area para fazer chamada -->
        <?php if ($condicao){ ?>
        <div id="services" class="container-fluid text-center">
            <?php echo '
            <h2>Arquivos para upload</h2>
            <table class="table table-hover text-left">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th width="1px"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Material aula 1</td>
                    <td>PDF com o Conteudo abordado em aula</td>
                    <td><a><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                    <td>Material aula 2</td>
                    <td>Power point sobre a tecnologia abordada</td>
                    <td><a><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                    <td>Material aula 3</td>
                    <td>Atividade para entrega dia 23/02</td>
                    <td><a><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></a></td>
                </tr>
                </tbody>
            </table>
            '; ?>
          <h2>Alunos cadastrados:</h2>
          <br>
            <?php

          include("../conexao/conexao.php");
          $idprofessor = $_SESSION['Id'];
          $query1 = "SELECT curso.Nome FROM curso WHERE curso.IdProfessor = '$idprofessor' ";
          $resultado1 = $curso->get_curso($idprofessor);
          while ($linha1 = mysqli_fetch_array($resultado1)) {
          $cursoinfo = $linha1['Nome'];
          // Colocando o Início da tabela
          echo '<div id="accordion">
          <div class="card">
                <div class="card-header" id="1">
                    <h5 class="mb-0">
                    <button class="btn btn-info btn-lg btn-block" data-toggle="collapse" data-target="#'.$cursoinfo.'" aria-expanded="true" aria-controls="collapseOne">
                       '.$cursoinfo.'
                    </button>
                    </h5>
                </div>';
          echo '<div id="'.$cursoinfo.'" class="collapse " aria-labelledby="1" data-parent="#accordion">
          <div class="card-body">';
          echo "<table class='table table-hover table-dark' >";
          echo "</tr>";
           echo "<td><b>Aluno</b></td>";
          echo "<td><b>Presença</b></td>";
          echo "<td><b>Presente</b></td>";
          echo "</tr>";
          // Fazendo uma consulta SQL e retornando os resultados em uma tabela HTML

          $idcursos = $linha1['IdCurso'];
          $query = "SELECT aprendizado.IdAluno, aprendizado.Presenca , aprendizado.IdCurso
                    FROM aprendizado 
                    JOIN curso ON aprendizado.IdCurso = curso.IdCurso
                    WHERE curso.IdProfessor = '$idprofessor ' AND curso.IdCurso = '$idcursos'";
          $resultado = mysqli_query($conexao,$query);
          while ($linha = mysqli_fetch_array($resultado)) {
           echo "<tr>";
           echo "<td>".$linha['IdAluno']."</td>";
           echo "<td>".$linha['Presenca']."</td>";
           echo "<td width=50>";

           // Inicio form presença!
           echo "<form method=post action=../aprendizado/Aprendizadofazer.php name=form3>";
           echo "<input type=hidden name=IdAluno value=".$linha['IdAluno'].">";
           echo "<input type=hidden name=presenca value=".$linha['Presenca'].">";
           echo "<input type=hidden name=IdCurso value=".$linha['IdCurso'].">";
           echo "<input checked type=checkbox class=checkbox name=presente[] value=".$linha['IdAluno'].">";
           echo "</td>";
           echo "</tr>";

          }
          echo "</table>";
          echo '<button class="btn btn-primary" type=submit name=acao value=Presença>Confirmar</button>';
          echo "</div>";
          echo "</form>";
        }
        $a = $linha['Presenca'];
          mysqli_close($conexao);
        }else{ ?>
                <div id="services" class="container-fluid text-center">
                    <h2>Crie seu curso agora mesmo</h2>
                    <a class="btn btn-info" href="../curso/Cursoinclui.php">Criar curso</a>
                </div>
        <?php   }
        ?>
        </div>
        </div>
    </div>
</div>

        <footer class="container-fluid text-center">
          <a href="#myPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>
          </a>
        </footer>
    </div>
</div>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>