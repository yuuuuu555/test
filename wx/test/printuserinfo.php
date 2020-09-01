<?php
    session_start();
    $userInfo = isset($_SESSION['userInfo']) ? $_SESSION['userInfo'] : [];

?>
<!DOCTYPE html>
<html
    lang="en">
<head>
    <meta
        charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>
        Document
    </title>
</head>
<body>
    <h3>信息
    </h3>
    <hr />
    <h3>列表
    </h3>
    <table
        width="600"
        border="1">
        <tr>
            <th>openid</th>
            <th>nickname</th>
            <th>sex</th>
            <th>language</th>
            <th>city</th>
            <th>province</th>
            <th>country</th>
            <th>headimgurl</th>
        </tr>
        <!-- <tr
            align="center">
            -$k为下标 -->
            <?php
            foreach($userInfo as $value){
                echo '<tr align="center">';
                // foreach($value as $k=>$v){
                //     if($k == 'sex'){
                //         echo "<td>".($v == 1?'男':'女')."</td>";
                //     }else{
                //         echo "<td>{$v}</td>";
                //     }
                // }
                echo "<td>{$value['openid']}</td><td>{$value['nickname']}</td><td>".($value['sex'] == 1? '男':'女')."</td><td>{$value['language']}</td><td>{$value['city']}</td><td>{$value['province']}</td><td>{$value['country']}</td><td>{$value['headimgurl']}</td>";

                echo '</tr>';
            }
            ?>
            <tr></tr>
        <!-- </tr> -->
    </table>
</body>
</html> 