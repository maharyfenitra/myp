$("#birthday").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy', yearRange: "1950:+nn" });
     $('.ui-datepicker-calendar').width(100);
$(document).ready(function() {
    $('#monForm').on('submit', function(e) {

     //Debut fonction
        
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
 
        var $this = $(this);
 
        var pseudo = $('#pseudo').val();
        var mail = $('#mail').val();
        var p_1=$('#password').val();
        var p_2=$('#password_2').val();
       // alert(p_1+"  "+p_2);
        if(p_1!==p_2||p_1===''){
           alert("<?php echo db_get_text_($lang, 'all', 'wrong_confirm_password'); ?>");
            }else
        if(pseudo === '' || mail === '') {
            alert("<?php echo db_get_text_($lang, 'all', 'missing_important_field'); ?>");
             //  return;
                } else {
             $("#monForm").hide();
         $("#register").hide();
         
            $.ajax({
                url: $this.attr('action'),
                type: $this.attr('method'),
                data: $this.serialize(),
               // dataType: 'json', // JSON
                success: function(json) {
                         if(json!=0){
                           $("#monForm").show();
                           $("#register").show();
                            alert("<?php db_get_text($lang, 'all', 'compte_already_exist'); ?>");
                            }else{
                            
                            $("#welcome").show();
                            
               }
                            //
                   
                }


            });
        }
    });
});