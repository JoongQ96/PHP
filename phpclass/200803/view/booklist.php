<!doctype html>
<html>
<head>
</head>
<body>
    <table border=1 cellspacing=5 cellpadding=5 bgcolor="#ccff99">
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>Description</td>
        </tr>
        <?php
            foreach($books as $book) {
                echo '<tr><td><a href="index.php?book='.
                    $book->title.'">'.$book->title.'</a></td>';
                echo '<td>'.$book->author.'</td>';
                echo '<td>'.$book->description.'</td></tr>';
            }
        ?>
    </table>
</body>
</html>



