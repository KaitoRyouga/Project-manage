<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="home.css">
    <style type="text/css">
        table, th, td{
            /*border:1px solid #ccc;*/
            border:1px solid #868585;
            text-align: center;
        }
        table{
            border-collapse:collapse;
            overflow:auto;
        }
        tr:hover{
            background-color:#ddd;
            cursor:pointer;
        }
        table tr:nth-child(1){
            background-color:skyblue;
        }
        input{
            width: 100px;
        }

        input[name="submit"]{
            margin: 20px auto;
        }

        a{
            text-decoration: none;
        }

        a:hover{
            color: red;
        }
        .container #menu input{
            float: right;
            margin-top: 6px;
            height: 20px;
        }

        .container #menu button{
            margin-top: 6px;
            margin-left: 10px;
            float: right;
            width: 26px;
            height: 26px;
        }

        .container #menu img{
            width: 20px;
            height: 20px;
            margin-left: -5px;
        }

        .container #menu #form-search{
            margin-top: 20px;
        }

        #cap{
            margin-bottom: 20px;
        }

    </style>
    <title>Table</title>
</head>

<body>
    <div class="container">
        <strong><span style="font-size: 30px">Product Management</span> </strong>
        <div class="a">
            <a href="login.php"> <button class="button" type="button">Login</button></a>
            <a href="register.php"><button class="button" type="button">Register</button></a><br>
            <br>

        </div>
        <div id="menu">
            <ul>
                <li><a href="#">Input</a></li>
                <li><a href="history.php">History</a></li>
                <form action="#" method="POST" id="form-search">
                    <button type="submit" name="submit_search" form="form-search"><img src="images/magnifier.svg"></button>
                    <input type="text" name="search" id="search" placeholder="Search">
                </form>
                <?php

                ?>
            </ul>
        </div>
        <form action="#" method="POST">
            <table border="1"; width="100%">
                <caption id="cap"><strong>THÔNG TIN SẢN PHẨM</strong></caption>
                <tbody>
                    <?php
                        require_once 'class/edit.php';
                        require_once 'config.php';
                        $edit = new edit();
                        if (!empty($_POST["search"])) {
                            $item_code_search = $_POST["search"];
                            $edit->form_search($item_code_search);
                            die();
                        }
                        $edit->create_manage();
                        $edit->delete();
                        if (!empty($_POST["submit"])) {
                            $row = $edit->nrow();
                            for ($i=1; $i <= $row; $i++) { 
                                $quantity = $_POST["name_step" . $i];
                                $edit->update($quantity, $i);
                            }
                        }
                        if (!empty($_POST["submit_name"])) {
                            $name = $_POST["name_item_input"];
                            $code_item = $edit->create_code_item();
                            echo '<script type="text/javascript">alert("Code item of '.$name.' is: '.$code_item.' ");</script>';
                            $quantity_insert = $_POST["name_step_insert"];
                            $edit->insert($code_item, $name, $quantity_insert);
                        }
                    ?>
                </tbody>
            </table>
            <input type="submit" name="submit" value="accept">
        </form>
        <a href="insert.php">Insert item with administrator permissions</a>
    </div>
</body>

</html>