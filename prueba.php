<?Php
    $db = new mysqli('localhost', 'root', '', 'muni_ticket');
    mysqli_query($db,"SET NAMES 'utf8'");

    $query = mysqli_query($db, "SELECT * FROM tickets");
    //$result = mysqli_fetch_assoc($query);

    while($result = mysqli_fetch_assoc($query)){
        //var_dump($result);
        echo $result['asunto'];
        echo '<br/>';
    }
?>