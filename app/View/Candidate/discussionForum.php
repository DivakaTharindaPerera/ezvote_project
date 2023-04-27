<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/side_bar.php'; ?>

<div class="border-2 border-dark border-radius-5 w-65 p-2 bg-light h-75" style="margin-left:250px; overflow-y: scroll; scrollbar-width: none; margin-top:10vh;">
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
                <label for="usr">Write your name:</label>
                <input type="text" class="form-control" name="Rname" required>
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

  <div class="" style="margin-top:20px">
    <div>
      <h3>Community forum</h3>
      <hr>
      <form name="frm" method="post">
        <input type="hidden" id="commentid" name="Pcommentid" value="0">
        <div>
          <label for="usr">Write your name:</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div>
          <label for="comment">Write your question:</label>
          <input type="text" class="form-control m-1" rows="5" name="msg" style="height:10vh;" required>
        </div>
        <br>
        <input type="button" id="butsave" name="save" class="btn btn-primary" value="Send">
      </form>
    </div>
    <!-- </div> -->


    <div class="">
      <div class="">
        <br>
        <h4>Recent questions</h4>
        <table class="" id="MyTable">
          <tbody id="record">

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
<script src="<?php echo urlroot; ?>/js/discussion.js"></script>
<?php
require approot . '/View/inc/footer.php';
?>