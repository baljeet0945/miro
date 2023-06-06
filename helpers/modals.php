<?php require_once('classes/config.php'); 

if(isset($_SESSION['admin']['result']['user_set']) && ($_SESSION['admin']['result']['user_set'] == 1)) {  // admin access only..
	if(count($_GET)){
		if(isset($_GET['id']) && ($_GET['id']!=="") && isset($_GET['action']) && ($_GET['action']!=="")){

			if($_GET['action']=="user_delete"){
					$id = $_GET['id'];?>	
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Delete User?</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body ">Do you really want to delete a faq? </div>
						<div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
							<a class="btn btn-primary" href="<?php echo SITE_URL ?>/helpers/functions.php?type=<?= base64_encode('delete_faq')?>&del_id=<?= $id ?>">Yes</a>
						</div>
					</div>
			<?php } 		
		} 
	} 
}


if(count($_GET)){
	if(isset($_GET['id']) && ($_GET['id']!=="") && isset($_GET['action']) && ($_GET['action']!=="")){
		if($_GET['action']=="delete_user"){
			$id = $_GET['id'];?>	
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete User?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body ">Do you really want to delete a user? </div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
					<a class="btn btn-primary" href="<?= SITE_URL ?>/helpers/functions.php?type=<?= base64_encode('delete_user')?>&del_id=<?= $id ?>">Yes</a>
				</div>
			</div>
		<?php } 	
	} 
}

?>
