<html>
<head></head>
<body>
    <table border=1 cellspacing=5 cellpadding=5 bgcolor=#00ff99>
        <?php
            echo "<tr><td>Title</td><td>".$book->title."</td></tr>";
            echo "<tr><td>Author</td><td>".$book->author."</td></tr>";
            echo "<tr><td>Description</td><td>".$book->description."</td></tr>";
        ?>
    </table>
</body>
</html>
