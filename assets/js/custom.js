// wait for the DOM to be loaded 
$(document).ready(function() { 
    // bind 'myForm' and provide a simple callback function    
    $('#form-submit').ajaxForm({ 
        beforeSubmit: validate, 
        // dataType identifies the expected content type of the server response 
        dataType:  'json',
        // success identifies the function to invoke when the server response 
        // has been received 
        success:   processJson 
    }); 
}); 

function processJson(data) { 
    // 'data' is the json object returned from the server     
    if(data.msg == 'success'){
      notificationMsg(data.notice);
        if(data.href !== ''){
          setTimeout(function(){ 
            window.location.replace(data.href);
          }, 2000);
          btnSpinner('hide'); 
        }    
    }else{ 
      var errors = '';
      if(isValidJSONString(data.notice)){
        const obj = JSON.parse(data.notice);        
        $.each(obj, function( index, value ) {
          $('input[name="'+index+'"]').css('border', '1px solid red');
          errors += '<li>'+value+'</li>';
        });  
      }else{
        errors += '<li>'+data.notice+'</li>';
      }      
      $('.error-container').html(errorMsg(errors));      
      btnSpinner('hide');     
    }       
}

function validate(formData, jqForm, options) {
  $('.error-container').html('');
  btnSpinner('show');
  var isValid = true; 
  for (var i=0; i < formData.length; i++) { 
      if (!formData[i].value) { 
        $('input[name="'+formData[i].name+'"]').css('border', '1px solid red');            
        isValid = false;
      }else{
        $('input[name="'+formData[i].name+'"]').css('border', '1px solid #d1d3e2'); 
      }
  } 
  
  if(isValid== false){
    btnSpinner('hide'); 
    return false;
  } 
}

function isValidJSONString(str) {
  try {
      JSON.parse(str);
  } catch (e) {
      return false;
  }
  return true;
}

function errorMsg(msg){
  return '<div class="alert alert-danger alert-dismissible">'+
  '<button type="button" class="close" data-dismiss="alert">&times;</button>'+msg+'</div>';
}

function btnSpinner(mode){
  var text = $('.spinner-button').data('text');
  if(mode == 'show'){
    $('.spinner-button').prop("disabled", true);
    $('.spinner-button').html('<span class="spinner-border spinner-border-sm"></span> '+text);
  }else{
    $('.spinner-button').prop("disabled", false);
    $('.spinner-button').html(text);
  }
}

function notificationMsg(msg) {
	Snackbar.show({
		pos: 'top-center',
		text: msg,
		customClass: 'snackbar-alert'
	});
	
}



