
<?php
    $host = "eu-cdbr-azure-north-a.cloudapp.net";
    $user = "b58e714ddd9e63";
    $pwd = "fd104d27";
    $db = "CommunityPodcast374";

    try
    {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e)
    {
        echo "We no make mistake";
    }
   
    $sql_select = "SELECT * FROM user";
    $stmt = $conn->query($sql_select);
    $result = $stmt->fetchAll();

    echo "<table>";
    foreach($result as $value)
    {
        echo "<tr><td>";
        echo $value['username'];
        echo "</td><td>";
		echo $value['email'];
        echo "</td></tr>";
        
    }
    echo "</table>";
?>
