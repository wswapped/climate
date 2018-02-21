<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="aqvert team">
        <link rel="shortcut icon" href="assets/images/logo.png">
        <link rel="stylesheet" type="text/css" href="css/facss/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Marinzara</title>
    </head>
    <?php
        include 'admin/db.php';
        include_once "functions.php";
    ?>
<body>
    <div class="page">
        <div class="mt-3"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block card-body">
                            <div class="card-title mod-title text-center">Fertilizer supply requests</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Field owner</th>
                                      <th scope="col">Fertilizer</th>
                                      <th scope="col">Quantity</th>
                                      <th scope="col">Date needed</th>
                                    </tr>
                                </thead>
                                <tbody>                            
                                <?php
                                    $fields = array();
                                    $query = $conn->query("SELECT * FROM field_fertilizer JOIN fertilizer ON field_fertilizer.fertilizer = fertilizer.id JOIN fields ON field_fertilizer.field = fields.id ") or die("error getting fields $conn->error");
                                    $n = 0;
                                    while ($data = $query->fetch_assoc()) {
                                        $fields[$data['id']] = $data;
                                        $ownerName = $data['ownerName']??"Muhinzi";

                                        //getting message
                                        $next_message = next_message($data['id']);
                                        $nmessage = $next_message['text'];

                                        $message = str_ireplace("\$name", $ownerName, str_ireplace("\$litters", rand(10, 20), 
                                            str_ireplace("\$fert_kg", rand(6, 9), $nmessage)));
                                        ?>
                                        <tr data-message="<?php echo $message; ?>" data-phone="<?php echo $data['phone']; ?>">
                                          <th scope="row"><?php echo $n+1; ?></th>
                                          <td><?php echo $data['ownerName']; ?></td>
                                          <td data-role='phone'><?php echo $data['name']; ?></td>
                                          <td><?php echo $data['quantity']; ?> kg</td>
                                          <td><?php echo $data['date_needed']; ?></td>
                                        </tr>
                                        <?php
                                        $n++;
                                    } 
                                ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><button class="btn btn-info" id="sendbroadcasts" data-message="<?php echo $message; ?>">Take Requests <i class="fa fa-envelope"></i></button></td>
                                    </tr>                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container-fluid menu-stick-footer container-full">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col col-4">
                        <div class="menu-item m_active">
                            <a href="index.php"><span><i class="fa fa-2x fa-dashboard"> </i></span> Ubuhinzi</a>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="menu-item">
                            <a href="market.php"><span><i class="fa fa-2x fa-shopping-basket"> </i></span> Ubucuruzi</a>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="menu-item">
                            <a href="profile.php"><span><i class="fa fa-2x fa-user"> </i></span> Ibindanga</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $("#sendbroadcasts").on('click', function(){
            //getting messages to send
            messages_elem = $(this).parents("table").find("tr:not(:last-child)");

            //Looping through messages
            for(n=0; n<messages_elem.length; n++){
                message_elem = messages_elem[n]
                message = $(message_elem).data('message');
                phone = $(message_elem).data('phone');

                $.post('api/index.php', {action:'send_sms', phone:phone, message:message}, function(data){
                    console.log(data)
                })
            }
        });

        function log(data){
            console.log(data)
        }
    </script>
</body>

</html>
