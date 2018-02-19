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
        <title>Marinzara | Isoko</title>
    </head>
    <?php
        include 'admin/db.php';
        include 'functions.php';


    ?>
<body>

    <div class="mpage page">
        <?php
            if(isset($_GET['sell'])){
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $target = $_POST['target']??"";
                    $group = $_POST['group']??"";
                    $quantity = $_POST['quantity']??"";

                    $q = $conn->query("INSERT INTO sales(crop, quantity, target) VALUES(\"$crop\", \"$quantity\", \"$target\") ") or die("$conn->error");
                    if($q){
                        die();
                        // header("location:market.php");
                    }
                    

                }
            }
        ?>
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
                        <li class="list-group-item"><button class="btn btn-success pull-right"  data-toggle="modal" data-target="#sell_modal"><i class="fa fa-balance-scale"></i> GURISHA</button></li>
                    </ul>
                </div>
                <div class="col-md-8">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Umusaruro </h5>
                        <?php
                            $umurima = $_GET['umurima']??'';
                            if($umurima){
                                ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            
                                        </div>
                                    </div>
                                <?php
                            }else{
                                ?>
                                    <p class="card-text">Hano mwahabona umusaruro w'imirima ihagaritse ndetse mukamenya uko isoko ryifashe mukabona n'abandi bacuruzi nibyo bacuruza</p>
                                <?php
                                foreach ($systems as $key => $system) {
                                    ?>
                                        <div class="card">
                                            <div class="card-block">
                                                <h6 class="card-title"><?php echo $system['name']; ?></h6>
                                                <ul class="list-group">
                                                    <li class="list-group-item">Production: <?php echo rand(8,15) ?> kg</li>
                                                </ul>
                                            </div>
                                        </div>                                        
                                    <?php
                                }
                            }
                        ?>                       
                        
                      </div>
                    </div>
                    <div class="mt-4"></div>
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title">Isoko</div>
                            <div style="padding-left: 12px;">
                                <p>Ibicuruzwa byawe</p>
                                <?php
                                    $sales = $conn->query("SELECT * FROM sales JOIN system_crops ON sales.crop = sales.crop");
                                    while ($sale = $sales->fetch_assoc()) {
                                        ?>
                                            Ikiribwa: <?php echo $sale['name'] ?><br />
                                            Ingano: <?php echo $sale['quantity'] ?><br />
                                            Abaguzi: <?php echo $sale['target'] ?><br />
                                            <div class="mt-5"></div>
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
            <div class="row no-gutters">
                <div class="col col-4">
                    <div class="menu-item">
                        <a href="index.php"><span><i class="fa fa-2x fa-dashboard"> </i></span> Ubuhinzi</a>
                    </div>
                </div>
                <div class="col col-4">
                    <div class="menu-item m_active">
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

    <div class="modal fade" id="sell_modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sakaza umusaruro wawe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form id="sell_form" method="POST" action="market.php?sell">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleSelect1">Uragurisha he umusaruro?</label>
                    <select class="form-control" id="select_sell" name="target">
                        <option>hitamo ..</option>
                        <option value="abaturanyi">Abaturanyi</option>
                        <option value="abacuruzi">Abacuruzi</option>
                        <option value="abatishoboye">Abatishoboye</option>
                        <option value="Abatunganya ibiribwa">Abatunganya ibiribwa</option>
                        <option value="hose">Kuri buri wese ubishaka</option>
                    </select>
                </div>
                <div class="form-group">
                    <?php
                        $systems = get_systems(1);
                            for ($n=0; $n < count($systems); $n++) {
                                $crops = get_crops($systems[$n]['id']);
                                for($i=0; $i<count($crops); $i++){
                                    ?>
                                        <?php echo $crops[$i]['name']; ?>
                                    <?php
                                }
                            }
                    ?>
                    <label for="exampleSelect1">Ubwoko bw'igihingwa?</label>
                    <select class="form-control" id="crop_type" name='group'>
                        <option>hitamo ..</option>
                        <?php
                            $systems = get_systems(1);
                            for ($n=0; $n < count($systems); $n++) { 
                                $crops = get_crops($systems[$n]['id']);
                                for($i=0; $i<count($crops); $i++){
                                    ?>
                                        <option value="<?php echo $crops[$i]['id']; ?>"><?php echo $crops[$i]['name']; ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea">Ingano y'ibigurishwa(kg)</label>
                    <input type="number" class="form-control" id="quantity_in" name="quantity" aria-describedby="emailHelp" placeholder="ingano mu biro">
                    <small id="emailHelp" class="form-text text-muted">Hari ingano utarenza hakuwemo ibyo umuryango wawe urarya!</small>
                </div>

              <div class="form-group">
                <label for="ifoto">Hari ifoto yabyo?</label>
                <input type="file" class="form-control-file" id="ifoto" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Izafasha abantu kugura byihuse, si itegeko.</small>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input">
                  Ndemera amategeko y'uburuzi agenga ubu buryo
                </label>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Reka</button>
                <button type="submit" class="btn btn-primary">Emeza</button>            
            </div>
        </form>          
        </div>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>
