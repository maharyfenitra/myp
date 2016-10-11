$(".pdprice").click(function (){
    var pdi = $(this).attr("alt").split("-");
      
          
              var current = $(this);
              
              if(!current.hasClass("active")){
                
                current.addClass("active");
                //var cuv= trim($(this).html());
                $(this).html("<input type='text' id='pricein' style='text-align:right;' class='box' value='"+trim($(this).html())+"' />");
              }
              $("#pricein").focus();
              $("#pricein").blur(function (){
              var val=$(this).val();
              current.html(val);
              current.removeClass("active");
              $.post("cycle.php",{"update_price_by_ajax":1,"pd_id" : pdi[0],"tid": pdi[1],"val" : val},function(data){
                  console.log(data);
              });

      });
   
  })