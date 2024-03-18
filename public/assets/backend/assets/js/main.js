$.noConflict();


jQuery(document).ready(function($) {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	});

	jQuery('.selectpicker').selectpicker;


	$('.select2').select2();

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	$('.equal-height').matchHeight({
		property: 'max-height'
	});

	// var chartsheight = $('.flotRealtime2').height();
	// $('.traffic-chart').css('height', chartsheight-122);


	// Counter Number
	$('.count').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 3000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			}
		});
	});


	 
	 
	// Menu Trigger
	$('#menuToggle').on('click', function(event) {
		var windowWidth = $(window).width();   		 
		if (windowWidth<1010) { 
			$('body').removeClass('open'); 
			if (windowWidth<760){ 
				$('#left-panel').slideToggle(); 
			} else {
				$('#left-panel').toggleClass('open-menu');  
			} 
		} else {
			$('body').toggleClass('open');
			$('#left-panel').removeClass('open-menu');  
		} 
			 
	}); 

	 
	$(".menu-item-has-children.dropdown").each(function() {
		$(this).on('click', function() {
			var $temp_text = $(this).children('.dropdown-toggle').html();
			$(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>'); 
		});
	});


	// Load Resize 
	$(window).on("load resize", function(event) { 
		var windowWidth = $(window).width();  		 
		if (windowWidth<1010) {
			$('body').addClass('small-device'); 
		} else {
			$('body').removeClass('small-device');  
		} 
		
	});
    
    
	
	$("#category").change(function(){
     var category_id=$(this).val();
    //  alert(category_id);
     if(category_id!='')
     {
        //  alert('firing');
          $.ajax({
                type: 'post',
                url: '/admin/getSubCategories',
                data: {category_id:category_id},
                success: function (data) {
                    
                    $('#subcategory').html(data); 
                    if($('#oldsubcategory').length){
                        var oldsubcategory=$('#oldsubcategory').val();
                        if(oldsubcategory!='')
                        $('#subcategory').val(oldsubcategory);
                    }
                    
                }
            });
     }
});


$(".parentselect").change(function(){
     var parent_id=$(this).val();
     var child_id=$(this).data('child_id');
     var child_model=$(this).data('child_model');
     var path=$(this).data('ajax_path');
     var parent_model=$(this).data('parent_model');

    //  alert(category_id);
     if(parent_id!='')
     {
        //  alert('firing');
          $.ajax({
                type: 'post',
                url: path,
                data: {parent_id:parent_id,child_model:child_model,parent_model:parent_model},
                success: function (data) {
                    
                    $('#'+child_id).html(data); 
                    if($('#old'+child_id).length){
                        var oldsubcategory=$('#old'+child_id).val();
                        if(oldsubcategory!='')
                        $('#'+child_id).val(oldsubcategory);
                    }
                    
                }
            });
     }
});

if($('#category').length){
        // alert()
        if($('#category').val()!=''){
            $('#category').trigger("change");
        }
    }
    
    $('#bootstrap-data-table thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#bootstrap-data-table thead');
 
    var table = $('#bootstrap-data-table').DataTable({
        columnDefs:[{targets:1,className:"truncate"}],
    createdRow: function(row){
       var td = $(row).find(".truncate");
       td.attr("title", td.html());
  },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }, 'print'
        ],
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 console.log('hello')
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });

 
});