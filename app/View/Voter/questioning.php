<?php
//echo '<pre>';
//print_r($data);
//exit();
require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
  <div class="title">Discussion Forum</div>
  <div class="border-2 border-primary border-radius-5 min-w-80 max-w-80  p-2 bg-white-0-7 h-75 " style="overflow-y: scroll; scrollbar-width: none;">
  <!-- Modal -->
  <div class="dialog-box-outer" id="popup">
    <div id="ReplyModal" class="ReplyModal p-3 w-45" role="dialog">
      <div class="">

        <!-- Modal content-->
        <!-- reply dialog box -->
        <div class="">
          <div class="">
            <!-- <button type="button" class=""  onclick="closePopup()">&times;</button> -->
            <h4 class="">Reply Question</h4>
            <br>
          </div>
          <div class="modal-body">
            <form name="frm1" method="post">
              <input type="hidden" id="commentid" name="Rcommentid">
              <div class="">
                <!-- <label for="usr">Write your name:</label> -->
                <input style="display:none;" type="text" class="form-control" name="Rname" value="<?= $result2[0]->candidateName ?>">
              </div>
              <div class="">
                <label for="comment">Write your reply:</label>
                <input type="text" class="form-control" rows="5" name="Rmsg" style="height:10vh;" required>
              </div>
              <br>
              <input type="button" id="btncancel" name="btncancel" class="btn btn-danger" value="Cancel" onclick="closePopup()">
              <input type="button" id="btnreply" name="btnreply" class="btn btn-primary" value="Reply">

            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- posting the question -->
  <!-- <div class="container"> -->

  <div class="mt-2">
    <div>
      <div class="sub-title">Q & A</div>
      <hr>
      <form name="frm" method="post">
        <input type="hidden" id="commentid" name="Pcommentid" value="0">
        <div>
          <!-- <label for="usr">Write your name:</label> -->
          <br>
          <input style="display:none;" type="text" class="form-control" name="name" value="<?= $result->Name?>">
        </div>
        <div>
          <label for="comment">Ask your question:</label>
          <input type="text" class="form-control m-1 border border-primary border-radius-1 border-1" rows="5" name="msg" style="height:10vh;" required>
        </div>
        <br>
        <input type="button" id="butsave" name="save" class="btn btn-primary w-20" value="Send">
      </form>
    </div>
    <!-- </div> -->


    <div class="">
      <div class="">
        <br>
        <div class="text-lg mb-1">Recent questions</div>
        <div class="d-flex flex-column bg-white shadow">
        <input type="hidden" id="profile_picture" value="<?php echo $_SESSION['profile_picture'];?>" style="border-radius: 50%">
        <table class="" id="MyTable">
          <tbody id="record">

          </tbody>
        </table>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
<script src="<?php echo urlroot; ?>/js/discussion.js"></script>
<?php
// require approot . '/View/inc/footer.php';
?>
