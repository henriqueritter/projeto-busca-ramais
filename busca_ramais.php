<!--
*****************************************
* Projeto Busca de Ramais Simples em	*
* PHP e MySQL.				*
* Data Busca de Ramais 04/dez/2017	*
* Última revisão: henrique		*
*****************************************
-->
<?php
header('Content-type: text/html; charset=ISO-8859-1');
//mb_internal_encoding("UTF-8");
//mb_http_output("UTF-8");
//mb_http_input("UTF-8");
//mb_language("uni");
//mb_regex_encoding("UTF-8");
//ob_start("mb_output_handler");
// definições de host, database, usuário e senha
$host = "mysql.endereço.do.bd";   
$db   = "nome_do_banco";
$user = "usuario";
$pass = "senha";
// conecta ao banco de dados
$con = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 
// seleciona a base de dados em que vamos trabalhar
mysql_select_db($db, $con);
//nome_busca recebe o valor do campo text do formulario
$nome_busca = $_GET['campo_busca'];
//define o texto para caixa baixa
$nome_busca = strtolower($nome_busca);
// cria a instrução SQL que vai selecionar os dados
$query = ("SELECT id, nome, depto, local, ramal, email, celular FROM lista_ramais WHERE LOWER(nome) LIKE '%$nome_busca%' ORDER BY nome"); //sprintf
// executa a query
$dados = mysql_query($query, $con) or die(mysql_error());
// transforma os dados em um array
$linha = mysql_fetch_assoc($dados);
// calcula quantos dados retornaram 
$total = mysql_num_rows($dados);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Projeto Lista Ramais PHP e MYSQL</title>
	</head>
	<body BGCOLOR="#FFFFFF" TEXT="#000080" LINK="#FF0000" VLINK="#FF0000" ALINK="#FF0000">

		<p> <!--<IMG SRC="logo.jpg" align="left" height="60" width="160"> --></p>
		<br><br><br>
		<form action= " " method="GET">
			<h2> <b> <u> Busca de Ramais </h2>  </u> </b> 			
			<input type="text" name="campo_busca" value="">
			<input type="submit" name="botao" value="Buscar" class="searchbutton" > <br>
			<font size="2">  Insira qualquer parte do nome e clique em buscar </font>
		</form>

		<br>
	
<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($nome_busca != "") {
		if($total > 0) {
		// inicia o loop que vai mostrar todos os dados
?>
			<font size="4.5">Resultados para: <b><u><?echo $nome_busca ?> </u></b>  </font> <br>
<?php
			
			do {
?>
		
				<p>
				<font size="3">
				<b>Nome:</b> <?=$linha['nome']?> <br>  	
				<?php //cada IF a seguir verifica se cada coluna está preenchida, caso esteja em branco a linha não será impressa ?>   
				<?php if($linha['depto']!= "") {   ?>  <b> Departamento:</b> <?=$linha['depto']?> <br>	<?php } ?>
				<?php if($linha['local']!= "") {   ?>  <b> Local:</b> <?=$linha['local']?> <br>			<?php } ?>
				<?php if($linha['ramal']!= "") {   ?>  <b>Ramal:</b> <?=$linha['ramal']?> <br>			<?php } ?>
				<?php if($linha['celular']!= "") { ?>  <b>Celular:</b> <?=$linha['celular']?> <br>		<?php } ?>
				<?php if($linha['email']!= "") {   ?>  <b>E-mail: </b> <?=$linha['email']?> <br>		<?php } ?>
				<b> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </b>	  
				</p>
			</font>
<?php
			// finaliza o loop que vai mostrar os dados
			}while($linha = mysql_fetch_assoc($dados));
		// fim do segundo if
		}
	// fim do primeeiro if
	}
?> 
	</body>
</html>
<?php
// tira o resultado da busca da memória
mysql_free_result($dados);
?>
