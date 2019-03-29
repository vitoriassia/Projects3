<?php
//INICIO A SESSÃO
session_start();
 include("checarprofessor.php"); 
 require_once 'ControllerCurso.php';
 require_once 'ControllerProfessor.php';
 $curso = new Curso();
 $professor = new Professor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon" />
  <title>Professores</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="Style.css" rel="stylesheet" type="text/css">
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
      <a class="navbar-brand CDC-link-home" href="home.php">CDC</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a class="menu-white" href="curso.php">Curso</a></li>
        <li><a class="menu-white" href="aluno.php">Aluno</a></li>
        <li><a class="menu-white" href="professor.php">Professor</a></li>
		<li><a class="menu-white" href="sair.php">Sair</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Logo central -->

<div class="jumbotron text-center">
  <h1>Fatec Jundiai</h1> 
  <p>Controle de cursos</p> 
</div>

<!-- Professor dados -->
<div>
<?php 

$exibir= $professor->get_professor($_SESSION['Email']);
$email =$_SESSION['Email'];

    

?>
<h2> Seus Dados </h2>
<form name=form1 action="ProfessorAltera.php" METHOD="post" enctype="multipart/form-data" class="needs-validation" novalidate>
<ul>
      <li>Nome: <?php echo $exibir['Nome']; ?></li>
      <li>Email: <?php echo $exibir['Email']; ?></li>
      <li>RA: <?php echo $_SESSION['Id']; ?></li>
      </ul>
      <input type=hidden name=Nome value= <?php echo $exibir['Nome'];?>>
      <input type=hidden name=Email value= <?php echo $exibir['Email'];?>>
      <input type=hidden name=RA value= <?php echo $exibir['IdProfessor'];?>>
      <button type=submit name=acao value=Alterar>Alterar</button>
      
  </form>
  <form name=form1 action="ProfessorFazer.php" METHOD="post" enctype="multipart/form-data" class="needs-validation" novalidate>
  <input type=hidden name=RA value= <?php echo $exibir['RA'];?>>
  <button type=submit name=acao value=Excluir>Excluir</button>
  </form>
<div>

<!-- Controle e cadastro de curso (Professor) -->

<div id="services" class="container-fluid text-center">
  <h2>Controle e cadastro de cursos</h2>
  <br>
  <div class="row slideanim">
  <?php
  include("conexao/conexao.php");

  // Cadastro de cursos
  
  // Colocando o Início da tabela

  
  // Fazendo uma consulta SQL e retornando os resultados em uma tabela HTML
  $resultado = $curso -> exibir_cursos();
  $condicao = False;
  
  while ($linha = mysqli_fetch_array($resultado)) {
    if ($_SESSION['Nome'] == $linha['IDprofessor']){
  
      echo "<td>";
                    ?>
      <div class="display-menu">

      <tr>
            <td>
                <img src="iconecurso/<?php echo $linha['nome_imagem'];?>" width="300" height="300">
            </td>
        </tr>
        <tr>
            <td>
                <p><b>ID Curso:</b><?php echo $linha['IDcurso']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><b>Professor:</b><?php echo $linha['IDprofessor']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><b>Nome:</b><?php echo $linha['Nome']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><b>Quantidade de Aulas:</b><?php echo $linha['QTDaula']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><b>Data Inicio/Final</b><br><?php echo $linha['dataStart'].'/'.$linha['dateEnd']; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><b> Descrição: </b><?php echo $linha['Descricao']; ?></p>
            </td>
        </tr>
        <tr>
          <td>
              <form method=post action=Cursoaltera.php name=form2>
                <input type=hidden name=IDcurso value=<?php echo $linha['IDcurso'];?>>
                <input type=submit class="btn btn-primary margin-btn" value=Alterar>
              </form>
              <form method=post action=Cursoexclui.php name=form3>
                  <input type=hidden name=IDcurso value= <?php echo $linha['IDcurso'];?>>
                  <input type=hidden name=IDprofessor value=<?php echo $linha['IDprofessor'];?>>
                  <input type=hidden name=Nome value=<?php echo $linha['Nome'];?>>
                  <input type=hidden name=QTDaula value=<?php echo $linha['QTDaula'];?>>
                  <input type=submit class="btn btn-danger margin-btn" value=Excluir></li>
              </form>
          </td>
        </tr>
    </td>
      </div>
        </td>
        <?php $condicao= True ;}?>
        
   <?php
  }
  if ($condicao == False){echo "<h2 style='color: red'>Você não possui nenhum curso.</h2>"; }
  echo '</tr>';
  echo "<tr>";
  echo "<td colspan=5>";
  echo "<form method=post action=Cursoinclui.php name=form3>";
  echo "<br>";
  echo "<input type=submit class=btn btn-info value=Incluir>";
  echo "</form>";
  echo "</td>";
  
