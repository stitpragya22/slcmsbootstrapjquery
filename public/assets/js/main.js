if($('#myCarousel').length){
$('#myCarousel').carousel({
            interval: 2000
        });

        //scroll slides on swipe for touch enabled devices

        $("#myCarousel").on("touchstart", function(event){

            var yClick = event.originalEvent.touches[0].pageY;
            $(this).one("touchmove", function(event){

                var yMove = event.originalEvent.touches[0].pageY;
                if( Math.floor(yClick - yMove) > 1 ){
                    $(".carousel").carousel('next');
                }
                else if( Math.floor(yClick - yMove) < -1 ){
                    $(".carousel").carousel('prev');
                }
            });
            $(".carousel").on("touchend", function(){
                $(this).off("touchmove");
            });
        });
}


    
    var frm = $('#companyForm');
    frm.submit(function (ev) {
        ev.preventDefault();
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function (data) {
                    
                    var title1= "Error !";
                    let result = data.includes("Successfully");
                    if(result)
                    {   
                        title1="Successful !";
                        $("#companyForm").trigger('reset');
                    }
                    Swal.fire({
  title: title1,
  icon: 'info',
  html:data,
  showCloseButton: true,
  focusConfirm: false,
})    
                }
            });


//   $("#companyForm").valid();
});


   $('#apply-now-Form').submit(function (ev) {
        ev.preventDefault();
        frm2=  $(this);
        var formData = new FormData($(this)[0]);


            $.ajax({
                type: frm2.attr('method'),
                url: frm2.attr('action'),
                data: formData,
                cache : false,
                processData: false,
                contentType: false,
                success: function (data) {
                    
                    var title1= "Error !";
                    let result = data.includes("Successfully");
                    if(result)
                    {   
                        title1="Successful !";
                        $("#apply-now-Form").trigger('reset');
                    }
                    Swal.fire({
                      title: title1,
                      icon: 'info',
                      html:data,
                      showCloseButton: true,
                      focusConfirm: false,
                    })    
                }
            });


//   $("#companyForm").valid();
});


//triggered when modal is about to be shown
$('#ApplyModal').on('show.bs.modal', function (event) {
            var modal       = $(this);
            var userid=$(event.relatedTarget).attr("data-user");
            var jobid=$(event.relatedTarget).attr("data-jobid");
            var jobtitle=$(event.relatedTarget).attr("data-jobtitle");
            var role=$(event.relatedTarget).attr("data-role");
            if(userid<1 || userid=='' || role!='')
            {
                event.preventDefault()
            Swal.fire({
                    title: '<strong>You Must Login To Apply This Job!!</strong>',
                    icon: 'info',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer:`<a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2"  onclick="Swal.close();" >Login</a>`
                });
    
            }
            else{
                // alert(jobtitle)
                modal.find('.modal-title').text('Applying For : '+jobtitle)
                modal.find('#jobid').val(jobid);
                
                // $('#apply_Email').text(userid);
            }
        });
