<?php



require_once("sesion.class.php");
$sesion = new sesion();

	
	function validarUsuario($usuario, $password)
	{


		$conexion = new mysqli("localhost","root","1234","prestaciones");
		$consulta = "select * from administrador where usuario = '$usuario' and  tipo=2";
		
		$result = $conexion->query($consulta);
		
		if($result->num_rows > 0)
		{
			$fila = $result->fetch_assoc();
			if( strcmp($password,$fila["pass"]) == 0 )
				return true;						
			else					
				return false;
		}
		
		else
				return false;
	}
	$tipo=$fila["tipo"];
	if( isset($_POST["iniciar"]) )
	{
		
		$usuario = $_POST["usuario"];
	
		 $password = md5($_POST["pass"]);
		

		if(validarUsuario($usuario,$password) == true)
		{			
			$sesion->set("usuario_dq",$usuario);
			$sesion->set("pass",$password);
			
            echo '<script type="text/javascript">
                window.location="paginas/index2.php";
            </script>';
			
			//header("location: paginas/index.php");
		}
		else 
		{
			echo "<center> <h1>Verifica tu nombre de usuario y clave</h1> </center>";
		}
	}

?>
<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <title>Prestaciones Sociales</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    
	   <script src="js/calendario/jquery-ui.min.js" type="text/javascript" ></script>
        <script src="js/tipo_alimen.js"></script>
        <script src="js/validarfrom.js"></script>
        <!--<script src="cordova.js"></script>-->

        <script>
        $(function() {
            $( "[data-role='navbar']" ).navbar();
            $( "[data-role='header'], [data-role='footer']" ).toolbar();
        });
        // Update the contents of the toolbars
        $( document ).on( "pagecontainerchange", function() {
            // Each of the four pages in this demo has a data-title attribute
            // which value is equal to the text of the nav button
            // For example, on first page: <div data-role="page" data-title="Info">
            var current = $( ".ui-page-active" ).jqmData( "title" );
            // Change the heading
            $( "[data-role='header'] h1" ).text( current );
            // Remove active class from nav buttons
            $( "[data-role='navbar'] a.ui-btn-active" ).removeClass( "ui-btn-active" );
            // Add active class to current nav button
            $( "[data-role='navbar'] a" ).each(function() {
                if ( $( this ).text() === current ) {
                    $( this ).addClass( "ui-btn-active" );
                }
            });
        });
    </script>
	
    </head>
    <body class="lockscreen">

        <div class="form-box" id="login-box">
            <div class="header">Inicie Sesion</div>
            <form  name="frmLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="usuario" class="form-control" placeholder="User"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Recordar
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="iniciar" class="btn bg-olive btn-block">Entrar</button>  
                    
                  <center>  <p><a href="#">Olvido su contraseña?</a></p>
				  <center>  <p><a href="index.php">Entrar Como Administrador</a></p>
                    
              
					</center>
                </div>
            </form>

         
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>