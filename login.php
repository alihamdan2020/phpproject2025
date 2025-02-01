<?php include "header.php" ?>
<body>
    <div class="formSignIn">
        <form action="signin.php" method="post">
            <h3>log in</h3>
            <div class="inputsGroup">
                <input type="text" 
                name="user" 
                placeholder=" "
                autocomplete="off"
                id="username" 
                value= <?php if(isset($_SESSION['user'])) echo $_SESSION['user'] ?>>
                <label for="username">User Name</label>
            </div>
            
            <div class="inputsGroup">
                <input type="password" 
                name="pass" 
                id="password"
                placeholder=" "
                autocomplete="off">
                
                <label for="password">Password</label>
            </div>
            
            
            <?php 
                if(isset($_SESSION['msg']))
                echo "<div class='inputsGroup'> <p class='danger'>" . $_SESSION['msg'] ."</p></div>" ;
                ?>
           
            
            <div style="text-align: center;">
                <button>submit</button>
                <div style="margin-top:10px">
                    <a href="signup.php">You dot have an account ?</a>
                </div>
            </div>
        </form>
    </div>
    <?php 
    unset($_SESSION['msg']);
    unset($_SESSION['user']);
    ?>
</body>
</html>