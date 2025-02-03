<?php include "header.php" ?>
<?php include "connection.php" ?>
<?php
$sql="select * from region";
$r=mysqli_query($con,$sql);
// print_r(mysqli_fetch_all($r));
?>
<body>
    <div class="formSignIn">
        <form action="createaccount.php" method="post">
            <h3>sign up</h3>
            <div class="inputsGroup">
                <input type="text" 
                name="user" 
                placeholder=" "
                id="username" 
                value= <?php if(isset($_SESSION['user'])) echo $_SESSION['user'] ?>>
                <label for="username">User Name</label>
            </div>

            <div class="inputsGroup">
                <input type="text" name="pass" id="password" placeholder=" ">
                
                <label for="password">Password</label>
            </div>

            <div class="inputsGroup">
                <label for="country" class="a">Country</label>
                <select name="country">
                    <?php while($row=mysqli_fetch_assoc($r)) {?>
                        <option value=<?php echo  $row['RegionID']?>><?php echo $row['RegionDescription']?></option>
                    <?php } ?>    
                </select>
            </div>
            
            
            <?php 
                if(isset($_SESSION['msg']))
                echo "<div class='inputsGroup'> <p class='danger'>" . $_SESSION['msg'] ."</p></div>" ;
                ?>
           
            
            <div style="text-align: center;">
                <button>submit</button>
            </div>
        </form>
    </div>
    <?php 
    unset($_SESSION['msg']); 
    unset($_SESSION['user']); 
    ?>
</body>
</html>