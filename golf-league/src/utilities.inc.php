    <div class="utilities">
        <div class="login">
<?php
        if (isset($_SESSION["firstName"])) { 
?>
            Welcome <?=$_SESSION["firstName"]?>! <a href="/login.php?logout=1">Not <?=$_SESSION["firstName"]?>?</a> <a href="/member/myAccount.php">My Account</a>
<?php
        } else {
?>
            <a href="/login.php">Login</a>
<?php
        } 
?>
        </div>
        <div class="weather">
             <script type="text/javascript" src="http://voap.weather.com/weather/oap/29223?template=GOLFH&par=3000000007&unit=0&key=twciweatherwidget"></script>
        </div>
    </div>