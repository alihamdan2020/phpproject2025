<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test stripe</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: darkgrey;
        }

        form {
            border: 5px solid whitesmoke;
            padding: 10px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 1px 1px 8px rgba(0,0,0,0.5);
            background-color: sandybrown;
        }

        .card-header {
            background-color: saddlebrown;
            margin: 10px 0px;
            border-radius: 5px;
        }

        .card-header h3 {
            padding: 5px 10px;
            text-align: center;
            text-transform: uppercase;
            color:white;
        }
        span{
            color:red
        }

        .card-body {
            text-align: center;
        }

        .card-footer {
            margin: 10px 0px;
            text-align: center;
        }

        .card-footer button {
            padding: 5px 10px;
            border-radius: 10px;
            border: 0;
            background-color: teal;
            color: white;
            text-transform: capitalize;
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <form action="checkout.php">
        <div class="card">
            <div class="card-header">
                <h3>product name <span> 20 $</span></h3>
            </div>
            <div class="card-body">
                <img src="images/pepsi.jpg" alt="">
            </div>
            <div class="card-footer">
                <button>check out</button>

            </div>
        </div>
    </form>
</body>

</html>