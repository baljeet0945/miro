<?php include('../helpers/classes/boards.php');
$objBoard = new BOARD;
$board = $objBoard->getCardItem(array('board_id'=>$_SESSION['admin']['result']['board_id'], 'card_id'=>$_SESSION['admin']['result']['card_id']));
    //($board);die;
include('elements/restricted.php');
include('elements/head.php');
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include('elements/sidebar.php');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include('elements/navbar.php');?>
            
                <!-- Begin Page Content -->
                <div class="container-fluid">

                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Miro Board</h1>
                        <!-- <button data-toggle="modal" data-target="#exampleModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-plus fa-sm text-white-50"></i> Invite User</button> -->
                    </div>
                    <?= FD_print_notices() ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4"> 
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Mission Statement</h6>                                   
                        </div>                       
                        <div class="card-body">
                            <textarea class="form-control" id="statement" rows="10" placeholder="Type Here..."><?= $board['result'] ?> </textarea>
                            <button type="button" class="btn btn-primary mt-3" onclick=openMiroBoard();>Open Miro Board</button>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Miro</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body"> 

              </div>
              <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>                    
              </div>
          </div>
      </div>
  </div>

<?php include('elements/footer.php');?>
<script>
    function loader(action, animation=null, text=null) {
      if(action == 'show'){
          $('body').loadingModal({'animation': animation, 'text':text, 'color':'#ffffff', 'backgroundColor': '#484646e0', 'opacity':'0.6'});
       }else{
          $('body').loadingModal('hide');
          $('body').loadingModal('destroy');
       }     
    }
</script>
<script type="text/javascript">
	var board_id = '<?= $_SESSION['admin']['result']['board_id']?>';
	var card_id = '<?= $_SESSION['admin']['result']['card_id']?>';

	function openMiroBoard(link){
		var statement = document.getElementById("statement").value;		
		$.ajax({  
            url:"<?= HELPER_URL?>add_statement",
            method:"POST",
            beforeSend: function(){
            loader('show', 'chasingDots', 'Please wait...');
            },  
            data:{'statement':statement, 'board_id':board_id, 'card_id':card_id},
            dataType:"json",
            success:function(response)
            {    
            console.log(response);  
            loader('hide');     
            if(response.msg == 'success'){
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#myModal').modal('show');
                $("#myModal .modal-body").html('<iframe id="frame" src="https://miro.com/app/live-embed/'+board_id+'/?moveToWidget='+card_id+'&embedAutoplay=true" frameBorder="0" scrolling="no" allowFullScreen width="100%" height="400px"></iframe>');
                $('#submit_payment span').removeClass('spinner-border');
            }else{
                notificationMsg(response.notice);
            }		        
            }
        });
	}


$('#myModal').on('hide.bs.modal', function (event) {
    $.ajax({  
      url:"<?= HELPER_URL?>get_statement",
      method:"POST",
      beforeSend: function(){
        loader('show', 'chasingDots', 'Please wait while update mission statement...');
      },  
      data:{'board_id':board_id, 'card_id':card_id},
      dataType:"json",
      success:function(response)
      {    
       console.log(response);  
       loader('hide');   
        if(response.msg == 'success'){
        	var statement = document.getElementById("statement").value = response.result;	
        }else{
        	notificationMsg(response.notice);
        }        
      }
  });
})

</script>

</body>

</html>