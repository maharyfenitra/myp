$('.input_switch').click(function (){
//alert("click");
  
  var val = $(this).html();
  var id = $(this).attr("alt");
  //var parent = current.parent();
  if(!$(this).hasClass("active")){
    if($(this).hasClass("lbl")){
      $(this).html("<input type='text' width= '100%' class='input_switch_value box lbl' value='"+val+"'/>");
    }
    if($(this).hasClass("dsc")){
      $(this).html("<input type='text' style= 'width:100%;color :red;' class='input_switch_value box dsc' value='"+val+"'/>");
    }
      
      $(this).addClass("active");
      var current = $(this);
      $('.input_switch_value').focus();
      $(".input_switch_value").blur(function (){
        if($(this).hasClass("lbl")){
          $.post("processType.php",{"update_label":id,val : $(this).val()},function(data){
              console.log(data);
          });
        }else{
          $.post("processType.php",{"update_description":id,val : $(this).val()},function(data){
              console.log(data);
          });
          
        }
        current.removeClass("active");
        current.html($(this).val());
      })
  }
  
})
function getconfirm(){
  var con=confirm("Are you sure to delete this one?");
}

function addType(){ 
  var reponse = prompt("Please enter the new type", "");
  if(reponse!=null){
    window.location="processType.php?addtype="+reponse+"";
}
	
	}