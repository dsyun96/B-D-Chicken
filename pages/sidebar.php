<div class="col-lg-3" style="padding-right: 3%; padding-left: 2%">
  <div class="container">
      <div class="card">
          <div class="card-body">
                  <?php

                  if (!isset($_SESSION['usr_id'])) {
                  ?>
                  <div class="text-center">
                      <img src="../../assets/images/Text_Logo.svg" height=100 class="img_top" style="width: 5rem;" />
                      <img src="../../assets/images/Chicken_Logo.svg" height=150 style="width: 7rem;" />
                  </div>
                  <h5 class="card-title">로그인</h5>
                  <form method="POST" action="../user/login.php">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="이메일" name="email" >
                          <input type="password" class="form-control" placeholder="패스워드" name="password">
                      </div>
                      <button type="submit" class="btn btn-primary form-control">로그인</button>
                      <div class="my-1">
                          <div class="float-left">
                              <a href="../user/register.php">회원가입</a>
                          </div>

                          <div class="float-right">
                              <a href="../user/idfind.php">이메일 찾기</a>
                              <a href="../user/pwfind.php">비밀번호 찾기</a>
                          </div>
                      </div>
                  </form>
                  <?php
                  } else {
                  $role_sql = "SELECT `role` FROM `authorities` WHERE `userId` = " . $_SESSION['usr_id'];
                  $result = mysqli_query($con, $role_sql);
                  while ($row = mysqli_fetch_assoc($result))
                      $auth[] = $row['role'];

                  if (in_array("IS_ADMIN", $auth))
                      $isAdmin = true;
                  else
                      $isAdmin = false;

                  $notBaedal = 0;
                  $isBaedal = 0;
                  $completeBaedal = 0;

                  $point_sql = "SELECT `point` FROM `user` WHERE `userId` = " . $_SESSION['usr_id'];
                  $user_sql = "SELECT `baedal`, `completeTime` FROM `baedal_list`";

                  if (!$isAdmin)
                      $user_sql .= " WHERE `userId` = " . $_SESSION['usr_id'];

                  $result = mysqli_query($con, $point_sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                      $point = $row['point'];
                  }

                  $result = mysqli_query($con, $user_sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                      if ($row['baedal'] == 0 && $row['completeTime'] == NULL) {
                          $notBaedal++;
                      } else if ($row['completeTime'] == NULL) {
                          $isBaedal++;
                      } else {
                          $completeBaedal++;
                      }
                  }



                  ?>
                  <h5 class="text-title">회원정보
                  <?php
                  if ($isAdmin)
                      echo "[관리자]";
                  ?>
                  </h5>
                  <div class="card m-0">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-6 form-group">이름</div>
                              <div class="col-6"><?php echo $_SESSION['usr_name']; ?></div>

                              <div class="col-6">포인트</div>
                              <div class="col-6"><?php echo $point; ?></div>

                              <div class="col-6">주문완료</div>
                              <div class="col-6"><?php echo $notBaedal; ?> 건</div>

                              <div class="col-6">배송중</div>
                              <div class="col-6"><?php echo $isBaedal; ?> 건</div>

                              <div class="col-6">배송완료</div>
                              <div class="col-6"><?php echo $completeBaedal; ?> 건</div>
                          </div>

                      </div>
                  </div>
                  <a class="btn btn-secondary full_button text-white" href="../user/profile.php">내 정보</a>
                  <div class="text-right my-1">
                      <a href="../user/logout.php">로그아웃</a>
                  </div>
                  <?php
                  }

                  ?>
                </div>
            </div>


      <div class="card" onclick="location.href='../chicken/baedal.php'">
          <div class="card-body">
              <div class="btn btn-lg btn-red full_button text-left">
                  <span class="large_font">배달조회</span>
                  <div style="float: right;"><img src="../../assets/images/box.svg" style="width: 6rem; height: 7rem" /></div>
              </div>
          </div>
      </div>

      <div class="card" onclick="location.href='../community/notice.php'">
          <div class="card-body">
              <div class="btn btn-lg btn-yellow full_button text-left">
                  <span class="large_font">
                      커뮤니티
                      <div style="float: right; padding-top: 10px;">
                          <img src="../../assets/images/Q&A.svg" style="width: 4rem; height: 4rem;" />
                      </div>
                      <br>& 자유게시판
                  </span>
              </div>
          </div>
      </div>

      <div class="card">
          <div class="card-body">
              <div class="btn btn-lg btn-gray full_button text-center">
                  <span class="one_line_height large_font">
                      스포츠 중계
                      <br>
                      사이트 연결
                      <br>
                  </span>
                  <img src="../../assets/images/sports.png" style="height: 11.5rem" onclick="window.open('../../popup/sports.php', '_blank', 'width=523, height=530, toolbar=no, scrollbars=no, resizable=yes');">

              </div>
          </div>
      </div>
    </div>

  </div>
