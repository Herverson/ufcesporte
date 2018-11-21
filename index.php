<?php include 'menu.php'?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tabela | campeonato</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php require_once "conexao.php" ?>
<div class="container">
	<div class="row">
    	<div class="col-lg-10">

			<table class="table table-bordered table-hover">
			  <tr>
				<td>Classificação</td>
				<td>Pontos</td>
				<td>Vitórias</td>
				<td>Empates</td>
				<td>Derrotas</td>
				<!--<td>Ação:</td>-->
			  </tr>

	       <?php
     
			$query = "SELECT * FROM times ORDER BY nome";
			
			$result = mysqli_query($dbc, $query);
			$cont = 0;
			while ($time = mysqli_fetch_array($result)) 
			{
				$cont++;
				// query2 pontos
				$query2 = "SELECT (COUNT(*) * 3) AS pontos FROM resultados WHERE vencedor_id = ".$time["id"];
				$result2 = mysqli_query($dbc, $query2);
				$pontos = mysqli_fetch_array($result2);
				
				// query3 vitorias
				$query3 = "SELECT COUNT(*) AS vitorias FROM resultados WHERE vencedor_id = ".$time["id"];
				$result3 = mysqli_query($dbc, $query3);
				$vitorias = mysqli_fetch_array($result3);
				
				// quer4 empates
				$query4 = "SELECT COUNT(*) AS empates FROM resultados WHERE empate_casa_id = "
					. $time["id"]. " OR empate_fora_id = " . $time["id"] ;
				$result4 = mysqli_query($dbc, $query4);
				$empates = mysqli_fetch_array($result4);
				
				// query5 derrotas
				$query5 = "SELECT COUNT(*) AS derrotas FROM resultados WHERE perdedor_id = " . $time["id"] ;
				$result5 = mysqli_query($dbc, $query5);
				$derrotas = mysqli_fetch_array($result5);
				
				
     		?>
			  <tr>
				<td><?php  $nome = $time["nome"]; echo "$cont "; echo "$nome<br>"; ?> </td>
				<td><?php  $ponto = $pontos["pontos"] + $empates["empates"]; echo "$ponto<br>"; ?> </td>
				<td><?php  $vitoria = $vitorias["vitorias"]; echo "$vitoria<br>"; ?> </td>
				<td><?php  $empate = $empates["empates"]; echo "$empate<br>"; ?> </td>
				<td><?php  $derrota = $derrotas["derrotas"]; echo "$derrota<br>"; ?> </td>
			</tr>
    <?php
    }
    ?>
    </table>
</div>
</div>
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>