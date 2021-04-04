
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Trang bán điện thoại</title>
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="index.css">
  <style>
    


  </style>
  <script>
    $(document).ready(function(){
      $("#btn-buy").click(function(){
        var url_string = window.location.href;
        var url = new URL(url_string);
        var idsp = url.searchParams.get("id");
        $.get("themcart.php" , {id: idsp}, function(result){
          var s = document.getElementById('tong-menu').innerHTML;
          var s1 = parseInt(s, 10);
          document.getElementById('tong-menu').innerHTML = (s1 + 1);
        });
      });
    });
    function themcart(id){
      $.get("themcart.php", {id: id} , function(result){
        var s = document.getElementById('tong-menu').innerHTML;
        var s1 = parseInt(s , 10);
        document.getElementById('tong-menu').innerHTML = (s1 + 1);
      });
    };
  </script>
</head>
<?php
  $conn = mysqli_connect("localhost", "root", "", "banhang");
  $sql = "SELECT *FROM hanghoa ORDER BY id DESC";
  $ketqua = mysqli_query($conn, $sql); 
?>

<body style="background-color:#E6E6E6;">
  <?php include('menu.php'); ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel" >
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
     
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active" style="height: 100%">
        <img src="image/banner1.png" width="100%" height="100%">
      </div>

      <div class="item" style="height:100%">
        <img src="image/banner2.jpg" width="100%" height="100%">
      </div>

      <div class="item" style="height:100%">
        <img src="image/banner3.jpg" width="100%" height="100%">
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <div class="container container-card" style="margin-top: 100px; background-color:#2389da; ">
    <div style="background-color:">
      <h1>The Firm</h1>
    </div>
    <hr style="height:1px;background-color: gray;">
    <?php 
      $sql = "SELECT *FROM danhmuc ";
      $ketqua1 = mysqli_query($conn, $sql); 
      while($row1 = mysqli_fetch_assoc($ketqua1)){
    ?>
    
    <div class="col-sm-3 ">
      <div class="card" align="center">
        <div class="card-header" align="center">
          <?php echo "<img src='image/".$row1['image']."' alt='' width='99%' height='100%'>";
          ?>
        </div>
        <div class="card-body" style="height: 50px;">
          <?php echo "<a href='danhmuchang.php?iddanhmuc=".$row1['id']."&page=1' >".$row1['tendanhmuc']."</a>" ;?> 
        </div>
        <?php
          if (isset($_COOKIE['user']))
            if($_COOKIE['user'] == 'admin'){
              echo "<div class='card-footer' align='center'>";
              echo "<button style='color= white;'><a href = 'suadanhmuc.php?id=".$row1['id']."' title= ''>Edit Firm </a> </button>";
              echo "<button style='color:white'> <a href='Xoadm.php?id=".$row1['id']."' title=''>Delete</a></button>";
                
              echo "</div>";  
            }
          ?>
        <div class = "height1"></div>
      </div>
      <div class="height1"></div>
    </div>
      <?php
    }
      ?>
    
  </div>

  <div class="container container-card" style="margin-top: 100px; background-color:#2389da;">
    <h1>PHỔ BIẾN</h1>
    <hr style="height: 2px; background:#ffffff;">
      <div class="row">
      <div class="col-md-6 ">
        <div class="card" align="center">
          <div class="card-header" align="center">
            <img src="image/oppoA92.png" alt="" width="100%" height="100%">
          </div>
          <div class="card-body">
            <p>Iphone 8 plus</p>
            <span class="gia">12000000 <sub>đ</sub></span> <span class="giagiam">15000000 <sub>đ</sub></span>
          </div>
          <div class="card-footer">
            <button style="color:white;">Mua</button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-sm-6 ">
            <div class="card" align="center">
              <div class="card-header" align="center" >
                <img src="image/ip11max.png" alt="" width="99%" height="100%" >
              </div>
              <div class="card-body">
                <p>Iphone 11 Max</p>
                <span class="gia">12000000 <sub>đ</sub></span> <span class="giagiam">15000000 <sub>đ</sub></span>
              </div>
              <div class="card-footer" align="center">
                <button style="color:white;">Mua</button>
              </div>
            </div>  
          </div>
          <div class="col-sm-6 ">
            <div class="card" align="center">
              <div class="card-header" align="center">
                <img src="image/ssNote20ustral.png" alt="" width="99%" height="100%">
              </div>
              <div class="card-body">
                <p>Sam sung Note 20</p>
                <span class="gia">12000000 <sub>đ</sub></span> <span class="giagiam">15000000 <sub>đ</sub></span>
              </div>
              <div class="card-footer" align="center">
                <button style="color:white;">Mua</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 ">
            <div class="card" align="center">
              <div class="card-header" align="center">
                <img src="image/oppoA92.png" alt="" width="99%" height="100%">
              </div>
              <div class="card-body">
                <p class="name-product">Iphone 8 plus</p>
                <span class="gia">12000000 <sub>đ</sub></span> <span class="giagiam">15000000 <sub>đ</sub></span>
                        </div>
              <div class="card-footer">
                <button style="color:white;">Mua</button>
              </div>
            </div>
          </div>
          <div class="col-sm-6 ">
            <div class="card" align="center">
              <div class="card-header" align="center">
                <img src="image/ip11max.png" alt="" width="99%" height="100%" >
            </div>
            <div class="card-body">
              <p>Iphone 11 Max</p>
              <span class="gia">12000000 <sub>đ</sub></span> <span class="giagiam">15000000 <sub>đ</sub></span>
            </div>
            <div class="card-footer" align="center">
                <button style="color:white;">Mua</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class= "height1"></div>
  </div>

    <div class="container container-card" style="background-color:#2389da; margin-top:50px;">
      <h1>NEW UPDATE</h1>
      <hr style="height: 2px; background:#ffffff;">

    <?php
      $row;
      while($row = mysqli_fetch_assoc($ketqua)){
        echo "<div class='col-md-3'>
            <div class='card' align='center'>
              <div class='card-header' align='center'>
                <img src='image/".$row['img']."' alt='' width='99%' height='70%'>
              </div>
              <div class='card-body'>";
                echo "<p><a href='detail_ip11max.php?id=".$row['id']."' style='' class='name-product'>".$row['tenmathang']."</a></p>";
                echo "<hr style='border-width:1px; border-color:#dcdcdc'>";
                echo "<h5>Colour</h5>
                          <ul class='ul-color'>
                            <li><a class='orange active'></a></li>
                            <li><a class='green'></a></li>
                            <li><a class='yellow'></a></li>
                          </ul>" ;
                echo "<p><span class='gia'>"; echo number_format($row['dongia']); echo "<sub style='font-weight:none;'>đ</sub></span</p>";
              echo "</div>
              <div class='card-footer' align='center'>
                <a href='detail_ip11max.php?id=".$row['id']."'>
                  <button style='color:white;'>detail</button>
                </a>
                <a onclick='themcart(".$row['id'].")'>
                  <button style='color:white;'>Buy</button>
                </a>
              </div>
              <div class='height1'>
              </div>
            </div>
            <div class='height1'>
              
            </div>
          </div>";
     }
    
     ?>

    </div>
    
    <div class="container-fluid" style="margin-top:50px">
      <iframe class="" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7727075351686!2d108.24774916707567!3d15.97324179069998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108878ee1dbf%3A0xb466fcf06b910a38!2zS2hvYSBDw7RuZyBuZ2jhu4cgdGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIC0gxJDhuqFpIGjhu41jIMSQw6AgTuG6tW5n!5e0!3m2!1svi!2s!4v1603006436564!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>

     <?php include_once('footer.php'); ?>
    <?php
     // $s = var_dump($_SESSION['cart']);
     // echo $s;
    ?>
</body>
</html>