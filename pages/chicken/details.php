<?php
$con = mysqli_connect("220.68.91.224", "chicken", "passwd", "chicken") or die("ERROR" . mysqli_error($con));
$con->set_charset("utf8");
?>
<!DOCTYPE html>
<html>
    <head>
    <?php include "../header.php"; ?>
    </head>
    <body>
    <?php include "../navbar.php"; ?>

  <!-- Page Content -->
  <div class="container-fluid" style="padding-left: 125px; padding-right: 125px; background-image: url('../../assets/images/background-2.png');">
    <div class="row">
         <div class="col-lg-9 text-center">
 		        <div class="col-lg-12 mt-4">
              <div class="btn btn-yellow full_button">
                <span class="huge_font" style="float: left; padding-left: 1.5rem;">치킨 상세정보</span>
              </div>
            </div>
              <div class="card">
                <div class="row no-gutters">
                   <?php
                   $sql = "SELECT `ID`, `title`, `price`, `context`,
                   (SELECT `url` FROM `item_images` WHERE `itemId` = `items`.`ID`) as `url` FROM `items` WHERE `ID` = ".$_GET['id'];
                   $result = mysqli_query($con, $sql);
                   $rows = mysqli_fetch_assoc($result);
                   echo '
                   <div class="col-auto p-2">
                     <img src="../../'.$rows['url'].'" alt="card image">
                   </div>
                   <div class="col text-left">
                     <div class="card-body px-2">
                       <h1 class="card-title huge_font">'.$rows['title'].'</h3>
                       <h3 class="card-subtitle text-muted mt-1">'.$rows['price'].'원</h4>
                       <h4 class="card-text mt-4">'.$rows['context'].'</p>
                       <div class="form-group row">
                         <div class="col-8">
                           <input class="form-control" type="number" value="1" min="1">
                         </div>
                         <a class="btn btn-primary" href="#">주문하기</a>
                       </div>
                     </div>
                   </div>
                   ';
                    ?>
                 </div>
             </div>
             <div class="card mt-0">
               <div class="card-title mb-0">
                 <p class="huge_font text-left ml-4 mt-3 mb-0">평가</p>
               </div>
               <div class="card-body pt-0">
                 <?php
                   $sql = "SELECT `name`, `title`, `context` FROM `items_comment` WHERE itemsId = ".$_GET['id'];
                   $result = mysqli_query($con, $sql);
                   while($row = mysqli_fetch_assoc($result)) {
                     echo '
                       <div class="card mt-0">
                               <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-2 huge_font">
                                       <p>'.$row['name'].'</p>
                                     </div>
                                     <div class="col-md-10">
                                         <p class="text-left col-md-12"><strong>'.$row['title'].'</strong></p>
                                         <div class="clearfix text-left col-md-12"><p>'.$row['context'].'</p></div>
                                     </div>
                                 </div>
                         </div>
                     </div>
                     ';
                   }
                  ?>
               </div>
             </div>
             <div class="card mt-0 mb-3">
               <div class="card-title">
                 <p class="huge_font float-left ml-4 mt-2 mb-0">댓글 작성</p>
               </div>
               <div class="card-body p-1">
                 <form method="post" action="details_comment.php" class="ml-3">
                   <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                   <input class="form-control col-2" type="text" name="name" placeholder="이름" value="<?php if(isset($name)){echo $name;} ?>">
                   <input class="form-control col-2" type="text" name="title" size=60 placeholder="제목" value="<?php if(isset($title)){echo $title;} ?>">
                   <textarea class="form-control col-10" name="context" cols=85 rows=6 placeholder="내용" value="<?php if(isset($context)){echo $context;} ?>" ></textarea>
                   <input class="btn btn-yellow btn-radius mx-1 my-2" type="submit" value="작성">
                 </form>
               </div>
             </div>
         </div>
         <!-- /.col-lg-9 -->
         <?php include "../sidebar.php"; ?>
     </div>
     <!-- /.row -->

  </div>
  <!-- /.container -->

  <?php include "../footer.php"; ?>

    </body>
</html>
