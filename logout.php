<script type="text/javascript">
    
<?php 
    session_start();

    unset($_SESSION['Email']);
    unset($_SESSION['Password']);  
?>

window.location.href='index.php';
alert("Successfully Logged Out!");

</script>