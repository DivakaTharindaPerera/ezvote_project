<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/side_bar.php'; ?>

<!-- <div class="border-2 border-radius-2 border-dark">
<h1>Discussion Forum</h1>
<hr>
<p>Write your name:</p>
</div> -->






<!-- Modal -->
<div id="ReplyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reply Question</h4>
      </div>
      <div class="modal-body">
        <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
        	<div class="form-group">
        	  <label for="usr">Write your name:</label>
        	  <input type="text" class="form-control" name="Rname" required>
        	</div>
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" rows="5" name="Rmsg" required></textarea>
            </div>
        	 <input type="button" id="btnreply" name="btnreply" class="btn btn-primary" value="Reply">
      </form>
      </div>
    </div>

  </div>
</div>

<div class="container">

<div class="panel panel-default" style="margin-top:50px">
  <div class="panel-body">
    <h3>Community forum</h3>
    <hr>
    <form name="frm" method="post">
        <input type="hidden" id="commentid" name="Pcommentid" value="0">
	<div class="form-group">
	  <label for="usr">Write your name:</label>
	  <input type="text" class="form-control" name="name" required>
	</div>
    <div class="form-group">
      <label for="comment">Write your question:</label>
      <textarea class="form-control" rows="5" name="msg" required></textarea>
    </div>
	 <input type="button" id="butsave" name="save" class="btn btn-primary" value="Send">
  </form>
  </div>
</div>
  

<div class="panel panel-default">
  <div class="panel-body">
    <h4>Recent questions</h4>           
	<table class="table" id="MyTable" style="background-color: #edfafa; border:0px;border-radius:10px">
	  <tbody id="record">
		
	  </tbody>
	</table>
  </div>
</div>

</div>

  <!-- *********************apply nomination************************************************************************************** -->
<!-- <div class="form border-1 border-dark p-2 text-1xl bg-light" style=" margin-top:60px; ">
        <form action="/ezvote/Candidates/nomination_apply" method="POST" enctype='multipart/form-data' >

    <h1 class="text-center">Community forum</h1>
    <label for="usr">Write your name:</label>
	  <input type="text" class="border-1 border-dark" name="name" required>

    <label for="comment">Write your question:</label><br>
      <textarea type="text" class="border-1 border-dark" rows="5" cols="65" name="msg" required></textarea>
<br><br>
    <button type="submit" id="btn" name="save" class="btn bg-primary text-white w-25">Send</button>
    <br><br>
</form>
</div> -->
  <!-- *********************apply nomination*********************************************************************************** -->



<div class="panel panel-default">
  <div class="panel-body">
    <h4>Recent questions</h4>           
	<table class="table" id="MyTable" style="background-color: #edfafa; border:0px;border-radius:10px">
	  <tbody id="record">
		
	  </tbody>
	</table>
  </div>
</div>

</div>

<!-- 
        <h2 class="" style="margin-left:200px; margin-top:30px;">Discussion Forum</h2>

        <div class="border-2 border-dark border-radius-5 m-1 p-1 bg-light" style="width:800px; margin-left:250px; box-shadow: 5px 5px #888888">
        
        <div class="d-flex">
        <img src="<?php echo urlroot; ?>/img/welcome/boy2.jfif" alt="Profile image" class="border-radius-13" style="width:100px; height:100px;"/>
        <p class="px-2 text-dark"><br>John Doe<br>12min ago</p>
        <p class="px-5">How could your vision be possible?</p>
        </div>

        <div style="padding-left:500px;">
        <img src="<?php echo urlroot; ?>/img/welcome/like.png" alt="like" class="" style="width:30px; height:30px; cursor:pointer;"/> Like -->
        <!-- <img src="<?php echo urlroot; ?>/img/welcome/reply.png" alt="reply" class="" style="width:30px; height:30px; cursor:pointer;"/> Reply -->
        <!-- <button class="btn bg-primary text-white text-1xl w-25 " style="margin-left:50px; "  onclick="openPopup()">Reply</button>
        </div>
        
        </div>
        <div class="dialog-box-outer" id="popup">
                                    <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                        <div class="title">My reply</div>
                                        <form action="#" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                                           
                                            <div class="d-flex flex-column my-1 w-100">
                                                <label for="Description" class="mr-1 text-left text-md">Write your name:</label>
                                                <textarea id="Description" class="border-1" name="Description" style="width: 100%"></textarea>
                                            </div>

                                            <div class="d-flex flex-column my-1 w-100">
                                                <label for="Description" class="mr-1 text-left text-md">Write your reply:</label>
                                                <textarea id="Description" class="border-1" name="Description" style="height: 150px;width: 100%"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-between my-1 w-100">
                                                <div><button class="btn btn-danger px-1" onclick="closePopup()">Cancel</div>
                                                <div ><button class="btn btn-primary px-1" type="submit">Reply</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
</div>
        <div class="border-2 border-dark border-radius-5 m-1 p-1 bg-light" style="width:800px; margin-left:250px; box-shadow: 5px 5px #888888">
        
        <div class="d-flex">
        <img src="<?php echo urlroot; ?>/img/welcome/girl.jpg" alt="Profile image" class="w-10 h-50 border-radius-13" style="width:100px; height:100px;"/>
        <p class="px-2 text-dark"><br>Michel Rose <br>6h ago</p>
        <p class="px-5">What is your future plan as the president?</p>
        </div>

        <div style="padding-left:500px;">
        <img src="<?php echo urlroot; ?>/img/welcome/like.png" alt="like" class="" style="width:30px; height:30px; cursor:pointer;"/> Like
        <img src="<?php echo urlroot; ?>/img/welcome/reply.png" alt="reply" class="" style="width:30px; height:30px; cursor:pointer;"/> Reply
        </div>
        
        </div>

        <div class="border-2 border-dark border-radius-5 m-1 p-1 bg-light" style="width:800px; margin-left:250px; box-shadow: 5px 5px #888888">
        
        <div class="d-flex">
        <img src="<?php echo urlroot; ?>/img/welcome/girl2.jpg" alt="Profile image" class="w-10 h-50 border-radius-13" style="width:100px; height:100px;"/>
        <p class="px-2 text-dark"><br>Hanna Lussifer <br>12h ago</p>
        <p class="px-5">What were your previous social works?</p>
        </div>

        <div style="padding-left:500px;">
        <img src="<?php echo urlroot; ?>/img/welcome/like.png" alt="like" class="" style="width:30px; height:30px; cursor:pointer;"/> Like
        <img src="<?php echo urlroot; ?>/img/welcome/reply.png" alt="reply" class="" style="width:30px; height:30px; cursor:pointer;"/> Reply
        </div>
        
        </div> -->
    <?php 
    // require approot.'/View/inc/footer.php';
    ?>