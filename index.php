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
        <title>Marinzara | Murakaza neza</title>
    </head>
    <?php
        include 'admin/db.php';
    ?>
<body>
    <div class="page">
        <div class="container">
            <div class="mt-3"></div>
            <div class="row no-gutters">
                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item active">Imirima</li>
                        <?php
                            $systems = array();
                            $query = $conn->query("SELECT * FROM systems WHERE ownerId = 1 ") or die("error getting systems $conn->error");
                            while ($data = $query->fetch_assoc()) {
                                $systems[$data['id']] = $data;
                                ?>
                                <li class="list-group-item"><a href="index.php?umurima=<?php echo $data['id']; ?>" class="no-deco"> <?php echo $data['name']; ?></a></li>
                                <?php
                            } 
                        ?>

                    </ul>
                </div>
                <div class="col-md-8">
                    <div class="">
                        <div class="card home-intro-cont">
                        <div class="card-body home-intro">
                            <h5 class="card-title">Imitere n'umusaruro </h5>
                            <?php
                                $umurima = $_GET['umurima']??'';
                                if($umurima){
                                    ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item text-primary">Amakuru ku murima</li>
                                                    <li class="list-group-item">Ubugari: cm <?php echo $systems[$umurima]['width']; ?></li>
                                                    <li class="list-group-item">Uburebure: <?php echo $systems[$umurima]['stages']; ?></li>
                                                    <li class="list-group-item">Umusaruro wose: <?php echo $systems[$umurima]['total_produce']; ?></li>
                                                    <li class="list-group-item">Umubare w'ibihingwa: </li>
                                                    <li class="list-group-item">Igihe kindi cyo gusarura: <i><?php echo date("d-m-Y", strtotime(date("d-m-Y"). ' + 4 days')) ?></i></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-8">
                                                <h1><?php echo $systems[$umurima]['name']; ?></h1>
                                                <div class="mb-5"></div>
                                                <p>Umurima wawe ugenewe: <i class="text-primary"><?php echo $systems[$umurima]['purpose']; ?></i></p>
                                                <p>Ubwoko bw'umurima: <i class="text-primary"><?php echo $systems[$umurima]['type']; ?></i></p>

                                                <a href="admin" class="btn btn-primary umurima-cta">Kurikirana umurima</a>
                                            </div>
                                        </div>
                                    <?php
                                }else{
                                    ?>
                                        <p class="card-text">Murakaza neza ku rubuga rw'ubuhinzi bwanyu. Mushobora kumenyera hano ibijyanye n'ubuhinzi, mukabona inama ku mirima y'impagaricye</p>
                                        <p>Ushobora kandi no gutangira gucuruza, guteganyiriza umuryango ndetse no kureba amakuru yimbitse</p>
                                    <?php
                                }
                            ?>                        
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid menu-stick-footer container-full">
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
        </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>