?>
</div>

<!-- Area para fazer chamada -->
<?php if ($condicao){ ?>
<div id="services" class="container-fluid text-center">
  <h2>Alunos cadastrados:</h2>
  <br>
    <?php
    
  include("conexao/conexao.php");
  $nome = $_SESSION['Nome'];
  $query1 = "SELECT curso.Nome FROM curso WHERE curso.IDprofessor = '$nome' ";
  $resultado1 = mysqli_query($conexao,$query1);
  while ($linha1 = mysqli_fetch_array($resultado1)) {
  $curso = $linha1['Nome'];
  // Colocando o Início da tabela
  echo '<div id="accordion">
  <div class="card">
        <div class="card-header" id="1">
            <h5 class="mb-0">
            <button class="btn btn-info btn-lg btn-block" data-toggle="collapse" data-target="#'.$curso.'" aria-expanded="true" aria-controls="collapseOne">
               '.$curso.'
            </button>
            </h5>
        </div>';
  echo '<div id="'.$curso.'" class="collapse " aria-labelledby="1" data-parent="#accordion">
  <div class="card-body">';
  echo "<table class='table table-hover table-dark' >";
  echo "</tr>";
   echo "<td><b>Aluno</b></td>";
  echo "<td><b>Presença</b></td>";
  echo "<td><b>Presente</b></td>";
  echo "</tr>";
  // Fazendo uma consulta SQL e retornando os resultados em uma tabela HTML 
  $nome = $_SESSION['Nome'];
  $query = "SELECT DISTINCT aprendizado.IDaluno , aprendizado.presenca ,aprendizado.IDcurso FROM aprendizado INNER JOIN curso ON aprendizado.IDcurso = curso.Nome INNER JOIN professor ON curso.IDprofessor = '$nome' WHERE aprendizado.IDcurso = '$curso'";
  $resultado = mysqli_query($conexao,$query);
  while ($linha = mysqli_fetch_array($resultado)) {
   echo "<tr>";
   echo "<td>".$linha['IDaluno']."</td>";
   echo "<td>".$linha['presenca']."</td>";
   echo "<td width=50>";  
   echo "<form method=post action=Aprendizadofazer.php name=form3>";   
   echo "<input type=hidden name=Nome value=".$linha['IDaluno'].">";
   echo "<input type=hidden name=presenca value=".$linha['presenca'].">";
   echo "<input type=hidden name=IDcurso value=".$linha['IDcurso'].">";
   echo "<input checked type=checkbox class=checkbox name=presente[] value=".$linha['IDaluno'].">";
   echo "</td>";
   echo "</tr>";
    
  }
  echo "</table>";
  echo '<button class="btn btn-primary" type=submit name=acao value=Presença>Confirmar</button>';
  echo '</div>
</div>';
  echo "</div>";
  echo "</form>";
}

$a = $linha['presenca'];
  mysqli_close($conexao);
} 
?>
</div>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
</footer>
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