<?php
    require 'db.php';
    $res = mysqli_query($db, "SELECT * FROM titles ORDER BY id DESC LIMIT 5");
 
    $titles = [];
    if ($res) {
        while($row = mysqli_fetch_assoc($res)){
            $titles[] = $row;
        }   
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset = "utf-8" />
    <title>Ajax-loading by scrolling</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
    <h3>Ajax-loading by scrolling</h3>
    <div id="titles">
        <?php foreach ($titles as $title): ?>
            <p><?php echo $title['title']; ?></p>
        <?php endforeach ?>
    </div>
 
    <script type="text/javascript">
        $(document).ready(function(){
            var inProgress = false;
            var startFrom = 5;
            
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !inProgress) {
                    $.ajax({
                        url: 'ajax.php',
                        method: 'POST',
                        data: {
                            "start" : startFrom
                        },
                        beforeSend: function() {
                            inProgress = true;
                        }
                    }).done(function(data){
                        data = jQuery.parseJSON(data);
                        if (data.length > 0){
                            $.each(data, function(index, data){
                                $("#titles").append("<p>" + data.title + "</p>");
                            });
                            inProgress = false;
                            startFrom += 5;
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>