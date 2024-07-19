<html>

<head>
    <title>vulnproj</title>
    <link rel="stylesheet" href="style.css">
</head>

<div class="root">
    <h1>User Data Entry</h1>
    <form action="<? echo "Database.class.php" ?>" method="post" enctype="multipart/form-data">
        <div class="container">
            Name : <input type="text" id="username" name="username">
            <br>
            User ID : <input type="text" id="userid" name="userid">
            <br>
            Profession : <input type="text" id="profession" name="profession">
            <br>
            File : <input type="file" id="file" name="file">
            <br>
            <input type="submit" id="sub" name="submit">
        </div>
    </form>
    <div class="space" style="color: black; background-color:#6D5D6E">
        <h3>User Entered Data</h3>
        <?
        if (isset($_POST['submit'])) {
            $filename = $_FILES['file']['name'];
            $filetype = $_FILES['file']['type'];
            $filetmp = $_FILES['file']['tmp_name'];
            if (file_exists('C:/xampp/htdocs/php/datafolder/' . $_FILES['file']['name'])) {
                echo "File Already Exists";
            } else {
                move_uploaded_file($filetmp, 'C:/xampp/htdocs/proj/vulnerablecode/datafolder/' . $_FILES['file']['name']);
        ?>
                <center>
                    <div class="container" id="datas">
                        <center>
                            <?
                            $pattern = "/[()']/i";
                            echo "<br>";
                            echo "User Name : " . preg_replace($pattern, "", strip_tags($_REQUEST['username']));
                            echo "<br>";
                            echo "<br>";
                            echo "User ID : " . preg_replace($pattern, "", strip_tags($_REQUEST['userid']));
                            echo "<br>";
                            echo "<br>";
                            echo "Profession : " . preg_replace($pattern, "", strip_tags($_REQUEST['profession']));
                            echo "<br>";
                            echo "<br>";
                            echo "File Name : " . $filename;
                            echo "<br>";
                            echo "<br>";
                            echo "File Type : " . $filetype; ?>
                            echo "<br>";
                        </center>
                    </div>
                </center>
        <?
            }
        }
        ?>
    </div>
</div>

</html>
