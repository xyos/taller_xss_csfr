<?
session_start();
if(isset($_GET['user']) && isset($_GET['pass']) 
  && $_GET['user'] === "hola" && $_GET['pass'] === "mundo" ){
    $_SESSION['user'] = $_GET['user'];
} else {
    header("Location: http://localhost/csfr/login/");
}
if ($_SESSION['user'] === "hola") {
?>
<html>
  <body>
    <form action="http://localhost/csfr/transfer/" method="post">
      <input type="text" name="name" placeholder="name"><br>
      <input type="text" name="amount" placeholder="amount"><br>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
<?
} else {
  echo("not authorized");
}
?>

